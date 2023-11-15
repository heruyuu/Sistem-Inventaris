<?php

namespace App\Http\Controllers;

use App\Helpers\Custom;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.login');
    }

    public function login(Request $request)
    {
        $validate = [
            'email'     => 'required',
            'password'  => 'required'
        ];
        $validation = Validator::make($request->all(), $validate, Custom::messages());
        if($validation->fails()) {
            return response()->json([
                'status'    => 'warning',
                'messages'  => $validation->errors()->first()
            ], 422);
        }

        DB::beginTransaction();
        try {
            $credentials = $request->only('email','password');
            $token = auth()->attempt($credentials);
            if(!$token) {
                return response()->json(['status' => 'warning', 'messages' => 'Login Gagal'], 422);
            }
            return response()->json(['status' => 'success', 'messages' => 'Login Success', 'data' => $token], 201);
        } catch(QueryException $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'messages' => $e->errorInfo], 500);
        } finally {
            DB::commit();
        }
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        return redirect('/login');
    }
}
