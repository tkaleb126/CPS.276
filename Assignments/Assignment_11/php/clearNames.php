<?php

require '../classes/Pdo_methods.php';
//Makes the connection to the Data Base
$pdo = new PdoMethods();

$sql = "TRUNCATE TABLE names";
//Sends the SQL to the mysql to delete the data
$result = $pdo->selectNotBinded($sql);

if($result === 'error'){
	header('Content-Type: application/json');
    //Returns in JSON that it was not successfull
    echo json_encode([

        "masterstatus" => "Error",
        "msg" => "Error removing data",
    ]);
}
else {
	header('Content-Type: application/json');
    //Returns in JSON that it was successfull
    echo json_encode([
        "masterstatus" => "Data successfully recieved!",
        "msg" => "Data was added",
    ]);
}

?>