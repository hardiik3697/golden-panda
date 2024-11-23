<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\AccessRequest;
use Yajra\DataTables\DataTables;
use Auth, DB, Mail, Validator, File;

class AccessController extends Controller{

    /** index */
        public function index(Request $request){
            if($request->ajax()){
                $data = Role::select('id', 'name')->orderBy('id', 'desc')->get();

                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($data){
                            $return = '<div class="btn-group">';

                            if (auth()->user()->can('access-read')) {
                                $return .= '<a href="' . route('access.read', ['id' => base64_encode($data->id)]) . '" class="btn btn-sm rounded-pill btn-icon">
                                                        <i class="ri-eye-line"></i>
                                                    </a> &nbsp;';
                            }
        
                            if (auth()->user()->can('access-update')) {
                                $return .= '<a href="' . route('access.update', ['id' => base64_encode($data->id)]) . '" class="btn btn-sm rounded-pill btn-icon">
                                                        <i class="ri-edit-box-line"></i>
                                                    </a>';
                            }
        
                            $return .= '</div>';

                            return $return;
                        })

                        ->editColumn('permissions', function($data) {
                            return 'permissions';
                        })

                        ->editColumn('name', function($data) {
                            return ucfirst(str_replace('_', ' ', $data->name));
                        })

                        ->rawColumns(['name', 'action', 'permissions'])
                        ->make(true);
            }

            return view('access.index');
        }
    /** index */

    /** update */
        public function update(Request $request){
            if(isset($request->id) && $request->id != '' && $request->id != null)
                $id = base64_decode($request->id);
            else
                return redirect()->route('access')->with('error', 'Something went wrong');

            $permissions = Permission::select('id', 'name')->get();
            $roles = Role::select('id', 'name')->get();
            $data = Role::select('id', 'name')->where(['id' => $id])->first();
            $role_permissions = DB::table("role_has_permissions as rhp")
                                    ->join('permissions as p', 'rhp.permission_id', '=', 'p.id')
                                    ->where("rhp.role_id", $id)
                                    ->select('p.name')
                                    ->get()
                                    ->toArray();

            $array = [];
            foreach ($role_permissions as $value)
                $array[] = $value->name;

            return view('access.update')->with(['data' => $data, 'roles' => $roles, 'permissions' => $permissions, 'role_permissions' => $array]);
        }
    /** update */

    /** alter */
        public function alter(AccessRequest $request){
            if($request->ajax()){ return true ;}

            if(empty($request->permissions)){
                return redirect()->back()->with('error', 'Failed to update record')->withInput();
            }

            $permissions = array_map(function($row) { return $row; }, $request->permissions);

            $role = Role::find($request->role);
            
            if($role->permissions()->sync($permissions))
                return redirect()->route('access')->with('success', 'Record updated successfully');
            else
                return redirect()->back()->with('error', 'Failed to update record')->withInput();
        }
    /** alter */

    /** read */
        public function read(Request $request){
            if(isset($request->id) && $request->id != '' && $request->id != null)
                $id = base64_decode($request->id);
            else
                return redirect()->route('access')->with('error', 'Something went wrong');

            $permissions = Permission::select('id', 'name')->get();
            $roles = Role::select('id', 'name')->get();
            $data = Role::select('id', 'name')->where(['id' => $id])->first();
            $role_permissions = DB::table("role_has_permissions as rhp")
                                    ->join('permissions as p', 'rhp.permission_id', '=', 'p.id')
                                    ->where("rhp.role_id", $id)
                                    ->select('p.name')
                                    ->get()
                                    ->toArray();

            $array = [];
            foreach ($role_permissions as $value)
                $array[] = $value->name;

            return view('access.read')->with(['data' => $data, 'roles' => $roles, 'permissions' => $permissions, 'role_permissions' => $array]);
        }
    /** read */
}
