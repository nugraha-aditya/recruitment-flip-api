<?php
namespace Model;

class Disbursement{

  public $id;
  public $transact_id;
  public $amount;
  public $status;
  public $t_timestamp;
  public $bank_code;
  public $account_number;
  public $beneficiary_name;
  public $remark;
  public $receipt;
  public $time_served;
  public $fee;
  public $created_at;
  public $updated_at;

  private $conn;

  public function __construct($connection){
    $this->conn = $connection;
  }

  public function setData($data){
    $this->transact_id = $data['id'];
    $this->amount = $data['amount'];
    $this->status = $data['status'];
    $this->t_timestamp = $data['timestamp'];
    $this->bank_code = $data['bank_code'];
    $this->account_number = $data['account_number'];
    $this->beneficiary_name = $data['beneficiary_name'];
    $this->remark = $data['remark'];
    $this->receipt = $data['receipt'];
    $this->time_served = $data['time_served'];
    $this->fee = $data['fee'];
  }

  public function insertDB(){
    $date = date('Y-m-d H:i:s');

    $sql = "INSERT INTO disbursement(transact_id,amount,status,
      t_timestamp,bank_code,account_number,beneficiary_name,remark,
      receipt,time_served,fee,created_at) VALUES ('$this->transact_id','$this->amount',
        '$this->status','$this->t_timestamp','$this->bank_code','$this->account_number','$this->beneficiary_name',
        '$this->remark','$this->receipt','$this->time_served','$this->fee','$this->date')";

    if ($this->conn->query($sql) === TRUE) {
        return array(
          "status" => 200,
          "result" => "Disbursement successful. Data is saved to database"
        );
    } else {
      return array(
        "status" => 500,
        "result" => "Error. Disbursement not successful. ".$this->conn->error
      );
    }

  }

public function updateDB(){
  $sql = "UPDATE disbursement SET receipt = '$this->receipt',status = '$this->status',time_served = '$this->time_served'
   WHERE transact_id = '$this->transact_id'";

   if ($this->conn->query($sql) === TRUE) {
       return array(
         "status" => 200,
         "result" => "Update Disbursement successful. Data is saved to database"
       );
   } else {
     return array(
       "status" => 500,
       "result" => "Error. Update Disbursement not successful. ".$this->conn->error
     );
   }
}

}


 ?>
