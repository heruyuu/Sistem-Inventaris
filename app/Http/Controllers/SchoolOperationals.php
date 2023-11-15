<?php

namespace App\Http\Controllers;

use App\Helpers\Custom;
use App\Models\SchoolOperational;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SchoolOperationals extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            $result = SchoolOperational::orderBy('name','ASC');
            return DataTables::eloquent($result)
            ->addIndexColumn()
            ->addColumn('act', function($data) {
                return view('pages.school_operational.modal.action', compact('data'));
            })
            ->rawColumns(['act'])->make(true);
        }
        return view('pages.school_operational.index');
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
            $school_operational = SchoolOperational::create([
                'name'          => $request->name,
                'description'   => $request->description
            ]);
            return response()->json(['status' => 'success', 'messages' => 'Data Berhasil Ditamabhakan'], 201);
        } catch(QueryException $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'messages' => $e->errorInfo], 500);
        } finally {
            DB::commit();
        }
    }

    public function edit($id)
    {
        $data = SchoolOperational::find($id);
        return response()->json(['status' => 'success', 'messages' => 'Load Data', 'data' => $data], 201);
    }

    public function update(Request $request, $id)
    {
        $validate = [
            'name'         => 'required',
            'description'  => 'required'
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
            $school_operationals = SchoolOperational::find($id)->update($data);
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
        $data = SchoolOperational::find($id);
        return response()->json(['status' => 'success', 'messages' => 'Load Data', 'data' => $data], 201);
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $school_operational = SchoolOperational::find($id)->delete();
            return response()->json(['status' => 'success', 'messages' => 'Data Telah Dihapus'], 201);
        } catch(QueryException $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'messages' => $e->errorInfo], 500);
        } finally {
            DB::commit();
        }
    }
}
