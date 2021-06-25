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
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="align-justify-center">
                        <a href="#" class="btn btn-default btn-sm flex-right" data-toggle="modal" data-target="#create-services">Tạo mới dịch vụ<i class="fas fa-plus m-l-5"></i></a> 
                    </div>
                </div>
            </div>
            <div class="m-t-25">
                <table id="services-table" class="table"> </table>
            </div>
        </div>
    </div>
</div>

@endsection()


@section('sub_layout')
<form class="modal modal-right fade quick-view" id="create-services" method="post" action="{{ route('services.store') }}" enctype="multipart/form-data">
        @csrf
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header justify-content-between align-items-center">
                <h5 class="modal-title">Tạo mới dịch vụ</h5>
            </div>
            <div class="modal-body">
                <div class="m-b-30" id="services-form">
                    <div class="form-group">
                        <label >Tên dịch vụ</label>
                        <input type="text" class="form-control name" name="name" placeholder="Name" required="">
                    </div>
                    <div class="form-group">
                        <label >Đơn giá</label>
                        <input type="number" class="form-control prices" name="prices" placeholder="Prices" required="">
                    </div>
                    <div class="form-group">
                        <label >Hình ảnh</label>
                        <input type="file" name="upload_avatar" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label >Hình ảnh mô tả</label>
                        <input type="file" name="upload_list[]" class="form-control" multiple="" required="">
                    </div>
                    <div class="form-group">
                        <label >Mô tả chi tiết</label>
                        <textarea class="form-control" rows="6" placeholder="Description" name="description" required=""></textarea>
                    </div>         
                    <button class="m-t-10 btn btn-primary w-100 none modal-action"> Tạo mới </button>
                </div>
            </div>
        </div>
    </div>            
</form>



<div class="modal fade" id="delete-services">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bạn muốn xóa dịch vụ? ?</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="service_id" class="service_id">
                <div class="form-group">
                    <label >Tên dịch vụ</label>
                    <input type="text" class="form-control name" name="name" placeholder="Name" required="" readonly="">
                </div>
                <div class="form-group">
                    <label >Đơn giá</label>
                    <input type="number" class="form-control prices" name="prices" placeholder="Prices" required="" readonly="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <button class="btn btn-primary modal-action" atr="Delete">Xóa</button>
            </div>
        </div>
    </div>
</div>
@endsection()

@section('js')
<!-- page js -->
<script src="{{ asset('assets/vendors/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables/dataTables.bootstrap.min.js') }}"></script>

<script src="{{ asset('assets/js/page-services.js') }}"></script>


@endsection()