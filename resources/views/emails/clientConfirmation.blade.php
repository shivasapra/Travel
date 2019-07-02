{{-- <p>Hi,</p>

<p>
	We need your permission to keep your passport details to inform you in future when your passport is going to expire.
	If you are happy to proceed please give your consent by <a href="{{ route('confirm', $token) }}" class="btn btn-success ">clicking here.</a>
</p>
<p>
	If no, then <a href="{{route('deleteClientPassportData', $token)}}" class="btn btn-warning">click here</a> and we will remove your passport details.
</p> --}}

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<title>Mailto</title>
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
<style type="text/css">
html { -webkit-text-size-adjust: none; -ms-text-size-adjust: none;}

	@media only screen and (min-device-width: 750px) {
		.table750 {width: 750px !important;}
	}
	@media only screen and (max-device-width: 750px), only screen and (max-width: 750px){
      table[class="table750"] {width: 100% !important;}
      .mob_b {width: 93% !important; max-width: 93% !important; min-width: 93% !important;}
      .mob_b1 {width: 100% !important; max-width: 100% !important; min-width: 100% !important;}
      .mob_left {text-align: left !important;}
      .mob_soc {width: 50% !important; max-width: 50% !important; min-width: 50% !important;}
      .mob_menu {width: 50% !important; max-width: 50% !important; min-width: 50% !important; box-shadow: inset -1px -1px 0 0 rgba(255, 255, 255, 0.2); }
      .mob_center {text-align: center !important;}
      .top_pad {height: 15px !important; max-height: 15px !important; min-height: 15px !important;}
      .mob_pad {width: 15px !important; max-width: 15px !important; min-width: 15px !important;}
      .mob_div {display: block !important;}
 	}
   @media only screen and (max-device-width: 550px), only screen and (max-width: 550px){
      .mod_div {display: block !important;}
   }
	.table750 {width: 750px;}
</style>
</head>
<body style="margin: 0; padding: 0;">

<table cellpadding="0" cellspacing="0" border="0" width="100%" style="background: #f3f3f3; min-width: 350px; font-size: 1px; line-height: normal;">
 	<tr>
   	<td align="center" valign="top">   			
   		<!--[if (gte mso 9)|(IE)]>
         <table border="0" cellspacing="0" cellpadding="0">
         <tr><td align="center" valign="top" width="750"><![endif]-->
   		<table cellpadding="0" cellspacing="0" border="0" width="750" class="table750" style="width: 100%; max-width: 750px; min-width: 350px; background: #f3f3f3;">
   			<tr>
               <td class="mob_pad" width="25" style="width: 25px; max-width: 25px; min-width: 25px;">&nbsp;</td>
   				<td align="center" valign="top" style="background: #ffffff;">

                  <table cellpadding="0" cellspacing="0" border="0" width="100%" style="width: 100% !important; min-width: 100%; max-width: 100%; background: #f3f3f3;">
                     <tr>
                        <td align="right" valign="top">
                           <div class="top_pad" style="height: 25px; line-height: 25px; font-size: 23px;">&nbsp;</div>
                        </td>
                     </tr>
                  </table>

                  <table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 88% !important; min-width: 88%; max-width: 88%;">
                     <tr>
                        <td align="left" valign="top">
                           <div style="height: 39px; line-height: 39px; font-size: 37px;">&nbsp;</div>
                           <a href="#" target="_blank" style="display: block;">
                              <img src="http://buildatwill.com/cloud/public/images/logo.png" alt="img" width="250" border="0" style="display: block;"/>
                           </a>
                           <div style="height: 40px; line-height: 40px; font-size: 71px;">&nbsp;</div>
                        </td>
                     </tr>
                  </table>

                  <table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 88% !important; min-width: 88%; max-width: 88%;">
                     <tr>
                        <td align="left" valign="top">
                           <font face="'Source Sans Pro', sans-serif" color="#1a1a1a" style="font-size: 52px; line-height: 60px; font-weight: 300; letter-spacing: -1.5px;">
                              <span style="font-family: 'Source Sans Pro', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 40px; line-height: 50px; font-weight: 300; letter-spacing: -1.5px;">Hi <b>{{$name}}</b>,</span><hr>
                           </font>
                           <!-- <font>
                              <span style="font-family: 'Source Sans Pro', Arial, Tahoma, Geneva, sans-serif; color: #26ace2;font-weight:700; font-size: 50px;text-transform:uppercase;">Thank you!</span><br>
                              <span style="color:#333;font-size:23px;font-family: 'Source Sans Pro', Arial, Tahoma, Geneva, sans-serif;font-weight:600;">for Sign Up</span>
                           </font> -->
                           <p style="font-family: 'Source Sans Pro', Arial, Tahoma, Geneva, sans-serif; font-size:16px;"><b>Your Passport Details:</b><br>
                           <b>Name:</b> {{$client->first_name.' '.$client->last_name}}
                           <b>Passport No:</b>{{$client->passport_no}}
                           <b>Place Of Issue:</b>{{$client->passport_place}}
                           <b>Date Of Issue:</b>{{$client->passport_issue_date}}
                           <b>Expiry Date:</b>{{$client->passport_expiry_date}}
                           <b>Expiry Date:</b>{{$client->passport_expiry_date}}
                           <b>Passport Front:</b>
                           
                           <div class="image-div">
                              <img src="{{asset($client->passport_front)}}" alt="passport front" height="200px" width="200px" style="border-radius:10px">
                              <a href="{{asset($client->passport_front)}}" download class="download-image-icon"><i class="fa fa-download" aria-hidden="true"></i></a>
                              </div>0
                           <b>Passport Back:</b><div class="image-div">
                              <img src="{{asset($client->passport_back)}}" alt="passport back" height="200px" width="200px" style="border-radius:10px">
                              <a href="{{asset($client->passport_back)}}" download class="download-image-icon"><i class="fa fa-download" aria-hidden="true"></i></a>
                              </div>
                           </p>
                           <hr>
                           <div style="height: 33px; line-height: 33px; font-size: 31px;">&nbsp;</div>
                           <font face="'Source Sans Pro', sans-serif" color="#585858" style="font-size: 20px; line-height: 21px;">
                              <span style="font-family: 'Source Sans Pro', Arial, Tahoma, Geneva, sans-serif; color: #585858; font-size: 20px; line-height: 28px;">We need your permission to keep your passport details to inform you in future when your passport is going to expire. If you are happy to proceed please give your consent by clicking below button.<br><a href="{{ route('confirm', $token) }}" style="color: #fff;background-color: green;text-decoration: none;padding: 10px 20px;
    border-radius: 4px;display: inline-block;margin-top:10px;">Confirm</a><br><br><br>
                              If no, then <a href="{{route('deleteClientPassportData', $token)}}">Click Here</a> and we will remove your passport details.</span>
                           </font>
                           <table style="margin-top:40px;">
                              <tr>
                                 <td> 
                                    <span style="font-family: 'Source Sans Pro', Arial, Verdana, Tahoma, Geneva, sans-serif; color: #333; font-size: 18px; line-height: 25px;">Thanks<br><b>Team Cloud Travel</b></span>
                                 </td>
                              </tr>
                           </table>
                           <div style="height: 75px; line-height: 75px; font-size: 73px;">&nbsp;</div>
                        </td>
                     </tr>
                  </table>

                  <table cellpadding="0" cellspacing="0" border="0" width="100%" style="width: 100% !important; min-width: 100%; max-width: 100%; background: #f3f3f3;">
                     <tr>
                        <td align="center" valign="top">
                           <div style="height: 34px; line-height: 34px; font-size: 32px;">&nbsp;</div>
                           <table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 88% !important; min-width: 88%; max-width: 88%;">
                              <tr>
                                 <td align="center" valign="top">
                                    <font face="'Source Sans Pro', sans-serif" color="#868686" style="font-size: 17px; line-height: 20px;">
                                       <span style="font-family: 'Source Sans Pro', Arial, Tahoma, Geneva, sans-serif; color: #868686; font-size: 17px; line-height: 20px;">Copyright &copy; 2017-2018 Cloud Travel. All&nbsp;Rights&nbsp;Reserved.</span>
                                    </font>
                                    <div style="height: 3px; line-height: 3px; font-size: 1px;">&nbsp;</div>
                                    <font face="'Source Sans Pro', sans-serif" color="#1a1a1a" style="font-size: 17px; line-height: 20px;">
                                       <span style="font-family: 'Source Sans Pro', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 17px; line-height: 20px;"><a href="mailto:info@cloudtravels.co.uk" target="_blank" style="font-family: 'Source Sans Pro', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 17px; line-height: 20px; text-decoration: none;">info@cloudtravels.co.uk</a> &nbsp;&nbsp;|&nbsp;&nbsp; <a href="tel:02035000000" target="_blank" style="font-family: 'Source Sans Pro', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 17px; line-height: 20px; text-decoration: none;">0203 500 0000</a>
                                    </font>
                                    <div style="height: 35px; line-height: 35px; font-size: 33px;">&nbsp;</div>
                                    <table cellpadding="0" cellspacing="0" border="0">
                                       <tr>
                                          <td align="center" valign="top">
                                             <a href="#" target="_blank" style="display: block; max-width: 19px;">
                                                <img src="{{asset('/images/soc_1.png')}}" alt="img" width="19" border="0" style="display: block; width: 19px;" />
                                             </a>
                                          </td>
                                          <td width="45" style="width: 45px; max-width: 45px; min-width: 45px;">&nbsp;</td>
                                          <td align="center" valign="top">
                                             <a href="#" target="_blank" style="display: block; max-width: 18px;">
                                                <img src="{{asset('/images/soc_2.png')}}" alt="img" width="18" border="0" style="display: block; width: 18px;" />
                                             </a>
                                          </td>
                                          <td width="45" style="width: 45px; max-width: 45px; min-width: 45px;">&nbsp;</td>
                                          <td align="center" valign="top">
                                             <a href="#" target="_blank" style="display: block; max-width: 21px;">
                                                <img src="{{asset('/images/soc_3.png')}}" alt="img" width="21" border="0" style="display: block; width: 21px;" />
                                             </a>
                                          </td>
                                          <td width="45" style="width: 45px; max-width: 45px; min-width: 45px;">&nbsp;</td>
                                          <td align="center" valign="top">
                                             <a href="#" target="_blank" style="display: block; max-width: 25px;">
                                                <img src="{{asset('/images/soc_4.png')}}" alt="img" width="25" border="0" style="display: block; width: 25px;" />
                                             </a>
                                          </td>
                                       </tr>
                                    </table>
                                    <div style="height: 35px; line-height: 35px; font-size: 33px;">&nbsp;</div>
                                 </td>
                              </tr>
                           </table>
                        </td>
                     </tr>
                  </table>  

               </td>
               <td class="mob_pad" width="25" style="width: 25px; max-width: 25px; min-width: 25px;">&nbsp;</td>
            </tr>
         </table>
         <!--[if (gte mso 9)|(IE)]>
         </td></tr>
         </table><![endif]-->
      </td>
   </tr>
</table>
</body>
</html>
