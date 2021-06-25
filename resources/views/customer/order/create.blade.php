@extends('customer.layout')

@section('css')

<!-- page css -->
<link href="{{ asset('assets/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">


@endsection()

@section('body')

<div class="main-content">

    <div class="page-header no-gutters has-tab">
        <div class="d-md-flex m-b-15 align-items-center justify-content-between notification relative" id="notification">
            <div class="media align-items-center m-b-15">
                <div class="m-l-15">
                    <h4 class="m-b-0">Tạo đơn hàng với: <?php echo $service->name ?></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-8 offset-2">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if ( Session::has('success') )
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="d-md-flex align-items-center">
                            <div class="text-center text-sm-left ">
                                <div class="avatar avatar-image" style="width: 150px; height:150px">
                                    <img src="{{ asset($service->image) }}" alt="">
                                </div>
                            </div>
                            <div class="text-center text-sm-left m-v-15 p-l-30">
                                <h2 class="m-b-5"><?php echo $service->name ?></h2>
                            </div>
                        </div>
                        <ul class="list-unstyled m-t-50">
                            <li class="row">
                                <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                    <i class="m-r-10 text-primary anticon anticon-dollar"></i>
                                    <span>Đơn giá: </span> 
                                </p>
                                <p class="col font-weight-semibold"> <?php echo number_format($service->prices) ?></p>
                            </li>
                            <li class="row">
                                <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                    <i class="m-r-10 text-primary anticon anticon-file-protect"></i>
                                    <span>Mô tả: </span> 
                                </p>
                                <p class="col font-weight-semibold" style="text-align: justify;"> <?php echo $service->description; ?></p>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <form method="POST" action="{{ route('customer.store') }}">
                            @csrf
                            <input type="hidden" name="customer_id" value="<?php echo $user_id ?>">
                            <input type="hidden" name="services_id" value="<?php echo $service->id ?>">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-semibold">Trang bắt đầu:</label>
                                        <input type="number" class="form-control time-action printed_start" name="printed_start" value="1" min="1">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-semibold">Trang kết thúc:</label>
                                        <input type="number" class="form-control time-action printed_end" name="printed_end" value="1" min="1">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold">Số bản copy:</label>
                                <input type="number" class="form-control url" name="copy" value="1" min="1" required="">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold">Slide/ trang:</label>
                                <input type="number" class="form-control" name="slide" value="1" min="1">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold">Đường dẫn file:</label>
                                <input type="text" class="form-control url" name="url" value="" required="">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold">Ghi chú khác:</label>
                                <textarea class="form-control note" name="note" required=""></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" style="float: right;">Tạo đơn hàng</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection()



@section('js')
<!-- page js -->
<script src="{{ asset('assets/vendors/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables/dataTables.bootstrap.min.js') }}"></script>



@endsection()