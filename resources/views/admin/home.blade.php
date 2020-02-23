@extends('layouts.admin')
@section('content')
<div class="container-fluid">
   <div id="ui-view">
      <div>
         <div class="animated fadeIn">
            <div class="row">
               <div class="col-sm-6 col-lg-3">
                  <div class="card text-white bg-primary">
                     <div class="card-body pb-0">
                        <div class="btn-group float-right widget-icon">
                           <i class="fa fa-cart-arrow-down nav-icon"></i>
                        </div>
                        <div class="text-value">{{$bookings}}</div>
                        
                     </div>
                     <div class="widget-title">Total Orders</div>
                  </div>
               </div>
               <div class="col-sm-6 col-lg-3">
                  <div class="card text-white bg-warning widget-icon">
                     <div class="card-body pb-0">
                        <div class="btn-group float-right">
                          <i class="fa fa-envelope nav-icon"></i>
                        </div>
                        <div class="text-value">{{$inqueries}}</div>
                     </div>
                     <div class="widget-title">Total Inqueries</div>
                  </div>
               </div>
               <div class="col-sm-6 col-lg-3">
                  <div class="card text-white bg-warning widget-icon">
                     <div class="card-body pb-0">
                        <div class="btn-group float-right">
                          <i class="fas fa-users nav-icon"></i>
                        </div>
                        <div class="text-value">{{$users}}</div>
                     </div>
                     <div class="widget-title">Total Users</div>
                  </div>
               </div>
               <div class="col-sm-6 col-lg-3">
                  <div class="card text-white bg-danger">
                     <div class="card-body pb-0">
                        <div class="btn-group float-right widget-icon">
                          <i class="fas fa-money nav-icon"></i>
                        </div>
                        <div class="text-value">{{$transections}}</div>
                     </div>
                     <div class="widget-title">Transections</div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('scripts')
@parent

@endsection