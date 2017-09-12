
<?php
// This sample demonstrates how to run a sale request, which combines an
// authorization with a capture in one request.

// Using Composer-generated autoload file.
//require __DIR__ . '/../vendor/autoload.php';
// Or, uncomment the line below if you're not using Composer autoloader.
 require_once(__DIR__ . '/lib/conf/dbconnect.php');
 require_once(__DIR__ . '/lib/CybsSoapClient.php');

// Before using this example, you can use your own reference code for the transaction.
$referenceCode = 'xxxxxxxxxxxxxxx';

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

$billTo = new stdClass();
$billTo->firstName = 'John';
$billTo->lastName = 'Doe';
$billTo->street1 = '1295 Charleston Road';
$billTo->city = 'Mountain View';
$billTo->state = 'CA';
$billTo->postalCode = '94043';
$billTo->country = 'US';
$billTo->email = 'null@cybersource.com';
$billTo->ipAddress = '10.7.111.111';
$request->billTo = $billTo;

$card = new stdClass();
$card->accountNumber = '4111111111111111';
$card->expirationMonth = '12';
$card->expirationYear = '2020';
$request->card = $card;

$purchaseTotals = new stdClass();
$purchaseTotals->currency = 'USD';
$purchaseTotals->grandTotalAmount = '90.01';
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

echo $requestID."<br/>".
$decision."<br/>".
$currency."<br/>".
$amount."<br/>".
$authorizationCode."<br/>".
$authorizedDateTime."<br/>".
$reconciliationID."<br/>".
$paymentNetworkTransactionID."<br/>".
$receiptNumber."<br/>";

$sql = "INSERT INTO `payment`(`id`, `requestID`, `decision`, `currency`, `amount`, `authorizationCode`, `authorizedDateTime`, `reconciliationID`, `paymentNetworkTransactionID`, `receiptNumber`) VALUES (NULL,'".$requestID."','".$decision."','".$currency."','".$amount."','".$authorizationCode."','".$authorizedDateTime."','".$reconciliationID."','".$paymentNetworkTransactionID."','".$receiptNumber."')";

$ord = mysqli_query($connection, $sql);

if($ord){
    echo "success";
}else{
    echo "fail";
}


