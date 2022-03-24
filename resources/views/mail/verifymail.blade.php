<?php 
	$name = $data['name'];
	$verifyNo = $data['verifyNo'];
	$verifyNos = str_split($data['verifyNo']);
	$number1 = $verifyNos[0];
	$number2 = $verifyNos[1];
	$number3 = $verifyNos[2];
	$number4 = $verifyNos[3];
	$number5 = $verifyNos[4];
	$number6 = $verifyNos[5];


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<style type="text/css">
		@media only screen and (max-width:480px) {
		    @-ms-viewport { width:320px; }
		    @viewport { width:320px; }
		}

		body { 
			margin: 0; 
			padding: 0; 
			-webkit-text-size-adjust: 100%; 
			-ms-text-size-adjust: 100%; 
		}

		@media only screen and (min-width:480px) {
		    .mj-column-per-100, * [aria-labelledby="mj-column-per-100"] { width:100%!important; }
		}

		#outlook a { 
			padding: 0; 
		}

		.ReadMsgBody { 
			width: 100%; 
		}

		.ExternalClass { 
			width: 100%; 
		}

		.ExternalClass * { 
			line-height:100%; 
		}
		table, td { 
			border-collapse:collapse; 
			mso-table-lspace: 0pt; 
			mso-table-rspace: 0pt; 
		}
		img { 
		  	border: 0; 
		  	height: auto; 
		  	line-height: 100%; 
		  	outline: none; 
		  	text-decoration: none; 
		  	-ms-interpolation-mode: bicubic; 
		}
		p { 
			display: block; 
			margin: 13px 0; 
		}

	</style>
</head>
<body style="background: #F9F9F9;">
  	<div style="background-color:#F9F9F9;">
  		<div style="max-width:640px;margin:0 auto;box-shadow:0px 1px 5px rgba(0,0,0,0.1);border-radius:4px;overflow:hidden">
  			<div style="margin:0px auto;max-width:640px;background:#042954 top center / cover no-repeat;">

  				<table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%; height: 300px; background:#042954 url({{$message->embed(public_path('assets/img/mail_thankyou.jpg'))}}) top center / cover no-repeat;" align="center" border="0">
  					<tbody>
  						<tr>
  							<td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:57px;">
  								<div style="cursor:auto;color:black;font-family:Whitney, Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif;font-size:36px;font-weight:600;line-height:36px;text-align:center;">
  								</div>
  							</td>
  						</tr>
  					</tbody>
  				</table>
  			</div>

  			<div style="margin:0px auto;max-width:640px;background:#ffffff;">
  				<table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;background:#ffffff;" align="center" border="0">
  					<tbody>
  						<tr>
  							<td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:40px 70px;">
  								<div aria-labelledby="mj-column-per-100" class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;">
  									<table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  										<tbody>
  											<tr>
  												<td style="word-break:break-word;font-size:0px;padding:0px 0px 20px;" align="left">
  													<div style="cursor:auto;color:#737F8D;font-family:Whitney, Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif;font-size:16px;line-height:24px;text-align:left;">
            											

  														<h2 style="font-family: Whitney, Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif;font-weight: 500;font-size: 20px;color: #4F545C;letter-spacing: 0.27px;">Hey {{ $name }},</h2>
														
														<p>Thank you for joining SMART CAMP!</p>
														<p> To complete your sign up process, use the code below to verify your email: </p>

          											</div>
          										</td>
          									</tr>

          									<tr>
          										<td style="word-break:break-word;font-size:0px;padding:10px 25px;" align="center">
          											
          											<h1 style="font-size: 50px;font-weight: 300; letter-spacing: 30px"> {{ $verifyNo }} </h1> 

          											<p>
														Please note that this code will only be valid for 1 hour.
													</p>
          										</td>
          									</tr>

          									<tr>
          										<td style="word-break:break-word;font-size:0px;padding:0px 0px 20px;" align="left">
  													<div style="cursor:auto;color:#737F8D;font-family:Whitney, Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif;font-size:16px;line-height:24px;text-align:left;">
  																												
														<p> If you have any problem, please contact us: support@smartcamp007.com </p>

          											</div>
          										</td>
          									</tr>

          									<tr>
          										<td style="word-break:break-word;font-size:0px;padding:0px 0px 20px;" align="left">
  													<div style="cursor:auto;color:#737F8D;font-family:Whitney, Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif;font-size:16px;line-height:24px;text-align:left;">
            																									
														<p> Regards, </p>
														<p> SMART CAMP </p>


          											</div>
          										</td>
          									</tr>

          								</tbody>
          							</table>
          						</div>
          					</td>
          				</tr>
          			</tbody>
          		</table>
          	</div>

          	<div style="margin:0px auto;max-width:640px;background:transparent;">
          		<table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;background:transparent;" align="center" border="0">
          			<tbody>
          				<tr>
          					<td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:20px 0px;">
          						<div aria-labelledby="mj-column-per-100" class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;">
          							<table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          								<tbody>
          									<tr>
          										<td style="word-break:break-word;font-size:0px;padding:0px;" align="center">
          											<div style="cursor:auto;color:#99AAB5;font-family:Whitney, Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif;font-size:12px;line-height:24px;text-align:center;">
      													Sent by SMART CAMP
    												</div>
    											</td>
    										</tr>
    									</tbody>
    								</table>
    							</div>
    						</td>
    					</tr>
    				</tbody>
    			</table>
    		</div>

  		</div>
  	</div>

</body>
</html>