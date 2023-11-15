<?php

namespace App\Http\Controllers;

use App\Helpers\Custom;
use App\Models\ComodityLocation;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ComodityLocations extends Controller
{
    public function index(Request $request)
    {
        // $data = ComodityLocation::get()->first();
        if(request()->ajax()) {
            $result = ComodityLocation::orderBy('name','ASC');
            return DataTables::eloquent($result)
            ->addIndexColumn()
            ->addColumn('act', function($data) {
                return view('pages.comodity_locations.modal.action', compact('data'));
            })
            ->rawColumns(['act'])->make(true);
        }
        return view('pages.comodity_locations.index');
    }

    public function store(Request $request)
    {
        $validate = [
            'name'          => 'required',
            'description'   => 'required'
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
            $comodity_location = ComodityLocation::create([
                'name'          => $request->name,
                'description'   => $request->description
            ]);
            return response()->json(['status' => 'success', 'messages' => 'Data Success Ditambahkan'], 201);
        } catch(QueryException $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'messages' => $e->errorInfo], 500);
        } finally {
            DB::commit();
        }
    }

    public function edit($id)
    {
        $data = ComodityLocation::find($id);
        return response()->json([' status' => 'success', 'messages' => 'Load Data', 'data' => $data], 201);
    }

    public function update(Request $request, $id)
    {
        $validate = [
            'name'          => 'required',
            'description'   => 'required'
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
            $data = [
                'name'         => $request->name,
                'description'  => $request->description
            ];
            $comodity_location = ComodityLocation::find($id)->update($data);
            return response()->json(['status' => 'success', 'messages' => 'Data Berhasil Di Update'], 201);
        } catch(QueryException $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'messages' => $e->errorInfo], 500);
        } finally {
            DB::commit();
        }
    }

    public function show($id)
    {
        $data = ComodityLocation::find($id);
        return response()->json(['status' => 'success', 'messages' => 'Load Data', 'data' => $data], 201);
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $comodity_location = ComodityLocation::find($id)->delete();
            return response()->json(['status' => 'success', 'messages' => 'Data Telah Dihapus'], 201);
        } catch(QueryException $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'messages' => $e->errorInfo], 500);
        } finally {
            DB::commit();
        }
    }
}
