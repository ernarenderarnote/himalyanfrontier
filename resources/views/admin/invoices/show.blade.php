<!DOCTYPE html>
<html>
<head>
<title>Email Template</title>
<style>
.details tr {
    text-align: left;
    font-size: 19px;
}
.details{
    width: 100%;
    margin-bottom: 20px;
} 
.inovo_detials tr {
    text-align: left;
    font-size: 19px;
}
.price_details th {
    font-size: 18px;
}
table.price_details tr td {
    font-size: 17px;
    line-height: 34px;
}
.inovo_detials {
    width: 100%;
    margin-bottom: 20px;
}
.footer_outer {
    background-color: #000;
    PADDING: 10PX;
    MARGIN-TOP: 20PX;
} 
.footer_outer P {
    COLOR: #FFF;
}
.details5 {
    text-align: left;
    font-size: 24px;
    margin-bottom: 10px;
}

.price_details {
    width: 100%;
    text-align: left;
    padding: 10px;
    border-collapse: collapse;
}
.estin {
    text-align: left;
    font-size: 20px;
    line-height: 27px;
}
.incluse th {
    text-align: left;
    font-size: 24px;
}
.incluse tr td {
    font-size: 20px;
    text-align: left;
    line-height: 28px;
    
}

</style>
</head>
<body>

<div style="
    width: 100%;
    margin: 0 auto;
    text-align: center;
    padding: 50px;
    //page-break-inside: auto;
">
<div><img src="{{url('images/himalayn_frontiers_logo_vector2017__1_-pdf_720.png')}}" alt="" class="img-fluid logo-img mt-1" style="
    width: 40%;
    margin-bottom: 10px;
    margin-top: 0px;
"></div>
<table style="
    width: 100%;
">
<tbody><tr>
<td style="
    text-align: left;
    font-size: 20px;
">Invoice No</td>
<td style="
    text-align: right;
    font-size: 20px;
">Invoice Date</td>
</tr>
<tr>
<td style="
    text-align: left;
">{{$invoice->invoice_prefix}}{{$invoice->invoice_id}}</td>
<td style="
    text-align: right;
">{{$invoice->created_at}}</td>
</tr>
</tbody></table>
 <table class="details">
<h3 style="
    text-align: left;
    font-size: 25px;
    margin-bottom: 10px;
"> Invoive Details</h3>
 <tr>
 <th>
Customer Name
 </th>
  <th>
Email
 </th>
  <th>
Contact
 </th>
  <th>
Tax Details
 </th>
 </tr>
 <tr>
 <td>{{$invoice->customer_name}}</td>
  <td>{{$invoice->email}}</td>
   <td>{{$invoice->contact_number}}</td>
   <td>{{$invoice->tax_details}}</td>
 </tr>
 </table>
 <table class="inovo_detials">
	<tr>
	<th>Invoice Due Date</th>
	<th>Booking Handled By</th>
	<th>Travel Date</th>
	</tr>
	 <tr>
 <td>{{$invoice->invoice_due_date}}</td>
  <td>{{$invoice->booking_handled_by}}</td>
   <td>{{$invoice->travel_date}}</td>

 </tr>
 </table>
  <table class="inovo_detials">
	<tr>
	<th>Travel Location</th>
	<th>Currency</th>
	</tr>
	 <tr>
 <td>{{$invoice->travel_location}}</td>
   <td>{{$invoice->currency}}</td>
 </tr>
 </table>
 
 <table  border="1" class="price_details">
	<h3 class="details5">Price Details</h3>
	<tr>
	<th>Description</th>
	<th>Number Of persons</th>
	<th>Per Person Price</th>
	<th>Tax</th>
	<th>Amount</th>
	</tr>
	<tr>
	<td>{{$invoice->service_name}}</td>
	<td>{{$invoice->no_of_persons}}</td>
	<td>{{$invoice->per_person_price}}</td>
	<td>{{$invoice->tax}}%</td>
	<td>{{$invoice->no_of_persons * $invoice->per_person_price }}</td>
	</tr>
	<tr>
	<td></td>
	<td></td>
	<td><b>Total Pyable</b></td>
	<td></td>
    
	<td><b>{{$invoice->currency}} 
    @if($invoice->tax != '')
        @php 
            $subtotal = $invoice->no_of_persons * $invoice->per_person_price;
            $total_tax = ($subtotal * $invoice->tax)/100;
            $total_payable = $subtotal + $total_tax;
        @endphp
        {{number_format($total_payable,2)}}
    @else
        {{number_format($invoice->no_of_persons * $invoice->per_person_price , 2)}}
    @endif</b></td>
	</tr>
	
	
 </table>
 <table class="incluse">
 <tr>
    <h3 class="details5">Tour Itinerary</h3>
    <p class="estin">{!!$invoice->tour_itinerary!!}</p>
 
 </tr>
    
 <tr>
 <th>Include</th>
  <th>Exclude</th>
 </tr>
 <tr>
 <td>{!!$invoice->inclusion!!}</td>
 <td>{!!$invoice->exclusion!!}</td>

 </tr>

 <table>
<div class="footer_outer">
<p>It is a long established fact that</p>
</div>
</div>




</body>
</html>