$(function () {
    $('#permission-scope').select2();
    $('#guard-name').select2();

}).on('click', '#check-all', function () {
    if ($(this).prop('checked') == true) {
        $('.permission-checkbox').attr('checked', true).val(1)
    } else {
        $('.permission-checkbox').attr('checked', false).val(0)
    }
}).on('click', '#add', function (e) {
    e.preventDefault();

    $('#addEditRoleSubmit').attr('disabled', true);
    $('#addEditRoleSubmit').html('Please wait');
    var url = APP_URL + 'roles/store';
    var data = new FormData($('#addEditRoleForm')[0]); // Retrieve the FormData instance
    const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

    axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;

    axios.post(url, data)
        .then(response => {
            if (response.status == 200) {
                //
            } else {
                toastr.error("Something went wrong!", "Error");
            }
            $('#addEditRoleForm')[0].reset();
            $('#addEditRoleSubmit').attr('disabled', false);
            $('#addEditRoleSubmit').html('Submit');
            $('#addEditRole').modal('toggle');
            datatable.ajax.reload();
        })
        .catch(error => {
            if (error.status != 200) {
                toastr.error(error.response.data.message, "Error");
            } else {
            }
            $('#addEditRoleForm')[0].reset();
            $('#addEditRoleSubmit').attr('disabled', false);
            $('#addEditRoleSubmit').html('Submit');
            $('#addEditRole').modal('toggle');
            datatable.ajax.reload();
        });
})