<?php

 require_once(__DIR__ . '/lib/conf/dbconnect.php');
 require_once(__DIR__ . '/lib/CybsSoapClient.php');

 //get the clients ip address
 function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

//get post data from post form
$firstName = $_POST["fname"];
$lastName = $_POST["lname"];
$street1 = $_POST["street"];
$city = $_POST["city"];
$state = $_POST["state"];
$postalCode = $_POST["postalcode"];
$country = $_POST["country"];
$email = $_POST["email"];
$ipAddress = get_client_ip();
$accountNumber = $_POST["account"];
$expirationMonth = $_POST["expiration"];
$expirationYear = $_POST["expirationyear"];
$currency = $_POST["currency"];
$grandTotalAmount = $_POST["amount"];

// echo $firstName;
// echo $lastName;
// echo $street1;
// echo $city;
// echo $state;
// echo $postalCode;
// echo $country;
// echo $email;
// echo $ipAddress;
// echo $accountNumber;
// echo $expirationMonth;
// echo $expirationYear;
// echo $currency;
// echo $grandTotalAmount;

//Before using this example, you can use your own reference code for the transaction.
$referenceCode = 'xxxxxxxxxxxxxxxxxxxxxx';

$client = new CybsSoapClient();
$request = $client->createRequest($referenceCode);

// Build a sale request (combining an auth and capture). In this example only
// the amount is provided for the purchase total.
$ccAuthService = new stdClass();
$ccAuthService->run = 'true';
$request->ccAuthService = $ccAuthService;

$ccCaptureService = new stdClass();
$ccCaptureService->run = 'true';
$request->ccCaptureService = $ccCaptureService;

//asign post values to bill to variables
$billTo = new stdClass();
$billTo->firstName = $firstName;
$billTo->lastName = $lastName;
$billTo->street1 = $street1;
$billTo->city = $city;
$billTo->state = $state;
$billTo->postalCode = $postalCode;
$billTo->country = $country;
$billTo->email = $email;
$billTo->ipAddress = $ipAddress;
$request->billTo = $billTo;

$card = new stdClass();
$card->accountNumber = $accountNumber;
$card->expirationMonth = $expirationMonth;
$card->expirationYear = $expirationYear;
$request->card = $card;

$purchaseTotals = new stdClass();
$purchaseTotals->currency = $currency;
$purchaseTotals->grandTotalAmount = $grandTotalAmount;
$request->purchaseTotals = $purchaseTotals;

$reply = $client->runTransaction($request);

// This section will show all the reply fields.
//print("\nRESPONSE: " . print_r($reply, true));

$json_reply = json_encode($reply,JSON_PRETTY_PRINT);

//echo "<pre>".$json_reply."</pre>";

$data = json_decode($json_reply, true);

$requestID = $data["requestID"];
$decision = $data["decision"];
$currency = $data["purchaseTotals"]["currency"];
$amount = $data['ccAuthReply']["amount"];
$authorizationCode = $data['ccAuthReply']["authorizationCode"];
$authorizedDateTime = $data['ccAuthReply']["authorizedDateTime"];
$reconciliationID = $data['ccAuthReply']["reconciliationID"];
$paymentNetworkTransactionID = $data['ccAuthReply']["paymentNetworkTransactionID"];
$receiptNumber = $data["receiptNumber"];

// echo $requestID."<br/>".
// $decision."<br/>".
// $currency."<br/>".
// $amount."<br/>".
// $authorizationCode."<br/>".
// $authorizedDateTime."<br/>".
// $reconciliationID."<br/>".
// $paymentNetworkTransactionID."<br/>".
// $receiptNumber."<br/>";

$sql = "INSERT INTO `payment`(`id`, `requestID`, `decision`, `currency`, `amount`, `authorizationCode`, `authorizedDateTime`, `reconciliationID`, `paymentNetworkTransactionID`, `receiptNumber`) VALUES (NULL,'".$requestID."','".$decision."','".$currency."','".$amount."','".$authorizationCode."','".$authorizedDateTime."','".$reconciliationID."','".$paymentNetworkTransactionID."','".$receiptNumber."')";

$ord = mysqli_query($connection, $sql);

if($ord){
	echo "success";
}else{
	echo "fail";
}