@extends('layouts.frontend')
@section('content')
<div class="container">

    <div class="dashboard-pages">
  <div class="container">
    <div class="row">
      <div class="col-sm-4">
        <div class="box-style box-style1">                     
          <div class="trek-count">0</div>
          <div class="trek-name"><h5>Upcoming Treks</h5></div>
          <div class="clear"></div>
          <div class="trek-icon"><img src="https://www.ridingsolo.in/public/templates/images/inner-page/trek-upcoming.png" alt="trek-upcoming"></div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="box-style box-style2">                     
          <div class="trek-count">0</div>
          <div class="trek-name"><h5>Completed Treks</h5></div>
          <div class="clear"></div>
          <div class="trek-icon"><img src="https://www.ridingsolo.in/public/templates/images/inner-page/trek-completed.png" alt="trek-completed"></div>
        </div>
      </div> 
      <div class="col-sm-4">
        <div class="box-style box-style3">                     
          <div class="trek-count">0</div>
          <div class="trek-name"><h5>Total Treks</h5></div>
          <div class="clear"></div>
          <div class="trek-icon"><img src="https://www.ridingsolo.in/public/templates/images/inner-page/trek-total.png" alt="trek-total"></div>
        </div>
      </div>
      <div class="clear"></div>

        <div class="col-sm-6"><div class="table-division">
          <h3>Upcoming Treks</h3>
          <p>No Treks Found</p> 
        </div>        </div>
        <div class="col-sm-6">		<div class="table-division">
          <h3>Advance Payment</h3>
           <p>No Treks Found</p> 
        </div>        </div>
        <div class="clear"></div>
      
    </div>
  </div>
</div>
</div>

@endsection