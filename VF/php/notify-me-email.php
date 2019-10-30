<?php

	header('content-type: application/json');

	$o = new stdClass();
	$o->status = 'success';
	echo json_encode($o);

	$email_to = "myemail@email.com"; // Write your email here to receive the email addresses submitted
    $subject = 'New subscriber from SAPHIR'; // Write the subject you'll see in your inbox

	$email = $_POST["email"];

	$text = "
	<head>
        <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1'>
    </head>

	<body style='font-family:Verdana;background:#f2f2f2;color:#606060;'>

		<style>
			h2 {
				color: #6534ff;
			}
			a {
				color: #FFFFFF;
				text-decoration: none;
			}
			p {
				line-height:1.5;
	            font-size: 14px;
			}
		</style>

		<table cellpadding='0' width='100%' cellspacing='0' border='0'>
			<tr>
				<td>
					<table cellpadding='0' cellspacing='0' border='0' align='center' width='100%' style='border-collapse:collapse;'>
						<tr>
							<td>

								<div>
									<table cellpadding='0' cellspacing='0' border='0' align='center'  style='width: 100%;max-width:600px;background:#FFFFFF;margin:0 auto;border-radius:5px;padding:50px 30px'>
										<tr>
											<td width='100%' colspan='3' align='center' style='padding-bottom:10px;'>
												<div>
													<h2 >Woohoo! 1 new subscriber</h2>
												</div>
											</td>
										</tr>
										<tr>
											<td width='100'>&nbsp;</td>
											<td width='400' align='center' style='padding-bottom:5px;'>
												<div>
													<p >One of your visitors has just subscribed to your Newsletter, here is their email address :</p>
												</div>
											</td>
											<td width='100'>&nbsp;</td>
										</tr>
										<tr>
											<td width='100'>&nbsp;</td>
											<td align='center' style='padding-top:25px;'>
												<table cellpadding='0' cellspacing='0' border='0' align='center' width='200' height='50'>
													<tr>
														<td bgcolor='#6534ff' align='center' style='border-radius:4px;padding:0 25px;color:#FFFFFF' height='50' width='auto'>
															<div>
																$email
															</div>

														</td>
													</tr>
												</table>
											</td>
											<td width='100'>&nbsp;</td>
										</tr>
									</table>
								</div>

								<div style='margin-top:30px;text-align:center;color:#b3b3b3'>
	                                <p style='font-size:12px;'>2018-2XXX ThemeHelite®, All Rights Reserved.</p>
	                            </div>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>";

	$headers = "MIME-Version: 1.0" . "\r\n"; 
	$headers .= "Content-type:text/html; charset=utf-8" . "\r\n";
    $headers .= 'From: SAPHIR Template <noreply@yourdomain.com>' . "\r\n"; // As an example, the 'From' address should be set to something like 'noreply@yourdomain.com' in order to be based on the same domain as the form.

	mail($email_to, $subject, $text, $headers);

?>
