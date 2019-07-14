<?php

use \Config\DBConnection as DBConnection;
require '../config/DBConnection.php';

use \Api\CallApi;
require '../api/CallApi.php';

use \Model\Disbursement;
require '../model/Disbursement.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data = $_GET['transaction_id'];
$result = array();
if(
    !empty($data)
){
    $dbconn = new DBConnection();
    $conn = $dbconn->getConnection();

    $callapi = new CallApi($conn);
    $dataDis = json_decode($callapi->callApiDisbursementStatus($data), true);

    $disburse = new Disbursement($conn);
    $disburse->setData($dataDis);
    $result = $disburse->updateDB();
}

//http_response_code(200)
if ($result['status'] == "success") {
  http_response_code(200);
} else {
  http_response_code(500);
}
echo json_encode($result);

 ?>
