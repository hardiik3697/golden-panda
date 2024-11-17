<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DataTables;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::select('id', 'name', 'guard_name')->orderBy('id', 'desc')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $return = '<div class="btn-group">';

                    $return .= '<button class="btn btn-icon btn-text-edit waves-effect waves-light edit-role" data-value="' . $data->name . '" data-id="' . $data->id . '">
                                           <i class="ri-edit-line"></i>
                                        </button> &nbsp;';

                    $return .= '<button class="btn btn-icon btn-text-delete waves-effect waves-light" href="javascript:void(0);" onclick="delete_func(this);" data-id="' . $data->id . '">
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
        return view("roles.index");
    }
}
