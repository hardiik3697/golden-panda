@extends('layout.app')

@section('meta')
@endsection

@section('title')
Roles {{$title}}
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

<link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- DataTable with Buttons -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-6">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Roles {{$title}}</h5>
                    <small class="text-body float-end">{{ $title }} role</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('roles.store') }}" class="row g-5" method="post">
                        @csrf
                        @method('post')
                        <div class="col-4">
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
                        <div class="col-4">
                            <div class="form-floating form-floating-outline">
                                <select class="select2 form-select" name="guard" id="guard-name">
                                    <option value="web">Web</option>
                                </select>
                                <label for="modalEditUserFirstName">Guard Name</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-floating form-floating-outline">
                                <select class="select2 form-select" name="guard" id="permission-scope">
                                    <option value="all">All</option>
                                    <option value="superAdmin-only">Super Admin Only</option>
                                    <option value="admin">Admin</option>
                                </select>
                                <label for="modalEditUserFirstName">Permission For</label>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <div class="form-group">
                                <strong>Permissions:</strong>
                                <div class="row">
                                    <div class="col-sm-12 mb-3">
                                        <input type="checkbox" name="permissions[]" id="check-all">
                                        <span class="input-span"></span>Select All
                                    </div>
                                    @foreach($permissions as $value)
                                    <div class="col-sm-3">
                                        <label class="ui-checkbox ui-checkbox-success mt-2" for="checkbox-{{ $value->id }}">
                                            <input type="checkbox" name="permissions[]" class="permission-checkbox" id="checkbox-{{ $value->id }}" value="{{ $value->id }}">
                                            <span class="input-span"></span>{{ $value->name }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-center d-flex flex-wrap justify-content-center gap-4 row-gap-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
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
</div>

@endsection

@section('scripts')
<!-- Page JS -->
<script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
@endsection

@php
$pageJs = ['resources/js/project/roles/create.js'];
@endphp