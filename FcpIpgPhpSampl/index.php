<!DOCTYPE html>  
<html lang="fa">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>فرم پرداخت</title>  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">  
</head>  
<body>    
	<div class="container">
		<div id="form-title" style="text-align:center; padding:20px; margin:30px; border:1px solid gray;border-radius:5px; box-shadow: 10px 10px 5px gray; text-margin:3px" >
			<span><h3 style="color:#000080">فرم پرداخت</h3></span>
		</div>					
			
		<div id="form-section" style="padding:20px; margin:30px; text-align:right; border:1px solid gray;border-radius:5px; box-shadow: 10px 10px 5px gray; text-margin:3px" >
					
			<div class="container mt-5">   
				<form id="paymentForm" action="./payment.php" method="POST">   
					<div class="form-group">  
						<label for="Amount">مبلغ</label>  
						<input type="number" class="form-control" id="Amount" name="Amount"  required>  
					</div> 
					<div class="form-group">  
						<label for="MobileNo">شماره همراه</label>  
						<input type="text" class="form-control" id="MobileNo" name="MobileNo"  required>  
					</div>  
					<div class="form-group">  
						<label for="Email">آدرس الکترونیکی</label>  
						<input type="email" class="form-control" id="Email" name="Email"  required>  
					</div>  
					<button type="submit" class="btn btn-primary">پرداخت</button>  
				</form>  
			</div>  		
		</div>
	</div>

</body>  
</html>