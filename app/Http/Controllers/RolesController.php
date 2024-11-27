<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleStoreRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        $title = 'List';
        if ($request->ajax()) {
            $data = Role::select('id', 'name', 'guard_name')->orderBy('id', 'desc')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $return = '<div class="btn-group">';

                    $return .= '<button class="btn btn-icon btn-text-edit waves-effect waves-light edit-role" data-value="' . $data->name . '" data-id="' . $data->id . '">
                                           <i class="ri-edit-line"></i>
                                        </button> &nbsp;';

                    $return .= '<button class="btn btn-icon btn-text-delete waves-effect waves-light delete-role" data-id="' . $data->id . '">
                                            <i class="ri-delete-bin-line"></i>
                                        </button> &nbsp;';


                    $return .= '</div>';

                    return $return;
                })

                ->editColumn('name', function ($data) {
                    return ucfirst(str_replace('_', ' ', $data->name));
                })

                ->rawColumns(['name', 'action'])
                ->make(true);
        }
        return view("roles.index", compact("title"));
    }

    public function create()
    {
        $user = Auth::user();
        $title = 'Create';
        $role = $user->getRoleNames()->first(); // Fetch role name using Spatie's helper

        $permissions = \App\Models\Permission::visibleToRole($role)->get();
        return view('roles.create', compact('permissions', 'title'));
    }

    public function store(RoleStoreRequest $request)
    {
        dd('here');
        $role = Role::insertOrUpdate($request);

        if ($role) {
            return redirect()->route('role')->with('success', 'Record inserted successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to insert record')->withInput();
        }
    }

    public function delete(Request $request, $id)
    {
        if (!empty($id)) {
            $delete = Role::where(['id' => $id])->delete();

            if ($delete)
                return response()->json(['code' => 200]);
            else
                return response()->json(['code' => 201]);
        } else {
            return response()->json(['code' => 202]);
        }
    }
}
