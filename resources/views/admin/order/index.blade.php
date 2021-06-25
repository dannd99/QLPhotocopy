@extends('admin.layout')

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
                    <h4 class="m-b-0">Đơn hàng</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item" atr="All">
                    <a class="nav-link" data-toggle="tab" href="javascript:;">
                        <span class="tab-title">Tất cả <span class="m-l-5 badge badge-primary"><?php echo $all ?></span></span>
                        <span class="order-counter"></span>
                    </a>
                </li>
                <li class="nav-item" atr="Pending">
                    <a class="nav-link active" data-toggle="tab" href="javascript:;">
                        <span class="tab-title">Đang chờ<span class="m-l-5 badge badge-warning"><?php echo $Pending ?></span></span>
                        <span class="order-counter"></span>
                    </a>
                </li>
                <li class="nav-item" atr="Confirm">
                    <a class="nav-link " data-toggle="tab" href="javascript:;">
                        <span class="tab-title">Đã xác nhận<span class="m-l-5 badge badge-info"><?php echo $Confirm ?></span></span>
                        <span class="order-counter"></span>
                    </a>
                </li>
                <li class="nav-item" atr="Processing">
                    <a class="nav-link" data-toggle="tab" href="javascript:;">
                        <span class="tab-title">Đang Xử Lí<span class="m-l-5 badge badge-info"><?php echo $Processing ?></span></span>
                        <span class="order-counter"></span>
                    </a>
                </li>
                <li class="nav-item" atr="Success">
                    <a class="nav-link" data-toggle="tab" href="javascript:;">
                        <span class="tab-title">Thành công<span class="m-l-5 badge badge-success"><?php echo $Success ?></span></span>
                        <span class="order-counter"></span>
                    </a>
                </li>
                <li class="nav-item" atr="Shipped">
                    <a class="nav-link" data-toggle="tab" href="javascript:;">
                        <span class="tab-title">Đã giao hàng<span class="m-l-5 badge badge-success"><?php echo $Shipped ?></span></span>
                        <span class="order-counter"></span>
                    </a>
                </li>
                <li class="nav-item" atr="Request Unpaid">
                    <a class="nav-link" data-toggle="tab" href="javascript:;">
                        <span><i class="anticon anticon-delete"></i> </span>
                        <span class="tab-title">Yêu cầu hủy<span class="m-l-5 badge badge-danger"><?php echo $RequestUnpaid ?></span></span>
                        <span class="order-counter"></span>
                    </a>
                </li>
                <li class="nav-item" atr="Unpaid">
                    <a class="nav-link" data-toggle="tab" href="javascript:;">
                        <span><i class="anticon anticon-delete"></i> </span>
                        <span class="tab-title">Loại bỏ<span class="m-l-5 badge badge-danger"><?php echo $Unpaid ?></span></span>
                        <span class="order-counter"></span>
                    </a>
                </li>
            </ul>
            <div class="m-t-25">
                <table id="orders-table" class="table"> </table>
            </div>
        </div>
    </div>
</div>

@endsection()


@section('modal')

@endsection()

@section('js')
<!-- page js -->
<script src="{{ asset('assets/vendors/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables/dataTables.bootstrap.min.js') }}"></script>

<script src="{{ asset('assets/js/page-orders-admin.js') }}"></script>


@endsection()