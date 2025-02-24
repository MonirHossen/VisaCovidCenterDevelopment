@extends('Volunteer.layouts.master')

@push('title')
    Vaccine | Premium
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/center-part/css/accordion_table_16.css') }}">

     {{-- datatables --}}
    <link href="{{ asset('assets/super-admin/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet"
     type="text/css" />
    <link href="{{ asset('assets/super-admin/plugins/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/super-admin/plugins/datatables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/super-admin/plugins/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/super-admin/plugins/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/super-admin/plugins/datatables/scroller.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
@endpush

@section('content')
    <div class="container py-4">
        <div class="card page-wrapper">
            <div class="accordion-table-breadcrumb">
                <div class="accordion-table-header ">
                    <div class="container">
                        <div class="row justify-content-between">
                            <div class="col-4">
                                <div class="accorion-link mt-2" id='active-div'>
                                    <a href="{{ route('volunteer.premium.pcr') }}" class="accorion-btn">PCR</a>
                                    <a href="{{ route('volunteer.premium.vaccine') }}" class="accorion-btn breadcrumb-active">Vaccine</a>
                                    <a href="{{ route('volunteer.premium.booster') }}" class="accorion-btn">Booster</a>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="ID/Name/Phone/Date">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion" id="accordionExample">
                @foreach ($vaccinationsOrderByDate as $vaccinationOrderByDate)
                    <div class="accordion-item table-accordion-item">
                        <h2 class="accordion-header" id="heading{{ $loop->iteration }}">
                            <button class="accordion-button table-accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $loop->iteration }}" aria-expanded="true"
                                aria-controls="collapse{{ $loop->iteration }}">
                                <span class="table-accordion-date">{{ Carbon\Carbon::parse($vaccinationOrderByDate->first()->updated_at)->format('d/m/Y') }}</span>
                                <span class="table-accordion-people">{{ $vaccinationOrderByDate->count() }} People</span>
                            </button>
                        </h2>
                        <div id="collapse{{ $loop->iteration }}"
                            class="accordion-collapse collapse @if ($loop->iteration == 1) show @endif"
                            aria-labelledby="heading{{ $loop->iteration }}"
                            data-bs-parent="#accordionExample{{ $loop->iteration }}">
                            <div class="accordion-body table-accordion-body">
                                <table class="table accordion-table" id="datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col"> <input type="checkbox" class="custom-control-input"
                                                    id="customCheck1" checked></th>
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Gender</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vaccinationOrderByDate as $vaccination)
                                            <tr class="table-row">
                                                <td><input type="checkbox" class="custom-control-input" id="customCheck1">
                                                </td>
                                                <td>{{ $vaccination->user_id }}</td>
                                                <td>{{ $vaccination->user->name }}</td>
                                                <td>{{ $vaccination->user->phone }}</td>
                                                <td>{{ $vaccination->user->userInfo->gender ?? '-' }}</td>
                                                <td>
                                                    <a href="{{ route('volunteer.payment.takePaymentFromUser', [$vaccination->user_id, 'premium-vaccine']) }}"><i class="fa fa-sign-in-alt" style="font-size: 36px;"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th scope="col"> <input type="checkbox" class="custom-control-input" id="customCheck1" checked></th>
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Gender</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection

@push('script')
    {{-- datatables --}}
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
