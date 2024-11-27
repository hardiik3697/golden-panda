@extends('layout.app')

@section('meta')
@endsection

@section('title')
New Role
@endsection

@section('styles')
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row sm-12">
        <div class="col-md">
            <div class="card">
                <h5 class="card-header">New Role</h5>
                <div class="card-body">
                    <form action="{{ route('role.insert') }}" method="post" name="form" id="form" class="needs-validation form" novalidate enctype="multipart/form-data">
                        @csrf
                        @method('post')
    
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="text" name="name" id="name" class="form-control" value="{{ @old('name') }}" />
                            <label for="bs-validation-name">Name</label>
                            <div class="invalid-feedback invalid-feedback-name"></div>
                        </div>
                        <div class="row g-0">
                            <small class="text-light fw-medium d-block">Permissions</small>
                            <div class="invalid-feedback invalid-feedback-permissions"></div>
                            @foreach($permissions as $value)
                                <div class="col-sm-3 p-6">
                                    <label class="switch" for="checkbox-{{ $value->id }}">
                                        <input type="checkbox" name="permissions[]" id="checkbox-{{ $value->id }}" value="{{ $value->name }}" class="switch-input">
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
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                <a href="{{ URL::previous() }}" class="btn btn-outline-secondary waves-effect">Back</a>
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
        var form = $('.form');
        form.submit(function (e) {
            $('.form').removeClass('was-validated');
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
                            $('.form').addClass('was-validated');
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