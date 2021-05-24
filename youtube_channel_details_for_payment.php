<?php
session_start();
ob_start();

include 'dbconfig.php';

$prd_name = "Plan Platinum";
$price = 100;
$instamojopercent = 3; /* 3 percent of price */
$instamojoamount = 3;  /* 3 rupees of price */
$gsttax = 18; /* 18 percent of totalprice */

/* price calculation with tax and fee */

$instamojofeepercent = ($price / 100) * $instamojopercent;
$instamojofeerupees = $instamojofeepercent + $instamojoamount;
$tax = ($instamojofeerupees / 100) * $gsttax;
$finalprice = $price + $instamojofeerupees + $tax;


	
?>

	<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		

		<!-- Your css file -->
		<link rel="stylesheet" type="text/css" href="assets/css/jquery.countdownTimer.css" />
			
		</head>
		<body>	
		 <!-- Your header -->
			  
			<!-- start banner Area -->
			<section class="about-banner">
				<div class="container">				
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h3 class="text-white">
								Access unlimited data	
							</h3>
						</div>	
					</div>
				</div>
			</section>
			<!-- End banner Area -->	
			
			<!-- Start Align Area -->
			<div class="whole-wrap">
				<div class="container">
					<div class="section-top-border">
						
						<div class="row">
							<div class="col-md-4">
								<div class="single-defination">
									<form name="customerloginform" id="customerloginform" action="phpfiles/thousandsubscriberpay.php" method="POST" accept-charset="utf-8">
									  <div class="alert alert-primary" id="responsemessage1" style="display:none;"><i class="ti-user"></i>
										 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
									  </div>
									  <div class="alert alert-danger" id="errormessage1" style="display:none;"><i class="ti-user"></i>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color: Red !important;font-weight:600 !important;"><span aria-hidden="true">×</span></button>
									  </div>
									  <div class="form-group">
										<label for="exampleInputEmail1">Customer Name</label>
										<input type="text" class="form-control" id="fullname" name="fullname" placeholder="Your full name" value="<?php echo $customername; ?>" readonly="readonly">
									  </div>
									  <div class="form-group">
										<label for="exampleInputPassword1">Customer Email</label>
										<input type="text" class="form-control" id="fullemail" name="fullemail" placeholder="Your full email" value="<?php echo $customeremail; ?>" readonly="readonly">
									  </div>
									  <input type="hidden" id="product_name" name="product_name" value="<?php echo $prd_name; ?>"> 
									  <input type="hidden" id="product_price" name="product_price" value="<?php echo round($price, 2); ?>"> 
									  <input type="hidden" id="fullmobile" name="fullmobile" value="<?php echo $customermobile; ?>" />
									  <button type="button" class="btn btn-success" id="buttonid" name="buttonid"> Pay Indian Rupees: <?php echo round($finalprice, 2); ?>/- Only</button>
									
									</form>
								</div>
							</div>
							
							
						</div>
					</div>
				</div>
			</div>
			<!-- End Align Area -->

			<!-- Start home-about Area -->
			<!-- Start home-about Area -->
			
			
			
			<!-- End home-about Area -->
			<!-- End home-about Area -->
		
		   

		    

            <?php include 'footer.php'; ?>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.js"></script>
			
			<script>
			 $(function() {
				$("#buttonid").click( function()
				   {
					 $('#customerloginform')[0].submit();
				   }
				);
			});
			</script>
			
			<script>
	 
	 $(document).keydown(function (event) {
    if (event.keyCode == 123) { // Prevent F12
        return false;
    } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I        
        return false;
    }
});

	 </script>
	 
	 <script type="text/javascript">
if (document.layers) {
        //Capture the MouseDown event.
    document.captureEvents(Event.MOUSEDOWN);
 
    //Disable the OnMouseDown event handler.
    $(document).mousedown(function () {
        return false;
    });
}
else {
    //Disable the OnMouseUp event handler.
    $(document).mouseup(function (e) {
        if (e != null && e.type == "mouseup") {
            //Check the Mouse Button which is clicked.
            if (e.which == 2 || e.which == 3) {
                //If the Button is middle or right then disable.
                return false;
            }
        }
    });
}
 
//Disable the Context Menu event.
$(document).contextmenu(function () {
    return false;
});
</script>



		</body>
	</html>