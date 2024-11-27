import axios from "axios";
var datatable;
$(function () {
    const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
    if ($('#datatables').length > 0) {
        datatable = $('#datatables').DataTable({
            processing: true,
            serverSide: true,

            "responsive": true,
            "aaSorting": [],

            "ajax": {
                "url": APP_URL + 'public/roles',
                "type": "POST",
                "dataType": "json",
                "data": {
                    _token: csrfToken
                }
            },
            "columnDefs": [{
                //"targets": [0, 5], //first column / numbering column
                "orderable": true, //set not orderable
            },
            ],
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'guard_name',
                    name: 'guard_name'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                },
            ]
        });
    }
})
    .on('click', '#add-roles', function () {
        $('#addEditRoleForm')[0].reset();
        $('#addEditRole').modal('show');
        $('#role-form-title').html('Add Roles');
        $('#role-form-subtitle').html('Add a role provided access to predefined menus.');
        $('#modelFormId').remove();
    })
    .on('click', '.delete-role', function (e) {
        e.preventDefault();

        var id = $(this).data('id');
        var url = `${APP_URL}roles/delete/${id}`;

        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
        axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;

        axios.get(url)
            .then(response => {
                console.log(response.status);
                if (response.status == 200) {
                    toastr.success(response.data.message, "Success");
                } else {
                    toastr.error("Something went wrong!", "Error");
                }
                datatable.ajax.reload();
            })
            .catch(error => {
                datatable.ajax.reload();
                console.error(error);
            });
    });
