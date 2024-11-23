<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\RoleRequest;
use Yajra\DataTables\DataTables;
use Auth, DB, Mail, Validator, File;

class RoleController extends Controller{
    /** index */
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Role::select('id', 'name', 'guard_name')->orderBy('id', 'asc')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $return = '<div class="btn-group">';

                    if (auth()->user()->can('role-read')) {
                        $return .= '<a href="' . route('role.read', ['id' => base64_encode($data->id)]) . '" class="btn btn-sm rounded-pill btn-icon">
                                                <i class="ri-eye-line"></i>
                                            </a> &nbsp;';
                    }

                    if (auth()->user()->can('role-update')) {
                        $return .= '<a href="' . route('role.update', ['id' => base64_encode($data->id)]) . '" class="btn btn-sm rounded-pill btn-icon">
                                                <i class="ri-edit-box-line"></i>
                                            </a>';
                    }

                    if (auth()->user()->can('role-delete')) {
                        $return .= '<a class="btn btn-sm rounded-pill btn-icon" href="javascript:void(0);" onclick="delete_func(this);" data-id="' . $data->id . '">
                                                <i class="ri-delete-bin-2-line"></i>
                                            </a> &nbsp;';
                    }

                    $return .= '</div>';

                    return $return;
                })

                ->editColumn('name', function ($data) {
                    return ucfirst(str_replace('_', ' ', $data->name));
                })

                ->rawColumns(['name', 'action'])
                ->make(true);
        }

        return view('role.index');
    }
    /** index */

    /** create */
    public function create(Request $request){
        $permissions = Permission::get();
        return view('role.create', ['permissions' => $permissions]);
    }
    /** create */

    /** insert */
    public function insert(RoleRequest $request){
        if ($request->ajax()) {
            return true;
        }

        $curd = [
            'name' => $request->name,
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $role = Role::create($curd);

        if ($role) {
            $role->syncPermissions($request->permissions);

            return redirect()->route('role')->with('success', 'Record inserted successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to insert record')->withInput();
        }
    }
    /** insert */

    /** update */
    public function update(Request $request){
        if (isset($request->id) && $request->id != '' && $request->id != null)
            $id = base64_decode($request->id);
        else
            return redirect()->route('role')->with('error', 'Something went wrong');

        $data = Role::find($id);
        $permissions = Permission::get();
        $role_permissions = DB::table("role_has_permissions as rhp")
                                ->join('permissions as p', 'rhp.permission_id', '=', 'p.id')
                                ->where("rhp.role_id", $id)
                                ->select('p.name')
                                ->get()
                                ->toArray();

        $array = [];
        foreach ($role_permissions as $value)
            $array[] = $value->name;

        return view('role.update')->with(['data' => $data, 'permissions' => $permissions, 'role_permissions' => $array]);
    }
    /** update */

    /** alter */
    public function alter(RoleRequest $request){
        if ($request->ajax()) { return true; }

        $role = Role::find($request->id);
        $role->name = $request->name;
        $role->updated_at = date('Y-m-d H:i:s');

        if ($role->save()) {
            $role->syncPermissions($request->permissions);

            return redirect()->route('role')->with('success', 'Record updated successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to update record')->withInput();
        }
    }
    /** alter */

    /** read */
    public function read(Request $request){
        if (isset($request->id) && $request->id != '' && $request->id != null)
            $id = base64_decode($request->id);
        else
            return redirect()->route('role')->with('error', 'Something went wrong');

        $data = Role::find($id);
        $permissions = Permission::get();
        $role_permissions = DB::table("role_has_permissions as rhp")
                                ->join('permissions as p', 'rhp.permission_id', '=', 'p.id')
                                ->where("rhp.role_id", $id)
                                ->select('p.name')
                                ->get()
                                ->toArray();

        $array = [];
        foreach ($role_permissions as $value)
            $array[] = $value->name;

        return view('role.read')->with(['data' => $data, 'permissions' => $permissions, 'role_permissions' => $array]);
    }
    /** read */

    /** delete */
    public function delete(Request $request){
        if (!$request->ajax()) { exit('No direct script access allowed'); }

        if (!empty($request->all())) {
            $id = $request->id;

            if ($id == 1)
                return redirect()->back()->with('error', 'Failed to update record');

            $delete = Role::where(['id' => $id])->delete();

            if ($delete)
                return response()->json(['code' => 200]);
            else
                return response()->json(['code' => 201]);
        } else {
            return response()->json(['code' => 201]);
        }
    }
    /** delete */
}
