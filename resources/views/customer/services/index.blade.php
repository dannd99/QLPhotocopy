@extends('customer.layout')

@section('css')

<!-- page css -->
<link href="{{ asset('assets/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">


@endsection()

@section('body')

<div class="main-content">
    <div class="page-header no-gutters">
        <div class="row align-items-md-center">
            <div class="col-md-6">
                <div class="media m-v-10" style="align-items: center;">
                    <div class="avatar avatar-cyan avatar-icon avatar-square">
                        <i class="anticon anticon-star"></i>
                    </div>
                    <div class="media-body m-l-15">
                        <h5 class="mb-0">Danh sách dịch vụ (<?php echo count($services) ?>)</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="text-md-right m-v-10">
                    <div class="btn-group">
                        <button id="list-view-btn" type="button" class="btn btn-default btn-icon">
                            <i class="anticon anticon-ordered-list"></i>
                        </button>
                        <button id="card-view-btn" type="button" class="btn btn-default btn-icon active">
                            <i class="anticon anticon-appstore"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-11 mx-auto">
            <!-- Card View -->
            <div class="row" id="card-view">
                <?php foreach ($services as $key => $value): ?>
                    <div class="col-xs-6 col-sm-4 col-md-4 col-lg-3">
                        <div class="card">
                            <img class="card-img-top lazy" id="services-image" src="{{ asset($value->image) }}" alt="">
                            <div class="card-body">
                                <h4 class="m-t-10"><?php echo $value->name ?></h4>
                                <p>Đơn giá: <?php echo number_format($value->prices) . " đ" ?></p>
                                <div class="m-t-20 text-center">
                                    <a href="{{ route('customer.servicesDetail', ['id' => $value->id]) }}" class="btn btn-primary btn-tone m-b-5" target="_blank">
                                        <i class="anticon anticon-eye"></i>
                                        <span class="m-l-5">Xem dịch vụ</span>
                                    </a>
                                    <a href="{{ route('customer.create', ['id' => $value->id]) }}" class="btn btn-success btn-tone m-b-5">
                                        <i class="anticon anticon-check"></i>
                                        <span class="m-l-5">Sử dụng ( tùy chỉnh )</span>
                                    </a>
                                    <a href="{{ route('customer.create2', ['id' => $value->id]) }}" class="btn btn-success btn-tone m-b-5">
                                        <i class="anticon anticon-check"></i>
                                        <span class="m-l-5">Sử dụng ( mặc định )</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
            <div class="row d-none" id="list-view">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th width="10">Tên dịch vụ</th>
                                            <th width="10">Hình ảnh</th>
                                            <th width="10">Đơn giá</th>
                                            <th width="20">Mô tả ngắn</th>
                                            <th width="20">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($services as $key => $value): ?>
                                            <tr>
                                                <td>
                                                    <?php echo $value->name ?>
                                                </td>
                                                <td>
                                                    <img class="card-img-top lazy" src="{{ asset($value->image) }}" alt="" style="width: 100px;">
                                                </td>
                                                <td>
                                                    <?php echo number_format($value->prices) ?>
                                                </td>
                                                <td>
                                                    <?php echo $value->description ?>
                                                </td>
                                                <td class="text-right">
                                                    <a href="{{ route('customer.servicesDetail', ['id' => $value->id]) }}" class="btn btn-primary btn-tone" target="_blank">
                                                        <i class="anticon anticon-eye"></i>
                                                        <span class="m-l-5">Xem dịch vụ</span>
                                                    </a>
                                                    <a href="{{ route('customer.create', ['id' => $value->id]) }}" class="btn btn-success btn-tone">
                                                        <i class="anticon anticon-check"></i>
                                                        <span class="m-l-5">Sử dụng ( tùy chỉnh )</span>
                                                    </a>
                                                    <a href="{{ route('customer.create2', ['id' => $value->id]) }}" class="btn btn-success btn-tone">
                                                        <i class="anticon anticon-check"></i>
                                                        <span class="m-l-5">Sử dụng ( mặc định )</span>
                                                    </a>
                                            </tr>
                                        <?php endforeach ?>
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
@endsection()


@section('modal')

@endsection()

@section('js')
<!-- page js -->
<script src="{{ asset('assets/vendors/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables/dataTables.bootstrap.min.js') }}"></script>


@endsection()