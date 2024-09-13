@extends('layouts.default')
{{-- Page title --}}
@section('title')
ProductSKU
@parent
@stop

@section('formSearch')
    @include('market.shared.mktSearchform')
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
                           data-hc="white"></i> Market Place Mapping
                    </h3>
                    <span class="pull-right ">
                        <i class="fa fa-chevron-up clickable"></i>
                    </span>
                </div>
                <div class="card-body table-responsive-lg table-responsive-md table-responsive-sm ">

                    <table class="table table-striped table-bordered display nowrap " id="market-table" width="100%">
                        <thead>
                        <tr>
                            <th></th>
                            <th>SKU</th>
                            <th>Condition</th>
                            <th>FulfillmentType</th>
                            <th>MerchantSKU</th>
                            <th>ASIN</th>
                            <th>Floor</th>
                            <th>Ceiling</th>
                            <th>Stamp</th>
                            <th>CN</th>
                            <th>SNL</th>
                            <th>DontDel</th>
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
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css"/>
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
    td.details-control{
    background: {{url('/img/details_open.png')}} no-repeat center center;
    }
    tr.shown td.details-control{
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
<script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
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
<script src="{{ asset('library/moment/moment.js') }}"></script>
<script src="{{ asset('js/_commonFunctions.js') }}"></script>
<script src="{{ asset('js/pages/_fieldsMarketPlace.js') }}"></script>

<script>
    let $modal = $('#myModal3');
    let $marketTable;
    let $form;
    let empty = true;
    let fpriceReplace='';


    $modal.on("hidden.bs.modal", function(){
        $(".modal-body").html("");
        $('.modal-dialog').removeClass().addClass('modal-dialog modal-lg');
        $('.modal-header').removeClass().addClass('modal-header bg-primary');
        $('.modal-footer').children().hide();
    });
    $modal.on("shown.bs.modal",function(){
        $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
        $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
            $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
        } );

    });
    $modal.on("show.bs.modal",function(){
        $('.myselect2').select2({
            theme: 'bootstrap4',
            width: '100%',
            dropdownParent: $("#myModal3")
        });
    });


    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.show_hide').hide();

        $marketTable = $('#market-table').DataTable({
            pageLength: 25,
            stateSave: true,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
            scrollY: "60vh",
            scrollX: true,
            scrollCollapse: true,
            processing:true,
            serverSide:true,
            select: true,

            language: {
                loadingRecords: "Please wait - loading..."
            },
            dom: '"<\'row\'<\'col-sm-12 col-md-8\'B><\'col-sm-12 col-md-4\'f>>" +\n' +
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
                    {   extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel-o"></i> Excel',
                        title: 'Excel MktPlaceMapping',
                        titleAttr: 'Excel',
                        className: 'btn btn-success export-excel',
                        exportOptions: {
                            format:{
                                body: function ( data, row, column, node ) {
                                    return $(data).is("input") || $(data).is("select") ?
                                        $(data).val():
                                        data;
                                },
                            },
                            columns: [1,2,3,4,5,6,7,8,9,10]
                        }
                    },{ extend: 'csvHtml5',
                        text: '<i class="fa fa-file-text-o"></i> CSV',
                        title: 'CSV MktPlaceMapping',
                        titleAttr: 'CSV',
                        className: 'btn btn-warning export-csv',
                        exportOptions: {
                            format:{
                                body: function ( data, row, column, node ) {
                                    return $(data).is("input") || $(data).is("select") ?
                                        $(data).val():
                                        data;
                                },
                            },
                            columns: [1,2,3,4,5,6,7,8,9,10]
                        }
                    },{ extend: 'pageLength',
                        titleAttr: 'Show Records',
                        className: 'btn btn-black selectTable'
                    },{ text: '<i class="fa fa-plus"></i> Merchant SKU',
                        titleAttr: 'Merchant SKU',
                        className: 'btn btn-primary',
                        attr: {
                            id:'create-mkt'
                        }
                    },{ text: '<i class="fa fa-cloud-upload"></i> Launch',
                        titleAttr: 'Launch',
                        className: 'btn btn-danger launch-btn',
                        attr: {
                            id:'launch-btn'
                        }

                    },{ text: '<i class="fa fa-cloud-upload"></i> Update Repricer',
                        titleAttr: 'Update Repricer',
                        className: 'btn btn-info ',
                        attr: {
                            id:'update-repricer-btn'
                        }
                    },{ text: '<i class="fa fa-sort-amount-asc"></i> Update Bulk Price',
                        titleAttr: 'Update Floor & Ceiling',
                        className: 'btn btn-black ',
                        attr: {
                            id:'update-bulk-btn',
                            disabled:"disabled"
                        },
                    },{ text: '<i class="fa fa-thumbs-down"></i> Delete Bulk SKU',
                        titleAttr: 'Delete Bulk SKU',
                        className: 'btn btn-danger ',
                        attr: {
                            id:'delete-bulk-sku-btn',
                            disabled:"disabled"
                        },
                    }
                ],
            },

            order: [8, "desc"],
            ajax: {
                url: '{!! route('market.getData') !!}',
                data: function (d) {
                    d.hasCondition = $('select[name=condition]').val();
                    d.hasFulfillment = $('select[name=fulfillment]').val();
                    d.isCN = $('select[name=isCN]').val();
                }
            },
            columns: [
                {},
                {"data":"SKU",name:"SKU"},
                {"data":"Condition",name:"Condition"},
                {"data":"FulfillmentType",name:"FulfillmentType"},
                {"data":"MerchantSKU",name:"MerchantSKU"},
                {"data":"ASIN",name:"ASIN"},
                {"data":"Floor",name:"Floor"},
                {"data":"Ceiling",name:"Ceiling"},
                {"data":"Stamp",name:"Stamp"},
                {"data":"IsCN",name:"IsCN"},
                {"data":"IsSnL",name:"IsSnL"},
                {"data":"DontDel",name:"DontDel"},
                {"data": "Delete", name: "Delete"},
            ],
            columnDefs: [
                {
                    searchable:false,
                    targets: 0,
                    className: "details-control",
                    orderable: false,
                    data: null,
                    defaultContent: ''

                },{
                    targets: 1,
                    render: function (data, type, row) {
                        return `<a href="#" class="edit-mkt" data-id='${row.ID}'>${data}</a>`;
                    },
                }, {
                    targets: 3,
                    render: function (data, type, row) {
                        return `<select class="custom-select fulfillment-type" >
                                    <option value='Amazon' ${(data==='Amazon')?'selected':''}>Amazon</option>
                                    <option value='Merchant' ${(data==='Merchant')?'selected':''}>Merchant</option>
                                    <option value='Walmart' ${(data==='Walmart')?'selected':''}>Walmart</option>
                                </select>`;
                    }
                },{
                    targets: 4,
                    render: function (data, type, row) {
                        return `${data}-${(row.Condition.indexOf('-')!=-1)? row.Condition.split('-')[0]:row.Condition}`;
                    },
                }, {
                    targets: 6,
                    render: function (data, type, row) {
                        return `<input class="form-control floor_price" type="number" data-id="${row.SKU}" value="${data}">`
                    },
                }, {
                    targets: 7,
                    render: function (data, type, row) {
                        return `<input class="form-control ceiling_price" type="number" data-id="${row.SKU}"  value="${data}">`
                    }
                },{
                    targets: 8,
                    render: function (data, type, row) {
                       return  (moment(data).isValid()) ? moment(data).format("MMM-DD-YYYY hh:mm a") : "-";
                    },
                },{
                    targets: 9,
                    render: function (data, type, row) {
                        return `${data?'true':'false'}`
                    }
                },{
                    targets: 10,
                    render: function (data, type, row) {
                        if (type === 'display') {
                            return `<input type="checkbox" data-id="${row.SKU}" class="is-snl custom-checkbox" value="${data?'true':'false'}">`
                        }
                        return data
                    },
                    className: "text-center"
                },{
                    targets: 11,
                   // data: 'Checked',
                    render: function (data, type, row) {
                        if (type === 'display') {
                            return `<input type="checkbox" data-id="${row.SKU}" class="custom-checkbox" value="false">`
                        }
                        return data
                    },
                    className: "text-center dont-del"
                },{
                    searchable:false,
                    targets: 12,
                    render: function (data, type, row) {
                        return `<a href="#" class="delete-mkt btn btn-xs btn-danger" data-id="${row.SKU}"><i class="fa fa-trash" aria-hidden="true"></i></a>`
                    },
                    className: "text-center"
                },

            ],
            rowCallback: function (row, data) {
                // Set the checked state of the checkbox in the table
                $('.is-snl', row).prop('checked', data.IsSnL == 1);
                //$('.dont-del', row).prop('checked', data.DontDel == 1);
            }
        });

        $('#market-table tbody').on('click','td.details-control',function(){
            let tr = $(this).closest('tr');
            let sku = $marketTable.row( tr ).data().SKU;
            //let sku = tr.attr('SKU');
            let row = $marketTable.row(tr);
            let url = `catalog/${sku}`;
            let data = myAjaxGET(url, 'GET','');
            if (row.child.isShown()){
                row.child.hide();
                row.child='';
                tr.removeClass('shown');
            }else{
                row.child(format(data)).show();
                tr.addClass('shown');
            }
        });


        $('input[type="search"]').on('keyup',function(){
            if ($(this).val().length === 0) {
                $('#update-bulk-btn').attr('disabled','disabled');
                $('#delete-bulk-sku-btn').attr('disabled','disabled');
            } else {
                $('#update-bulk-btn').removeAttr('disabled');
                $('#delete-bulk-sku-btn').removeAttr('disabled');
            }
        });

        $('#mkt-search-form').on('submit', function(e) {
            $marketTable.draw();
            e.preventDefault();
        });

    });

    //Launch RED Button
    $(document).on('click', '#launch-btn', function (e){
        e.preventDefault();

        $.confirm({
            title: 'Confirm!',
            content: 'Are you sure to update Launch this products?',
            buttons: {
                confirm: function () {
                    let ret = myAjaxGET('{!! route('action.launchInv') !!}','GET');

                    if(ret){
                        $.alert(ret.msg);
                    }
                },
                cancel: function () {
                    return true
                },
            }
        });
    });

    //Update LightButton Repricer Button
    $(document).on('click', '#update-repricer-btn', function (e){
        e.preventDefault();

        $.confirm({
            title: 'Confirm!',
            content: 'Are you sure to update repricer?',
            buttons: {
                confirm: function () {
                    let ret = myAjaxGET('{!! route('action.update.repricer') !!}','GET');
                    if(ret){
                        $.alert(ret.msg);
                    }
                },
                cancel: function () {
                    return true
                },
            }
        });
    });

    //Bulk Price Button
    $(document).on('click', '#update-bulk-btn', function (e){
        e.preventDefault();
        $modal.find('.modal-title').html(`<h4> Update Bulk Price</h4>`);
        $modal.find(".modal-dialog").removeClass().addClass('modal-dialog modal-sm');
        $modal.find(".modal-body").append($updateBulkFields);
        $modal.find('.modal-footer').find('#save-same').hide();
        $modal.find('.modal-footer').find('#save-new').hide();
        $modal.find('.modal-footer').find('#success').hide();
        $modal.find('.modal-footer').find('#save-bulk').show();
        $modal.find('.modal-footer').find('#cancel').show();
        $form = $("#update-bulk-form");
        $form.attr('action',`market/updateBulkPrice`);
        $form.attr('method','POST');

        $modal.modal();
    });


    //Bulk Price Form Action
    $('#save-bulk').on('click',function(e){
        e.preventDefault();
        let ids = $marketTable.rows( { search:'applied' } ).ids().toArray();

        let $form = $modal.find('.form-active');
        let url = $form.attr('action');
        let method = $form.attr('method');

        for (let i = 0; i <ids.length; i++) {
            let id=ids[i];
            $form.append(`<input type="hidden" class="idsBulkUpdate" name="ids[${i}]" value="${id}">`);
        }

        $.confirm({
            title: 'Alert !!!',
            content: 'This action will change the prices of all the SKUs listed.',
            buttons: {
                confirm: function () {
                   let $ret = myAjaxPost(url,method,$form.serialize());

                   if($ret.msg){
                        $.alert('Wait to reload table!');
                        $marketTable.ajax.reload();
                    }
                    $form.find('input:hidden').remove();
                   return true
                },
                cancel: function () {
                    $('#bulkFloorPrice').val('');
                    $('#bulkCeilingPrice').val('');
                    $.alert('Transaction canceled!');
                   // return false
                },
            }
        });

        return true;
    });


    $(document).on('click', '#delete-bulk-sku-btn', function (e){
        e.preventDefault();
        let $form = $("<form></form>");
        let url = `market/deleteBulkPrice`;
        let method ='POST';

        $marketTable.rows( { search:'applied' } ).every(function(rowIdx, tableLoop, rowLoop){

            let data = this.node();
            let dontDel = data.cells[11].firstChild.checked;
            let rowId = data.id;
            if(!dontDel){
                $form.append(`<input type="hidden" class="idsBulkUpdate" name="ids[${rowIdx}]" value="${rowId}">`);
            }
        });

        if($form[0].elements.length) {
            $.confirm({
                title: 'Alert !!!',
                content: 'This action will delete permanently all SKUs Listed.',

                buttons: {
                    confirm: {
                        btnClass: 'btn-danger',
                        action: function () {

                            let $ret = myAjaxPost(url, method, $form.serialize());

                            if ($ret.msg) {
                                $.alert('Wait to reload table!');
                                $marketTable.ajax.reload();
                            }
                            $form.remove();

                            return true
                        }
                    },
                    cancel: function () {
                        $.alert('Transaction canceled!');
                        // return false
                    },
                }
            });
        }
    });

    //fulfillmentType
    $(document).on('change','.fulfillment-type',function(){
        let $tr = $(this).closest('tr');
        let $td = $(this).parent();
        let value = this.value;
        let rowId = $tr.attr('id');
        let url = `market/fulfillment/${rowId}`;

        $form = $(`<form><form>`);
        $form.append(`<input type="hidden" name="FulfillmentType" value="${value}">`);
        let $return = myAjaxPost(url,'PUT',$form.serialize());

        if($return){
            $td.find('option').each(function(i, o) {
                $(o).removeAttr('selected');
                if ($(o).val() === value) $(o).attr('selected', true);
            });
        }else{
            $marketTable.cell($td).invalidate().draw();
        }
       return false;
    });

    //floor Price
    $(document).on('change','.floor_price',function(){
        let $tr = $(this).closest('tr');
        let $td = $(this).parent();
        let value = this.value;
        let rowId = $tr.attr('id');
        let url = `market/floor/${rowId}`;

        $form = $(`<form><form>`);
        $form.append(`<input type="hidden" name="Floor" value="${value}">`);
        let $return = myAjaxPost(url,'PUT',$form.serialize());

        if($return){
            $marketTable.cell($td).draw();
        }else{
            $marketTable.cell($td).invalidate().draw();
        }
        return false;

    });

    //ceiling Price
    $(document).on('change','.ceiling_price',function(){
        let $tr = $(this).closest('tr');
        let $td = $(this).parent();
        let value = this.value;
        let rowId = $tr.attr('id');
        let url = `market/ceiling/${rowId}`;

        $form = $(`<form><form>`);
        $form.append(`<input type="hidden" name="Ceiling" value="${value}">`);
        let $return = myAjaxPost(url,'PUT',$form.serialize());

        if($return){
            $marketTable.cell($td).draw();
        }else{
            $marketTable.cell($td).invalidate().draw();
        }
        return false;
    });

    // IsSnl checkbox
    $(document).on('change','.is-snl',function(){
        let $tr = $(this).closest('tr');
        let $td = $(this).parent();
        let value = this.value;
        let rowId = $tr.attr('id');
        let url = `market/isSnl/${rowId}`;

        $form = $(`<form><form>`);
        $form.append(`<input type="hidden" name="IsSnL" value="${value}">`);
        let $return = myAjaxPost(url,'PUT',$form.serialize());

        if($return){
            $td.find('checkbox',function(i, o) {
                $(o).val(value);
            });
        }else{
            $marketTable.cell($td).invalidate().draw();
        }
        return true;
    });

    //delete Button
    $(document).on('click','.delete-mkt',function(){
        let $tr = $(this).closest('tr');
        let rowId = $tr.attr('id');
        let url = `market/${rowId}`;

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

    //Create SKU Click Grid Row ---- To Removeeeee-----
    $(document).on('click', '#create-mkt', function (e) {
        e.preventDefault();
        let skus = myAjaxGET('market/create', 'GET');
        $modal.find('.modal-title').html(`<h4> Market Place Mapping</h4>`);
        $modal.find('.modal-footer').find('#save-same').show();
        $modal.find('.modal-footer').find('#save-new').show();
        $modal.find('.modal-footer').find('#success').show();
        $modal.find('.modal-footer').find('#save-bulk').hide();
        $modal.find('.modal-footer').find('#cancel').show();
        $modal.find('#success').text('Create SKU');
        $modal.find(".modal-body").append($createMktFields);
        $form = $("#create-mkt-form");
        $form.attr('action',`market`);
        $form.attr('method','PUT');
        //fill SKUs
        $.frm_sku=($form.find('#SKU'));
        $.each(skus,function () {
            $.frm_sku.append($("<option/>")
                .val(this.SKU)
                .text(this.SKU))
        });
        $modal.modal();


        $modal.find('#SKU').on('change',function(e){
            e.preventDefault();
            let sku= this.value;
            if(sku){
                let mSku = myAjaxGET(`market/getMS/${sku}`, 'GET');
                $('#MerchantSKU').val(mSku);
                $form.find('#Floor').val('14.99');
                $form.find('#Ceiling').val('19.99')
            }
        });
    });

    //Edit SKU Click Grid Row
    $(document).on('click', '.edit-mkt', function (e) {
        e.preventDefault();
        let row = getRowData($(this).data('id'));
        $modal.find('.modal-title').html(`<h4> Market Place Mapping - ${row['market'].SKU}</h4>`);
        $modal.find('.modal-footer').find('#save-same').show();
        $modal.find('.modal-footer').find('#save-new').show();
        $modal.find('.modal-footer').find('#success').show();
        $modal.find('.modal-footer').find('#save-bulk').hide();
        $modal.find('.modal-footer').find('#cancel').show();
        $modal.find('#success').text('Update SKU');
        $modal.find(".modal-body").append($updateMktFields);
        $form = $("#update-mkt-form");
        $form.attr('action',`market/${row['market'].ID}`);
        $form.attr('method','PUT');
        fillFields(row['market'],$form);
        $form.find('#IsSnL').prop('checked', row['market'].IsSnL);
        $form.find('#IsCN').prop('checked', row['market'].IsCN);
        $form.find('#DumpIt').prop('checked', row['market'].DumpIt);

        //fill SKUs
        $.frm_sku=($form.find('#SKU'));
        $.each(row['sku'],function () {
            $.frm_sku.append($("<option/>")
                .val(this.SKU)
                .text(this.SKU))
        });
        //Select SKU
        $("#SKU option[value="+row['market'].SKU+"]").attr('selected','selected');

        $modal.modal();

        $modal.find('#SKU').on('change',function(e){
            e.preventDefault();
            let sku= this.value;
            if(sku){
                let mSku = myAjaxGET(`market/getMS/${sku}`, 'GET');
                $('#MerchantSKU').val(mSku);
            }
        });
    });

    ///successButton
    $(document).on('click','#success',function(e){
        e.preventDefault();
        let $form = $modal.find('.form-active');
        let url = $form.attr('action');
        let method = $form.attr('method');
        myAjaxPost(url,method,$form.serialize());
        $marketTable.ajax.reload();
    });

    $(document).on('click','#save-same',function(e){
        e.preventDefault();
        let $form = $modal.find('.form-active');
        let url = $form.attr('action');
        let method = $form.attr('method');

        let ret = myAjaxGET(url,method,$form.serialize());

        if(ret){
            $form.find('#ASIN').focus();
            $form.find('#MerchantSKU').val(ret.merchantSku);
            $marketTable.ajax.reload();
        }
    });

    $(document).on('click','#save-new',function(e){
        e.preventDefault();
        let $form = $modal.find('.form-active');
        let url = $form.attr('action');
        let method = $form.attr('method');
        let ret = myAjaxGET(url,method,$form.serialize());
        if(ret){
            $form[0].reset();
            $('.myselect2').val('').trigger('change');
            $form.find('#FulfillmentType').val('Amazon').select2({theme: 'bootstrap4'});
            $form.find('#SKU').val('').select2({theme: 'bootstrap4'});
            $form.find('#Condition').val('New').select2({theme: 'bootstrap4'});
            $form.find('#MerchantSKU').val('-001');
            $marketTable.ajax.reload();
        }
    });


</script>
@endpush
