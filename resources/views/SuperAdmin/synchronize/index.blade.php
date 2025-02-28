@extends('SuperAdmin.layouts.master')

@push('title')
    Synchronize
@endpush
@push('datatableCSS')
    <!-- DataTables -->
    <link href="{{ asset('assets/super-admin/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/super-admin/plugins/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/super-admin/plugins/datatables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/super-admin/plugins/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/super-admin/plugins/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/super-admin/plugins/datatables/scroller.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
@endpush


@section('content')
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header-title">
                        <h4 class="pull-left page-title">All Synchronize Rule</h4>
                        <ol class="breadcrumb pull-right">
                            <li><a href="{{route('superAdmin.dashboard')}}">Dashboard</a></li>
                            <li class="active">All Synchronize Rule</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row m-b-15">
                <div class="col-sm-12">
                    <a class="btn btn-primary" href="{{route('superAdmin.synchronize.create')}}"><i class="fa fa-plus"></i> Create Synchronize Rule</a>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">All Synchronize Rule Table</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="datatable-buttons" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th style="width: 5%">#SL</th>
                                            <th style="width: 10%">Country Name</th>
                                            <th>Rule</th>
                                            <th style="width: 10%">Status</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>

                                        </thead>
                                        <tbody>
                                        @foreach($synchronizes as $synchronize)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$synchronize->country->name}}</td>
                                                <td>{{$synchronize->synchronize_rule}}</td>
                                                <td><span class="label {{$synchronize->status ? 'label-success':'label-warning'}}">{{$synchronize->status ? 'Active':'Inactive'}}</span></td>
                                                <td>
                                                    <a href="{{route('superAdmin.synchronize.edit', $synchronize->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                                    <button class="btn btn-danger" onclick="delete_function(this)" value="{{ route('superAdmin.synchronize.destroy', $synchronize->id) }}"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('datatableJS')
    <!-- Datatables-->
    <script src="{{ asset('assets/super-admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/super-admin/plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/super-admin/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/super-admin/plugins/datatables/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/super-admin/plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/super-admin/plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/super-admin/plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/super-admin/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/super-admin/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/super-admin/plugins/datatables/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('assets/super-admin/plugins/datatables/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/super-admin/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/super-admin/plugins/datatables/responsive.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/super-admin/plugins/datatables/dataTables.scroller.min.js') }}"></script>
    <!-- Datatable init js -->
    <script src="{{ asset('assets/super-admin/pages/datatables.init.js') }}"></script>
@endpush

@push('script')
@endpush
