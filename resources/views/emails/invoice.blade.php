
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
  <body style="background-color:#ecf0f5;margin:0;padding:3rem 0;font-size:15px;font-family: 'Lato', sans-serif !important;color:#000;">
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
<div class="col-md-6"><p class="m-0">Invoice No:<b> CLDI0007 </b></p></div>
{{-- <div class="col-md-4 text-center"><h1>Invoice</h1></div> --}}
<div class="col-md-6 text-right"><p class="m-0">Invoice Date:<b> 26 June 2019</b></p></div>
</div>
<div class="row mt-5">
<div class="col-md-8">
<h3>To</h3>
<p>shiva sapra<br>
fghf<br>Alperton<br>jkbjhb<br>160102
</div>
<div class="col-md-4">
<h3>Issued By</h3>
<p>62 King street,<br> Southall, <br>Middlesex,<br> UB2 4DB<br>
<b>TEL:</b> 02035000000<br>
<b>E-MAIL</b> info@cloudtravels.co.uk</p>
</div>
</div>

<h2 class="p-3 bg-light-blue d-inline-block text-white">Flight</h2>
<h4 class="mt-3"><b>1. Passenger Details</b></h4>
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
<tr>
<td>1</td>
<td>ADULT</td>
<td>SIBV</td>
<td>KHGJB</td>
</tr>
</tbody>
</table>
</div>
<p>Note - * denotes the lead passenger</p><br>

<h4 class="mt-3"><b>Flight Details</b></h4>
<p>Booking Ref: IEB 9003953 &nbsp;&nbsp; | &nbsp;&nbsp; Airline Ref: YTYGHG</p>
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
<td>KABUL, Tuesday, January 1st, 2019, 01:00 AM</td>
<td>KABUL, Tuesday, January 1st, 2019, 01:00 AM</td>
<td>AEGEAN AIRLINES</td>
<td>ECONOMY CLASS</td>
<td>SS</td>
</tr>
<tr>
<td>KABUL, Tuesday, January 1st, 2019, 01:00 AM</td>
<td>KABUL, Tuesday, January 1st, 2019, 01:00 AM</td>
<td>AEGEAN AIRLINES</td>
<td>ECONOMY CLASS</td>
<td>AA</td>
</tr>
</tbody>
</table>
</div>
<div class="">
<h4 class="mt-3"> <b class="float-right"><b>Total: </b><span class="text-light-blue">£240</span></b></h4>
</div>


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
<tr>
<th>1.</th>
<td>SHIVA SAPRA</td>
<td>INDIA</td>
<td>INDIA</td>
<td>TOURIST</td>
<td>120</td>
<td>120</td>
<td><b>£240</b></td>
</tr>
</tbody>
</table>
</div>
<div class="">
<h4 class="mt-3"> <b class="float-right"><b>Total: </b><span class="text-light-blue">£240</span></b></h4>
</div>

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
<tr>
<th>1.</th>
<td>BANGALORE</td>
<td>INDIA</td>
<td>VEDANTA</td>
<td>01/01/2019</td>
<td>26/06/2019</td>
<td>2</td>
<td>5</td>
<td><b>£120</b></td>
</tr>
</tbody>
</table>
</div>
<div class="">
<h4 class="mt-3"> <b class="float-right"><b>Total: </b><span class="text-light-blue">£120</span></b></h4>
</div>

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
<tr>
<th>1.</th>
<td>SIBV KHGJB</td>
<td>TEST</td>
<td>GOOD</td>
<td><b>£120</b></td>
</tr>
</tbody>
</table>
</div>
<div class="">
<h4 class="mt-3"> <b class="float-right"><b>Total: </b><span class="text-light-blue">£120</span></b></h4>
</div>
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
<tr>
<th>1.</th>
<td>GOOD</td>
<td><b>£120</b></td>
</tr>
</tbody>
</table>
</div>
<div class="">
<h4 class="mt-3"> <b class="float-right"><b>Total: </b><span class="text-light-blue">£120</span></b></h4>
</div>
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
<tr>
<th>1.</th>
<td>TESTING</td>
<td><b>£125</b></td>
</tr>
</tbody>
</table>
</div>
<div class="">
<h4 class="mt-3"> <b class="float-right"><b>Total: </b><span class="text-light-blue">£125</span></b></h4>
</div>
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
<tr>
<th>1.</th>
<td>TESTING</td>
<td><b>£1254</b></td>
</tr>
</tbody>
</table>
</div>
<div class="">
<h4 class="mt-3"> <b class="float-right"><b>Total: </b><span class="text-light-blue">£1254</span></b></h4>
</div>
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
<tr>
<th>1.</th>
<td>AWESOME!!</td>
<td><b>£1258</b></td>
</tr>
</tbody>
</table>
</div>
<div class="">
<h4 class="mt-3"> <b class="float-right"><b>Total: </b><span class="text-light-blue">£1258</span></b></h4>
</div>
<br><br>
<div class="row">
<div class="col-md-4">
<div class="table-responsive">
<table class="table table-bordered">
<thead>
<tr>
<th>Payment Mode</th>
<th>Amount</th>
</tr>
</thead>
<tbody>
<tr>
<td>Debit Card</td>
<td>£300</td>
</tr>
<tr>
<td>Credit Card</td>
<td>£12000</td>
</tr>
<tr>
<td>Cash</td>
<td>£452</td>
</tr>
<tr>
<td>Bank</td>
<td>£250</td>
</tr>
</tbody>
</table>
</div>
</div>
<div class="col-md-8 text-right">
<div class="w-100">
<div class="" style="display:inline-block;margin-right:30px;">
<p class="mb-1"><b>Sub Total:</b></p>
<p class="mb-1"><b>Discount:</b></p>
<p class="mb-1"><b>VAT @ 10%</b></p>
<p class="mb-1"><b>Total:</b></p>
<p class="mb-1"><b>Paid:</b></p>
</div>
<div class="" style="display:inline-block;">
<p class="mb-1"><b>£3477.00</b></p>
<p class="mb-1"><b>£477</b></p>
<p class="mb-1"><b>£300:</b></p>
<p class="mb-1"><b>£3300</b></p>
<p class="mb-1"><b>£13002</b></p>
</div>
</div>
<hr>
<div class="w-100">
<div class="" style="display:inline-block;margin-right:30px;">
<h4 class="mb-1"><b>Advance:</b></h4>
</div>
<div class="" style="display:inline-block;">
<h4 class="mb-1"><b>£ 9702</b></h4>
</div>
</div>
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
</section>
</body>
</html>