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
                    <h4 class="m-b-0">Chi tiết đơn hàng</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-8 offset-2">
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
                                <p class="col font-weight-semibold"> <?php echo number_format($order->services_prices) ?></p>
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
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-semibold">Trang bắt đầu:</label>
                                        <input type="text" class="form-control time-action printed_start" name="printed_start" value="<?php echo $order->printed_start ?>" min="1" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-semibold">Trang kết thúc:</label>
                                        <input type="text" class="form-control time-action printed_end" name="printed_end" value="<?php echo $order->printed_end ?>" min="1" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold">Số bản copy:</label>
                                <input type="text" class="form-control url" name="copy" value="<?php echo number_format($order->copy) ?>" required="" readonly>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold">Tổng tiền:</label>
                                <input type="text" class="form-control url" name="copy" value="<?php echo number_format($order->total_prices) . " Đ"?>" required="" readonly>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold">Trạng thái:</label>
                                <?php if ($order->payment_status == 0): ?>
                                    <span class=" badge badge-pill badge-danger">Chưa thanh toán</span>
                                <?php elseif ($order->payment_status == 1): ?>
                                    <span class=" badge badge-pill badge-success">Đã thanh toán qua VNPay</span>
                                <?php else: ?>
                                    <span class=" badge badge-pill badge-success">Đã thanh toán Khi nhận hàng</span>
                                <?php endif ?>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold">Đường dẫn file:</label>
                                <a class=" badge badge-pill badge-info" href="<?php echo $order->url ?>" target="_blank"><i class="anticon anticon-link m-r-5"></i>Truy cập</a>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold">Ghi chú khác:</label>
                                <textarea class="form-control note" name="note" required="" readonly><?php echo $order->note ?></textarea>
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