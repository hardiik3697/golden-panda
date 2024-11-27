@extends('layout.app')

@section('meta')
@endsection

@section('title')
Roles {{ $title }}
@endsection

@section('styles')
<!-- Page CSS -->
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
<!-- Row Group CSS -->
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}" />
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Roles {{$title}}</h5>
            <div class="col-xl-6 text-end">
                <a href="{{ route('roles.create') }}" id="add-roles" type="button" class="btn btn-outline-primary me-2 waves-effect">
                    Add Roles+
                </a>
            </div>
        </div>
        <div class="card-datatable table-responsive pt-0">
            <table id="datatables" class="datatables-basic table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Guard Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="addEditRole" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body p-0">
                <div class="text-center mb-6">
                    <h4 class="mb-2" id="role-form-title">Add Roles</h4>
                    <p class="mb-6" id="role-form-subtitle">Add a role provided access to predefined menus.</p>
                </div>
                <form id="addEditRoleForm" class="row g-5">
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <input
                                type="text"
                                id="modalRoleName"
                                name="name"
                                class="form-control"
                                placeholder="Admin" />
                            <label for="modalEditUserFirstName">Role Name</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <input
                                type="text"
                                id="modalRoleGuard"
                                name="guard"
                                class="form-control"
                                placeholder="Web" />
                            <label for="modalEditUserFirstName">Guard Name</label>
                        </div>
                    </div>
                    <div class="col-12 text-center d-flex flex-wrap justify-content-center gap-4 row-gap-4">
                        <button id="addEditRoleSubmit" type="submit" class="btn btn-primary">Submit</button>
                        <button
                            type="reset"
                            class="btn btn-outline-secondary"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Page JS -->
<script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
@endsection

@php
$pageJs = ['resources/js/project/roles/index.js'];
@endphp