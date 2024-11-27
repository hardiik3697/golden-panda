@extends('layout.app')

@section('meta')
@endsection

@section('title')
View Role
@endsection

@section('styles')
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row sm-12">
        <div class="col-md">
            <div class="card">
                <h5 class="card-header">View Role</h5>
                <div class="card-body">
                    <div class="form-floating form-floating-outline mb-6">
                        <input name="name" type="text" value="{{ $data->name ?? @old('name') }}" id="name" class="form-control" placeholder="Employee / Guest" disabled>
                        <label for="bs-validation-name">Name</label>
                        <div class="invalid-feedback invalid-feedback-name"></div>
                    </div>
                    <div class="row g-0">
                        <small class="text-light fw-medium d-block">Permissions</small>
                        <div class="invalid-feedback invalid-feedback-permissions"></div>
                        @foreach($permissions as $value)
                            <div class="col-sm-3 p-6">
                                <label class="switch" for="checkbox-{{ $value->id }}">
                                    <input type="checkbox" name="permissions[]" id="checkbox-{{ $value->id }}" value="{{ $value->name }}" class="switch-input" <?php if(in_array($value->name, $role_permissions)){ echo 'checked'; } ?> disabled>
                                    <span class="switch-toggle-slider">
                                        <span class="switch-on">
                                            <i class="ri-check-line"></i>
                                        </span>
                                        <span class="switch-off">
                                            <i class="ri-close-line"></i>
                                        </span>
                                    </span>
                                    <span class="switch-label">{{ $value->name }}</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ URL::previous() }}" class="btn btn-outline-secondary waves-effect">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection