@extends('SuperAdmin.layouts.master')

@push('title')
    Edit Payment Method
@endpush

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header-title">
                        <h4 class="pull-left page-title">Edit Payment Method</h4>
                        <ol class="breadcrumb pull-right">
                            <li><a href="{{route('superAdmin.dashboard')}}">Dashboard</a></li>
                            <li><a href="{{route('superAdmin.payment.index')}}">All Payment Method</a></li>
                            <li class="active">Edit Payment Method</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit Payment Method</h3>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <form role="form" action="{{route('superAdmin.payment.update', $paymentMethod->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @include('Others.message')
                                        @method('put')
                                        <div class="form-group">
                                            <label for="name">Payment Method Name</label>
                                            <input type="text" name="name" value="{{$paymentMethod->name ? $paymentMethod->name : old('name') }}" class="form-control @error('name') is-invalid @enderror" id="ex1" placeholder="Enter Payment Method Name">
                                        </div>
                                        @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror


                                        <div class="form-group">
                                            <label for="image">Payment Method Image</label>
                                            <img src="{{asset($paymentMethod->image)}}" alt="course thumbnail" class="img-responsive w-lg" style="height: 200px;">
                                        </div>

                                        <div class="form-group">
                                            <input type="file" name="image" value="{{ old('image') ? old('image') : '' }}" class="form-control @error('image') is-invalid @enderror">
                                        </div>
                                        @error('image')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror


                                        <div class="form-group">
                                            <label for="status">Payment Method Status</label>
                                            <br>
                                            @php
                                                if(old('status')){
                                                    $status = old('status');
                                                }else{
                                                    $status = $paymentMethod->status;
                                                }
                                            @endphp

                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="inlineRadio1" value="1" name="status" @if($status==1) {{'checked'}}@endif>
                                                <label for="inlineRadio1">Active</label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="inlineRadio1" value="0" name="status"@if($status==0) {{'checked'}}@endif>
                                                <label for="inlineRadio1">Inactive</label>
                                            </div>
                                        </div>
                                        @error('status')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                        <button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
                                        <a href="{{route('superAdmin.payment.index')}}" class="btn btn-info waves-effect waves-light">Back</a>
                                    </form>
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

@push('script')
@endpush
