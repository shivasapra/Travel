
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Font Awsome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <title>Generate Invoices</title>

    <style>
      /*!
 * Bootstrap v4.3.1 (https://getbootstrap.com/)
 * Copyright 2011-2019 The Bootstrap Authors
 * Copyright 2011-2019 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 */:root{--blue:#007bff;--indigo:#6610f2;--purple:#6f42c1;--pink:#e83e8c;--red:#dc3545;--orange:#fd7e14;--yellow:#ffc107;--green:#28a745;--teal:#20c997;--cyan:#17a2b8;--white:#fff;--gray:#6c757d;--gray-dark:#343a40;--primary:#007bff;--secondary:#6c757d;--success:#28a745;--info:#17a2b8;--warning:#ffc107;--danger:#dc3545;--light:#f8f9fa;--dark:#343a40;--breakpoint-xs:0;--breakpoint-sm:576px;--breakpoint-md:768px;--breakpoint-lg:992px;--breakpoint-xl:1200px;--font-family-sans-serif:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";--font-family-monospace:SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace}*,::after,::before{box-sizing:border-box}html{font-family:sans-serif;line-height:1.15;-webkit-text-size-adjust:100%;-webkit-tap-highlight-color:transparent}main,section{display:block}body{margin:0;font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";font-size:1rem;font-weight:400;line-height:1.5;color:#212529;text-align:left;background-color:#fff}[tabindex="-1"]:focus{outline:0!important}hr{box-sizing:content-box;height:0;overflow:visible}h1,h2,h3,h4,h5,h6{margin-top:0;margin-bottom:.5rem}p{margin-top:0;margin-bottom:0.5rem}ul{margin-top:0;margin-bottom:1rem}ul ul{margin-bottom:0}b{font-weight:bolder}sub{position:relative;font-size:75%;line-height:0;vertical-align:baseline}sub{bottom:-.25em}img{vertical-align:middle;border-style:none}table{border-collapse:collapse}th{text-align:inherit}label{display:inline-block;margin-bottom:.5rem}input{margin:0;font-family:inherit;font-size:inherit;line-height:inherit}input{overflow:visible}[type=button],[type=reset],[type=submit]{-webkit-appearance:button}[type=button]:not(:disabled),[type=reset]:not(:disabled),[type=submit]:not(:disabled){cursor:pointer}[type=button]::-moz-focus-inner,[type=reset]::-moz-focus-inner,[type=submit]::-moz-focus-inner{padding:0;border-style:none}input[type=checkbox],input[type=radio]{box-sizing:border-box;padding:0}input[type=date],input[type=datetime-local],input[type=month],input[type=time]{-webkit-appearance:listbox}[type=number]::-webkit-inner-spin-button,[type=number]::-webkit-outer-spin-button{height:auto}[type=search]{outline-offset:-2px;-webkit-appearance:none}[type=search]::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{font:inherit;-webkit-appearance:button}[hidden]{display:none!important}.h1,.h2,.h3,.h4,.h5,.h6,h1,h2,h3,h4,h5,h6{margin-bottom:.5rem;font-weight:500;line-height:1.2}.h1,h1{font-size:2.5rem}.h2,h2{font-size:2rem}.h3,h3{font-size:1.75rem}.h4,h4{font-size:1.5rem}.h5,h5{font-size:1.25rem}.h6,h6{font-size:1rem}.lead{font-size:1.25rem;font-weight:300}.display-1{font-size:6rem;font-weight:300;line-height:1.2}.display-2{font-size:5.5rem;font-weight:300;line-height:1.2}.display-3{font-size:4.5rem;font-weight:300;line-height:1.2}.display-4{font-size:3.5rem;font-weight:300;line-height:1.2}hr{margin-top:1rem;margin-bottom:1rem;border:0;border-top:1px solid rgba(0,0,0,.1)}.img-fluid{max-width:100%;height:auto}.container{width:100%;padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto}@media (min-width:576px){.container{max-width:540px}}@media (min-width:768px){.container{max-width:720px}}@media (min-width:992px){.container{max-width:960px}}@media (min-width:1200px){.container{max-width:1140px}}.container-fluid{width:100%;padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto}.row{display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;margin-right:-15px;margin-left:-15px}.col,.col-1,.col-10,.col-11,.col-12,.col-2,.col-3,.col-4,.col-5,.col-6,.col-7,.col-8,.col-9,.col-auto,.col-md,.col-md-1,.col-md-10,.col-md-11,.col-md-12,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9,.col-md-auto{position:relative;width:100%;padding-right:15px;padding-left:15px}.col{-ms-flex-preferred-size:0;flex-basis:0;-ms-flex-positive:1;flex-grow:1;max-width:100%}.col-auto{-ms-flex:0 0 auto;flex:0 0 auto;width:auto;max-width:100%}.col-1{-ms-flex:0 0 8.333333%;flex:0 0 8.333333%;max-width:8.333333%}.col-2{-ms-flex:0 0 16.666667%;flex:0 0 16.666667%;max-width:16.666667%}.col-3{-ms-flex:0 0 25%;flex:0 0 25%;max-width:25%}.col-4{-ms-flex:0 0 33.333333%;flex:0 0 33.333333%;max-width:33.333333%}.col-5{-ms-flex:0 0 41.666667%;flex:0 0 41.666667%;max-width:41.666667%}.col-6{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}.col-7{-ms-flex:0 0 58.333333%;flex:0 0 58.333333%;max-width:58.333333%}.col-8{-ms-flex:0 0 66.666667%;flex:0 0 66.666667%;max-width:66.666667%}.col-9{-ms-flex:0 0 75%;flex:0 0 75%;max-width:75%}.col-10{-ms-flex:0 0 83.333333%;flex:0 0 83.333333%;max-width:83.333333%}.col-11{-ms-flex:0 0 91.666667%;flex:0 0 91.666667%;max-width:91.666667%}.col-12{-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%}@media (min-width:768px){.col-md{-ms-flex-preferred-size:0;flex-basis:0;-ms-flex-positive:1;flex-grow:1;max-width:100%}.col-md-auto{-ms-flex:0 0 auto;flex:0 0 auto;width:auto;max-width:100%}.col-md-1{-ms-flex:0 0 8.333333%;flex:0 0 8.333333%;max-width:8.333333%}.col-md-2{-ms-flex:0 0 16.666667%;flex:0 0 16.666667%;max-width:16.666667%}.col-md-3{-ms-flex:0 0 25%;flex:0 0 25%;max-width:25%}.col-md-4{-ms-flex:0 0 33.333333%;flex:0 0 33.333333%;max-width:33.333333%}.col-md-5{-ms-flex:0 0 41.666667%;flex:0 0 41.666667%;max-width:41.666667%}.col-md-6{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}.col-md-7{-ms-flex:0 0 58.333333%;flex:0 0 58.333333%;max-width:58.333333%}.col-md-8{-ms-flex:0 0 66.666667%;flex:0 0 66.666667%;max-width:66.666667%}.col-md-9{-ms-flex:0 0 75%;flex:0 0 75%;max-width:75%}.col-md-10{-ms-flex:0 0 83.333333%;flex:0 0 83.333333%;max-width:83.333333%}.col-md-11{-ms-flex:0 0 91.666667%;flex:0 0 91.666667%;max-width:91.666667%}.col-md-12{-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%}}.table{width:100%;margin-bottom:1rem;color:#212529}.table td,.table th{padding:.75rem;vertical-align:top;border-top:1px solid #dee2e6}.table thead th{vertical-align:bottom;border-bottom:2px solid #dee2e6}.table tbody+tbody{border-top:2px solid #dee2e6}.table-bordered{border:1px solid #dee2e6}.table-bordered td,.table-bordered th{border:1px solid #dee2e6}.table-bordered thead td,.table-bordered thead th{border-bottom-width:2px}.table-info,.table-info>td,.table-info>th{background-color:#bee5eb}.table-info tbody+tbody,.table-info td,.table-info th,.table-info thead th{border-color:#86cfda}.table-light,.table-light>td,.table-light>th{background-color:#fdfdfe}.table-light tbody+tbody,.table-light td,.table-light th,.table-light thead th{border-color:#fbfcfc}.table .thead-light th{color:#495057;background-color:#e9ecef;border-color:#dee2e6}@media (max-width:767.98px){.table-responsive-md{display:block;width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch}.table-responsive-md>.table-bordered{border:0}}.table-responsive{display:block;width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch}.table-responsive>.table-bordered{border:0}thead{display:table-header-group}img,tr{page-break-inside:avoid}h2,h3,p{orphans:3;widows:3}h2,h3{page-break-after:avoid}@page{size:a3}body{min-width:992px!important}.container{min-width:992px!important}.table{border-collapse:collapse!important}.table-bordered td,.table-bordered th{border:1px solid #dee2e6!important}

 @import url('https://fonts.googleapis.com/css?family=Lato:400,700&display=swap');
 @import url('https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&display=swap');
 body{
    font-family: 'Lato', sans-serif !important;
 }
.text-center {
    text-align: center;
}
.text-right {
    text-align: right;
}
.float-right {
    float: right;
}
.text-light-blue {
    color: #26ace2 !important;
}
.outer-div-inner h3 {
    font-size: 24px;
    text-transform: uppercase;
    font-weight: 600;
    font-family: 'Roboto Condensed', sans-serif;
    color: #26ace2;
}
.outer-div-inner h1 {
    font-size: 45px;
    position: relative;
    text-transform: uppercase;
    font-weight: 600;
    font-family: 'Roboto Condensed', sans-serif;
}
.outer-div-inner h2 {
    font-size: 20px;
    text-transform: uppercase;
    font-weight: 600;
    font-family: 'Roboto Condensed', sans-serif;
    color: #fff !important;
    display: inline-block !important;
    padding: 0.7rem 1rem;
    margin-top: 10px;
}
.bg-light-blue {
    background-color: #26ace2 !important;
}
.outer-div-inner h4 {
    font-size: 1.2rem;
    margin: 20px 0 10px 0;
}
.outer-div-inner table thead {
    background-color: #4e484c;
    color: #fff;
    text-transform: uppercase;
}
    </style>
  </head>
  <body style="background-color:#ecf0f5;margin:0;padding:3rem 0;font-size:15px;color:#000;">
<!-- Main content -->
<section class="content">
<div class="outer-div">
<div class="container outer-div-inner" style="background-color:#fff;padding:30px;box-shadow:0px 0px 40px rgba(0,0,0,0.05);">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Performa Invoice</h1>
        </div>
    </div>
<div class="row" style="border-bottom:1px solid #797777;padding-bottom:10px;margin-bottom:10px;">
<div class="col-md-12">
<img src="http://buildatwill.com/cloud/public/images/logo.png" alt="logo" class="img-fluid img-responsive"/>
</div>
</div>
<div class="row">
<div class="col-md-6"><p class="m-0">Invoice No:<b> {{$invoice->invoice_no}} </b></p></div>
{{-- <div class="col-md-4 text-center"><h1>Invoice</h1></div> --}}
<div class="col-md-6 text-right"><p class="m-0">Invoice Date:<b> {{ Carbon\Carbon::parse($invoice->invoice_date)->format('j F Y') }}</b></p></div>
</div>
<div class="row mt-5">
<div class="col-md-8">
<h3>To</h3>
<p>{{ $invoice->client->first_name }} {{ $invoice->client->last_name }}<br>
    {{ $invoice->client->address }}<br>{{ $invoice->client->city }}<br>{{ $invoice->client->county }}<br>{{ $invoice->client->postal_code }}</div>
<div class="col-md-4">
<h3>Issued By</h3>
<p>62 King street,<br> Southall, <br>Middlesex,<br> UB2 4DB<br>
<b>TEL:</b> 02035000000<br>
<b>E-MAIL</b> info@cloudtravels.co.uk</p>
</div>
</div>

@if($invoice->flights->count() > 0)
<?php $j =1 ?>
<h2 class="p-3 bg-light-blue d-inline-block text-white">Flight</h2>
@foreach($invoice->flights as $flight)
<h4 class="mt-3"><b>{{$j++}}. Passenger Details</b></h4>
<div class="table-responsive">
<table class="table table-bordered">
<thead>
<tr>
<th>S#</th>
<th>Pax Type</th>
<th>First Name & Title</th>
<th>Last Name</th>
</tr>
</thead>
<tbody>
        <?php $i = 1;?>
        @foreach($flight->passengers as $passenger)
<tr>
        <td>{{ $i++ }}</td>
        <td>{{ $passenger->pax_type }}</td>
        <td>{{ $passenger->first_name}}</td>
        <td>{{ $passenger->last_name }}</td>
</tr>
@endforeach
</tbody>
</table>
</div>
<p>Note - * denotes the lead passenger</p><br>

<h4 class="mt-3"><b>Flight Details</b></h4>
<p>Booking Ref: IBE 9003953 &nbsp;&nbsp; | &nbsp;&nbsp; Airline Ref: {{ $flight->airline_ref }}</p>
<div class="table-responsive">
<table class="table table-bordered">
<thead>
<tr>
<th>Departure</th>
<th>Arrival</th>
<th>Airline</th>
<th>Class</th>
<th>Carrier</th>
</tr>
</thead>
<tbody>
    
<tr>
        <td>{{ $flight->segment_one_from.', '. strtoupper(Carbon\Carbon::parse($flight->segment_one_departure)->format('l\\, F jS\\, Y\\, h:i A')) }}</td>
        <td>{{ $flight->segment_one_to.', '.  strtoupper(Carbon\Carbon::parse($flight->segment_one_arrival)->format('l\\, F jS\\, Y\\, h:i A')) }}</td>
        <td>{{ $flight->segment_one_flight }}</td>
        <td>{{ $flight->segment_one_class }}</td>
        <td>{{ $flight->segment_one_carrier }}</td>
</tr>
<tr>
        <td>{{ $flight->segment_two_from.', '. strtoupper(Carbon\Carbon::parse($flight->segment_two_departure)->format('l\\, F jS\\, Y\\, h:i A')) }}</td>
        <td>{{ $flight->segment_two_to.', '. strtoupper(Carbon\Carbon::parse($flight->segment_two_arrival)->format('l\\, F jS\\, Y\\, h:i A')) }}</td>
        <td>{{ $flight->segment_two_flight }}</td>
        <td>{{ $flight->segment_two_class }}</td>
        <td>{{ $flight->segment_two_carrier}}</td>
</tr>
</tbody>
</table>
</div>
<div class="">
<h4 class="mt-3"> <b class="float-right"><b>Total: </b><span class="text-light-blue">{{ $invoice->currency.$flight->total_amount }}</span></b></h4>
@endforeach
</div>
@endif


@if($visa->count() > 0 )
        <?php $visa_amount = 0 ; $k = 1;?>
<h2 class="p-3 bg-light-blue d-inline-block text-white">Visa Services</h2>
<div class="table-responsive">
<table class="table table-bordered">
<thead>
<tr>
<th>SNo.</th>
<th>Applicant Name</th>
<th>Passport Origin</th>
<th>Visa Country</th>
<th>Visa Type</th>
<th>Visa Fees</th>
<th>Service Charge</th>
<th>Amount</th>
</tr>
</thead>
<tbody>
        @foreach($visa as $info)
        <tr>
        <th>{{$k++}}.</th>
          <td>{{$info->name_of_visa_applicant}}</td>
          <td>{{$info->passport_origin}}</td>
          <td>{{$info->visa_country}}</td>
          <td>{{$info->visa_type}}</td>
          <td>{{$info->visa_charges}}</td>
          <td>{{$info->service_charge}}</td>
          <td><b>{{ $invoice->currency.$info->visa_amount }}</b></td>
          <?php $visa_amount = $visa_amount + $info->visa_amount; ?>
        </tr>
        @endforeach
</tbody>
</table>
</div>
<div class="">
<h4 class="mt-3"> <b class="float-right"><b>Total: </b><span class="text-light-blue">{{ $invoice->currency.number_format( (float) ($visa_amount), 2, '.', '')}}</span></b></h4>
</div>
@endif

@if($hotel->count()>0)
        <?php $hotel_amount = 0 ; $k = 1;?>
<h2 class="p-3 bg-light-blue d-inline-block text-white">Hotel</h2>
<div class="table-responsive">
<table class="table table-bordered">
<thead>
<tr>
<th>SNo.</th>
<th>Hotel City</th>
<th>Hotel Country</th>
<th>Hotel Name</th>
<th>Check-In-Date</th>
<th>Check-Out-Date</th>
<th>No. Of Children</th>
<th>No. Of Rooms</th>
<th>Amount:</th>
</tr>
</thead>
<tbody>
        @foreach($hotel as $info)
        <tr>
            <th>{{$k++}}.</th>
          <td>{{ $info->hotel_city }}</td>
          <td>{{ $info->hotel_country }}</td>
          <td>{{ $info->hotel_name }}</td>
          <td>{{ Carbon\Carbon::parse($info->check_in_date)->format('d/m/Y') }}</td>
          <td>{{ Carbon\Carbon::parse($info->check_out_date)->format('d/m/Y') }}</td>
          <td>{{ $info->no_of_children }}</td>
          <td>{{ $info->no_of_rooms }}</td>
          <td><b>{{ $invoice->currency.$info->hotel_amount }}</b></td>
          <?php $hotel_amount = $hotel_amount + $info->hotel_amount; ?>
        </tr>
      @endforeach
</tbody>
</table>
</div>
<div class="">
<h4 class="mt-3"> <b class="float-right"><b>Total: </b><span class="text-light-blue">{{ $invoice->currency.number_format( (float) ($hotel_amount), 2, '.', '') }}</span></b></h4>
</div>
@endif


@if($insurance->count()>0)
<?php $insurance_amount = 0 ; $k=1;?>
<h2 class="p-3 bg-light-blue d-inline-block text-white">Insurance</h2>
<div class="table-responsive">
<table class="table table-bordered">
<thead>
<tr>
<th>SNo.</th>
<th>Name Of Insurance Applicant</th>
<th>Company Name</th>
<th>Insurance Remarks</th>
<th>Amount:</th>
</tr>
</thead>
<tbody>
        @foreach($insurance as $info)
        <tr>
            <th>{{$k++}}.</th>
          <td>{{ $info->name_of_insurance_applicant }}</td>
          <td>{{ $info->name_of_insurance_company }}</td>
          <td>{{ $info->insurance_remarks }}</td>
          <td><b>{{ $invoice->currency.$info->insurance_amount }}</b></td>
          <?php $insurance_amount = $insurance_amount + $info->insurance_amount; ?>
        </tr>
        @endforeach
</tbody>
</table>
</div>
<div class="">
<h4 class="mt-3"> <b class="float-right"><b>Total: </b><span class="text-light-blue">{{ $invoice->currency.number_format( (float) ($insurance_amount), 2, '.', '') }}</span></b></h4>
</div>
@endif

    @if($local_sight_sceen->count()>0)
    <?php $local_sight_sceen_amount = 0 ; $k =1;?>
<h2 class="p-3 bg-light-blue d-inline-block text-white">Local Sight Sceen</h2>
<div class="">
<div class="table-responsive">
<table class="table table-bordered">
<thead>
<tr>
<th>SNo.</th>
<th>Local Sight Sceen Remarks</th>
<th>Amount:</th>
</tr>
</thead>
<tbody>
        @foreach($local_sight_sceen as $info)
        <tr>
            <th>{{$k++}}.</th>
          <td>{{ $info->local_sight_sceen_remarks }}</td>
          <td><b>{{ $invoice->currency.$info->local_sight_sceen_amount }}</b></td>
          <?php $local_sight_sceen_amount = $local_sight_sceen_amount + $info->local_sight_sceen_amount; ?>
        </tr>
        @endforeach
</tbody>
</table>
</div>
<div class="">
<h4 class="mt-3"> <b class="float-right"><b>Total: </b><span class="text-light-blue">{{ $invoice->currency.number_format( (float) ($local_sight_sceen_amount), 2, '.', '') }}</span></b></h4>
</div>
@endif

@if($local_transport->count() > 0)
      <?php $local_transport_amount = 0 ; $k=1;?>
<h2 class="p-3 bg-light-blue d-inline-block text-white">Local Transport</h2>
<div class="table-responsive">
<table class="table table-bordered">
<thead>
<tr>
<th>SNo.</th>
<th>Local Transport Remarks</th>
<th>Amount:</th>
</tr>
</thead>
<tbody>
        @foreach($local_transport as $info)
        <tr>
            <th>{{$k++}}.</th>
          <td>{{ $info->local_transport_remarks }}</td>
          <td><b>{{ $invoice->currency.$info->local_transport_amount }}</b></td>
          <?php $local_transport_amount = $local_transport_amount + $info->local_transport_amount; ?>
        </tr>
        @endforeach
</tbody>
</table>
</div>
<div class="">
<h4 class="mt-3"> <b class="float-right"><b>Total: </b><span class="text-light-blue">{{ $invoice->currency.number_format( (float) ($local_transport_amount), 2, '.', '') }}</span></b></h4>
</div>

@endif
      @if($car_rental->count() > 0)
      <?php $car_rental_amount = 0 ; $k = 1;?>
<h2 class="p-3 bg-light-blue d-inline-block text-white">Car Rental</h2>
<div class="table-responsive">
<table class="table table-bordered">
<thead>
<tr>
<th>SNo.</th>
<th>Car Rental Remarks</th>
<th>Amount:</th>
</tr>
</thead>
<tbody>
        @foreach($car_rental as $info)
        <tr>
            <th>{{$k++}}.</th>
          <td>{{ $info->car_rental_remarks }}</td>
          <td><b>{{ $invoice->currency.$info->car_rental_amount}}</b></td>
          <?php $car_rental_amount = $car_rental_amount + $info->car_rental_amount; ?>
        </tr>
        @endforeach
</tbody>
</table>
</div>
<div class="">
<h4 class="mt-3"> <b class="float-right"><b>Total: </b><span class="text-light-blue">{{ $invoice->currency.number_format( (float) ($car_rental_amount), 2, '.', '')}}</span></b></h4>
</div>

@endif

@if($other_facilities->count()>0)
      <?php $other_facilities_amount = 0 ; $k=1;?>
<h2 class="p-3 bg-light-blue d-inline-block text-white">Other Facilities</h2>
<div class="table-responsive">
<table class="table table-bordered">
<thead>
<tr>
<th>SNo.</th>
<th>Other Facilities Remarks</th>
<th>Amount:</th>
</tr>
</thead>
<tbody>
        @foreach ($other_facilities as $info)
            
        
            <tr>
                <th>{{$k++}}.</th>
              <td>{{ $info->other_facilities_remarks }}</td>
              <td><b>{{ $invoice->currency.$info->other_facilities_amount }}</b></td>
              <?php $other_facilities_amount = $other_facilities_amount + $info->other_facilities_amount; ?>
            </tr>
            @endforeach
</tbody>
</table>
</div>
<div class="">
<h4 class="mt-3"> <b class="float-right"><b>Total: </b><span class="text-light-blue">{{ $invoice->currency.number_format( (float) ($other_facilities_amount), 2, '.', '') }}</span></b></h4>
</div>
@endif
<br><br>
<div class="row">
<div class="col-md-4">
        @if($invoice->debit_amount > 0 or $invoice->credit_amount > 0 or $invoice->cash_amount > 0 or $invoice->bank_amount > 0)

<table class="table table-bordered">
<thead>
<tr>
<th>Payment Mode</th>
<th>Amount</th>
</tr>
</thead>
<tbody>
        @if($invoice->debit_amount > 0 )
      <tr>
        <td>Debit Card</td>
        <td>{{ $invoice->currency.$invoice->debit_amount }}</td>
      </tr>
      @endif
        @if($invoice->credit_amount > 0)
      <tr>
        <td>Credit Card</td>
        <td>{{ $invoice->currency.$invoice->credit_amount }}</td>
      </tr>
      @endif
        @if($invoice->cash_amount > 0)
      <tr>
        <td>Cash</td>
        <td>{{ $invoice->currency.$invoice->cash_amount }}</td>
      </tr>
      @endif
        @if($invoice->bank_amount > 0)
      <tr>
        <td>Bank</td>
        <td>{{ $invoice->currency.$invoice->bank_amount }}</td>
      </tr>
      @endif
      </tbody>
</table>

@endif
</div>
<div class="col-md-8 text-right">
<div class="w-100">
<div class="" style="display:inline-block;margin-right:30px;">
        @if($invoice->discount != 0 or $invoice->VAT_percentage != 0)
        <p class="mb-1"><b>Sub Total:</b></p>
        @if($invoice->discount != 0)
          <p class="mb-1"><b>Discount:</b></p>
        @endif
        @if($invoice->VAT_percentage != 0)
          <p class="mb-1"><b>VAT @ {{ $invoice->VAT_percentage }}%</b></p>
        @endif
      @endif
      <p class="mb-1"><b>Total:</b></p>
      @if($invoice->paid != 0)
        <p class="mb-1"><b>Paid:</b></p>
      @endif
</div>
<div class="" style="display:inline-block;">
        @if($invoice->discount != 0 or $invoice->VAT_percentage != 0)
        <p class="mb-1"><b>{{ $invoice->currency}}{{$invoice->total}}</b></p>
        @if($invoice->discount != 0)
          <p class="mb-1"><b>{{ $invoice->currency}}{{$invoice->discount}}</b></p>
        @endif
        @if($invoice->VAT_amount != 0)
          <p class="mb-1"><b>{{ $invoice->currency}}{{ $invoice->VAT_amount }}:</b></p>
        @endif
        @endif
        <p class="mb-1"><b>{{ $invoice->currency}}</b></p>
      @if($invoice->paid != 0)
          <p class="mb-1"><b>{{ $invoice->currency}}{{$invoice->paid}}</b></p>
      @endif
</div>
</div>
@if($invoice->pending_amount != 0)
        <hr>
        <div class="w-100">
            <div class="" style="display:inline-block;margin-right:30px;">
            <p class="mb-1"><b>Due Payment:</b></p>
          </div>
          <div class="" style="display:inline-block;">
            @if($invoice->pending_amount != 0 )
            <p class="mb-1">{{ $invoice->currency}} {{ $invoice->pending_amount}}</p>
            @endif
        </div>
        </div>
        @endif
        @if($invoice->advance != 0)
        <hr>
        <div class="w-100">
            <div class="" style="display:inline-block;margin-right:30px;">
            <p class="mb-1"><b>Advance:</b></p>
          </div>
          <div class="" style="display:inline-block;">
            @if($invoice->advance != 0 )
            <p class="mb-1">{{ $invoice->currency}} {{ $invoice->advance}}</p>
            @endif
        </div>
        </div>
        @endif
</div>
</div><hr><br>

<h4><b>Notes:</b></h4>
<ul>
<li>This sale is covered by ATOL number 3853.</li>
<li>There is no liability if airline(s) above cease to trade, unless Scheduled Airline Failure Insurance (SAFI) has been paid.</li>
<li>Passengers travelling to/ or via USA/CANADA : will require an ESTA at least 72 hours prior to travel, even for transit purposes.Children under 18 travelling to South Africa and Botswana : All minors travelling will be required to carry certified copies Birth Certificate, and in the event that only one parent is travelling, certified written consent from the other parent to allow the child to travel.</li>
</ul>
</div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br><br>
            @if($token != null)
              <h5>If the above information is correct then click on confirm button.</h5>
              <a href="{{route('confirmInvoice', $token)}}" class="btn btn-success btn-md" style="display:inline-block; border: 1px solid green; border-radius: 4px; padding: 12px 23px; color: #ffffff; font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;background-color:green;">Confirm</a>
              <br><br><h5>If No then <a href="{{route('refuseInvoice', $token)}}">Click Here </a></h5>
            @endif
             <hr>
            <p>
                <b>Terms & Conditions</b><br>
                Can you plz check the spelling of your name Date and the destinations of travel to.
                then reply back to me to issue your e_tickets for above Mention Airline on the itinerary 
                once you order (full paid deposit or on accounts) and e_ticket has been issued we won’t make any amendment
                on the confirmed issued itinerary and you will be liable for all losses occurred full or on during amendment*



                Note:~
                Don’t book any travel until you have received your visa
                We cannot accept responsibility for travel booked before your visa arrives
                (Check your passport & Visa Matches with your name)
                if any above detail is wrong in the visa or initial booking and confirmed by you the Cloud Travel®
                will not take responsibility for any unnecessary losses cause by you
                on the e_mail or WhatsApp Please check carefully and reply to issue your e_ticket ??
            </p>
        </div>
    </div>
</div>
</div>
</section>
</body>
</html>