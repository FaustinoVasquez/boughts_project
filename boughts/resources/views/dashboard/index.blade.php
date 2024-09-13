@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Dashboard
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')

@stop

{{-- Page content --}}
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="card panel-primary filterable">
                    <div class="card-heading">
                        <h3 class="card-title">
                            <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff"
                               data-hc="white"></i> Dashboard
                        </h3>
                        <span class="pull-right ">
                            <i class="fa fa-chevron-up clickable"></i>
                        </span>
                    </div>
                    <div class="card-body">
                        <form id="dashboard-form">
                            <div class="form-row align-items-center">
                                <div class="col-auto">
                                    <label class="sr-only" for="condition">Condition</label>
                                    <select class="form-control" name="condition" id="condition">
                                        <option value="NEW">New</option>
                                        <option value="USED">Used</option>
                                        <option value="CN">CN</option>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <label class="sr-only" for="days">Days</label>
                                    <select class="form-control" name="days" id="days">
                                        <option value="30">Last 30 Days</option>
                                        <option value="60">Last 60 Days</option>
                                        <option value="90">Last 90 Days</option>
                                        <option value="120">Last 120 Days</option>
                                        <option value="365">Last 1 Year</option>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <div class="row ">
                            <div class="col-lg-12">
                                <table class="table" id="dashboard-table">
                                    <thead>
                                    <tr>
                                        <th>#SKU</th>
                                        <th>Manufacturer</th>
                                        <th>Part Number</th>
                                        <th>Qty Sold</th>
                                        <th>AvsSalesPrice</th>
                                        <th>Qty</th>
                                        <th>Category Name</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
@endpush

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
    <script src="{{ asset('library/moment/moment.js') }}"></script>
    <script src="{{ asset('js/_commonFunctions.js') }}"></script>
    <script>
        let table ='';

        $('#dashboard-form').on('submit',function (e) {
            e.preventDefault();

            if(table!==''){
                table.destroy();
            }

          table =$('#dashboard-table').DataTable({
                processing: true,
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
                      {   extend: 'excelHtml5',
                          text: '<i class="fa fa-file-excel-o"></i> Excel',
                          title: 'Excel MktPlaceMapping',
                          titleAttr: 'Excel',
                          className: 'btn btn-success export-excel',
                          exportOptions: {
                              columns: [0,1,2,3,4,5,6]
                          }
                      },{ extend: 'csvHtml5',
                          text: '<i class="fa fa-file-text-o"></i> CSV',
                          title: 'CSV MktPlaceMapping',
                          titleAttr: 'CSV',
                          className: 'btn btn-warning export-csv',
                          exportOptions: {
                              columns: [0,1,2,3,4,5,6]
                          }
                      }
                  ],
                  },
                ajax: {
                    url: '/getData',
                    data: function (d) {
                        d.condition = $('#condition option:selected').val();
                        d.days = $('#days option:selected').val();
                    }
                },
                columns: [
                    {data:'SKU',name:'SKU'},
                    {data:'Manufacturer',name:'Manufacturer'},
                    {data:'PartNumber',name:'PartNumber'},
                    {data:'QtySold',name:'QtySold'},
                    {data:'AvsSalesPrice',name:'AvsSalesPrice'},
                    {data:'Qty',name:'Qty'},
                    {data:'CategoryName',name:'CategoryName'},
                ]
            });


        });

    </script>
@endpush

