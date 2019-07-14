<?php

use \Config\DBConnection as DBConnection;
require '../config/DBConnection.php';

use \Api\CallApi;
require '../api/CallApi.php';

use \Model\Disbursement;
require '../model/Disbursement.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data = json_decode(file_get_contents("php://input"));
$result = array();
if(
    !empty($data->bank_code) &&
    !empty($data->account_number) &&
    !empty($data->amount) &&
    !empty($data->remark)
){
    $bank_code = $data->bank_code;
    $account_number = $data->account_number;
    $amount = $data->amount;
    $remark = $data->remark;

    $dbconn = new DBConnection();
    $conn = $dbconn->getConnection();

    $callapi = new CallApi($conn);
    $dataDis = json_decode($callapi->callApiDisbursement($bank_code,$account_number,$amount,$remark), true);

    $disburse = new Disbursement($conn);
    $disburse->setData($dataDis);
    $result = $disburse->insertDB();
}

if ($result['status'] == "success") {
  http_response_code(200);
} else {
  http_response_code(500);
}

echo json_encode($result);

 ?>
