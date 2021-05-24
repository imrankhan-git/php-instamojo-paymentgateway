<?php 
$product_name = $_POST["product_name"];
$price = $_POST["product_price"];
$name = $_POST["fullname"];
$phone = $_POST["fullmobile"];
$email = $_POST["fullemail"];
	
include '../src/instamojo.php';
	
/*$api = new Instamojo\Instamojo('your key', 'your token','https://test.instamojo.com/api/1.1/');*/
	 
$api = new Instamojo\Instamojo('your key', 'your token','https://www.instamojo.com/api/1.1/');
	 
 try 
 {
	$response = $api->paymentRequestCreate(array(
		"purpose" => $product_name,
		"amount" => $price,
		"buyer_name" => $name,
		"phone" => $phone,
		"send_email" => true,
		"send_sms" => true,
		"email" => $email,
		'allow_repeated_payments' => false,
		"redirect_url" => "http://yourdomain.com/payment_success.php",
		"webhook" => "http://yourdomain.com/phpfiles/thousandsubscribers_webhook.php"
		));
	//print_r($response);

	$pay_ulr = $response['longurl'];
	
	//Redirect($response['longurl'],302); //Go to Payment page

	header("Location: $pay_ulr");
	exit();

}
catch (Exception $e) 
{
	print('Error: ' . $e->getMessage());
}
     
  ?>
