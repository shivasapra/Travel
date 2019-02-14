@extends('layouts.frontend')
@section('title')
Client Status
@endsection
@section('header')
	<section class="content-header">
      <h1>
        Client Status
      <button type="button" data-toggle="modal" data-target="#modal-info" class="btn btn-sm btn-info">Search Client&nbsp;&nbsp;&nbsp;<i class="fa fa-search"></i></button>
      </h1>
      <div class="modal fade" id="modal-info">
  		<div class="modal-dialog">
   			<div class="modal-content">
      <div class="modal-header" style="color:white;font-weight:500;background-color:#0066FF;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Search client</h4>
      </div>
      <form action="{{route('searchClient')}}" method="post">
        @csrf
      <div class="modal-body">
          <label for="client_name">Client Name</label>
          <input type="text" name="client_name" class="form-control" />
      </div>
      <div class="modal-footer" style="color:white;font-weight:500;background-color:#0066FF;">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-outline">Search</button>
      </div>
      </form>
    		</div>
  		</div>
	</div>

      
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-pencil-square-o"></i>Status</li>
      </ol>
    </section>
@stop
@section('content')
<form action="{{route('statusSave')}}" method="post">
  @csrf
	@if($clients->count()>0)
  	<div class="box box-info">
    	<div class="box-body">
    		@foreach($clients as $client)
    		<table class="table table-hover mb-0">
                    <thead>
                      <tr>
                        <th>Sno.</th>
                        <th>Name</th>
                        <th>Client Id</th>
                        <th>Country</th>
                        <th>Postal Code</th>
                        <th>Contact</th>
                        <th>DOB</th>
                        <th>Email</th>
                      </tr>
                    	</thead>
                    <tbody>
                    	@if($clients->count()>0)
                    	<?php $i = 1; ?>
	                    	@foreach($clients as $client)
	                    	<tr>
	                    		<td>{{$i++}}</td>
	                    		<td>{{$client->first_name.' '.$client->last_name}}</td>
	                    		<td><input id="unique" type="text" value="{{$client->unique_id}}" readonly></td>
	                    		<td>{{$client->country}}</td>
	                    		<td>{{$client->postal_code}}</td>
	                    		<td>{{$client->phone}}</td>
	                    		<td>{{$client->DOB}}</td>
	                    		<td>{{$client->email}}</td>
	                    		</tr>
	                    	@endforeach
                    	@endif
                    </tbody>
            </table>
    		@endforeach
    			
    	</div>
	</div>
    @endif	
	<div class="box box-info">
    	<div class="box-body">
    		
    		<div class="row">
    			<div class="col-md-4">
    				<label for="client_id">Client Id:</label>
    				<input type="text" id="clientId" name="client_id" required class="form-control">
    			</div>
    			<div class="col-md-4">
    				<label for="country">Select Country:</label>
    				<select name="country" required class="form-control" id="country">
    					<option value=''>----Select----</option>
					    <option value='Ascension Island'>Ascension Island</option>
					    <option value='Andorra'>Andorra</option>
					    <option value='United Arab Emirates'>United Arab Emirates</option>
					    <option value='Afghanistan'>Afghanistan</option>
					    <option value='Antigua And Barbuda'>Antigua And Barbuda</option>
					    <option value='Anguilla'>Anguilla</option>
					    <option value='Albania'>Albania</option>
					    <option value='Armenia'>Armenia</option>
					    <option value='Angola'>Angola</option>
					    <option value='Antarctica'>Antarctica</option>
					    <option value='Argentina'>Argentina</option>
					    <option value='American Samoa'>American Samoa</option>
					    <option value='Austria'>Austria</option>
					    <option value='Australia'>Australia</option>
					    <option value='Aruba'>Aruba</option>
					    <option value='Åland Islands'>Åland Islands</option>
					    <option value='Azerbaijan'>Azerbaijan</option>
					    <option value='Bosnia & Herzegovina'>Bosnia & Herzegovina</option>
					    <option value='Barbados'>Barbados</option>
					    <option value='Bangladesh'>Bangladesh</option>
					    <option value='Belgium'>Belgium</option>
					    <option value='Burkina Faso'>Burkina Faso</option>
					    <option value='Bulgaria'>Bulgaria</option>
					    <option value='Bahrain'>Bahrain</option>
					    <option value='Burundi'>Burundi</option>
					    <option value='Benin'>Benin</option>
					    <option value='Saint Barthélemy'>Saint Barthélemy</option>
					    <option value='Bermuda'>Bermuda</option>
					    <option value='Brunei Darussalam'>Brunei Darussalam</option>
					    <option value='Bolivia, Plurinational State Of'>Bolivia, Plurinational State Of</option>
					    <option value='Bonaire, Saint Eustatius And Saba'>Bonaire, Saint Eustatius And Saba</option>
					    <option value='Brazil'>Brazil</option>
					    <option value='Bahamas'>Bahamas</option>
					    <option value='Bhutan'>Bhutan</option>
					    <option value='Bouvet Island'>Bouvet Island</option>
					    <option value='Botswana'>Botswana</option>
					    <option value='Belarus'>Belarus</option>
					    <option value='Belize'>Belize</option>
					    <option value='Canada'>Canada</option>
					    <option value='Cocos (Keeling) Islands'>Cocos (Keeling) Islands</option>
					    <option value='Democratic Republic Of Congo'>Democratic Republic Of Congo</option>
					    <option value='Central African Republic'>Central African Republic</option>
					    <option value='Republic Of Congo'>Republic Of Congo</option>
					    <option value='Switzerland'>Switzerland</option>
					    <option value='Cote d'Ivoire'>Cote d'Ivoire</option>
					    <option value='Cook Islands'>Cook Islands</option>
					    <option value='Chile'>Chile</option>
					    <option value='Cameroon'>Cameroon</option>
					    <option value='China'>China</option>
					    <option value='Colombia'>Colombia</option>
					    <option value='Clipperton Island'>Clipperton Island</option>
					    <option value='Costa Rica'>Costa Rica</option>
					    <option value='Cuba'>Cuba</option>
					    <option value='Cabo Verde'>Cabo Verde</option>
					    <option value='Curacao'>Curacao</option>
					    <option value='Christmas Island'>Christmas Island</option>
					    <option value='Cyprus'>Cyprus</option>
					    <option value='Czech Republic'>Czech Republic</option>
					    <option value='Germany'>Germany</option>
					    <option value='Diego Garcia'>Diego Garcia</option>
					    <option value='Djibouti'>Djibouti</option>
					    <option value='Denmark'>Denmark</option>
					    <option value='Dominica'>Dominica</option>
					    <option value='Dominican Republic'>Dominican Republic</option>
					    <option value='Algeria'>Algeria</option>
					    <option value='Ceuta, Mulilla'>Ceuta, Mulilla</option>
					    <option value='Ecuador'>Ecuador</option>
					    <option value='Estonia'>Estonia</option>
					    <option value='Egypt'>Egypt</option>
					    <option value='Western Sahara'>Western Sahara</option>
					    <option value='Eritrea'>Eritrea</option>
					    <option value='Spain'>Spain</option>
					    <option value='Ethiopia'>Ethiopia</option>
					    <option value='European Union'>European Union</option>
					    <option value='Finland'>Finland</option>
					    <option value='Fiji'>Fiji</option>
					    <option value='Falkland Islands'>Falkland Islands</option>
					    <option value='Micronesia, Federated States Of'>Micronesia, Federated States Of</option>
					    <option value='Faroe Islands'>Faroe Islands</option>
					    <option value='France'>France</option>
					    <option value='France, Metropolitan'>France, Metropolitan</option>
					    <option value='Gabon'>Gabon</option>
					    <option value='United Kingdom'>United Kingdom</option>
					    <option value='Grenada'>Grenada</option>
					    <option value='Georgia'>Georgia</option>
					    <option value='French Guiana'>French Guiana</option>
					    <option value='Guernsey'>Guernsey</option>
					    <option value='Ghana'>Ghana</option>
					    <option value='Gibraltar'>Gibraltar</option>
					    <option value='Greenland'>Greenland</option>
					    <option value='Gambia'>Gambia</option>
					    <option value='Guinea'>Guinea</option>
					    <option value='Guadeloupe'>Guadeloupe</option>
					    <option value='Equatorial Guinea'>Equatorial Guinea</option>
					    <option value='Greece'>Greece</option>
					    <option value='South Georgia And The South Sandwich Islands'>South Georgia And The South Sandwich Islands</option>
					    <option value='Guatemala'>Guatemala</option>
					    <option value='Guam'>Guam</option>
					    <option value='Guinea-bissau'>Guinea-bissau</option>
					    <option value='Guyana'>Guyana</option>
					    <option value='Hong Kong'>Hong Kong</option>
					    <option value='Heard Island And McDonald Islands'>Heard Island And McDonald Islands</option>
					    <option value='Honduras'>Honduras</option>
					    <option value='Croatia'>Croatia</option>
					    <option value='Haiti'>Haiti</option>
					    <option value='Hungary'>Hungary</option>
					    <option value='Canary Islands'>Canary Islands</option>
					    <option value='Indonesia'>Indonesia</option>
					    <option value='Ireland'>Ireland</option>
					    <option value='Israel'>Israel</option>
					    <option value='Isle Of Man'>Isle Of Man</option>
					    <option value='India'>India</option>
					    <option value='British Indian Ocean Territory'>British Indian Ocean Territory</option>
					    <option value='Iraq'>Iraq</option>
					    <option value='Iran, Islamic Republic Of'>Iran, Islamic Republic Of</option>
					    <option value='Iceland'>Iceland</option>
					    <option value='Italy'>Italy</option>
					    <option value='Jersey'>Jersey</option>
					    <option value='Jamaica'>Jamaica</option>
					    <option value='Jordan'>Jordan</option>
					    <option value='Japan'>Japan</option>
					    <option value='Kenya'>Kenya</option>
					    <option value='Kyrgyzstan'>Kyrgyzstan</option>
					    <option value='Cambodia'>Cambodia</option>
					    <option value='Kiribati'>Kiribati</option>
					    <option value='Comoros'>Comoros</option>
					    <option value='Saint Kitts And Nevis'>Saint Kitts And Nevis</option>
					    <option value='Korea, Democratic People's Republic Of'>Korea, Democratic People's Republic Of</option>
					    <option value='Korea, Republic Of'>Korea, Republic Of</option>
					    <option value='Kuwait'>Kuwait</option>
					    <option value='Cayman Islands'>Cayman Islands</option>
					    <option value='Kazakhstan'>Kazakhstan</option>
					    <option value='Lao People's Democratic Republic'>Lao People's Democratic Republic</option>
					    <option value='Lebanon'>Lebanon</option>
					    <option value='Saint Lucia'>Saint Lucia</option>
					    <option value='Liechtenstein'>Liechtenstein</option>
					    <option value='Sri Lanka'>Sri Lanka</option>
					    <option value='Liberia'>Liberia</option>
					    <option value='Lesotho'>Lesotho</option>
					    <option value='Lithuania'>Lithuania</option>
					    <option value='Luxembourg'>Luxembourg</option>
					    <option value='Latvia'>Latvia</option>
					    <option value='Libya'>Libya</option>
					    <option value='Morocco'>Morocco</option>
					    <option value='Monaco'>Monaco</option>
					    <option value='Moldova'>Moldova</option>
					    <option value='Montenegro'>Montenegro</option>
					    <option value='Saint Martin'>Saint Martin</option>
					    <option value='Madagascar'>Madagascar</option>
					    <option value='Marshall Islands'>Marshall Islands</option>
					    <option value='Macedonia, The Former Yugoslav Republic Of'>Macedonia, The Former Yugoslav Republic Of</option>
					    <option value='Mali'>Mali</option>
					    <option value='Myanmar'>Myanmar</option>
					    <option value='Mongolia'>Mongolia</option>
					    <option value='Macao'>Macao</option>
					    <option value='Northern Mariana Islands'>Northern Mariana Islands</option>
					    <option value='Martinique'>Martinique</option>
					    <option value='Mauritania'>Mauritania</option>
					    <option value='Montserrat'>Montserrat</option>
					    <option value='Malta'>Malta</option>
					    <option value='Mauritius'>Mauritius</option>
					    <option value='Maldives'>Maldives</option>
					    <option value='Malawi'>Malawi</option>
					    <option value='Mexico'>Mexico</option>
					    <option value='Malaysia'>Malaysia</option>
					    <option value='Mozambique'>Mozambique</option>
					    <option value='Namibia'>Namibia</option>
					    <option value='New Caledonia'>New Caledonia</option>
					    <option value='Niger'>Niger</option>
					    <option value='Norfolk Island'>Norfolk Island</option>
					    <option value='Nigeria'>Nigeria</option>
					    <option value='Nicaragua'>Nicaragua</option>
					    <option value='Netherlands'>Netherlands</option>
					    <option value='Norway'>Norway</option>
					    <option value='Nepal'>Nepal</option>
					    <option value='Nauru'>Nauru</option>
					    <option value='Niue'>Niue</option>
					    <option value='New Zealand'>New Zealand</option>
					    <option value='Oman'>Oman</option>
					    <option value='Panama'>Panama</option>
					    <option value='Peru'>Peru</option>
					    <option value='French Polynesia'>French Polynesia</option>
					    <option value='Papua New Guinea'>Papua New Guinea</option>
					    <option value='Philippines'>Philippines</option>
					    <option value='Pakistan'>Pakistan</option>
					    <option value='Poland'>Poland</option>
					    <option value='Saint Pierre And Miquelon'>Saint Pierre And Miquelon</option>
					    <option value='Pitcairn'>Pitcairn</option>
					    <option value='Puerto Rico'>Puerto Rico</option>
					    <option value='Palestinian Territory, Occupied'>Palestinian Territory, Occupied</option>
					    <option value='Portugal'>Portugal</option>
					    <option value='Palau'>Palau</option>
					    <option value='Paraguay'>Paraguay</option>
					    <option value='Qatar'>Qatar</option>
					    <option value='Reunion'>Reunion</option>
					    <option value='Romania'>Romania</option>
					    <option value='Serbia'>Serbia</option>
					    <option value='Russian Federation'>Russian Federation</option>
					    <option value='Rwanda'>Rwanda</option>
					    <option value='Saudi Arabia'>Saudi Arabia</option>
					    <option value='Solomon Islands'>Solomon Islands</option>
					    <option value='Seychelles'>Seychelles</option>
					    <option value='Sudan'>Sudan</option>
					    <option value='Sweden'>Sweden</option>
					    <option value='Singapore'>Singapore</option>
					    <option value='Saint Helena, Ascension And Tristan Da Cunha'>Saint Helena, Ascension And Tristan Da Cunha</option>
					    <option value='Slovenia'>Slovenia</option>
					    <option value='Svalbard And Jan Mayen'>Svalbard And Jan Mayen</option>
					    <option value='Slovakia'>Slovakia</option>
					    <option value='Sierra Leone'>Sierra Leone</option>
					    <option value='San Marino'>San Marino</option>
					    <option value='Senegal'>Senegal</option>
					    <option value='Somalia'>Somalia</option>
					    <option value='Suriname'>Suriname</option>
					    <option value='South Sudan'>South Sudan</option>
					    <option value='São Tomé and Príncipe'>São Tomé and Príncipe</option>
					    <option value='USSR'>USSR</option>
					    <option value='El Salvador'>El Salvador</option>
					    <option value='Sint Maarten'>Sint Maarten</option>
					    <option value='Syrian Arab Republic'>Syrian Arab Republic</option>
					    <option value='Swaziland'>Swaziland</option>
					    <option value='Tristan de Cunha'>Tristan de Cunha</option>
					    <option value='Turks And Caicos Islands'>Turks And Caicos Islands</option>
					    <option value='Chad'>Chad</option>
					    <option value='French Southern Territories'>French Southern Territories</option>
					    <option value='Togo'>Togo</option>
					    <option value='Thailand'>Thailand</option>
					    <option value='Tajikistan'>Tajikistan</option>
					    <option value='Tokelau'>Tokelau</option>
					    <option value='Timor-Leste, Democratic Republic of'>Timor-Leste, Democratic Republic of</option>
					    <option value='Turkmenistan'>Turkmenistan</option>
					    <option value='Tunisia'>Tunisia</option>
					    <option value='Tonga'>Tonga</option>
					    <option value='Turkey'>Turkey</option>
					    <option value='Trinidad And Tobago'>Trinidad And Tobago</option>
					    <option value='Tuvalu'>Tuvalu</option>
					    <option value='Taiwan'>Taiwan</option>
					    <option value='Tanzania, United Republic Of'>Tanzania, United Republic Of</option>
					    <option value='Ukraine'>Ukraine</option>
					    <option value='Uganda'>Uganda</option>
					    <option value='United Kingdom'>United Kingdom</option>
					    <option value='United States Minor Outlying Islands'>United States Minor Outlying Islands</option>
					    <option value='United States'>United States</option>
					    <option value='Uruguay'>Uruguay</option>
					    <option value='Uzbekistan'>Uzbekistan</option>
					    <option value='Vatican City State'>Vatican City State</option>
					    <option value='Saint Vincent And The Grenadines'>Saint Vincent And The Grenadines</option>
					    <option value='Venezuela, Bolivarian Republic Of'>Venezuela, Bolivarian Republic Of</option>
					    <option value='Virgin Islands (British)'>Virgin Islands (British)</option>
					    <option value='Virgin Islands (US)'>Virgin Islands (US)</option>
					    <option value='Viet Nam'>Viet Nam</option>
					    <option value='Vanuatu'>Vanuatu</option>
					    <option value='Wallis And Futuna'>Wallis And Futuna</option>
					    <option value='Samoa'>Samoa</option>
					    <option value='Yemen'>Yemen</option>
					    <option value='Mayotte'>Mayotte</option>
					    <option value='South Africa'>South Africa</option>
					    <option value='Zambia'>Zambia</option>
					    <option value='Zimbabwe'>Zimbabwe</option>    
					</select>
    			</div>
    			<div class="col-md-4">
    				<label for="status">Status:</label>
    				
    					<div id="status"></div>
    				
    			</div>
    		</div>
    	</div>
	</div>
	<div class="text-center">
		<button type="submit" class="btn btn-xs btn-success">Send</button>
	</div>
	
</form>
@stop
@section('js')
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
    $("#country").on('change',function(){
    	var value = this.value;
		var data = '<select name="status" class="form-control"><option value="Your '+value+'Visa and E_Ticket is Ready for Collection">Your '+value+' Visa and E_Ticket is Ready for Collection</option><option value="Your '+value+' Visa application has been submitted successfully today">Your '+value+' Visa application has been submitted successfully today</option><option value="Your '+value+' Business Visa application has been submitted successfully today">Your '+value+' Business Visa application has been submitted successfully today</option><option value="Your '+value+' Visa is Ready for Collection">Your '+value+' Visa is Ready for Collection</option><option value="Your '+value+' Visa is Ready for Collection">Your '+value+' Visa is Ready for Collection</option><option value="Your '+value+' Visa is Ready for Collection">Your '+value+' Visa is Ready for Collection</option><option value="Your '+value+' Visa and E_Ticket is Ready for Collection">Your '+value+' Visa and E_Ticket is Ready for Collection</option></select>';
    	// console.log(data);
		$("#status").html(data); 
	});
	$("#unique").on('click',function(){
		document.getElementById('clientId').value = this.value;
	});
});
	</script>
@stop