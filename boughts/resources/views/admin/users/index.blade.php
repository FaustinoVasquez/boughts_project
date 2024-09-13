@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Users
    @parent
@stop

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-lg-12 my-3">

                <div class="card panel-primary filterable">
                    <div class="card-heading clearfix">
                        <h3 class="card-title pull-left">
                            <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff"
                               data-hc="white"></i> Users List
                        </h3>
                        @include('admin.users.shared._filter')
                    </div>
                    <div class="card-body table-responsive-lg table-responsive-sm table-responsive-md">

                        <table class="table table-striped table-bordered table-hover" id="users-table" width="100%">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>LastName</th>
                                <th>Email</th>
                                <th>UserName</th>
                                <th>Profile</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

{{-- page level styles --}}
@push('header_styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <style>
        div.dt-buttons {
            float: none;
            text-align: center;
        }
        .table tbody tr:hover td, .table tbody tr:hover th {
            background-color: lightgoldenrodyellow;
        }
    </style>
@endpush

{{-- page level scripts --}}
@push('footer_scripts')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('library/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script>

        var btnfilterUsers;

        $(function () {
            var $usersTable = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                lengthMenu: [[25, 50, 100, -1], [25, 50, 100, 'All']],
                scrollY: "45vh",
                dom: "lBfrtip",
                ajax: {
                    url: '{!! route('admin.users.getUsers') !!}',
                    data: function(data){
                        data.deleted = btnfilterUsers;
                        }
                    },

                columns: [
                    {"data": "Name", name: 'Name'},
                    {"data": "LastName", name: 'LastName'},
                    {"data": "Email", name: 'Email'},
                    {"data": "Username", name: 'Username'},
                    {"data": "Profile", name: 'Profile'},
                    {"data": "Actions", name: 'Actions'},
                ]
            });


            $('input[type=radio][name=deletedStatus]').change(function(){
                btnfilterUsers = $(this).val();
                $usersTable.draw();
            });

            $(document).on('click', '.user-delete', function (e) {
                e.preventDefault();
                if (!confirm('Are you sure to delete this user?')) {
                    return false;
                }
                const row = $(this).parents('tr');
                const form = $(this).parents('form');
                const url = form.attr('action');

                $.post(url, form.serialize(), function (result) {
                    row.fadeOut();
                    $.notify({
                        title: "<strong>" + result[0].toUpperCase() + ":</strong> ",
                        message: result[1]
                    }, {
                        type: result[0]
                    });
                }).fail(function () {
                    $.notify({
                        title: "<strong>" + result[0].toUpperCase() + ":</strong> ",
                        message: result[1]
                    }, {
                        type: result[0]
                    });
                })

            });
        });

    </script>
@endpush