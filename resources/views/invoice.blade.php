@extends('layouts.frontend')
@section('title')
Invoice
@endsection
@section('header')
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

    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <img src="{{asset('/logo.jpg')}}" style="width: 150px; height: 70px" alt="User Image">
            <small class="pull-right"></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        
        <!-- /.col -->
        <div class="col-sm-8 invoice-col">
          To,<br>
          RECEIVER (BILL TO)
          <address>
            <strong>{{$invoice->receiver_name}}</strong><br>
            {{$invoice->billing_address}}<br>
            {{-- San Francisco, CA 94107<br>
            Phone: (555) 539-1037<br>
            Email: john.doe@example.com --}}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          {{-- Reverse Charge: <br><br> --}}
          <b>Invoice: {{$invoice->invoice_no}}</b>
          <br>
          <b>Date: </b>{{$invoice->invoice_date}}<br>
          {{-- <b>Payment Due:</b> 2/22/2014<br>
          <b>Account:</b> 968-34567 --}}
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
                <th width="15%" style="color:white;font-weight:500;background-color:#0066FF;">Item Name</th>
                <th width="15%" style="color:white;font-weight:500;background-color:#0066FF;">Item Sub Name</th>
                <th width="7%" style="color:white;font-weight:500;background-color:#0066FF;">Quantity</th>
                {{-- <th width="8%">Currency</th> --}}
                <th width="13%" style="color:white;font-weight:500;background-color:#0066FF;">Price</th>
                <th width="12%" style="color:white;font-weight:500;background-color:#0066FF;">Actual Amt.</th>
                {{-- <th width="12%">Status</th> --}}
            </tr>
            </thead>
            <tbody>
            @foreach($invoice->invoiceInfo as $info)
            <tr id="row">
            <td>{{$info->item_name}}</td>
            <td>{{$info->item_subname}}</td>
            <td>{{$info->quantity}}</td>
            {{-- <td>{{$invoice->currency}}</td> --}}
            <td>{{$info->price}}</td>
            <td>{{$info->currency.$info->amount}}</td>
            @endforeach
            {{-- <td>@if($invoice->status ==1)
                {{'Paid'}}
                @else
                {{"UnPaid"}}
                @endif
            </td> --}}
          </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div><br>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Payment Methods:</p>
          <div class="table-responsive">
            <table class="table">
              @if($invoice->credit)
              <tr>
                <th style="width:50%"><button class="btn btn-xs bg-maroon btn-flat">Credit Card</button></th>
                <td>{{$invoice->invoiceInfo[0]->currency. $invoice->credit_amount}}</td>
              </tr>
              @endif

              @if($invoice->debit)
              <tr>
                <th style="width:50%"><button class="btn btn-xs bg-purple btn-flat">Debit Card</button></th>
                <td>{{$invoice->invoiceInfo[0]->currency. $invoice->debit_amount}}</td>
              </tr>
              @endif
              @if($invoice->cash)
                <tr>
                <th style="width:50%"><button class="btn btn-xs bg-navy btn-flat">Cash</button></th>
                <td>{{$invoice->invoiceInfo[0]->currency. $invoice->cash_amount}}</td>
              </tr>
              @endif
              @if($invoice->bank)
                <tr>
                <th style="width:50%"><button class="btn btn-xs bg-olive btn-flat">Bank Transfer</button></th>
                <td>{{$invoice->invoiceInfo[0]->currency. $invoice->bank_amount}}</td>
              </tr>
              @endif
            </table>
          </div>
          {{-- <img src="../../dist/img/credit/visa.png" alt="Visa">
          <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
          <img src="../../dist/img/credit/american-express.png" alt="American Express">
          <img src="../../dist/img/credit/paypal2.png" alt="Paypal"> --}}

          {{-- <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
            dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
          </p> --}}
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          {{-- <p class="lead">Amount Due Date: </p> --}}

          <div class="table-responsive">
            <table class="table">
              
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td>{{$invoice->invoiceInfo[0]->currency}} {{$invoice->total}}</td>
              </tr>
              <tr>
                <th>Discount:</th>
                <td>{{$invoice->invoiceInfo[0]->currency}} {{$invoice->discount}}</td>
              </tr>
              {{-- <tr>
                <th>Discounted Total:</th>
                <td>{{$invoice->invoiceInfo[0]->currency}} {{$invoice->discounted_total}}</td>
              </tr> --}}
              @if($tax[0]->enable == 'yes')
              <tr>
                <th>VAT ({{$tax[0]->tax}}%)</th>
                <?php $taxed = ($tax[0]->tax/100*$invoice->discounted_total) ?>
                <td>{{$invoice->invoiceInfo[0]->currency}} {{$taxed}}</td>
              </tr>
              @endif
              {{-- <tr>
                <th>Shipping:</th>
                <td>{{$invoice->invoiceInfo[0]->currency}} 0.00</td>
              </tr> --}}
              <tr>
                <th>Total:</th>
                @if($tax[0]->enable == 'yes')
                <?php $total = $invoice->discounted_total + $taxed ?>
                <td style="color:white;font-weight:500;background-color:#0066FF;">{{$invoice->invoiceInfo[0]->currency}} {{$total}}</td>
                @else
                  <td style="color:white;font-weight:500;background-color:#0066FF;">{{$invoice->invoiceInfo[0]->currency}} {{$invoice->discounted_total}}</td>
                @endif
              </tr>
              <tr>
                <th class="text-success">Paid:</th>
                <td>{{$invoice->invoiceInfo[0]->currency}} {{$invoice->paid}}</td>
              </tr>
              <tr>
                <th class="text-danger">Pending:</th>
                <td>{{$invoice->invoiceInfo[0]->currency}} {{$invoice->pending_amount}}</td>
              </tr>
              
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="{{route('invoice.print',['id'=>$invoice->id])}}" target="_blank" class="btn btn-primary pull-right"><i class="fa fa-print"></i> Print</a>
          {{-- <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button> --}}
        </div>
      </div><hr>
      <p class="text-muted" style="margin-top: 10px; font-size: 10px">
        <strong>*T&C</strong><br>
        Foreign & Commonwealth Office Travel Advice: The Foreign & Commonwealth Office (FCO) issues travel advice on destinations, which includes information on passports, visas, health, safety and security and more. For more information refer to the link: <a href=" https://www.gov.uk/foreign-travel-advice"> https://www.gov.uk/foreign-travel-advice</a> New Security Requirements For Airlines : Phones, laptops and tablets larger than 16.0cm x 9.3cm x 1.5cm not allowed in the cabin on flights to the UK from Turkey, Lebanon, Egypt, Saudi Arabia, Jordan and Tunisia. For more information please see <a href="https://www.gov.uk/government/news/additional-hand-luggage-restrictions-on-some-flights-to-the-uk">https://www.gov.uk/government/news/additional-hand-luggage-restrictions-on-some-flights-to-the-uk</a>
      </p>
      <p class="text-muted" style="margin-top: 10px; font-size: 10px">
        NOTES :
        Reconfirmation of any onward / return journey is passengers responsibility.
        Valid travel documentation such as valid passport, visa, health precautions are passengers responsibility.
        Timings are subject to change, please reconfirm with your airline operator before you fly.
        Any reissue / revalidation / cancellation will incur a fee.
        Any passengers under 18 years on age travelling to South Africa will be denied boarding if not carrying their original birth certificate.
        Any passengers who hold an OCI who travel to INDIA without their original OCI card will be denied boarding.
        Passengers travelling to/ or via USA/CANADA : will require an ESTA at least 72 hours prior to travel, even for transit purposes. Children under 18 travelling to South Africa and Botswana : All minors travelling will be required to carry certified copies Birth Certificate, and in the event that only one parent is travelling, certified written consent from the other parent to allow the child to travel.
        If there are any long (or overnight transits) , include multiple transit points enroute within a country, it is the passengers responsibility to make the necessary accommodation and visa arrangements.
        PASSENGER NOTICE :
        Carriage and other services provided by the carrier are subject to conditions of contract, which are hereby incorporated by reference. These conditions may be obtained from the issuing carrier. The itinerary/receipt constitutes the passenger ticket for the purposes of Article 3 of the Warsaw convention, except where the carrier delivers to the passenger another document complying with the requirements of Article 3. If the passenger's journey involves an ultimate destination or stop in a country other than the country of departure the Warsaw Convention may be applicable, and the convention governs, and in most cases limits, the liability of carriers for death or personal injury and in respect of loss of or damage to baggage. See also notices headed Advice to International Passengers on limitation of liability and notice of baggage liability limitations. Full conditions can be found at
        <a href="WWW.IATA.ORG">WWW.IATA.ORG</a>
        or by clicking 
        HERE
      </p>
      <p class="text-muted" style="margin-top: 10px; font-size: 10px">
        If you are travelling to USA, all qualified Visa Waiver Program travellers will be required to obtain electronic travel authorization prior to boarding an air or sea carrier to the United States.
        Electronic System for Travel Authorization (ESTA) to USA
        Travellers who do not receive travel authorization prior to their departure may be denied boarding, experience delays or be denied admission into the United
        States. Applications may be submitted at anytime prior to travel, but no less than 72 hours prior to departure.
        Travel Authorization is obtained through an online registration system known as the Electronic System for Travel Authorization (ESTA). If your registration
        is successful, it will be valid for multiple applications for two years or until the date on which your passport expires, which ever comes first.
        Submit your ESTA Application at 
        <a href="WWW.IATA.ORG">WWW.IATA.ORG</a>
      </p>
      <p class="text-muted" style="margin-top: 10px; font-size: 10px">
        Note : There is no liability if airline(s) above cease to trade, unless Scheduled Airline Failure Insurance (SAFI) has been paid.
        Yours Sincerely
      </p>
    
    </section>
@stop