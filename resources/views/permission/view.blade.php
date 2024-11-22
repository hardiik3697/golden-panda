@extends('layout.app')

@section('meta')
@endsection

@section('title')
View Permission
@endsection

@section('styles')
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row sm-12">
        <div class="col-md">
            <div class="card">
                <h5 class="card-header">View Permission</h5>
                <div class="card-body">
                    <form>
                        <div class="form-floating form-floating-outline mb-6">
                            <input name="name" type="text" value="{{ $data->name ?? @old('name') }}" id="name" class="form-control" placeholder="Employee / Guest" disabled>
                            <label for="bs-validation-name">Name</label>
                            <div class="invalid-feedback invalid-feedback-name"></div>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <input name="guard_name" type="text" value="{{ $data->guard_name ?? @old('guard_name') }}" id="guard_name" class="form-control" placeholder="Employee / Guest" disabled>
                            <label for="bs-validation-guard_name">Guard Name</label>
                            <div class="invalid-feedback invalid-feedback-guard_name"></div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <a href="{{ route('permission') }}" class="btn btn-primary waves-effect waves-light">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection