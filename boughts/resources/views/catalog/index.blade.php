@extends('layouts.default')
{{-- Page title --}}
@section('title')
    ProductSKU
    @parent
@stop

@section('formSearch')
    @include('catalog.shared._formSearch',[$partNumbers,$categories])
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
                               data-hc="white"></i> Product Catalog List
                        </h3>
                        <span class="pull-right ">
                            <i class="fa fa-chevron-up clickable"></i>
                        </span>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>
                    </div>
                    <div class="card-body table-responsive-lg table-responsive-md table-responsive-sm">


                        <table class="table table-striped table-bordered display nowrap " id="catalog-table"
                               width="100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th>SKU</th>
                                <th>Manufacturer</th>
                                <th>PartNumber</th>
                                <th>Categories</th>
                                <th>NewPrices</th>
                                <th>CNPrices</th>
                                <th>UsedPrices</th>
                                <th>QtyUS</th>
                                <th>QtyEU</th>
                                <th>Have CNVariant</th>
                                <th>NImages</th>
                                <th>CleanLaunch</th>
                                <th>Delete</th>
                                <th>FloorPrice</th>
                                <th>CeilingPrice</th>
                                <th>UnitCost</th>
                                <th>FloorPriceCN</th>
                                <th>CeilingPriceCN</th>
                                <th>UnitCostCN</th>
                                <th>FloorPriceUSED</th>
                                <th>CeilingPriceUSED</th>
                                <th>UnitCostUSED</th>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

    <script src="{{ asset('library/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('library/iCheck/js/icheck.js') }}"></script>
    <script src="{{ asset('library/yadcf/js/jquery.dataTables.yadcf.js') }}"></script>

    <script src="{{ asset('js/_commonFunctions.js') }}"></script>
    <script src="{{ asset('js/pages/_fieldsProductSku.js') }}"></script>
    <script src="{{ asset('js/pages/_fieldsClean.js') }}"></script>


    <script>
        let $modal = $('#myModal');
        let $modal2 = $('#myModal2');
        let $catalogTable;
        let $form = '';
        let sku = '';

        $('.myselect2').select2({
            theme: 'bootstrap4',
            width: '250px',
            tags:true,
        });
        $('.myselect20').select2({
            theme: 'bootstrap4',
            width: '250px',
            tags:true,
        });

        $modal.on("hidden.bs.modal", function () {
            $("#myModal .modal-body").html("");
            $('#myModal .modal-dialog').removeClass().addClass('modal-dialog modal-lg');
            $('#myModal .modal-header').removeClass().addClass('modal-header bg-primary');
            $('#success').show();
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
                tags:true
            });
        });
        $modal2.on("hidden.bs.modal", function () {
            $("#myModal2 .modal-body").html("");
            $("#myModal2 .modal-title").html("");
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

            $('.percent').mask('##0,00%', {reverse: true});


            $catalogTable = $('#catalog-table').DataTable({
                    pageLength: 25,
                    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
                    scrollY: "50vh",
                    scrollX: true,
                    scrollCollapse: true,
                    processing: true,
                    stateSave: true,
                    serverSide:true,

                    dom: '"<\'row\'<\'col-sm-12 col-md-6\'B><\'col-sm-12 col-md-6\'f>>" +\n' +
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
                                    columns: [1,2,3,4,14,15,16,17,18,19,20,21,22,8,9,10]
                                },
                            },
                            {
                                extend: 'csvHtml5',
                                text: '<i class="fa fa-file-text-o"></i> CSV',
                                title: 'CSV Product SKU',
                                titleAttr: 'CSV',
                                className: 'btn btn-warning export-csv',
                                exportOptions: {
                                    columns: [1,2,3,4,14,15,16,17,18,19,20,21,22,8,9,10]
                                }
                            },
                            {
                                extend: 'pageLength',
                                titleAttr: 'Show Records',
                                className: 'btn btn-black selectTable'
                            }, {
                                text: '<i class="fa fa-plus"></i> SKU',
                                titleAttr: 'Create SKU',
                                className: 'btn btn-primary create-sku',
                            }, {
                                text: '<i class="fa fa-check-circle"></i> Update Inventory',
                                titleAttr: 'Update Inventory',
                                className: 'btn btn-info',
                                attr: {
                                    id: 'update-inv-btn'
                                }
                            }, {
                                text: '<i class="fa fa-check-circle"></i> Clean Launch',
                                titleAttr: 'CleanLaunch',
                                className: 'btn btn-warning',
                                attr: {
                                    id: 'clean-launch-btn'
                                }
                            }
                        ],
                    },

                    order: [1, "desc"],
                    ajax: {
                        url: '{!! route('catalog.getData') !!}',
                        data: function (d) {
                            d.hasCompatibility = $('#hasCompatibility').val();
                            d.manufacturer = $('select[name=hasManufacturer]').val();
                            d.hasCategory = $('select[name=hasCategory]').val();
                            d.hasInventory = $('#hasInventory').val();
                            d.isCn = $('#isCn').val();
                            d.researchComplete = $('#researchComplete').val();
                        }
                    },
                    columns: [
                        {},
                        {"data": "SKU", name: "SKU"},
                        {"data": "Manufacturer", name: "Manufacturer"},
                        {"data": "PartNumber", name: "PartNumber"},
                        {"data": "Categories", name: "Categories"},
                        {"data": "NewPrices", name: "NewPrices"},
                        {"data": "CNPrices", name: "CNPrices"},
                        {"data": "UsedPrices", name: "UsedPrices"},
                        {"data": "Qty", name: "Qty"},
                        {"data": "QtyGBT", name: "QtyGBT"},
                        {"data": "HaveCNVariant", name: "HaveCNVariant"},
                        {"data": "NImages", name: "NImages"},
                        {"data": "CleanLaunch", name: "CleanLaunch"},
                        {"data": "Delete", name: "Delete"},
                        {"data": "FloorPrice", name: "FloorPrice"},
                        {"data": "CeilingPrice", name: "CeilingPrice"},
                        {"data": "UnitCost", name: "UnitCost"},
                        {"data": "FloorPriceCN", name: "FloorPriceCN"},
                        {"data": "CeilingPriceCN", name: "CeilingPriceCN"},
                        {"data": "UnitCostCN", name: "UnitCostCN"},
                        {"data": "FloorPriceUSED", name: "FloorPriceUSED"},
                        {"data": "CeilingPriceUSED", name: "CeilingPriceUSED"},
                        {"data": "UnitCostUSED", name: "UnitCostUSED"},
                    ],
                    columnDefs: [
                        {
                            targets: 0,
                            className: "details-control",
                            orderable: false,
                            data: null,
                            defaultContent: ''
                        }, {
                            targets: 1,
                            render: function (data, type, row) {
                                return `<a href="#" class="edit-sku" data-id='${row.SKU}'>${data}</a>`;
                            },
                        }, {
                            targets: 3,
                            render: function (data, type, row) {
                                return `<a href="#" class="edit-partnumber" data-id="${row.SKU}">${data}</a>`;
                            }
                        }, {
                            targets: 4,
                            orderable: false,
                            render: function (data, type, row) {
                                return `<div class='text-wrap width-250'>${data}</div>`;
                            }
                        }, {
                            targets: 5,
                            render: function (data, type, row) {
                                return `<a  href="#" class="edit-newprices" data-id="${row.SKU}"><nobr>${row.NewPrices}</nobr></a>`
                            }
                        }, {
                            targets: 6,
                            render: function (data, type, row) {
                                return `<a href="#" class="edit-cnprices" data-id="${row.SKU}"><nobr>${row.CNPrices}</nobr></button >`
                            }
                        }, {
                            targets: 7,
                            render: function (data, type, row) {
                                return `<a href="#" class="edit-usedprices" data-id="${row.SKU}"><nobr>${row.UsedPrices}</nobr></a>`
                            }
                        }, {
                            targets: 8,
                            render: function (data, type, row) {
                                return `<a href="#" class="edit-qty" data-id="${row.SKU}"><nobr>${data}<nobr></a>`
                            }
                        }, {
                            targets: 9,
                            render: function (data, type, row) {
                                return `<a href="#" class="edit-qtygbt" data-id="${row.SKU}"><nobr>${data}</nobr></a>`
                            }
                        }, {
                            targets: 10,
                            render: function (data, type, row) {
                                if (type === 'display') {
                                    return `<input type="checkbox" data-id="${row.SKU}" class="have-variants custom-checkbox">`
                                }
                                return data;
                            },
                            className: "text-center"
                        }, {
                            targets: 11,
                            render: function (data, type, row) {
                                return `<a href="#" class="edit-images" data-id="${row.SKU}"><i class="fa fa-camera" aria-hidden="true"></i>  ${data}</a>`;
                            },
                            className: "text-center"
                        }, {
                            targets: 12,
                            render: function (data, type, row) {
                                let url = '{{route("clean.show",":sku")}}';
                                url = url.replace(':sku', row.SKU);
                                return `<a href="#" class="btn btn-sm btn-success" id="create-launch-btn" data-id="${row.SKU}">CL</i></a>
                                        <a href="${url}" class="btn btn-sm btn-warning" id="show-launch-btn" data-id="${row.SKU}">
                                            <i class="fa fa-list" aria-hidden="true"></i>
                                        </a>
                                       `
                            },
                            className: "text-center"
                        },{
                            targets: 13,
                            render: function (data, type, row) {
                                return `<a href="#" class="delete-sku btn btn-sm btn-danger" data-id="${row.SKU}"><i class="fa fa-trash" aria-hidden="true"></i></a>`
                            },
                            className: "text-center"
                        },{
                            targets: [14,15,16,17,18,19,20,21,22],
                            visible: false
                        }

                    ],
                    rowCallback: function (row, data) {
                        // Set the checked state of the checkbox in the table
                        $('.have-variants', row).prop('checked', data.HaveCNVariant == 1);
                        if (data.NImages === '0') {
                            $(row).find('td:eq(0)').css('background-color', '#bf80ff');
                        }
                    }
                });

            $('#catalog-table tbody').on('click', 'td.details-control', function () {
                let tr = $(this).closest('tr');
                let row = $catalogTable.row(tr);
                let sku = tr.attr('id');
                let url = `catalog/${sku}`;
                let data = myAjaxGET(url, 'GET', '');

                if (row.child.isShown()) {
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    row.child(format(data)).show();
                    tr.addClass('shown');
                }
            });

            $('#category').on('change', function () {
                $catalogTable.search(this.value).draw();
            });


            $('#extra-search-form').on('submit', function(e) {
                $catalogTable.draw();
                e.preventDefault();
            });

        });


        $(document).on('click', '#update-inv-btn', function (e) {
            e.preventDefault();

            $.confirm({
                title: 'Confirm!',
                content: 'Are you sure to update Inventory?',
                buttons: {
                    confirm: function () {
                        let ret = myAjaxGET('{!! route('action.update.inventory') !!}', 'GET');
                        if (ret) {
                            $.alert(ret.msg);
                        }
                        //return true
                    },
                    cancel: function () {
                        return true
                    },
                }
            });
        });

        function updateInv() {

           // let $returns = myAjaxGET('catalog/inventory', 'GET');
            $.confirm({
                title: 'Confirm!',
                content: 'Are you sure to update Inventory?',
                buttons: {
                    confirm: function () {
                        let $returns = myAjaxGET('catalog/inventory', 'GET');
                        if ($returns) {
                            $.alert('holss');
                        }
                        return true
                    },
                    cancel: function () {
                        return true
                    },
                }
            });
        }

        //Create SKU Click Grid Row
        $(document).on('click', '.create-sku', function (e) {
            e.preventDefault();
            let data = myAjaxGET('catalog/create', 'GET');
            $modal.find('.modal-title').html(`<h4> Create SKU Details</h4>`);
            $modal.find('#success').text('Create SKU');
            $modal.find(".modal-body").append($createSkuFields);
            $form = $("#create-sku-form");
            $form.attr('action', `catalog`);
            $form.attr('method', 'POST');
            $form.find('#SKU').attr("disabled", true);
            $.frm_categories = ($form.find('#CategoryID'));
            $.each(data, function () {
                $.frm_categories.append($("<option/>")
                    .val(this.CategoryID)
                    .text(this.CategoryName))
            });
            $("#myTab li:eq(0) a").tab('show');
            $modal.modal();
        });

        //Edit SKU Click Grid Row
        $(document).on('click', '.edit-sku', function (e) {
            e.preventDefault();
            let row = getRowData($(this).data('id'), 'sku');
            sku = $(this).data('id');
            $modal.find('.modal-title').html(`<h4> SKU Details - ${sku}</h4>`);
            $modal.find('#success').text('Update SKU');
            $modal.find(".modal-body").append($updateSkuFields);
            $form = $("#update-sku-form");
            $form.attr('action', `catalog/${sku}`);
            $form.attr('method', 'PUT');
            fillFields(row['sku'], $form);
            $form.find('#SKU').attr("disabled", true);
            $form.find('#HaveCNVariant').prop('checked', row['sku'].HaveCNVariant);
            $form.find('#ResearchComplete').prop('checked', row['sku'].ResearchComplete);
            $form.find('#Wholesale').prop('checked', row['sku'].Wholesale);
            let wolesale = $modal.find('#Wholesale').is(':checked');
            if(wolesale){
                $modal.find('#WholesalePrice').removeAttr("disabled");
                $modal.find('#WholesaleInvPercent').removeAttr("disabled");
            }

            $.frm_categories = ($form.find('#CategoryID'));
            //fill Categories
            $.each(row['categories'], function () {
                $.frm_categories.append($("<option/>")
                    .val(this.CategoryID)
                    .text(this.CategoryName))
            });
            //SelectCategory
            $("#CategoryID option[value=" + row['sku'].CategoryID + "]").attr('selected', 'selected');
            $("#myTab li:eq(0) a").tab('show');
            $modal.modal();
        });

        $(document).on('change', '#Wholesale', function (e) {
            e.preventDefault();
            let wolesale = $modal.find('#Wholesale').is(':checked');
            if(wolesale){
                $modal.find('#WholesalePrice').removeAttr("disabled");
                $modal.find('#WholesaleInvPercent').removeAttr("disabled");
            }else{
                $modal.find('#WholesalePrice').prop('disabled', 'disabled').val('');
                $modal.find('#WholesaleInvPercent').prop('disabled', 'disabled').val('');
            }
        });

        //click on button UpdateSku or CreateSku
        $(document).on('click', '#success', function (e) {
            e.preventDefault();
            let $form = $modal.find('.form-active');
            let url = $form.attr('action');
            let method = $form.attr('method');
            myAjaxPost(url, method, $form.serialize());
        });

        //PartNumber Click Grid Row
        $(document).on('click', '.edit-partnumber', function (e) {
            let row = getRowData($(this).data('id'), 'partNumber');
            $modal.find('.modal-title').html(`<h4> SKU Details - ${$(this).data('id')}</h4>`);
            $modal.find('#success').hide();
            $modal.find(".modal-body").append($partNumberFields);
            $modal.find('#OriginallySuppliedWith').prop("readonly", true);
            $modal.find('#AlsoCompatibleWith').prop("readonly", true);
            $modal.find('#CanReplaceSKUs').prop("readonly", true);
            let $form = $("#show-partNumber-form");
            fillFields(row['sku'], $form);
            $modal.modal();
        });

        //Button Copy Info
        $(document).on('click', ".copy-info", function () {
            $(this).parent().siblings().children().select();
            document.execCommand('copy');
        });

        //NewPrices Click PartNumber
        $(document).on('click', '.edit-newprices', function (e) {
            e.preventDefault();
            let row = getRowData($(this).data('id'), 'newPrices');
            $modal.find('.modal-title').html(`<h4> SKU Details - ${$(this).data('id')}  -- NEW --</h4>`);
            $modal.find(".modal-body").append($newPricesFields);

            $form = $("#update-new-prices");
            $form.attr('action', `catalog/newPrices/${$(this).data('id')}`);
            $form.attr('method', 'PUT');
            fillFields(row['sku'], $form);
            $modal.modal();
        });

        //CNPrices Click Grid Row
        $(document).on('click', '.edit-cnprices', function (e) {
            e.preventDefault();
            let row = getRowData($(this).data('id'), 'cnPrices');
            $modal.find('.modal-title').html(`<h4> SKU Details - ${$(this).data('id')}  -- CN --</h4>`);
            $modal.find(".modal-body").append($cnPricesFields);

            $form = $("#update-cn-prices");
            $form.attr('action', `catalog/cnPrices/${$(this).data('id')}`);
            $form.attr('method', 'PUT');
            fillFields(row['sku'], $form);
            $modal.modal();
        });

        //USEDPricesClick Grid Row
        $(document).on('click', '.edit-usedprices', function (e) {
            e.preventDefault();
            let row = getRowData($(this).data('id'), 'usedPrices');
            $modal.find('.modal-title').html(`<h4> SKU Details - ${$(this).data('id')}  -- USED --</h4>`);
            $modal.find(".modal-body").append($usedPricesFields);
            $form = $("#update-used-prices");
            $form.attr('action', `catalog/usedPrices/${$(this).data('id')}`);
            $form.attr('method', 'PUT');
            fillFields(row['sku'], $form);
            $modal.modal();
        });

        //Qty US Click Grid Row
        $(document).on('click', '.edit-qty', function (e) {
            e.preventDefault();
            const sku = $(this).data('id');
            $modal.find('.modal-title').html(`<h4> SKU Details - ${sku}</h4>`);
            $modal.find('#success').hide();
            $modal.find(".modal-body").append($qtyUSDetails);

            $('#bin-stock-us-table').DataTable({
                processing: true,
                pageLength: 25,
                scrollY: "30vh",
                scrollCollapse: true,
                order: [0, "desc"],
                ajax: {
                    url: `catalog/getQtyUSBinStockData/${sku}`,
                },
                columns: [
                    {"data": "BinID", name: "BinID"},
                    {"data": "StockQty", name: "StockQty"},
                    {"data": "ScanCode", name: "ScanCode"},
                ],
            });


            $('#bin-history-us-table').DataTable({
                processing: true,
                pageLength: 25,
                scrollY: "30vh",
                scrollX: true,
                scrollCollapse: true,
                order: [0, "asc"],
                ajax: {
                    url: `catalog/getQtyUSBinHistoryData/${sku}`,
                },
                columns: [
                    {"data": "BinID", name: "BinID"},
                    {"data": "SKU", name: "SKU"},
                    {"data": "Quantity", name: "Quantity"},
                    {"data": "Flow", name: "Flow"},
                    {"data": "ScanCode", name: "ScanCode"},
                    {"data": "ScanType", name: "ScanType"},
                    {"data": "CreateUser", name: "CreateUser"},
                    {"data": "CreateDate", name: "CreateDate"},
                    {"data": "Comments", name: "Comments"},
                ]
            });
            $modal.modal();
        });

        //Qty EU Click Grid Row
        $(document).on('click', '.edit-qtygbt', function (e) {
            e.preventDefault();
            const sku = $(this).data('id');
            $modal.find('.modal-title').html(`<h4> SKU Details - ${sku}</h4>`);
            $modal.find('#success').hide();
            $modal.find(".modal-body").append($qtyEUDetails);


            $('#bin-stock-eu-table').DataTable({
                processing: true,
                pageLength: 25,
                scrollY: "30vh",
                scrollCollapse: true,
                order: [0, "asc"],
                ajax: {
                    url: `catalog/getQtyEUBinStockData/${sku}`,
                },
                columns: [
                    {"data": "BinID", name: "BinID"},
                    {"data": "StockQty", name: "StockQty"},
                    {"data": "ScanCode", name: "ScanCode"},
                ],
            });

            $('#bin-history-eu-table').DataTable({
                processing: true,
                pageLength: 25,
                scrollY: "30vh",
                scrollX: true,
                scrollCollapse: true,
                order: [0, "asc"],
                ajax: {
                    url: `catalog/getQtyEUBinHistoryData/${sku}`,
                },
                columns: [
                    {"data": "BinID", name: "BinID"},
                    {"data": "SKU", name: "SKU"},
                    {"data": "Quantity", name: "Quantity"},
                    {"data": "Flow", name: "Flow"},
                    {"data": "ScanCode", name: "ScanCode"},
                    {"data": "ScanType", name: "ScanType"},
                    {"data": "CreateUser", name: "CreateUser"},
                    {"data": "CreateDate", name: "CreateDate"},
                    {"data": "Comments", name: "Comments"},
                ]
            });
            $modal.modal();
        });

        //Have CNVariant
        $(document).on('change', '.have-variants', function (e) {
            let $tr = $(this).closest('tr');
            let $td = $(this).parent();
            let value = this.value;
            let rowId = $tr.attr('id');
            let url = `catalog/haveCnVariant/${rowId}`;

            $form = $(`<form><form>`);
            $form.append(`<input type="hidden" name="HaveCNVariant" value="${value}">`);
            let $return = myAjaxPost(url, 'PUT', $form.serialize());

            if ($return) {
                $td.find('checkbox', function (i, o) {
                    $(o).val(value);
                });
            } else {
                $catalogTable.cell($td).invalidate().draw();
            }
            return true;
        });

        //Delete SKU
        $(document).on('click', '.delete-sku', function (e) {
            let $tr = $(this).closest('tr');
            let rowId = $tr.attr('id');
            let url = `catalog/${rowId}`;

            $.confirm({
                title: 'Confirm!',
                content: 'Are you sure to delete this SKU',
                buttons: {
                    confirm: function () {
                        let ret = myAjaxPost(`${url}`, 'DELETE');
                        if (ret) {
                            $.alert(ret.msg);
                            $tr.fadeOut();
                        }
                        return true
                    },
                    cancel: function () {
                        return true
                    },
                }
            });
        });

        //Images Edit
        $(document).on('click', '.edit-images', function (e) {
            let tr = $(this).closest('tr');
            let sku = tr.attr('id');
            editImagesModal(sku);
        });

        //Images Edit Modal
        function editImagesModal(sku = '') {
            $modal = $('#myModal');
            $modal.find('.modal-title').html(`<h4> SKU Images for - ${sku}</h4>`);
            $modal.find('#success').hide();
            $modal.find('.modal-dialog').removeClass('modal-lg');
            let images = getImages(sku);
            $modal.find(".modal-body").append(images);
            $modal.modal('show');

            $('.store-image').on('change', function (e) {
                let image = e.target.files[0];
                let num = e.target.attributes['data-num'].value;
                let id = e.target.attributes['data-id'].value;
                let name = e.target.attributes['data-name'].value;
                let item = e.target.attributes['data-item'].value;
                let myFormData = new FormData();
                myFormData.append('pictureFile', image);
                myFormData.append('url', 'http://remotespict.mitechnologiesinc.com');
                myFormData.append('id', id);
                myFormData.append('name', name);
                myFormData.append('item', item);

                $.ajax({
                    url: `/images`,
                    type: 'POST',
                    processData: false, // important
                    contentType: false, // important
                    cache: false,
                    dataType: 'json',
                    data: myFormData,
                    success: function (data) {
                        d = new Date();
                        $(`#a-${num}`).attr("href", `${data.URL}?` + d.getTime());
                        $(`#image-${num}`)
                            .attr("src", `${data.URL}?` + d.getTime())
                            .attr("width", "100")
                            .attr("height", "100")
                            .removeAttr('style');
                        $(`#input-${num}`)
                            .attr('data-id', `id`)
                            .attr('data-item', `${data.ID}`)
                            .attr('data-name', `${data.ID}-${num}`)
                            .val('');
                        $(`#btn-${num}`)
                            .attr("data-id", `${data.ID}`)
                            .attr("data-sku", `${data.SKU}`)
                            .removeClass('disabled');

                        $catalogTable.ajax.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        $.notify({
                            title: `<p><strong>Please check your request, there are some errors on your submit:</strong></p>`,
                            message: jqXHR
                        });
                    }
                });
                return true;
            });

            $('.delete-image').click(function (e) {
                e.preventDefault();
                let id = $(this).data("id");
                let sku = $(this).data("sku");
                let num = $(this).data("num");
                let noImage = 'http://remotespict.mitechnologiesinc.com/no_image.png';
                let token = $("meta[name='csrf-token']").attr("content");

                $.confirm({
                    title: 'Confirm!',
                    content: 'Are you sure to delete image?',
                    buttons: {
                        confirm: function () {
                            $.ajax(
                                {
                                    url: 'images/' + id,
                                    type: 'DELETE', // replaced from put
                                    dataType: "JSON",
                                    data: {
                                        "id": id,
                                        "_token": token,
                                    },
                                    success: function (data) {
                                        d = new Date();
                                        $(`#a-${num}`).attr("href", `${noImage}` + d.getTime());
                                        $(`#image-${num}`)
                                            .attr("src", `${noImage}?` + d.getTime())
                                            .removeAttr('width')
                                            .removeAttr('height')
                                            .attr('style', 'width: 108px;height:66px');
                                        $(`#input-${num}`)
                                            .attr('data-id', `sku`)
                                            .attr('data-item', `${sku}`)
                                            .attr('data-name', `${sku}-${num}`)
                                            .val('');
                                        $(`#btn-${num}`)
                                            .attr("data-id", '')
                                            .attr("data-sku", '')
                                            .addClass('disabled');

                                        $catalogTable.ajax.reload();
                                    },
                                    error: function (xhr) {
                                        console.log(xhr.responseText);
                                    }
                                });

                            $.alert('Wait to reload table!');

                        },
                        cancel: function () {
                            $.alert('Transaction canceled!');

                        },
                    }
                });

                return true;
            });

            return true;

        }

        function compareText(field, dataLength) {
            let $form = $(`<form><form>`);
            $form.append(`<input type="hidden" name="dataField" value=${dataLength}>`);
            $form.append(`<input type="hidden" name="nameField" value=${field}>`);
            let url = `catalog/compareText/${sku}`;
            return myAjaxGET(url, 'POST', $form.serialize())['data'];
        }


        //check Original Supplied With
        $(document).on('click', '#btn-original-supplied-with', function (e) {
            e.preventDefault();
            let fieldData = $('#OriginallySuppliedWith');
            if (compareText('OriginallySuppliedWith', fieldData.val().length) <= 90) {
                alert('More than 10% of the original information has been lost')
                $($(this).data("target")).hide();
            } else {

                $modal2.css("margin-left", $(window).width() - $('.modal-content').width());
                $modal2.find('.modal-title').html(`<h4> CLEAN ORIGINAL SUPPLIED</h4>`);
                $modal2.find('.modal-body').append($cleanCompatibility);
                $modal2.find('#before').attr('readonly', true).val(fieldData.val());

                let url = `catalog/cleanTxt`;
                $form = $(`<form><form>`);
                $form.append(`<input type="hidden" name="text" value="OriginallySuppliedWith">`);
                $form.append(`<input type="hidden" name="text" value="${fieldData.val()}">`);

                if (fieldData.val() !== '') {
                    let data = myAjaxGET(url, 'POST', $form.serialize());
                    $modal2.find('#after').attr('readonly', true).val(data.data[0].VARIATIONS);
                    fieldData.val(data.data[0].VARIATIONS);
                }
                $modal2.modal('show');

            }
        });

        $(document).on('click', '#btn-also-compatible-with', function (e) {
            e.preventDefault();
            let fieldData = $('#AlsoCompatibleWith');
            $modal2.css("margin-left", $(window).width() - $('.modal-content').width());
            $modal2.find('.modal-header').addClass('bg-danger');
            $modal2.find('.modal-title').html(`<h4> CLEAN COMPATIBLE WITH</h4>`);
            $modal2.find('.modal-body').append($cleanCompatibility);
            $modal2.find('#before').attr('readonly', true).val(fieldData.val());
            let url = `catalog/cleanTxt`;
            $form = $(`<form><form>`);
            $form.append(`<input type="hidden" name="text" value="AlsoCompatibleWith">`);
            $form.append(`<input type="hidden" name="text" value="${fieldData.val()}">`);

            if (fieldData.val() !== '') {
                let data = myAjaxGET(url, 'POST', $form.serialize());
                $modal2.find('#after').attr('readonly', true).val(data.data[0].VARIATIONS);
                fieldData.val(data.data[0].VARIATIONS);
            }
            $modal2.modal('show');
        });

        //Clean Launch
        $(document).on('click', '#create-launch-btn', function (e) {
            e.preventDefault();
            let tr = $(this).closest('tr');
            let sku = tr.attr('id');
            let row = $catalogTable.row(tr);
            $modal.find('.modal-title').html(`<h4> Clean Launch</h4>`);
            $modal.find('#success').text('Clean Launch');
            $modal.find(".modal-body").append($cleanLaunch);
            $form = $("#clean-launch-form");
            $form.attr('action', `clean`);
            $form.attr('method', 'POST');
            $form.find('#SKU').val(sku);
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

            $("#myTab li:eq(0) a").tab('show');
            $modal.modal();
        });

    </script>
@endpush


