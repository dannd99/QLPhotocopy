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
                    <h4 class="m-b-0">Danh sách dịch vụ</h4>
                </div>
            </div>
        </div>
    </div>
    @if ( Session::has('error') )
        <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}
        </div>
    @endif
    @if ( Session::has('success') )
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="card col-sm-12 col-md-8 offset-2">
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="m-b-30" id="services-form">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <div class="form-group">
                            <label >Tên dịch vụ</label>
                            <input type="text" class="form-control name" name="name" placeholder="Name" required="" value="<?php echo $service->name ?>">
                        </div>
                        <div class="form-group">
                            <label >Đơn giá</label>
                            <input type="number" class="form-control prices" name="prices" placeholder="Prices" required="" value="<?php echo $service->prices ?>">
                        </div>
                        <div class="form-group">
                            <label >Hình ảnh</label>
                            <input type="file" name="upload_avatar" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label >Hình ảnh mô tả ( chọn nhiều tệp tin )</label>
                            <input type="file" name="upload_list[]" class="form-control" multiple="" >
                        </div>
                        <div class="form-group">
                            <label >Mô tả chi tiết</label>
                            <textarea class="form-control" rows="6" placeholder="Description" name="description" required=""><?php echo $service->description ?></textarea>
                        </div>         
                        <button class="m-t-10 btn btn-primary w-100 none modal-action"> Cập nhật </button>
                    </div>
                </div>        
            </form>
        </div>
    </div>
</div>

@endsection()


@section('sub_layout')

@endsection()

@section('js')
<!-- page js -->
<script src="{{ asset('assets/vendors/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables/dataTables.bootstrap.min.js') }}"></script>

<script src="{{ asset('assets/js/page-services.js') }}"></script>


@endsection()