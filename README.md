
# recruitment-flip-api
This repository is for mini project as part of recruitment process for Flip Tech

This is a documentation on recruitment project for Flip tech. I will be describing on what the codes do and how they should be functioned. 

# Introduction
This service will call Slightly-big Flip API which the documentation can be found on here : [Slightly-big Flip API](https://gist.github.com/luqmansungkar/9512940cac53f53bb4a024a1e5f70ef7)

User who wants to disburse money from their account will call the API from this service to pass the information to the Slightly-big Flip API. Then the disbursement data will be saved to the database and can be updated when user call another API from this service. This project is done with PHP and so user must have requirements to execute or run a php file (e.g. XAMPP, MAMP, or version of php already installed to OS), curl certificate, application that can be used easily to call API (e.g. Postman), local MySQL DBMS to host the database, and text editor to check the codes.

Before we can run the project, user must placed the project file into htdocs folder or similar folder. The purpose is because the API needs to run on a server, whether it's a local or online. Make sure you installed the latest PHP version. Also, verify your curl certification file (curl-ca-bundle.crt or similar) and its path (check this on your php.ini file, find the path on curl.cainfo) as this project use curl to call the Slightly-big Flip API.

The configuration file is in the config folder. It's name is config.ini and it will configure your connection to your database. The default configuration can be seen on config.ini file.

# Migrating the database
You have the file but your database is not being set up yet. So, migrate the database with running the migrate.php file. run this from you terminal/command prompt. 

`$ php migrate.php`

The migration wil result in creation of a database named LocalDB2 and a table named disbursement. Mind you that DBMS used here is MySQL so make sure you have the current version of MySQL.

# Running the service
It's time to run the service ! Make sure your server is up. You can call two APIs that will connect to Slightly-big Flip API.

No Authentication needed to run this service.

# Disbursement
	
**Request** 
	
	>POST 
	http://localhost/flipapi/api/disburse.php 
	HTTP/1.1
	Content-Type: application/x-www-form-urlencoded
	
**Attribute**
 - bank_code
 - account_number
 - amount
 - remark
 
 example :

    {
    		"bank_code" : "bni",
    		"account_number" : "9080091",
    		"amount" : 10000,
    		"remark" : "sample remark"
    }

 
 **Response** 

    Status 200
    Content-Type: application/json
    {
    	    "status": "success",
    	    "result": "Disbursement successful. Data is saved to database"
    }


# Disbursement Status

**Request**

    GET 
	http://localhost/flipapi/api/disburse-status.php?transaction_id={transaction_id} 
	HTTP/1.1
	Content-Type: application/x-www-form-urlencoded

**Response**

    Status 200
    Content-Type: application/json
    {
	    "status":"success",
	    "result":"Update Disbursement successful. Data is saved to database","status2":"SUCCESS"}
    
