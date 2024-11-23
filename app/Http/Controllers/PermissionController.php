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

                            if (auth()->user()->can('permission-read')) {
                                $return .= '<a href="' . route('permission.read', ['id' => base64_encode($data->id)]) . '" class="btn btn-sm rounded-pill btn-icon">
                                                        <i class="ri-eye-line"></i>
                                                    </a> &nbsp;';
                            }
        
                            if (auth()->user()->can('permission-update')) {
                                $return .= '<a href="' . route('permission.update', ['id' => base64_encode($data->id)]) . '" class="btn btn-sm rounded-pill btn-icon">
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

    /** update */ 
        public function update(Request $request){
            if(isset($request->id) && $request->id != '' && $request->id != null)
                $id = base64_decode($request->id);
            else
                return redirect()->route('permission')->with('error', 'Something went wrong');

            $data = Permission::find($id);

            return view('permission.update')->with(['data' => $data]);
        }
    /** update */

    /** alter */
        public function alter(PermissionRequest $request){
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
    /** alter */

    /** read */
        public function read(Request $request){
            if(isset($request->id) && $request->id != '' && $request->id != null)
                $id = base64_decode($request->id);
            else
                return redirect()->route('permission')->with('error', 'Something went wrong');

            $data = Permission::find($id);

            return view('permission.read')->with(['data' => $data]);
        }
    /** read */

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
