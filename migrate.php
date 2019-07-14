<?php

use \Config\DBConnection as DBConnection;
require 'config/DBConnection.php';
//Database Configuration on change.ini
//Databse Configuration can be changed on change.ini
//Default Database Configuration is on localhost (127.0.0.1) with port 3306

$enter = "\r\n";

echo "Starting Migration....".$enter;

$app_name = $config['app_name'];
$version = $config['version'];
echo "=============================== ".$enter;
echo "Application Name : ".$app_name."".$enter;
echo "Version : ".$version."".$enter;
echo "=============================== ".$enter;

$dbconn = new DBConnection();
$dbconn->setDB();
$conn = $dbconn->getConnection();
//Create Table
echo "Create Table DISBURSEMENT....".$enter;
$sql = "CREATE TABLE IF NOT EXISTS DISBURSEMENT (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
transact_id VARCHAR(30) NOT NULL,
amount BIGINT(25) NOT NULL,
status VARCHAR(30) NOT NULL,
t_timestamp DATETIME NOT NULL,
bank_code VARCHAR(30) NOT NULL,
account_number VARCHAR(30) NOT NULL,
beneficiary_name VARCHAR(30) NOT NULL,
remark VARCHAR(30) NOT NULL,
receipt TEXT DEFAULT NULL,
time_served DATETIME NULL DEFAULT NULL,
fee BIGINT(25) NOT NULL,
created_at TIMESTAMP NOT NULL DEFAULT 0,
updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table DISBURSEMENT created successfully".$enter;
} else {
    echo "Error creating table: " . $conn->error;
    mysqli_close($conn);
    die();
}

echo "Migration Succesfull".$enter."Closing connection".$enter;

mysqli_close($conn);

echo "Connection closed";
?>
