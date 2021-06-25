@extends('customer.layout')

@section('css')

<!-- page css -->
<link href="{{ asset('assets/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">


@endsection()

@section('body')

<div class="main-content">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div id="invoice" class="p-h-30">
                    <div class="m-t-15 lh-2">
                        <div class="inline-block">
                            <img class="img-fluid" src="{{ $service->image }}" alt="" style="width: 100px;">
                        </div>
                        <div class="float-right">
                            <h2>Báo cáo</h2>
                        </div>
                    </div>
                    <div class="row m-t-20 lh-2">
                        <div class="col-sm-9">
                            <h3 class="p-l-10 m-t-10">Chi tiết đơn hàng:</h3>
                            <address class="p-l-10 m-t-10">
                                <span class="font-weight-semibold text-dark">Dịch vụ: <?php echo $service->name ?></span><br>
                                <span>Đơn giá: <?php echo number_format($service->prices) . " Đ" ?> </span><br>
                                <span>Số nhân bản: <?php echo number_format($order->copy) ?> </span><br>
                                <span>Đường dẫn: <a href="<?php echo $order->url ?>"><?php echo $order->url ?></a> </span><br>
                            </address>
                        </div>
                        <div class="col-sm-3">
                            <div class="m-t-80">
                                <div class="text-dark text-uppercase d-inline-block">
                                    <span class="font-weight-semibold text-dark">Ghi chú :</span></div>
                                <div class="float-right"><?php echo $order->note ?></div>
                            </div>
                            <div class="text-dark text-uppercase d-inline-block">
                                <span class="font-weight-semibold text-dark">Ngày tạo :</span>
                            </div>
                            <div class="float-right"><?php echo date("d/m/Y"); ?></div>
                        </div>
                    </div>
                    <div class="row m-t-30 lh-1-8">
                        <div class="col-sm-12">
                            <div class="float-right text-right">
                                <p>Đơn giá: <?php echo number_format($service->prices) . " Đ" ?></p>
                                <p>Số nhân bản: <?php echo number_format($order->copy) ?></p>
                                <p>Số slide/trang: <?php echo number_format($order->slide) ?></p>
                                <p>Số trang: <?php echo number_format($order->printed_end - $order->printed_start + 1) ?></p>
                                <hr>
                                <h3><span class="font-weight-semibold text-dark">Tổng giá :</span> <?php echo number_format($order->total_prices) . " Đ" ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-t-20 text-center">
                    <button onclick="event.preventDefault(); document.getElementById('order-form').submit();" class="btn btn-primary btn-tone">
                        <i class="anticon anticon-shopping"></i>
                        <span class="m-l-5">Thanh toán khi nhận hàng</span>
                    </button>
                    <button  onclick="event.preventDefault(); document.getElementById('VNPAY').submit();" class="btn btn-success btn-tone">
                        <i class="anticon anticon-bank"></i>
                        <span class="m-l-5">Thanh toán qua VNPay</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<form  method="POST" action="{{ route('customer.createOrder') }}" id="order-form">@csrf</form>
<form id="VNPAY" action="{{ route('customer.create_pay') }}" method="POST" style="display: none;"> @csrf </form>
@endsection()



@section('js')
<!-- page js -->
<script src="{{ asset('assets/vendors/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables/dataTables.bootstrap.min.js') }}"></script>



@endsection()