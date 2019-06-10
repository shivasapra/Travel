@extends('layouts.frontend')
@section('title')
Invoice
@endsection
@section('header')
<style>
:root{--blue:#007bff;--indigo:#6610f2;--purple:#6f42c1;--pink:#e83e8c;--red:#dc3545;--orange:#fd7e14;--yellow:#ffc107;--green:#28a745;--teal:#20c997;--cyan:#17a2b8;--white:#fff;--gray:#6c757d;--gray-dark:#343a40;--primary:#007bff;--secondary:#6c757d;--success:#28a745;--info:#17a2b8;--warning:#ffc107;--danger:#dc3545;--light:#f8f9fa;--dark:#343a40;--breakpoint-xs:0;--breakpoint-sm:576px;--breakpoint-md:768px;--breakpoint-lg:992px;--breakpoint-xl:1200px;--font-family-sans-serif:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";--font-family-monospace:SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace}*,::after,::before{box-sizing:border-box}html{font-family:sans-serif;line-height:1.15;-webkit-text-size-adjust:100%;-webkit-tap-highlight-color:transparent}body{margin:0;font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";font-weight:400;line-height:1.5;color:#212529;text-align:left;background-color:#fff}[tabindex="-1"]:focus{outline:0!important}hr{box-sizing:content-box;height:0;overflow:visible}h1,h2,h3,h4,h5,h6{margin-top:0;margin-bottom:.5rem}p{margin-top:0;margin-bottom:1rem}ol{margin-top:0;margin-bottom:1rem}ol ol{margin-bottom:0}b{font-weight:bolder}a{color:#007bff;text-decoration:none;background-color:transparent}a:hover{color:#0056b3;text-decoration:underline}a:not([href]):not([tabindex]){color:inherit;text-decoration:none}a:not([href]):not([tabindex]):focus,a:not([href]):not([tabindex]):hover{color:inherit;text-decoration:none}a:not([href]):not([tabindex]):focus{outline:0}code{font-family:SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;}img{vertical-align:middle;border-style:none}table{border-collapse:collapse}th{text-align:inherit}button{border-radius:0}button:focus{outline:1px dotted;outline:5px auto -webkit-focus-ring-color}button{margin:0;font-family:inherit;line-height:inherit}button{overflow:visible}button{text-transform:none}[type=button],[type=reset],[type=submit],button{-webkit-appearance:button}[type=button]:not(:disabled),[type=reset]:not(:disabled),[type=submit]:not(:disabled),button:not(:disabled){cursor:pointer}[type=button]::-moz-focus-inner,[type=reset]::-moz-focus-inner,[type=submit]::-moz-focus-inner,button::-moz-focus-inner{padding:0;border-style:none}[type=number]::-webkit-inner-spin-button,[type=number]::-webkit-outer-spin-button{height:auto}[type=search]{outline-offset:-2px;-webkit-appearance:none}[type=search]::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{font:inherit;-webkit-appearance:button}[hidden]{display:none!important}.h1,.h2,.h3,.h4,.h5,.h6,h1,h2,h3,h4,h5,h6{margin-bottom:.5rem;font-weight:500;line-height:1.2}hr{margin-top:1rem;margin-bottom:1rem;border:0;border-top:1px solid rgba(0,0,0,.1)}.img-fluid{max-width:100%;height:auto}code{color:#e83e8c;word-break:break-word}a>code{color:inherit}.container{width:100%;padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto}@media (min-width:576px){.container{max-width:540px}}@media (min-width:768px){.container{max-width:720px}}@media (min-width:992px){.container{max-width:960px}}@media (min-width:1200px){.container{max-width:1140px}}.container-fluid{width:100%;padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto}.row{display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;margin-right:-15px;margin-left:-15px}.col,.col-1,.col-10,.col-11,.col-12,.col-2,.col-3,.col-4,.col-5,.col-6,.col-7,.col-8,.col-9,.col-md,.col-md-1,.col-md-10,.col-md-11,.col-md-12,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9,.col-sm,.col-sm-1,.col-sm-10,.col-sm-11,.col-sm-12,.col-sm-2,.col-sm-3,.col-sm-4,.col-sm-5,.col-sm-6,.col-sm-7,.col-sm-8,.col-sm-9{position:relative;width:100%;padding-right:15px;padding-left:15px}.col{-ms-flex-preferred-size:0;flex-basis:0;-ms-flex-positive:1;flex-grow:1;max-width:100%}.col-1{-ms-flex:0 0 8.333333%;flex:0 0 8.333333%;max-width:8.333333%}.col-2{-ms-flex:0 0 16.666667%;flex:0 0 16.666667%;max-width:16.666667%}.col-3{-ms-flex:0 0 25%;flex:0 0 25%;max-width:25%}.col-4{-ms-flex:0 0 33.333333%;flex:0 0 33.333333%;max-width:33.333333%}.col-5{-ms-flex:0 0 41.666667%;flex:0 0 41.666667%;max-width:41.666667%}.col-6{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}.col-7{-ms-flex:0 0 58.333333%;flex:0 0 58.333333%;max-width:58.333333%}.col-8{-ms-flex:0 0 66.666667%;flex:0 0 66.666667%;max-width:66.666667%}.col-9{-ms-flex:0 0 75%;flex:0 0 75%;max-width:75%}.col-10{-ms-flex:0 0 83.333333%;flex:0 0 83.333333%;max-width:83.333333%}.col-11{-ms-flex:0 0 91.666667%;flex:0 0 91.666667%;max-width:91.666667%}.col-12{-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%}@media (min-width:576px){.col-sm{-ms-flex-preferred-size:0;flex-basis:0;-ms-flex-positive:1;flex-grow:1;max-width:100%}.col-sm-1{-ms-flex:0 0 8.333333%;flex:0 0 8.333333%;max-width:8.333333%}.col-sm-2{-ms-flex:0 0 16.666667%;flex:0 0 16.666667%;max-width:16.666667%}.col-sm-3{-ms-flex:0 0 25%;flex:0 0 25%;max-width:25%}.col-sm-4{-ms-flex:0 0 33.333333%;flex:0 0 33.333333%;max-width:33.333333%}.col-sm-5{-ms-flex:0 0 41.666667%;flex:0 0 41.666667%;max-width:41.666667%}.col-sm-6{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}.col-sm-7{-ms-flex:0 0 58.333333%;flex:0 0 58.333333%;max-width:58.333333%}.col-sm-8{-ms-flex:0 0 66.666667%;flex:0 0 66.666667%;max-width:66.666667%}.col-sm-9{-ms-flex:0 0 75%;flex:0 0 75%;max-width:75%}.col-sm-10{-ms-flex:0 0 83.333333%;flex:0 0 83.333333%;max-width:83.333333%}.col-sm-11{-ms-flex:0 0 91.666667%;flex:0 0 91.666667%;max-width:91.666667%}.col-sm-12{-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%}}@media (min-width:768px){.col-md{-ms-flex-preferred-size:0;flex-basis:0;-ms-flex-positive:1;flex-grow:1;max-width:100%}.col-md-1{-ms-flex:0 0 8.333333%;flex:0 0 8.333333%;max-width:8.333333%}.col-md-2{-ms-flex:0 0 16.666667%;flex:0 0 16.666667%;max-width:16.666667%}.col-md-3{-ms-flex:0 0 25%;flex:0 0 25%;max-width:25%}.col-md-4{-ms-flex:0 0 33.333333%;flex:0 0 33.333333%;max-width:33.333333%}.col-md-5{-ms-flex:0 0 41.666667%;flex:0 0 41.666667%;max-width:41.666667%}.col-md-6{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}.col-md-7{-ms-flex:0 0 58.333333%;flex:0 0 58.333333%;max-width:58.333333%}.col-md-8{-ms-flex:0 0 66.666667%;flex:0 0 66.666667%;max-width:66.666667%}.col-md-9{-ms-flex:0 0 75%;flex:0 0 75%;max-width:75%}.col-md-10{-ms-flex:0 0 83.333333%;flex:0 0 83.333333%;max-width:83.333333%}.col-md-11{-ms-flex:0 0 91.666667%;flex:0 0 91.666667%;max-width:91.666667%}.col-md-12{-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%}}.table{width:100%;margin-bottom:1rem;color:#212529}.table td,.table th{padding:.75rem;vertical-align:top;border-top:1px solid #dee2e6}.table-sm td,.table-sm th{padding:.3rem}.table-bordered{border:1px solid #dee2e6}.table-bordered td,.table-bordered th{border:1px solid #dee2e6}.table-success,.table-success>td,.table-success>th{background-color:#c3e6cb}.table-success td,.table-success th{border-color:#8fd19e}.table-info,.table-info>td,.table-info>th{background-color:#bee5eb}.table-info td,.table-info th{border-color:#86cfda}@media (max-width:575.98px){.table-responsive-sm{display:block;width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch}.table-responsive-sm>.table-bordered{border:0}}@media (max-width:767.98px){.table-responsive-md{display:block;width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch}.table-responsive-md>.table-bordered{border:0}}.table-responsive{display:block;width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch}.table-responsive>.table-bordered{border:0}.btn{display:inline-block;font-weight:400;color:#212529;text-align:center;vertical-align:middle;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;background-color:transparent;border:1px solid transparent;padding:.375rem .75rem;line-height:1.5;border-radius:.25rem;transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out}@media (prefers-reduced-motion:reduce){.btn{transition:none}}.btn:hover{color:#212529;text-decoration:none}.btn:focus{outline:0;box-shadow:0 0 0 .2rem rgba(0,123,255,.25)}.btn:disabled{opacity:.65}.btn-success{color:#fff;background-color:#28a745;border-color:#28a745}.btn-success:hover{color:#fff;background-color:#218838;border-color:#1e7e34}.btn-success:focus{box-shadow:0 0 0 .2rem rgba(72,180,97,.5)}.btn-success:disabled{color:#fff;background-color:#28a745;border-color:#28a745}.btn-info{color:#fff;background-color:#17a2b8;border-color:#17a2b8}.btn-info:hover{color:#fff;background-color:#138496;border-color:#117a8b}.btn-info:focus{box-shadow:0 0 0 .2rem rgba(58,176,195,.5)}.btn-info:disabled{color:#fff;background-color:#17a2b8;border-color:#17a2b8}.btn-link{font-weight:400;color:#007bff;text-decoration:none}.btn-link:hover{color:#0056b3;text-decoration:underline}.btn-link:focus{text-decoration:underline;box-shadow:none}.btn-link:disabled{color:#6c757d;pointer-events:none}.btn-sm{padding:.25rem .5rem;line-height:1.5;border-radius:.2rem}img,tr{page-break-inside:avoid}h2,h3,p{orphans:3;widows:3}h2,h3{page-break-after:avoid}@page{size:a3}body{min-width:992px!important}.container{min-width:992px!important}.table{border-collapse:collapse!important}.table td,.table th{background-color:#fff!important}.table-bordered td,.table-bordered th{border:1px solid #dee2e6!important}
 </style>
  <section class="content-header">
      <h1>
        Invoice
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('invoice')}}"><i class="fa fa-paperclip"></i> Invoice</a></li>
        <li class="active">Generate Invoice</li>
      </ol>
    </section>
@stop
@section('content')

<div class="container generate-invoice">
    <div class="row align-items-center pt-2 pb-2 border-bottom" style="border-bottom:1px solid #ddd;padding-bottom:20px;">
        <div class="col-md-3">
        <img src="{{asset('images/logo.png')}}" alt="logo" class="img-fluid img-responsive"/>
       </div>
       <div class="col-md-9 text-right">
         <p class="mb-0">62 King street, southall, middlesex, UB2 4DB, United Kingdom<br>
         Email: info@cloudtravels.co.uk, admin@cloudtravels.co.uk<br>
         Phone: 02035000000</p>
         <h5 class="mb-3">Invoive No: <b>{{$invoice->invoice_no}}</b></h5>
         <h5><span class="text-blue">Date:</span> {{$invoice->invoice_date}}</h5>
       </div>
      </div>
      <div class="panel-body">
    <div class="row mt-4 mb-3">
      <div class="col-md-12 text-center">
        <h2 class="mb-4 text-uppercase font-weight-bold">Invoice</h2>
      </div>

      @foreach($invoice->flights as $flight)
      <div class="col-sm-12">
        <h3>Service: Flight</h3>
      </div>
      <div class="col-md-3">
        <h5><span class="text-blue">Universal PNR:</span> {{ $flight->universal_pnr }}</h5>
      </div>
      <div class="col-md-3">
        <h5><span class="text-blue">PNR:</span> {{ $flight->pnr }}</h5>
      </div>
      <div class="col-md-3">
        <h5><span class="text-blue">Agency PCC:</span> {{ $flight->agency_pcc }}</h5>
      </div>
      <div class="col-md-3">
        <h5><span class="text-blue">Airline Ref:</span> {{ $flight->airline_ref }}</h5>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <h4 class="text-blue font-weight-bold">Passenger Details</h4>
        <div class="table-responsive">
          <table class="table table-bordered">
            <tr class="text-blue">
              <th>S#</th>
              <th>Pax Type</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>DOB</th>
            </tr>
            <?php $i = 1;?>
            @foreach($flight->passengers as $passenger)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $passenger->pax_type }}</td>
                    <td>{{ $passenger->first_name}}</td>
                    <td>{{ $passenger->last_name }}</td>
                    <td>{{ $passenger->DOB }}</td>
                </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-md-12">
        <h4 class="text-blue font-weight-bold">Flight Details</h4>
        <div class="table-responsive">
          <table class="table table-bordered">
            <tr class="text-blue">
              <th>Departure</th>
              <th>Arrival</th>
              <th>Airline</th>
              <th>Class</th>
              <th>Carrier</th>
            </tr>
            <tr>
              <td>{{ $flight->segment_one_from.', '.$flight->segment_one_departure }}</td>
              <td>{{ $flight->segment_one_to.', '.$flight->segment_one_arrival }}</td>
              <td>{{ $flight->segment_one_flight }}</td>
              <td>{{ $flight->segment_one_class }}</td>
              <td>{{ $flight->segment_one_carrier }}</td>
            </tr>
            <tr>
             <td>{{ $flight->segment_two_from.', '.$flight->segment_two_departure }}</td>
             <td>{{ $flight->segment_two_to.', '.$flight->segment_two_arrival }}</td>
             <td>{{ $flight->segment_two_flight }}</td>
             <td>{{ $flight->segment_two_class }}</td>
             <td>{{ $flight->segment_two_carrier}}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 col-xs-6">
        <h2 class="text-blue" style="font-size:20px;">Total Flight Charges:</h2>
      </div>
      <div class="col-md-6 text-right col-xs-6">
        <h4>GBP {{ $invoice->currency.$flight->total_amount }}</h4>
      </div>
      @endforeach

      @foreach($invoice->invoiceInfo as $info)
      @if($info->service_name == 'Visa Services')
      <div class="col-sm-12"><hr>
        <h3>Service: {{ $info->service_name }}</h3>
      </div>
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered">
            <tr class="text-blue">
              <th>Applicant Name</th>
              <th>Passport Origin</th>
              <th>Passport No.</th>
              <th>DOB</th>
              <th>Visa Country</th>
              <th>Visa Type</th>
              <th>Visa Fees</th>
              <th>Service Charge</th>
            </tr>
            <tr>
              <td>{{$info->name_of_visa_applicant}}</td>
              <td>{{$info->passport_origin}}</td>
              <td>{{$info->passport_no}}</td>
              <td>{{$info->passport_member_DOB}}</td>
              <td>{{$info->visa_country}}</td>
              <td>{{$info->visa_type}}</td>
              <td>{{$info->visa_charges}}</td>
              <td>{{$info->service_charge}}</td>
            </tr>
          </table>
        </div>
      </div>
      <div class="col-md-6 col-xs-6">
        <h2 class="text-blue" style="font-size:20px;">Total Visa Charges:</h2>
      </div>
      <div class="col-md-6 text-right col-xs-6">
        <h4>GBP {{ $invoice->currency.$info->visa_amount }}</h4>
      </div>
      @endif

      @if($info->service_name == 'Hotel')
      <div class="col-sm-12"><hr>
        <h3>Service: {{ $info->service_name }}</h3>
      </div>
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered">
            <tr class="text-blue">
              <th>Hotel City</th>
              <th>Hotel Country</th>
              <th>Name</th>
              <th>Check-In-Date</th>
              <th>Check-Out-Date</th>
              <th>No. Of Children</th>
              <th>No. Of Rooms</th>
            </tr>
            <tr>
              <td>{{ $info->hotel_city }}</td>
              <td>{{ $info->hotel_country }}</td>
              <td>{{ $info->hotel_name }}</td>
              <td>{{ $info->check_in_date }}</td>
              <td>{{ $info->check_out_date }}</td>
              <td>{{ $info->no_of_children }}</td>
              <td>{{ $info->no_of_rooms }}</td>
            </tr>
          </table>
        </div>
      </div>
      <div class="col-md-6 col-xs-6">
        <h2 class="text-blue" style="font-size:20px;">Total Hotel Charges:</h2>
      </div>
      <div class="col-md-6 text-right col-xs-6">
        <h4>GBP {{ $invoice->currency.$info->hotel_amount }}</h4>
      </div>
      @endif

      @if($info->service_name == 'Insurance')
      <div class="col-sm-12"><hr>
        <h3>Service: {{ $info->service_name }}</h3>
      </div>
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered">
            <tr class="text-blue">
              <th>Name Of Insurance Applicant</th>
              <th>Insurance Remarks</th>
            </tr>
            <tr>
              <td>{{ $info->name_of_insurance_applicant }}</td>
              <td>{{ $info->insurance_remarks }}</td>
            </tr>
          </table>
        </div>
      </div>
      <div class="col-md-6 col-xs-6">
        <h2 class="text-blue" style="font-size:20px;">Total Insurance Charges:</h2>
      </div>
      <div class="col-md-6 text-right col-xs-6">
        <h4>GBP {{ $invoice->currency.$info->insurance_amount }}</h4>
      </div>
      @endif

      @if($info->service_name == 'Local Sight Sceen')
      <div class="col-sm-12"><hr>
        <h3>Service: {{ $info->service_name }}</h3>
      </div>
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered">
            <tr class="text-blue">
              <th>Local Sight Sceen Remarks</th>
            </tr>
            <tr>
              <td>{{ $info->local_sight_sceen_remarks }}</td>
            </tr>
          </table>
        </div>
      </div>
      <div class="col-md-6 col-xs-6">
        <h2 class="text-blue" style="font-size:20px;">Total Sight Sceen Charges:</h2>
      </div>
      <div class="col-md-6 text-right col-xs-6">
        <h4>GBP {{ $invoice->currency.$info->local_sight_sceen_amount }}</h4>
      </div>
      @endif

      @if($info->service_name == 'Local Transport')
      <div class="col-sm-12"><hr>
        <h3>Service: {{ $info->service_name }}</h3>
      </div>
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered">
            <tr class="text-blue">
              <th>Local Transport Remarks</th>
            </tr>
            <tr>
              <td>{{ $info->local_transport_remarks }}</td>
            </tr>
          </table>
        </div>
      </div>
      <div class="col-md-6 col-xs-6">
        <h2 class="text-blue" style="font-size:20px;">Total Transport Charges:</h2>
      </div>
      <div class="col-md-6 text-right col-xs-6">
        <h4>GBP {{ $invoice->currency.$info->local_transport_amount }}</h4>
      </div>
      @endif

      @if($info->service_name == 'Car Rental')
      <div class="col-sm-12"><hr>
        <h3>Service: {{ $info->service_name }}</h3>
      </div>
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered">
            <tr class="text-blue">
              <th>Car Rental Remarks</th>
            </tr>
            <tr>
              <td>{{ $info->car_rental_remarks }}</td>
            </tr>
          </table>
        </div>
      </div>
      <div class="col-md-6 col-xs-6">
        <h2 class="text-blue" style="font-size:20px;">Total Car Rental Charges:</h2>
      </div>
      <div class="col-md-6 text-right col-xs-6">
        <h4>GBP {{ $invoice->currency.$info->car_rental_amount}}</h4>
      </div>
      @endif

      @if($info->service_name == 'Other Facilities')
      <div class="col-sm-12"><hr>
        <h3>Service: {{ $info->service_name }}</h3>
      </div>
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered">
            <tr class="text-blue">
              <th>Other Facilities Remarks</th>
            </tr>
            <tr>
              <td>{{ $info->other_facilities_remarks }}</td>
            </tr>
          </table>
        </div>
      </div>
      <div class="col-md-6 col-xs-6">
        <h2 class="text-blue" style="font-size:20px;">Total Facilities Charges:</h2>
      </div>
      <div class="col-md-6 text-right col-xs-6">
        <h4>GBP {{ $invoice->currency.$info->other_facilities_amount }}</h4>
      </div>
      @endif
      @endforeach


      <div class="col-md-6 text-right align-self-center">
        <hr><img
        @if($invoice->status == 1)
            src="{{asset('images/paid.png')}}" alt="paid"
        @else
            src="{{asset('images/unpaid.jpg')}}" alt="unpaid"
        @endif
        style="width:200px;"/>
      </div>
      <div class="col-md-6 text-right">
        <hr><h2 style="font-size:17px;line-height:27px;">SubTotal: <b>{{$invoice->currency}} {{$invoice->total}}</b> <br>
            Discount: <b>{{$invoice->currency}} {{ $invoice->discount }}</b><br>
        VAT @ {{$invoice->VAT_percentage}}%: <b>{{$invoice->currency}} {{$invoice->VAT_amount}}</b><br>
        <?php $total = $invoice->discounted_total + $invoice->VAT_amount ?>
      Invoice Total: <b>{{$invoice->currency}} {{ $total }}</b>
    </h2><hr style="margin-top:0px;margin-bottom:0px;">
    <h2 style="font-size:17px;line-height:27px;">Paid: <b>{{$invoice->currency}} {{$invoice->paid}}</b> <br>
        @if($invoice->pending_amount != 0 )
        Amount Due: <b>{{ $invoice->currency}} {{ $invoice->pending_amount}}</b>
        @endif
        @if($invoice->advance != 0 )
        Advance: <b>{{$invoice->currency}} {{$invoice->advance}}</b>
        @endif
    </h2>
      </div>
      <div class="col-md-3">

      </div>
      <div class="col-md-12">
        <h4 class="font-weight-bold">Payment Information</h2>
      </div>
      <div class="col-md-12">
            <table class="table table-bordered">

            <tr class="text-blue">
              <th>Mode</th>
              <th>Amount</th>
            </tr>
                @if($invoice->credit_amount != 0)
                <tr>
                    <td>Credit Card</td>
                  <td>{{$invoice->invoiceInfo[0]->currency. $invoice->credit_amount}}</td>
                </tr>
                @endif
                @if($invoice->debit_amount != 0)
              <tr>
                <td>Debit Card</td>
                <td>{{$invoice->invoiceInfo[0]->currency. $invoice->debit_amount}}</td>
              </tr>
              @endif
              @if($invoice->cash_amount != 0)
                <tr>
                <td>Cash</td>
                <td>{{$invoice->invoiceInfo[0]->currency. $invoice->cash_amount}}</td>
              </tr>
              @endif
              @if($invoice->bank_amount != 0)
                <tr>
                <td>Bank Transfer</td>
                <td>{{$invoice->invoiceInfo[0]->currency. $invoice->bank_amount}}</td>
              </tr>
              @endif
          </table>
        </div>
      </div>
      <div class="col-md-12"><br>
        <p style="margin-bottom:5px;"><b>Remarks:</b></p>
        <p style="color:red;"><b>Only those invoices can be cancelled which are within 60 days from the current system date.</b></p>
      </div>
      <div class="col-md-12 mt-4">
        <p><b>NOTES:</b></p>
        <ol>
         <li>This sale is covered by ATOL number 3853.</li>
         <li>There is no liability if airline(s) above cease to trade, unless Scheduled Airline Failure Insurance (SAFI)
          has been paid.</li>
        <li>Passengers travelling to/ or via USA/CANADA : will require an ESTA at least 72 hours prior to travel, even
          for transit purposes.Children under 18 travelling to South Africa and Botswana : All minors travelling will be
          required to carry certified copies Birth Certificate, and in the event that only one parent is travelling,
          certified written consent from the other parent to allow the child to travel.</li>
        </ol>
      </div>
      <div class="col-md-12 text-right">
        <button type="button" class="btn btn-success">Print Invoice</button>
      </div>
    </div>
  </div>
  </div>

@stop
@section('js')
<script>
function print() {
  window.print();
}
</script>
@stop
