<?php

require '../classes/Pdo_methods.php';

//Recives the JSON file from main.js
$postData = file_get_contents('php://input');

$data = json_decode($postData, true);

//Explodes the string that was recived from main.js so we can rearange it
$parts = explode(" ", $data["name"]);
//Fromats Last Name , First Name
$name = $parts[1] . ", " . $parts[0];


//Connects to the Data Base
$pdo = new PdoMethods();

$sql = "INSERT INTO names (name) VALUES (:name)";
//Bindings
$bindings = [
	[':name',$name,'str']
];
$result = $pdo->otherBinded($sql, $bindings);
$pdo = null;

if($result === 'error'){
	header('Content-Type: application/json');
    //If adding the name was not succesfull it will return JSON file saying there was a error
    echo json_encode([

        "masterstatus" => "Error",
        "msg" => "Error adding data",
    ]);
}
else {
	header('Content-Type: application/json');
    //If adding the name was succesfull it will return JSON file saying that it was successfull
    echo json_encode([
        "masterstatus" => "Data successfully recieved!",
        "msg" => "Data was added",
    ]);
}






?>