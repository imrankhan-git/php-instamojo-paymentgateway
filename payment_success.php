<?php
session_start();
ob_start();

include 'dbconfig.php';

include 'src/instamojo.php';

/*$api = new Instamojo\Instamojo('your key', 'your token','https://test.instamojo.com/api/1.1/');*/

$api = new Instamojo\Instamojo('your key', 'your token','https://www.instamojo.com/api/1.1/');

$payid = $_GET["payment_request_id"];

try {
	$response = $api->paymentRequestStatus($payid);
	
	$paymentid = $response['payments'][0]['payment_id'];
	$paymentname = $response['payments'][0]['buyer_name'];
	$paymentemail =  $response['payments'][0]['buyer_email'];
	
	$accountverifyres=$conn->query("SELECT * FROM table_customers where status = 1 and customer_email = '$paymentemail' order by id asc");
		
	$accountverifyrow = $accountverifyres->fetch_assoc();
	$accountverifynum_rows = $accountverifyres->num_rows;
	if ($accountverifynum_rows > 0)
	{
		$customerid = $accountverifyrow['id'];
		$customername = $accountverifyrow['customer_first_name'];
		$customeremail = $accountverifyrow['customer_email'];
		$customerchannelname = $accountverifyrow['customer_channel_name'];
		$customerchannelid = $accountverifyrow['customer_channel_id'];
	}
	else
	{
		$customerid = "";
		$customeremail = "Not Found";
	}
	
	 $todaydate = date("d/m/Y");

     $expirydate = date('d/m/Y', strtotime('+1 years'));
	
	 $sqls = "UPDATE table_customers SET customer_payment_status = 1,payment_gateway_reference_number='$paymentid' WHERE customer_email = '$paymentemail' and id='$customerid'";

	 if ($conn->query($sqls) === TRUE)
	 {
		$paymentsuccessid = 1;
		$sessionvalue = 2;
		
		$customerlogintext = $paymentname;
		$customersignuptext = "Logout";
		
		$customerloginemail = $paymentemail;
		$customersignupemail = "";
		
		$customersignupurl = "logout.php";
		
		
		
 
		//Redirect using the Location header.
		header('Location: index.php');
		
		
		
	 } 
	 else {
		$paymentsuccessid = 2;
		
	 }
}
catch (Exception $e) {
	$paymentsuccessid = 2;
	$errormessage = $e->getMessage();
	//print('Error: ' . $e->getMessage());
	
}
	
?>

	<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		

		<?php include 'csslinks.php'; ?>
		<link rel="stylesheet" type="text/css" href="assets/css/jquery.countdownTimer.css" />
			
		</head>
		<body>	
		 <?php include 'header.php' ?>
			  
			<!-- start banner Area -->
			
			<!-- End banner Area -->	

			<!-- Start home-about Area -->
			<!-- Start home-about Area -->
			<!-- Start home-about Area -->
			<section class="home-about-area section-gap">
				<div class="container">
					<div class="row align-items-center justify-content-between">
						<div class="col-lg-6 col-md-6 home-about-left">
						<?php 
				if($paymentsuccessid == 1)
				{
				?>
				<div class="widget">
					<h3 class="widget-title">Payment Details</h3>
					<div class="table-responsive">
					  <table class="table">
						<thead>
						<tr>
						  <th scope="col">Payment Status</th>
						  <th scope="col">Success</th>
						</tr>
					  </thead>
					  <tbody>
						<tr>
						  <th scope="row">Payment ID</th>
						  <td><?php echo $paymentid; ?></td>
						</tr>
						<tr>
						  <th scope="row">Name</th>
						  <td><?php echo $paymentname; ?></td>
						</tr>
						<tr>
						  <th scope="row">Email</th>
						  <td><?php echo $paymentemail; ?></td>
						</tr>
					  </tbody>
					  </table>
					</div>
				</div>
				<?php
				}
				else
				{
				?>
				<div class="widget">
					<h3 class="widget-title">Payment Details</h3>
					<div class="table-responsive">
					  <table class="table">
						<thead>
						<tr>
						  <th scope="col">Payment Status</th>
						  <th scope="col" style="color:red !important;">Failure</th>
						</tr>
					   </thead>
					  <tbody>
						<tr>
						  <th scope="row" colspan="2" style="text-align:center !important;color:red !important;">Please Contact Administrator</th>
						</tr>
					  </tbody>
					  </table>
					</div>
				</div>
				<?php
				}
				?>
						</div>
					</div>
				</div>	
			</section>
			<!-- End home-about Area -->
			
			
		  	

		    

            <?php include 'footer.php'; ?>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.js"></script>
			
			<script>

var paymentsuccessid = '<?php echo $paymentsuccessid; ?>';
if(paymentsuccessid == 1)
{
	//redirect to your main page which u want to show after payment is success
}


</script>

		</body>
	</html>