@extends('layout.app')

@section('meta')
@endsection

@section('title')
Access
@endsection

@section('styles')
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header flex-column flex-md-row border-bottom">
                    <div class="head-label text-center">
                        <h5 class="card-title mb-0">Access</h5>
                    </div>
                    <div class="dt-action-buttons text-end pt-3 pt-md-0">
                        <div class="dt-buttons btn-group flex-wrap">
                        </div>
                    </div>
                </div>
                <table class="datatables-basic table table-bordered dataTable data-table" id="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Role</th>
                            <th>Permissions</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    var datatable;

    $(document).ready(function () {
        if ($('#data-table').length > 0) {
            datatable = $('#data-table').DataTable({
                processing: true,
                serverSide: true,

                // "pageLength": 10,
                // "iDisplayLength": 10,
                "responsive": true,
                "aaSorting": [],
                // "order": [], //Initial no order.
                //     "aLengthMenu": [
                //     [5, 10, 25, 50, 100, -1],
                //     [5, 10, 25, 50, 100, "All"]
                // ],

                // "scrollX": true,
                // "scrollY": '',
                // "scrollCollapse": false,
                // scrollCollapse: true,

                // lengthChange: false,

                "ajax": {
                    "url": "{{ route('access') }}",
                    "type": "POST",
                    "dataType": "json",
                    "data": {
                        _token: "{{ csrf_token() }}"
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
                        data: 'permissions',
                        name: 'permissions'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                    },
                ]
            });
        }
    });
</script>
@endsection