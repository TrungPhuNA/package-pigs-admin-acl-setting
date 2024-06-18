@extends('adm_acl_setting::layout.adm_acl_master')
@section('content')
    <h2>Thống kê</h2>
    <div class="row">
        <div class="col-sm-3">
            <div class="box p-3 mb-2 bg-primary text-white">
                <h6>Thành viên <b id="totalUser"><i class="fa fa-spinner fa-spin"
                                                    style="font-size:24px;color:white"></i></b></h6>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="box p-3 mb-2 bg-danger text-white">
                <h6>Sản phẩm <b id="totalProduct"><i class="fa fa-spinner fa-spin"
                                                     style="font-size:24px;color:white"></i></b></h6>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="box p-3 mb-2 bg-info text-white">
                <h6>Đơn hàng <b id="totalOrder"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:white"></i></b>
                </h6>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="box p-3 mb-2 bg-secondary text-white">
                <h6>User mới <b id="totalUserNew"><i class="fa fa-spinner fa-spin"
                                                     style="font-size:24px;color:white"></i></b></h6>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="tab-content">
            </div>
        </div>
    </div>
@stop

@section('script')
@stop
