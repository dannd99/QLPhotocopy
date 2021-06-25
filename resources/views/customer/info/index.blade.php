@extends('customer.layout')

@section('css')

<!-- page css -->
<link href="{{ asset('assets/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">


@endsection()

@section('body')

<div class="main-content">
    <div class="container">
        <div class="tab-content m-t-15">
            <div class="tab-pane fade show active" id="tab-account">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Thông tin cá nhân</h4>
                    </div>
                    <form class="card-body" method="POST" action="{{ route('customer.infoupdate') }}" enctype="multipart/form-data">
                        @csrf
                        @if ( Session::has('success') )
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <div class="media align-items-center">
                            <div class="image_avatar avatar avatar-image  m-h-10 m-r-15" style="height: 80px; width: 80px">
                                <img class="image_upload" src="{{ asset($customer_info->customer_info->avatar) }}" alt="">
                            </div>
                            <div class="m-l-20 m-r-20">
                                <h5 class="m-b-5 font-size-18">Đổi avatar</h5>
                                <p class="opacity-07 font-size-13 m-b-0">
                                    Định dạng đẹp nhất: <br>
                                    120x120 
                                </p>
                            </div>
                            <div>
                                <label class="btn btn-tone btn-primary" for="upload-avatar">Tải lên</label>
                                <input type="file" name="avatar" id="upload-avatar" style="display: none">
                            </div>
                        </div>
                        <hr class="m-v-25">
                        <div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="font-weight-semibold" for="userName">Họ và tên:</label>
                                    <input type="text" class="form-control" name="name" id="userName" placeholder="Họ và tên" value="<?php echo $customer_info->customer_info->name ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="font-weight-semibold" for="email">Email:</label>
                                    <input type="text" class="form-control" placeholder="email" value="<?php echo $customer_info->email ?>" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label class="font-weight-semibold" for="phoneNumber">Số điện thoại:</label>
                                    <input type="text" class="form-control" name="telephone" id="phoneNumber" placeholder="Số điện thoại" value="<?php echo $customer_info->customer_info->telephone ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="font-weight-semibold" for="dob">Địa chỉ:</label>
                                    <input type="text" class="form-control" name="address" id="address" placeholder="Địa chỉ" value="<?php echo $customer_info->customer_info->address ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <button class="btn btn-primary m-t-30">Cập nhật</button>
                        </div>
                    </form>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Đổi mật khẩu</h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if ( Session::has('pass_success') )
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('pass_success') }}
                            </div>
                        @endif
                        @if ( Session::has('pass_error') )
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('pass_error') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('customer.updatePassword') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label class="font-weight-semibold" for="oldPassword">Mật khẩu cũ:</label>
                                    <input type="password" class="form-control" id="oldPassword" placeholder="Old Password" required="" name="current-password">
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="font-weight-semibold" for="newPassword">Mật khẩu mới:</label>
                                    <input type="password" class="form-control" id="newPassword" placeholder="New Password" required="" name="password">
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="font-weight-semibold" for="confirmPassword">Nhập lại mật khẩu:</label>
                                    <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password" required="" name="password_confirmation">
                                </div>
                                <div class="form-group col-md-3">
                                    <button class="btn btn-primary m-t-30">Thay đổi</button>
                                </div>
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

<script src="{{ asset('assets/js/page-customer.js') }}"></script>


@endsection()