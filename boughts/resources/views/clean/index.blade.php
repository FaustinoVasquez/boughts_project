@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Clean Launch
    @parent
@stop

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="card panel-primary filterable">
                    <div class="card-heading">
                        <h3 class="card-title">
                            <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff"
                               data-hc="white"></i> Clean Launch List
                        </h3>
                        <span class="pull-right ">
                            <i class="fa fa-chevron-up clickable"></i>
                        </span>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>
                    </div>
                    <div class="card-body table-responsive-lg table-responsive-md table-responsive-sm">
                        <table class="table table-striped table-bordered display nowrap " id="clean-table"
                               width="100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th>SKU</th>
                                <th>UPC</th>
                                <th>ASIN</th>
                                <th>Brand</th>
                                <th>PartNumber</th>
                                <th>FloorPrice</th>
                                <th>CeilingPrice</th>
                                <th>Condition</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('catalog.shared._modal')
@stop

{{-- page level styles --}}
@push('header_styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.3/css/buttons.bootstrap4.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css"/>
    <link rel="stylesheet" href="{{asset('library/select2-bootstrap4/select2-bootstrap4.min.css') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" href="{{asset('library/iCheck/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/_tables.css') }}"/>

    <style>
        .width-250 {
            width: 250px;
        }


        td.details-control {
            background: {{url('/img/details_open.png')}} no-repeat center center;
        }

        tr.shown td.details-control {
            background: {{url('/img/details_close.png')}} no-repeat center center;
        }

        .img-column {
            float: left;
            width: 8.33%;
            padding: 5px;
        }

        /* Clear floats after image containers */
        .row::after {
            content: "";
            clear: both;
            display: table;
        }

        .img-row {
            float: left;
            width: 8.33%;
            padding: 5px;
        }

    </style>
@endpush

{{-- page level scripts --}}
@push('footer_scripts')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.3/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.3/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.3/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.3/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

    <script src="{{ asset('library/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('library/iCheck/js/icheck.js') }}"></script>
    <script src="{{ asset('js/_commonFunctions.js') }}"></script>
    <script src="{{ asset('js/pages/_fieldsClean.js') }}"></script>
    <script>
        let $modal = $('#myModal');
        let $cleanTable;
        let $form = '';

        $modal.on("hidden.bs.modal", function () {
            $("#myModal .modal-body").html("");
            $('#myModal .modal-dialog').removeClass().addClass('modal-dialog modal-lg');
            $('#myModal .modal-header').removeClass().addClass('modal-header bg-primary');
            $('#success').show();
            $cleanTable.ajax.reload();
        });
        $modal.on("shown.bs.modal", function () {
            $.fn.dataTable.tables({visible: true, api: true}).columns.adjust();
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $.fn.dataTable.tables({visible: true, api: true}).columns.adjust();
            });

        });
        $modal.on("show.bs.modal", function () {
            $('.myselect2').select2({
                theme: 'bootstrap4',
                width: '100%',
                dropdownParent: $("#myModal"),
                tags: true
            });
        });

        $(document).on('click', '.navbar-btn', function () {
            $.fn.dataTable.tables({visible: true, api: true}).columns.adjust();
        });


        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $cleanTable = $('#clean-table').DataTable({
                    pageLength: 25,
                    scrollCollapse: true,
                    processing: true,
                    stateSave: true,
                    scrollY: "50vh",
                    scrollX: true,

                    dom: 'B"<\'row\'<\'col-sm-12 col-md-6\'l><\'col-sm-12 col-md-6\'f>>" +\n' +
                        '"<\'row\'<\'col-sm-12\'tr>>" +\n' +
                        '"<\'row\'<\'col-sm-12 col-md-5\'i><\'col-sm-12 col-md-7\'p>>"',

                    buttons: {
                        dom: {
                            container: {
                                tag: 'div',
                                className: 'flexcontent'
                            },
                            buttonLiner: {
                                tag: null
                            }
                        },

                        buttons: [
                            {
                                extend: 'excelHtml5',
                                text: '<i class="fa fa-file-excel-o"></i> Excel',
                                title: 'Titulo Product SKU',
                                titleAttr: 'Excel',
                                className: 'btn btn-success export-excel',
                                exportOptions: {
                                    columns: [1,2,3,4,5,6,7,8,9,10]
                                },
                            },
                            {
                                extend: 'csvHtml5',
                                text: '<i class="fa fa-file-text-o"></i> CSV',
                                title: 'CSV Product SKU',
                                titleAttr: 'CSV',
                                className: 'btn btn-warning export-csv',
                                exportOptions: {
                                    columns: [1,2,3,4,5,6,7,8,9,10]
                                }
                            },
                            {
                                extend: 'pageLength',
                                titleAttr: 'Show Records',
                                className: 'btn btn-black selectTable'
                            }
                        ],
                    },
                    ajax: {
                        url: '{!! route('clean.getData') !!}'
                    },
                    columns: [
                        {},
                        {"data":"SKU",name:"SKU"},
                        {"data":"UPC",name:"UPC"},
                        {"data":"ASIN",name:"ASIN"},
                        {"data":"Brand",name:"Brand"},
                        {"data":"PartNumber",name:"PartNumber"},
                        {"data":"FloorPrice",name:"FloorPrice"},
                        {"data":"CeilingPrice",name:"CeilingPrice"},
                        {"data":"Condition",name:"Condition"},
                        {"data": "Delete", name: "Delete"},
                    ],
                    columnDefs: [
                        {   targets: 0,
                            className: "details-control",
                            orderable: false,
                            data: null,
                            defaultContent: ''
                         },{
                            targets: 1,
                            render: function (data, type, row) {
                                return `<a href="#" class="edit-clean" data-id="${row.ID}">${data}</i></a>`
                            },
                            className:'text-center'
                        },{
                            targets: 9,
                            render: function (data, type, row) {
                                return `<a href="#" class="delete-clean btn btn-sm btn-danger mb-0" data-id="${row.ID}"><i class="fa fa-trash" aria-hidden="true"></i></a>`
                            },
                            className:'text-center'
                        }
                    ]

                });

            $('#clean-table tbody').on('click', 'td.details-control', function () {
                let tr = $(this).closest('tr');
                let row = $cleanTable.row(tr);
                if (row.child.isShown()) {
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    row.child(cleanData(row.data())).show();
                    tr.addClass('shown');
                }
            });

            if('{!! $sku !!}'){
                $cleanTable.search('{{$sku}}').draw();
            }
        });

        $(document).on('click', '#success', function (e) {
            e.preventDefault();
            let $form = $modal.find('.form-active');
            let url = $form.attr('action');
            let method = $form.attr('method');
            myAjaxPost(url, method, $form.serialize());
            $cleanTable.draw();
        });

        $(document).on('click','.edit-clean',function () {
            let tr = $(this).closest('tr');
            let row = $cleanTable.row(tr);
            let clean = tr.attr('id');

            $modal.find('.modal-title').html(`<h4> Clean Launch</h4>`);
            $modal.find(".modal-body").append($cleanLaunch);

            $form = $("#clean-launch-form");
            $form.attr('action', `clean/${clean}`);
            $form.attr('method', 'PUT');

            let brand = myAjaxGET('{{route('clean.getBrand')}}', 'GET');
            let partNumber = myAjaxGET('{{route('clean.getPartNumber')}}', 'GET');
            let frm_brand = ($form.find('#Brand'));
            let frm_partNumber = ($form.find('#PartNumber'));
            $.each(brand, function () {
                frm_brand.append($("<option/>")
                    .val(this.Manufacturer)
                    .text(this.Manufacturer))
            });
            $.each(partNumber, function () {
                frm_partNumber.append($("<option/>")
                    .val(this.PartNumber)
                    .text(this.PartNumber))
            });
            fillFields(row.data(), $form);
            $modal.modal();
        });

        $(document).on('click','.delete-clean',function () {
            let $tr = $(this).closest('tr');
            let id = $tr.attr('id');
            let url = `clean/${id}`;
            $.confirm({
                title: 'Confirm!',
                content: 'Are you sure to delete this SKU',
                buttons: {
                    confirm: function () {
                        let ret = myAjaxPost(`${url}`, 'DELETE');
                        if (ret) {
                            $.alert(ret.msg);
                            $cleanTable.ajax.reload();
                        }
                        return true
                    },
                    cancel: function () {
                        return true
                    },
                }
            });

        });


        {{--$(document).on('click', '#clean-launch-btn', function (e) {--}}
            {{--e.preventDefault();--}}

            {{--$modal.find('.modal-title').html(`<h4> Clean Launch</h4>`);--}}
            {{--$modal.find('#success').text('Clean Launch');--}}
            {{--$modal.find(".modal-body").append($cleanLaunch);--}}
            {{--$form = $("#clean-launch-form");--}}
            {{--// $form.attr('action', `catalog`);--}}
            {{--// $form.attr('method', 'POST');--}}

            {{--let sku = myAjaxGET('{{route('clean.getSku')}}', 'GET');--}}
            {{--let brand = myAjaxGET('{{route('clean.getBrand')}}', 'GET');--}}
            {{--let partNumber = myAjaxGET('{{route('clean.getPartNumber')}}', 'GET');--}}
            {{--let frm_sku = ($form.find('#SKU'));--}}
            {{--let frm_brand = ($form.find('#Brand'));--}}
            {{--let frm_partNumber = ($form.find('#PartNumber'));--}}
            {{--$.each(sku, function () {--}}
                {{--frm_sku.append($("<option/>")--}}
                    {{--.val(this.SKU)--}}
                    {{--.text(this.SKU))--}}
            {{--});--}}
            {{--$.each(brand, function () {--}}
                {{--frm_brand.append($("<option/>")--}}
                    {{--.val(this.Manufacturer)--}}
                    {{--.text(this.Manufacturer))--}}
            {{--});--}}
            {{--$.each(partNumber, function () {--}}
                {{--frm_partNumber.append($("<option/>")--}}
                    {{--.val(this.PartNumber)--}}
                    {{--.text(this.PartNumber))--}}
            {{--});--}}

            {{--$("#myTab li:eq(0) a").tab('show');--}}
            {{--$modal.modal();--}}
        {{--});--}}

    </script>
@endpush
