@extends('layout.app')

@section('meta')
@endsection

@section('title')
Add User
@endsection

@section('styles')
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row sm-12">
        <div class="col-md">
            <div class="card">
                <h5 class="card-header">Add User</h5>
                <div class="card-body">
                    <form action="{{ route('user.insert') }}" name="form" id="form" method="post" class="needs-validation ajax-form" novalidate="" enctype="multipart/form-data">
                        @csrf
                        @method('post')

                        <div class="row g-6">
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input name="firstname" type="text" value="{{ @old('firstname') }}" id="firstname" class="form-control" placeholder="" >
                                    <label for="bs-validation-firstname">FirstName</label>
                                    <div class="invalid-feedback invalid-feedback-firstname"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input name="lastname" type="text" value="{{ @old('lastname') }}" id="lastname" class="form-control" placeholder="" >
                                    <label for="bs-validation-lastname">Lastname</label>
                                    <div class="invalid-feedback invalid-feedback-lastname"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input name="username" type="text" value="{{ @old('username') }}" id="username" class="form-control" placeholder="" >
                                    <label for="bs-validation-username">Username</label>
                                    <div class="invalid-feedback invalid-feedback-username"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input name="email" type="email" value="{{ @old('email') }}" id="email" class="form-control" placeholder="" >
                                    <label for="bs-validation-email">Email</label>
                                    <div class="invalid-feedback invalid-feedback-email"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input name="phone" type="text" value="{{ @old('phone') }}" id="phone" class="form-control" placeholder="" >
                                    <label for="bs-validation-phone">Phone Number</label>
                                    <div class="invalid-feedback invalid-feedback-phone"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-password-toggle">
                                    <div class="input-group input-group-merge">
                                        <div class="form-floating form-floating-outline">
                                            <input type="password" id="password" class="form-control password" name="password"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="password" />
                                            <label for="password">Password</label>
                                        </div>
                                        <span class="input-group-text cursor-pointer">
                                            <i class="ri-eye-off-line"></i>
                                        </span>
                                        <div class="invalid-feedback invalid-feedback-password"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <select class="form-select mySelect role" name="role" id="role">
                                    <option value="">Select role</option>
                                    @if(isset($roles) && $roles->isNotEmpty())
                                        @foreach($roles as $role)
                                            <option value="{{ $role->name }}">{{ ucfirst(str_replace('_', ' ', $role->name)) }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="invalid-feedback invalid-feedback-role"></div>
                            </div>
                            <div class="col-md-6">
                                <input class="form-control photo" type="file" id="photo">
                                <div class="invalid-feedback invalid-feedback-photo"></div>
                            </div>
                        </div>

                        <div class="row pt-6">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                <a href="{{ route('user') }}" class="btn btn-primary waves-effect waves-light">Cancel</a>
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
<script>
    $(document).ready(function () {
        var form = $('.ajax-form');
        form.submit(function (e) {
            $('.ajax-form').removeClass('was-validated');
            $('.invalid-feedback').css({"display": "none"});
            $('.invalid-feedback').html('');
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: new FormData($(this)[0]),
                dataType: 'json',
                async: false,
                processData: false,
                contentType: false,
                success: function (response) {
                    return true;
                },
                error: function (response) {
                    e.preventDefault();
                    if (response.status === 422) {
                        var errors = response.responseJSON;
                        $.each(errors.errors, function (key, value) {
                            $('.ajax-form').addClass('was-validated');
                            $('.invalid-feedback-'+key).css({"display": "block"});
                            $('.invalid-feedback-'+key).html(value[0]);
                        });
                    }
                }
            });
        });
    });
</script>
@endsection