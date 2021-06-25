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
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <div class="d-md-flex align-items-center">
                            <div class="text-center text-sm-left ">
                                <div class="avatar avatar-image" style="width: 150px; height:150px">
                                    <img src="{{ asset($service->image) }}" alt="">
                                </div>
                            </div>
                            <div class="text-center text-sm-left m-v-15 p-l-30">
                                <h2 class="m-b-5"><?php echo $service->name ?></h2>
                                <a href="{{ route('customer.create', ['id' => $service->id]) }}" class="btn btn-primary btn-tone">Sử dụng ( Tùy chỉnh  )</a>
                                <a href="{{ route('customer.create2', ['id' => $service->id]) }}" class="btn btn-primary btn-tone">Sử dụng ( Mặc định )</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="d-md-block d-none border-left col-1"></div>
                            <div class="col">
                                <ul class="list-unstyled m-t-10">
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
                                        <p class="col font-weight-semibold"> <?php echo $service->description; ?></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <?php foreach (explode(" | ", $service->images) as $key => $value): ?>
                                <?php if ($value != ""): ?>
                                    <div class="col-xs-12 col-sm-6 col-mg-6 col-lg-6">
                                        <img src="{{ asset($value) }}" style="width: 100%;">
                                    </div>
                                <?php endif ?>
                            <?php endforeach ?>
                            
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