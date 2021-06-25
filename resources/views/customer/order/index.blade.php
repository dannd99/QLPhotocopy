@extends('customer.layout')

@section('css')

<!-- page css -->
<link href="{{ asset('assets/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">


@endsection()

@section('body')

<div class="main-content">
    <input type="hidden" name="" class="customer_id" value="<?php echo $user_id ?>">
    <div class="page-header no-gutters has-tab">
        <div class="d-md-flex m-b-15 align-items-center justify-content-between notification relative" id="notification">
        @if ( Session::has('success') )
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
            <div class="media align-items-center m-b-15">
                <div class="m-l-15">
                    <h4 class="m-b-0">Đơn hàng</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="m-t-25">
                <table id="orders-table" class="table"> </table>
            </div>
        </div>
    </div>
</div>

@endsection()


@section('js')
<!-- page js -->
<script src="{{ asset('assets/vendors/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables/dataTables.bootstrap.min.js') }}"></script>

<script src="{{ asset('assets/js/page-orders.js') }}"></script>


@endsection()