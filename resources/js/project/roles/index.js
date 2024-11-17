import axios from "axios";
$(function () {
    var datatable;
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
    .on('click', '.edit-role', function () {
        var value = $(this).data('value');
        var id = $(this).data('id');
        $('#addEditRole').modal('show');
        $('#role-form-title').html('Edit Roles');
        $('#role-form-subtitle').html('Edit a role provided access to predefined menus.');
        $('#modalRoleName').val(value);
        $('#modalRoleGuard').val('web');

        $('#addEditRoleForm').append('<input type="hidden" id="modelFormId" name="id" value="' + id + '"/>')
    })
    .on('click', '#addEditRoleSubmit', function (e) {
        e.preventDefault();
        $('#addEditRoleForm')[0].reset();
    });
