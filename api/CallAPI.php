<?php
namespace Api;

class CallAPI{

  public $conn;
  public $auth;
  public $header;
  public $body;
  public $method;
  public $url;

  public function __construct($connection){
    $this->conn = $connection;
    $this->header = array(
      'Content-Type: application/x-www-form-urlencoded'
    );

    $this->url = 'https://nextar.flip.id/disburse';
  }

  public function callApiDisbursement($bank_code,$account_number,$amount,$remark){
    $this->method = "POST";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_URL, $this->url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $this->header);

    $body = "bank_code=".$bank_code."&account_number=".$account_number."&amount=".$amount."&remark=".$remark;

    curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    //curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    $username = "HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41";
    $password = "";
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, $username . ":" . $password);

    $result = curl_exec($curl);
    $err = curl_error($curl);

    if(!$result){die($err);}
    curl_close($curl);
    return $result;
  }

  public function callApiDisbursementStatus($transaction_id){
    $this->method = "GET";
    $this->url = "".$this->url."/".$transaction_id;

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $this->url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $this->header);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    //curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    $username = "HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41";
    $password = "";
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, $username . ":" . $password);

    $result = curl_exec($curl);
    $err = curl_error($curl);

    if(!$result){die($err);}
    curl_close($curl);
    return $result;
  }

}



 ?>
