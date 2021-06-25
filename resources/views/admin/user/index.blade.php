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
                    <h4 class="m-b-0">Tài Khoản Khách Hàng</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="m-t-25">
                @if ( Session::has('success') )
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <table id="orders-table" class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Họ và tên</th>
                            <th>Email</th>
                            <th>Địa chỉ</th>
                            <th>Điện thoại</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $key => $value): ?>
                            <tr>
                                <td><?php echo $value->id ?></td>
                                <td><?php echo $value->customer_info->name ?></td>
                                <td><?php echo $value->email ?></td>
                                <td><?php echo $value->customer_info->address ?></td>
                                <td><?php echo $value->customer_info->telephone ?></td>
                                <td><span class="badge badge-pill <?php echo $value->status ? 'badge-green' : 'badge-magenta' ?>"><?php echo $value->status ? 'Đang hoạt động' : 'Đã chặn' ?></span></td>
                                <td><a href="/admin/user/change-status/<?php echo $value->id ?>" class="btn btn-tone btn-action <?php echo $value->status ? 'btn-danger' : 'btn-success' ?>"><?php echo $value->status ? 'Chặn' : 'Bỏ chặn' ?></a>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
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