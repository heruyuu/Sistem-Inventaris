<?php

namespace App\Http\Controllers;

use App\Helpers\Custom;
use App\Models\Comodities;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index()
    {
        $comodities = Comodities::count();
        $comodities_good = Comodities::where('condition', 1)->count();
        $comodities_notGood = Comodities::where('condition', 2)->count();
        $comodities_demage = Comodities::where('condition', 3)->count();
        $comodities_order = Comodities::orderBy('price','DESC')->take(5)->get();
        return view('pages.dashboard.index', compact('comodities', 'comodities_good', 'comodities_notGood', 'comodities_demage', 'comodities_order' ));
    }

    public function inSetting()
    {
        $data = User::all();
        return view('pages.dashboard.setting',compact('data'));
    }

    public function setStore(Request $request)
    {
        $validate = [
            'thumbnail'     => 'required|image|mimes:jpeg,jpg,png',
            'name'          => 'required',
            'email'         => 'required',
            'password'      => 'required',
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
            if($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $fileName = $file->getClientOriginalName().'.'. $file->getClientOriginalExtension();
                $file->move('public/img_user',$fileName);
            }

            $user = User::find($request->id);
            $pass = $request->password;

            if(!password_verify($pass, $user->password)) {
                return response()->json(['status' => 'warning', 'messages' => 'Password Salah !'], 422);
            }

            if(!empty($request->newPassword) || !empty($request->rePassword)) {
                if(empty($request->newPassword) || empty($request->rePassword)) {
                    return response()->json(['warning', 'messages' => 'New Password dan Re Password Tidak sama !'], 422);
                }
                if($request->newPassword != $request->rePassword) {
                    return response()->json(['status' => 'warning', 'messages' => 'New Password dan Re Password Tidak sama !'], 422);
                }
                $user->password = password_hash($request->newPassword, PASSWORD_DEFAULT);
            }

            // $user = User::update([
            //     'name'  => $request->name,
            //     'email' => $request->email,
            //     'foto'  => $fileName,
            // ]);
            $user->foto = $fileName;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            return response()->json(['status' => 'success', 'messages' => 'Profil Telah Berhasil Diubah'], 201);
        } catch(QueryException $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'messages' => $e->errorInfo], 500);
        } finally {
            DB::commit();
        }
    }
}
