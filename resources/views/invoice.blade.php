@extends('layouts.frontend')
@section('title')
Invoice
@endsection
@section('header')
<style>
  @import url('https://fonts.googleapis.com/css?family=Lato:400,700&display=swap');
  @import url('https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&display=swap');
  .outer-div{
    background-color: #fff;
    width:100%;
    font-family: 'Lato', sans-serif;
    font-size:16px;
  }
  :root{--blue:#007bff;--indigo:#6610f2;--purple:#6f42c1;--pink:#e83e8c;--red:#dc3545;--orange:#fd7e14;--yellow:#ffc107;--green:#28a745;--teal:#20c997;--cyan:#17a2b8;--white:#fff;--gray:#6c757d;--gray-dark:#343a40;--primary:#007bff;--secondary:#6c757d;--success:#28a745;--info:#17a2b8;--warning:#ffc107;--danger:#dc3545;--light:#f8f9fa;--dark:#343a40;--breakpoint-xs:0;--breakpoint-sm:576px;--breakpoint-md:768px;--breakpoint-lg:992px;--breakpoint-xl:1200px;--font-family-sans-serif:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";--font-family-monospace:SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace}*,::after,::before{box-sizing:border-box}html{font-family:sans-serif;line-height:1.15;-webkit-text-size-adjust:100%;-webkit-tap-highlight-color:transparent}body{margin:0;font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";font-weight:400;line-height:1.5;color:#212529;text-align:left;background-color:#fff}[tabindex="-1"]:focus{outline:0!important}hr{box-sizing:content-box;height:0;overflow:visible}h1,h2,h3,h4,h5,h6{margin-top:0;margin-bottom:.5rem}p{margin-top:0;margin-bottom:1rem}address{margin-bottom:1rem;font-style:normal;line-height:inherit}ul{margin-top:0;margin-bottom:1rem}ul ul{margin-bottom:0}b{font-weight:bolder}a{color:#007bff;text-decoration:none;background-color:transparent}a:hover{color:#0056b3;text-decoration:underline}a:not([href]):not([tabindex]){color:inherit;text-decoration:none}a:not([href]):not([tabindex]):focus,a:not([href]):not([tabindex]):hover{color:inherit;text-decoration:none}a:not([href]):not([tabindex]):focus{outline:0}code{font-family:SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;}img{vertical-align:middle;border-style:none}table{border-collapse:collapse}th{text-align:inherit}[type=button],[type=reset],[type=submit]{-webkit-appearance:button}[type=button]:not(:disabled),[type=reset]:not(:disabled),[type=submit]:not(:disabled){cursor:pointer}[type=button]::-moz-focus-inner,[type=reset]::-moz-focus-inner,[type=submit]::-moz-focus-inner{padding:0;border-style:none}[type=number]::-webkit-inner-spin-button,[type=number]::-webkit-outer-spin-button{height:auto}[type=search]{outline-offset:-2px;-webkit-appearance:none}[type=search]::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{font:inherit;-webkit-appearance:button}[hidden]{display:none!important}.h1,.h2,.h3,.h4,.h5,.h6,h1,h2,h3,h4,h5,h6{margin-bottom:.5rem;font-weight:500;line-height:1.2}hr{margin-top:1rem;margin-bottom:1rem;border:0;border-top:1px solid rgba(0,0,0,.1)}.img-fluid{max-width:100%;height:auto}code{color:#e83e8c;word-break:break-word}a>code{color:inherit}.container{width:100%;padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto}@media (min-width:576px){.container{max-width:540px}}@media (min-width:768px){.container{max-width:720px}}@media (min-width:992px){.container{max-width:960px}}@media (min-width:1200px){.container{max-width:1140px}}.container-fluid{width:100%;padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto}.row{display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;margin-right:-15px;margin-left:-15px}.col,.col-1,.col-10,.col-11,.col-12,.col-2,.col-3,.col-4,.col-5,.col-6,.col-7,.col-8,.col-9,.col-md,.col-md-1,.col-md-10,.col-md-11,.col-md-12,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9{position:relative;width:100%;padding-right:15px;padding-left:15px}.col{-ms-flex-preferred-size:0;flex-basis:0;-ms-flex-positive:1;flex-grow:1;max-width:100%}.col-1{-ms-flex:0 0 8.333333%;flex:0 0 8.333333%;max-width:8.333333%}.col-2{-ms-flex:0 0 16.666667%;flex:0 0 16.666667%;max-width:16.666667%}.col-3{-ms-flex:0 0 25%;flex:0 0 25%;max-width:25%}.col-4{-ms-flex:0 0 33.333333%;flex:0 0 33.333333%;max-width:33.333333%}.col-5{-ms-flex:0 0 41.666667%;flex:0 0 41.666667%;max-width:41.666667%}.col-6{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}.col-7{-ms-flex:0 0 58.333333%;flex:0 0 58.333333%;max-width:58.333333%}.col-8{-ms-flex:0 0 66.666667%;flex:0 0 66.666667%;max-width:66.666667%}.col-9{-ms-flex:0 0 75%;flex:0 0 75%;max-width:75%}.col-10{-ms-flex:0 0 83.333333%;flex:0 0 83.333333%;max-width:83.333333%}.col-11{-ms-flex:0 0 91.666667%;flex:0 0 91.666667%;max-width:91.666667%}.col-12{-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%}@media (min-width:768px){.col-md{-ms-flex-preferred-size:0;flex-basis:0;-ms-flex-positive:1;flex-grow:1;max-width:100%}.col-md-1{-ms-flex:0 0 8.333333%;flex:0 0 8.333333%;max-width:8.333333%}.col-md-2{-ms-flex:0 0 16.666667%;flex:0 0 16.666667%;max-width:16.666667%}.col-md-3{-ms-flex:0 0 25%;flex:0 0 25%;max-width:25%}.col-md-4{-ms-flex:0 0 33.333333%;flex:0 0 33.333333%;max-width:33.333333%}.col-md-5{-ms-flex:0 0 41.666667%;flex:0 0 41.666667%;max-width:41.666667%}.col-md-6{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}.col-md-7{-ms-flex:0 0 58.333333%;flex:0 0 58.333333%;max-width:58.333333%}.col-md-8{-ms-flex:0 0 66.666667%;flex:0 0 66.666667%;max-width:66.666667%}.col-md-9{-ms-flex:0 0 75%;flex:0 0 75%;max-width:75%}.col-md-10{-ms-flex:0 0 83.333333%;flex:0 0 83.333333%;max-width:83.333333%}.col-md-11{-ms-flex:0 0 91.666667%;flex:0 0 91.666667%;max-width:91.666667%}.col-md-12{-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%}}.table{width:100%;margin-bottom:1rem;color:#212529}.table td,.table th{padding:.75rem;vertical-align:top;border-top:1px solid #dee2e6}.table thead th{vertical-align:bottom;border-bottom:2px solid #dee2e6}.table tbody+tbody{border-top:2px solid #dee2e6}.table-bordered{border:1px solid #dee2e6}.table-bordered td,.table-bordered th{border:1px solid #dee2e6}.table-bordered thead td,.table-bordered thead th{border-bottom-width:2px}.table-success,.table-success>td,.table-success>th{background-color:#c3e6cb}.table-success tbody+tbody,.table-success td,.table-success th,.table-success thead th{border-color:#8fd19e}.table-info,.table-info>td,.table-info>th{background-color:#bee5eb}.table-info tbody+tbody,.table-info td,.table-info th,.table-info thead th{border-color:#86cfda}.table-danger,.table-danger>td,.table-danger>th{background-color:#f5c6cb}.table-danger tbody+tbody,.table-danger td,.table-danger th,.table-danger thead th{border-color:#ed969e}.table-light,.table-light>td,.table-light>th{background-color:#fdfdfe}.table-light tbody+tbody,.table-light td,.table-light th,.table-light thead th{border-color:#fbfcfc}.table .thead-light th{color:#495057;background-color:#e9ecef;border-color:#dee2e6}@media (max-width:767.98px){.table-responsive-md{display:block;width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch}.table-responsive-md>.table-bordered{border:0}}.table-responsive{display:block;width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch}.table-responsive>.table-bordered{border:0}.btn{display:inline-block;font-weight:400;color:#212529;text-align:center;vertical-align:middle;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;background-color:transparent;border:1px solid transparent;padding:.375rem .75rem;line-height:1.5;border-radius:.25rem;transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out}@media (prefers-reduced-motion:reduce){.btn{transition:none}}.btn:hover{color:#212529;text-decoration:none}.btn:focus{outline:0;box-shadow:0 0 0 .2rem rgba(0,123,255,.25)}.btn:disabled{opacity:.65}.btn-success{color:#fff;background-color:#28a745;border-color:#28a745}.btn-success:hover{color:#fff;background-color:#218838;border-color:#1e7e34}.btn-success:focus{box-shadow:0 0 0 .2rem rgba(72,180,97,.5)}.btn-success:disabled{color:#fff;background-color:#28a745;border-color:#28a745}.btn-info{color:#fff;background-color:#17a2b8;border-color:#17a2b8}.btn-info:hover{color:#fff;background-color:#138496;border-color:#117a8b}.btn-info:focus{box-shadow:0 0 0 .2rem rgba(58,176,195,.5)}.btn-info:disabled{color:#fff;background-color:#17a2b8;border-color:#17a2b8}.btn-danger{color:#fff;background-color:#dc3545;border-color:#dc3545}.btn-danger:hover{color:#fff;background-color:#c82333;border-color:#bd2130}.btn-danger:focus{box-shadow:0 0 0 .2rem rgba(225,83,97,.5)}.btn-danger:disabled{color:#fff;background-color:#dc3545;border-color:#dc3545}.btn-light{color:#212529;background-color:#f8f9fa;border-color:#f8f9fa}.btn-light:hover{color:#212529;background-color:#e2e6ea;border-color:#dae0e5}.btn-light:focus{box-shadow:0 0 0 .2rem rgba(216,217,219,.5)}.btn-light:disabled{color:#212529;background-color:#f8f9fa;border-color:#f8f9fa}.btn-block{display:block;width:100%}.btn-block+.btn-block{margin-top:.5rem}thead{display:table-header-group}img,tr{page-break-inside:avoid}h2,h3,p{orphans:3;widows:3}h2,h3{page-break-after:avoid}@page{size:a3}body{min-width:992px!important}.container{min-width:992px!important}.table{border-collapse:collapse!important}.table td,.table th{}.table-bordered td,.table-bordered th{border:1px solid #dee2e6!important}
  .float-right{
    float:right;
  }
  .outer-div-inner{
    margin:2% auto;
    padding:20px 25px;
    box-shadow:0px 0px 10px rgba(0,0,0,0.07);
  }
  .bg-light-blue{
    background-color:#26ace2 !important;
  }
  .text-light-blue{
    color:#26ace2 !important;
  }
  .outer-div-inner h1{
    font-size:45px;
    position: relative;
    text-transform: uppercase;
    font-weight: 600;
    font-family: 'Roboto Condensed', sans-serif;
  }
  /*.outer-div-inner h1::after{*/
    /*content: "";*/
    /*position: absolute;*/
    /*height:5px;*/
    /*left:0;*/
    /*width:80px;*/
    /*bottom: -10px;*/
    /*background-color:#26ace2;*/
  /*}*/
  .outer-div-inner h2 {
    font-size: 20px;
    text-transform: uppercase;
    font-weight: 600;
    font-family: 'Roboto Condensed', sans-serif;
    color: #fff !important;
    display: inline-block !important;
    padding: 1rem;
    margin-top:10px;
  }
  .outer-div-inner h3 {
    font-size: 24px;
    text-transform: uppercase;
    font-weight: 600;
    font-family: 'Roboto Condensed', sans-serif;
    color: #26ace2;
  }
  .outer-div-inner h4{
    font-size:2rem;
  }
  .outer-div-inner table{
    margin-top:1rem;
  }
  .outer-div-inner table thead {
    background-color: #4e484c;
    color: #fff;
    text-transform: uppercase;
  }
  .outer-div-inner table thead tr th{
    color: #fff;
    font-weight: 600;
  }
  .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 30px;
    float: right;
    margin-top: 18px;
  }

  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 22px;
    width: 22px;
    left: 9px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked + .slider {
    background-color: #69a713;
  }

  input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }
  .opacity_05{
    opacity: 0.3;
  }




  @media only screen and (max-width:767px){
    .outer-div{
      font-size:13px;
    }
    .outer-div-inner{
      margin:2% auto;
      padding:15px 10px;
    }
    .outer-div-inner h1{
      font-size:30px;
    }
    .outer-div-inner h1::after{
      height:3px;
      width:60px;
    }
    .outer-div-inner h2{
      font-size:18px;
    }
    .outer-div-inner h4{
      font-size:1rem;
    }
  }
  @media print {
    .noprint {
      display: none;
    }
}
</style>
  <section class="content-header">
      <h1>
        Invoice
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        @if(!Auth::user()->client)
        <li><a href="{{route('invoice')}}"><i class="fa fa-paperclip"></i> Invoices</a></li>
        @endif 
        <li class="active">Invoice</li>
      </ol>
    </section>
@stop
@section('content')

<div class="outer-div">
    <div class="container outer-div-inner">
        <div class="row" style="border-bottom:2px solid #797777;padding-bottom:10px;margin-bottom:10px;">
          <div class="col-md-12">
            <img src="{{asset('images/logo.png')}}" alt="logo" class="img-fluid img-responsive"/>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"><p class="m-0">Invoice No:<b> {{$invoice->invoice_no}} </b></p></div>
          <div class="col-md-4 text-center"><h1>Invoice</h1></div>
          <div class="col-md-4 text-right"><p class="m-0">Invoice Date:<b> {{ Carbon\Carbon::parse($invoice->invoice_date)->format('j F Y') }}</b></p></div>
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
        <div class="row hide_div1">
          <div class="col-md-12">
            <h2 class="p-3 bg-light-blue d-inline-block text-white">Flight</h2>
            <label class="switch switch1">
              <input type="checkbox" checked>
              <span class="slider round"></span>
            </label>
          </div>
      @foreach($invoice->flights as $flight)
          <div class="col-md-12">
            <h4 class="mt-3"><b>Passanger Details</b></h4>

          </div>
          <div class="col-md-12">
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
          </div>
          <div class="col-md-12 mt-4">
            <h4 class="mt-3"><b>Flight Details</b></h4>
            <p>Booking Ref: IEB 9003953 &nbsp;&nbsp; | &nbsp;&nbsp; Airline Ref: {{ $flight->airline_ref }}</p>
          </div>
          <div class="col-md-12">
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
                    <td>{{ $flight->segment_one_from.', '. Carbon\Carbon::parse($flight->segment_one_departure)->format('l\\, F jS\\, Y\\, h:i A') }}</td>
                    <td>{{ $flight->segment_one_to.', '.  Carbon\Carbon::parse($flight->segment_one_arrival)->format('l\\, F jS\\, Y\\, h:i A') }}</td>
                    <td>{{ $flight->segment_one_flight }}</td>
                    <td>{{ $flight->segment_one_class }}</td>
                    <td>{{ $flight->segment_one_carrier }}</td>
            </tr>
            <tr>
                    <td>{{ $flight->segment_two_from.', '. Carbon\Carbon::parse($flight->segment_two_departure)->format('l\\, F jS\\, Y\\, h:i A') }}</td>
                    <td>{{ $flight->segment_two_to.', '. Carbon\Carbon::parse($flight->segment_two_arrival)->format('l\\, F jS\\, Y\\, h:i A') }}</td>
                    <td>{{ $flight->segment_two_flight }}</td>
                    <td>{{ $flight->segment_two_class }}</td>
                    <td>{{ $flight->segment_two_carrier}}</td>
            </tr>
          </tbody>
          </table>
        </div>
          </div>
          <div class="col-md-12">
            <h4 class="mt-3"><b>Total:</b> <b class="float-right"><span class="text-light-blue">{{ $invoice->currency.$flight->total_amount }}</span></b></h4>
          </div>
          @endforeach
        </div>
        @endif
        @foreach($invoice->invoiceInfo as $info)
        @if($info->service_name == 'Visa Services')
        <div class="row hide_div2">
          <div class="col-md-12 mt-4">
            <h2 class="p-3 bg-light-blue d-inline-block text-white">{{ $info->service_name }}</h2>
            <label class="switch switch2">
              <input type="checkbox" checked>
              <span class="slider round"></span>
            </label>
          </div>
          <div class="col-md-12">
            <div class="table-responsive">
            <table class="table table-bordered">
            <thead>
            <tr>
                    <th>Applicant Name</th>
                    <th>Passport Origin</th>
                    <th>Visa Country</th>
                    <th>Visa Type</th>
                    <th>Visa Fees</th>
                    <th>Service Charge</th>
            </tr>
          </thead>
          <tbody>
            <tr>
                    <td>{{$info->name_of_visa_applicant}}</td>
                    <td>{{$info->passport_origin}}</td>
                    <td>{{$info->visa_country}}</td>
                    <td>{{$info->visa_type}}</td>
                    <td>{{$info->visa_charges}}</td>
                    <td>{{$info->service_charge}}</td>
            </tr>
          </tbody>
          </table>
        </div>
          </div>
          <div class="col-md-12">
            <h4 class="mt-3"><b>Total:</b> <b class="float-right"><span class="text-light-blue">{{ $invoice->currency.$info->visa_amount }}</span></b></h4>
          </div>
        </div>
        @endif
        @if($info->service_name == 'Hotel')
        <div class="row hide_div3">
      <div class="col-sm-12 mt-4">
        <h2 class="p-3 bg-light-blue d-inline-block text-white">{{ $info->service_name }}</h2>
        <label class="switch switch3">
          <input type="checkbox" checked>
          <span class="slider round"></span>
        </label>
      </div>
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
            <tr>
              <th>Hotel City</th>
              <th>Hotel Country</th>
              <th>Name</th>
              <th>Check-In-Date</th>
              <th>Check-Out-Date</th>
              <th>No. Of Children</th>
              <th>No. Of Rooms</th>
            </tr>
        </thead>
            <tr>
              <td>{{ $info->hotel_city }}</td>
              <td>{{ $info->hotel_country }}</td>
              <td>{{ $info->hotel_name }}</td>
              <td>{{ Carbon\Carbon::parse($info->check_in_date)->format('d/m/Y') }}</td>
              <td>{{ Carbon\Carbon::parse($info->check_out_date)->format('d/m/Y') }}</td>
              <td>{{ $info->no_of_children }}</td>
              <td>{{ $info->no_of_rooms }}</td>
            </tr>
          </table>
        </div>
      </div>
      <div class="col-md-12">
        <h4 class="mt-3"><b>Total:</b> <b class="float-right"><span class="text-light-blue">{{ $invoice->currency.$info->hotel_amount }}</span></b></h4>
      </div>
    </div>
      @endif

      @if($info->service_name == 'Insurance')
      <div class="row hide_div4">
        <div class="col-md-12 mt-4">
            <h2 class="p-3 bg-light-blue d-inline-block text-white">{{ $info->service_name }}</h2>
          <label class="switch switch4">
            <input type="checkbox" checked>
            <span class="slider round"></span>
          </label>
        </div>
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
            <tr>
              <th>Name Of Insurance Applicant</th>
              <th>Company Name</th>
              <th>Insurance Remarks</th>
            </tr>
        </thead>
            <tr>
              <td>{{ $info->name_of_insurance_applicant }}</td>
              <td>{{ $info->name_of_insurance_company }}</td>
              <td>{{ $info->insurance_remarks }}</td>
            </tr>
          </table>
        </div>
      </div>
      <div class="col-md-12">
        <h4 class="mt-3"><b>Total:</b> <b class="float-right"><span class="text-light-blue">{{ $invoice->currency.$info->insurance_amount }}</span></b></h4>
      </div>
    </div>
      @endif

      @if($info->service_name == 'Local Sight Sceen')
      <div class="row hide_div5">
            <div class="col-md-12 mt-4">
              <h2 class="p-3 bg-light-blue d-inline-block text-white">{{ $info->service_name }}</h2>
              <label class="switch switch5">
                <input type="checkbox" checked>
                <span class="slider round"></span>
              </label>
            </div>
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered">
                <thead>
            <tr>
              <th>Local Sight Sceen Remarks</th>
            </tr>
        </thead>
            <tr>
              <td>{{ $info->local_sight_sceen_remarks }}</td>
            </tr>
          </table>
        </div>
      </div>
      <div class="col-md-12">
        <h4 class="mt-3"><b>Total:</b> <b class="float-right"><span class="text-light-blue">{{ $invoice->currency.$info->local_sight_sceen_amount }}</span></b></h4>
      </div>
    </div>
      @endif

      @if($info->service_name == 'Local Transport')
      <div class="row hide_div6">
            <div class="col-md-12 mt-4">
              <h2 class="p-3 bg-light-blue d-inline-block text-white">{{ $info->service_name }}</h2>
              <label class="switch switch6">
                <input type="checkbox" checked>
                <span class="slider round"></span>
              </label>
                  </div>
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered">
              <thead>
            <tr>
              <th>Local Transport Remarks</th>
            </tr>
        </thead>
            <tr>
              <td>{{ $info->local_transport_remarks }}</td>
            </tr>
          </table>
        </div>
      </div>
      <div class="col-md-12">
        <h4 class="mt-3"><b>Total:</b> <b class="float-right"><span class="text-light-blue">{{ $invoice->currency.$info->local_transport_amount }}</span></b></h4>
      </div>
    </div>
      @endif

      @if($info->service_name == 'Car Rental')
      <div class="row hide_div7">
      <div class="col-md-12 mt-4">
            <h2 class="p-3 bg-light-blue d-inline-block text-white">{{ $info->service_name }}</h2>
        <label class="switch switch7">
          <input type="checkbox" checked>
          <span class="slider round"></span>
        </label>
          </div>
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered">
              <thead>
            <tr>
              <th>Car Rental Remarks</th>
            </tr>
        </thead>
            <tr>
              <td>{{ $info->car_rental_remarks }}</td>
            </tr>
          </table>
        </div>
      </div>

      <div class="col-md-12">
        <h4 class="mt-3"><b>Total:</b> <b class="float-right"><span class="text-light-blue">{{ $invoice->currency.$info->car_rental_amount}}</span></b></h4>
      </div>
        </div>
      @endif

      @if($info->service_name == 'Other Facilities')
      <div class="row hide_div8">
      <div class="col-md-12 mt-4">
            <h2 class="p-3 bg-light-blue d-inline-block text-white">{{ $info->service_name }}</h2>
        <label class="switch switch8">
          <input type="checkbox" checked>
          <span class="slider round"></span>
        </label>
          </div>
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered">
              <thead>
            <tr>
              <th>Other Facilities Remarks</th>
            </tr>
        </thead>
            <tr>
              <td>{{ $info->other_facilities_remarks }}</td>
            </tr>
          </table>
        </div>
      </div>
      <div class="col-md-12">
        <h4 class="mt-3"><b>Total:</b> <b class="float-right"><span class="text-light-blue">{{ $invoice->currency.$info->other_facilities_amount }}</span></b></h4>
      </div>
    </div>
      @endif
      @endforeach<br>
        <div class="row">
          <div class="col-md-4">
             {{-- <h4><b>Payment Information</b></h4> --}}
              <div class="table-responsive">
                <table class="table">
                  {{-- <thead>
                  <tr>
                    <th>Mode</th>
                    <th>Amount</th>
                  </tr>
                  </thead> --}}
                  <tbody>
                    @if($invoice->debit_amount != '0' or $invoice->debit_amount != null or $invoice->debit_amount != 0.00  )
                  <tr>
                    <td>Debit Card</td>
                    <td>{{ $invoice->currency.$invoice->debit_amount }}</td>
                  </tr>
                  @endif
                    @if($invoice->credit_amount != '0' or $invoice->credit_amount != null or $invoice->credit_amount != 0.00)
                  <tr>
                    <td>Credit Card</td>
                    <td>{{ $invoice->currency.$invoice->credit_amount }}</td>
                  </tr>
                  @endif
                    @if($invoice->cash_amount != '0' or $invoice->cash_amount != null or $invoice->cash_amount != 0.00)
                  <tr>
                    <td>Cash</td>
                    <td>{{ $invoice->currency.$invoice->cash_amount }}</td>
                  </tr>
                  @endif
                    @if($invoice->bank_amount != '0' or $invoice->bank_amount != null or $invoice->bank_amount != 0.00)
                  <tr>
                    <td>Bank</td>
                    <td>{{ $invoice->currency.$invoice->bank_amount }}</td>
                  </tr>
                  @endif
                  </tbody>
                </table>
              </div>
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
                <p class="mb-1"><b>VAT @ {{ $invoice->VAT_percentage }}%:</b></p>
              @endif
            @endif
            <p class="mb-1"><b>Total:</b></p>
            @if($invoice->paid != 0)
              <p class="mb-1"><b>Paid:</b></p>
            @endif
            @if($invoice->advance != 0)
              <p class="mb-1"><b>Advance:</b></p>
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
              <p class="mb-1"><b>{{ $invoice->currency}}{{$invoice->discounted_total + $invoice->VAT_amount}}</b></p>
            @if($invoice->paid != 0)
                <p class="mb-1"><b>{{ $invoice->currency}}{{$invoice->paid}}</b></p>
            @endif
            @if($invoice->advance != 0)
                <p class="mb-1"><b>{{ $invoice->currency}}{{$invoice->advance}}</b></p>
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
          </div>
        </div><hr>
        <div class="row">
          <div class="col-md-12">
            <h4><b>Remarks:</b></h4>
            <p class="text-danger">Only those invoices can be cancelled which are within 60 days from the current system date.</p>
          </div>
          <div class="col-md-12">
            <h4><b>Notes:</b></h4>
            <ul>
              <li>This sale is covered by ATOL number 3853.</li>
              <li>There is no liability if airline(s) above cease to trade, unless Scheduled Airline Failure Insurance (SAFI) has been paid.</li>
              <li>Passengers travelling to/ or via USA/CANADA : will require an ESTA at least 72 hours prior to travel, even for transit purposes.Children under 18 travelling to South Africa and Botswana : All minors travelling will be required to carry certified copies Birth Certificate, and in the event that only one parent is travelling, certified written consent from the other parent to allow the child to travel.</li>
            </ul>
            {{-- <a href="#" class="btn btn-success noprint" onclick="print();">Print Invoice</a> --}}
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
<script>
      $('.switch1 input:checkbox').change(function(){
          if($(this).is(":checked")) {
              $('.hide_div1').removeClass("noprint");
              $('.hide_div1').removeClass("opacity_05");

          } else {
              $('.hide_div1').addClass("noprint");
              $('.hide_div1').addClass("opacity_05");
          }
      });

      $('.switch2 input:checkbox').change(function(){
          if($(this).is(":checked")) {
              $('.hide_div2').removeClass("noprint");
              $('.hide_div2').removeClass("opacity_05");

          } else {
              $('.hide_div2').addClass("noprint");
              $('.hide_div2').addClass("opacity_05");
          }
      });

      $('.switch3 input:checkbox').change(function(){
          if($(this).is(":checked")) {
              $('.hide_div3').removeClass("noprint");
              $('.hide_div3').removeClass("opacity_05");

          } else {
              $('.hide_div3').addClass("noprint");
              $('.hide_div3').addClass("opacity_05");
          }
      });

      $('.switch4 input:checkbox').change(function(){
          if($(this).is(":checked")) {
              $('.hide_div4').removeClass("noprint");
              $('.hide_div4').removeClass("opacity_05");

          } else {
              $('.hide_div4').addClass("noprint");
              $('.hide_div4').addClass("opacity_05");
          }
      });

      $('.switch5 input:checkbox').change(function(){
          if($(this).is(":checked")) {
              $('.hide_div5').removeClass("noprint");
              $('.hide_div5').removeClass("opacity_05");

          } else {
              $('.hide_div5').addClass("noprint");
              $('.hide_div5').addClass("opacity_05");
          }
      });

      $('.switch6 input:checkbox').change(function(){
          if($(this).is(":checked")) {
              $('.hide_div6').removeClass("noprint");
              $('.hide_div6').removeClass("opacity_05");

          } else {
              $('.hide_div6').addClass("noprint");
              $('.hide_div6').addClass("opacity_05");
          }
      });

      $('.switch7 input:checkbox').change(function(){
          if($(this).is(":checked")) {
              $('.hide_div7').removeClass("noprint");
              $('.hide_div7').removeClass("opacity_05");

          } else {
              $('.hide_div7').addClass("noprint");
              $('.hide_div7').addClass("opacity_05");
          }
      });

      $('.switch8 input:checkbox').change(function(){
          if($(this).is(":checked")) {
              $('.hide_div8').removeClass("noprint");
              $('.hide_div8').removeClass("opacity_05");

          } else {
              $('.hide_div8').addClass("noprint");
              $('.hide_div8').addClass("opacity_05");
          }
      });
 </script>
@stop
