
<?php
/* Template Name: verify*/
					
						// دریافت پارامترها از POST  
						$MID = isset($_POST['MID']) ? htmlspecialchars($_POST['MID']) : null;  
						$shaparakTerminalId = isset($_POST['shaparakTerminalId']) ? htmlspecialchars($_POST['shaparakTerminalId']) : null;  
						$CustomerRefNum = isset($_POST['CustomerRefNum']) ? htmlspecialchars($_POST['CustomerRefNum']) : null;  
						$mobileNo = isset($_POST['mobileNo']) ? htmlspecialchars($_POST['mobileNo']) : null;  
						$State = isset($_POST['State']) ? htmlspecialchars($_POST['State']) : null;  
						$RefNum = isset($_POST['RefNum']) ? htmlspecialchars($_POST['RefNum']) : null; // استفاده صحیح از RefNum  
						$token = isset($_POST['token']) ? htmlspecialchars($_POST['token']) : null; // توجه به حروف کوچک در نام token  

						// تابع برای تأیید تراکنش  
						function verifyMerchantTrans($RefNum, $token) {  
							$UserId = "شناسه کاربری";  // شناسه کاربری  
							$Password = "رمز عبور";  // رمز عبور  

							$json_ver_data = json_encode([  
								"WSContext" => [  
									"UserId" => $UserId,  
									"Password" => $Password  
								],  
								"Token" => $token,  
								"RefNum" => $RefNum  
							]);  

							$curl = curl_init('https://fcp.shaparak.ir/ref-payment/RestServices/mts/verifyMerchantTrans/');  
							curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  
							curl_setopt($curl, CURLOPT_POST, true);  
							curl_setopt($curl, CURLOPT_POSTFIELDS, $json_ver_data);  
							curl_setopt($curl, CURLOPT_HTTPHEADER, [  
								'Content-Type: application/json',  
								'Content-Length: ' . strlen($json_ver_data)  
							]);  

							$response = curl_exec($curl);  
							if ($response === false) {  
								echo 'cURL Error: ' . curl_error($curl);  
							} else {  
								echo '<pre>Response: ' . htmlspecialchars($response) . '</pre>';  
								$data = json_decode($response);  
								//print_r($data); // برای مشاهده پاسخ دریافتی  
							}  

							curl_close($curl);  
						}  
					?>  

				<div style="background-color:#c4faf8; padding:20px; margin:80px; text-align:center; border:1px solid gray;border-radius:5px; box-shadow: 10px 10px 5px gray; text-margin:3px">  
					<?php  
								// بررسی وجود پارامترها  
								if ($RefNum && $token) {   
									echo '<b style="color:green">پرداخت شما با موفقیت انجام شد </b><br><br>';  
									echo ' شماره پذیرنده : ' . $MID . '<br>';  
									echo ' کد درگاه پرداخت : ' . $shaparakTerminalId . '<br>';  
									echo ' شماره مرجع تراکنش : ' . $RefNum . '<br>';  
									echo ' شماره همراه : ' . $mobileNo . '<br>';  
									echo ' وضعیت انجام تراکنش : ' . $State . '<br>';  

									// فراخوانی تابع تأیید  
									verifyMerchantTrans($RefNum, $token);  
								} else {  
									echo '<b style="color:red">تراکنش ناموفق یا پارامترهای ورودی نادرست است.</b>';  
								}  
					?>  
				</div>  

				<div>   
					<div style="text-align: center; padding-top:15px;">  
						<button style="border-radius: 7px; background-color: #7fff00; color: black; cursor: pointer; width: 150px;">  
							<a href="آدرس وب سایت شما" style="text-decoration: none; color: black;">بازگشت</a>  
						</button>  
					</div>  
				</div>  


