<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\PermissionRequest;
use Yajra\DataTables\DataTables;
use Auth, DB, Mail, Validator, File;

class PermissionController extends Controller{

    /** index */
        public function index(Request $request){
            if($request->ajax()){
                $data = Permission::select('id', 'name', 'guard_name')->orderBy('id', 'desc')->get();

                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($data){
                            $return = '<div class="btn-group">';

                            if (auth()->user()->can('permission-view')) {
                                $return .= '<a href="' . route('permission.view', ['id' => base64_encode($data->id)]) . '" class="btn btn-sm rounded-pill btn-icon">
                                                        <i class="ri-eye-line"></i>
                                                    </a> &nbsp;';
                            }
        
                            if (auth()->user()->can('permission-edit')) {
                                $return .= '<a href="' . route('permission.edit', ['id' => base64_encode($data->id)]) . '" class="btn btn-sm rounded-pill btn-icon">
                                                        <i class="ri-edit-box-line"></i>
                                                    </a>';
                            }
        
                            if (auth()->user()->can('permission-delete')) {
                                $return .= '<a class="btn btn-sm rounded-pill btn-icon" href="javascript:void(0);" onclick="delete_func(this);" data-id="' . $data->id . '">
                                                        <i class="ri-delete-bin-2-line"></i>
                                                    </a> &nbsp;';
                            }
        
                            $return .= '</div>';

                            return $return;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }

            return view('permission.index');
        }
    /** index */

    /** create */
        public function create(Request $request){
            return view('permission.create');
        }
    /** create */

    /** insert */
        public function insert(PermissionRequest $request){
            if($request->ajax()){ return true; }

            $curd = [
                'name' => $request->name,
                'guard_name' => $request->guard_name ?? 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $last_id = Permission::insertGetId($curd);

            if($last_id > 0)
                return redirect()->route('permission')->with('success', 'Record inserted successfully');
            else
                return redirect()->back()->with('error', 'Failed to insert record')->withInput();
        }
    /** insert */

    /** edit */ 
        public function edit(Request $request){
            if(isset($request->id) && $request->id != '' && $request->id != null)
                $id = base64_decode($request->id);
            else
                return redirect()->route('permission')->with('error', 'Something went wrong');

            $data = Permission::find($id);

            return view('permission.edit')->with(['data' => $data]);
        }
    /** edit */

    /** update */
        public function update(PermissionRequest $request){
            if($request->ajax()){ return true ;}

            $curd = [
                'name' => $request->name,
                'guard_name' => $request->guard_name ?? 'web',
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $update = Permission::where(['id' => $request->id])->update($curd);

            if($update)
                return redirect()->route('permission')->with('success', 'Record updated successfully');
            else
                return redirect()->back()->with('error', 'Failed to update record')->withInput();
        }
    /** update */

    /** view */
        public function view(Request $request){
            if(isset($request->id) && $request->id != '' && $request->id != null)
                $id = base64_decode($request->id);
            else
                return redirect()->route('permission')->with('error', 'Something went wrong');

            $data = Permission::find($id);

            return view('permission.view')->with(['data' => $data]);
        }
    /** view */

    /** delete */
        public function delete(Request $request){
            if(!$request->ajax()){ exit('No direct script access allowed'); }

            if(!empty($request->all())){
                $id = $request->id;
                $delete = Permission::where(['id' => $id])->delete();

                if($delete)
                    return response()->json(['code' => 200]);
                else
                    return response()->json(['code' => 201]);
            }else{
                return response()->json(['code' => 201]);
            }
        }
    /** delete */
}
