@extends('layout.app')

@section('meta')
@endsection

@section('title')
Update Access
@endsection

@section('styles')
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row sm-12">
        <div class="col-md">
            <div class="card">
                <h5 class="card-header">Update Access</h5>
                <div class="card-body">
                    <form action="{{ route('access.alter') }}" name="form" id="form" method="post"
                        class="needs-validation ajax-form" novalidate="">
                        <input type="hidden" name="id" value="{{ $data->id }}">

                        @csrf
                        @method('PATCH')

                        <div class="mb-4">
                            <label for="role" name="role" class="form-label" placeholder="Select Role">Role</label>
                            <select class="form-select mySelect" name="role" id="role" readonly>
                                <option value="">Select role</option>
                                @if(isset($roles) && $roles->isNotEmpty())
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" @if($data->id == $role->id) selected @endif>{{ ucfirst(str_replace('_', ' ', $role->name)) }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="invalid-feedback invalid-feedback-role"></div>
                        </div>
                        <div class="row g-0">
                            <small class="text-light fw-medium d-block">Permissions</small>
                            <div class="invalid-feedback invalid-feedback-permissions"></div>
                            @foreach($permissions as $value)
                                <div class="col-sm-3 p-6">
                                    <label class="switch" for="checkbox-{{ $value->id }}">
                                        <input type="checkbox" name="permissions[]" id="checkbox-{{ $value->id }}" value="{{ $value->id }}" class="switch-input" <?php if(in_array($value->name, $role_permissions)){ echo 'checked'; } ?>>
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
                                <a href="{{ route('access') }}" class="btn btn-primary waves-effect waves-light">Cancel</a>
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
            $('.invalid-feedback').css({ "display": "none" });
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
                            $('.invalid-feedback-' + key).css({ "display": "block" });
                            $('.invalid-feedback-' + key).html(value[0]);
                        });
                    }
                }
            });
        });
    });
</script>
@endsection