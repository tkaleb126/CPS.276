<?php

require '../classes/Pdo_methods.php';

//Makes a connection to the data base
$pdo = new PdoMethods();

$sql = "SELECT * FROM names";

$records = $pdo->selectNotBinded($sql);

$output = "";

//Checks to see if there was a error retrieving the information
if($records === "error"){
    $pdo = null;
    $output = "Error Retrieving Data";

    header('Content-Type: application/json');

    echo json_encode([

    "masterstatus" => "Error",
    "names" => $output,

]);
}
else{
    //If there was no error checks to see if there is anything in the data base and if there is adds it to output
    if(count($records) != 0){
        foreach ($records as $row){
            $output .= "<p>" . $row["name"] . "</p>";
        }
    }
    //If there was no error and nothing in the data base the output will be "no names to display"
    else{
        $output = "No names to display";
    }
    $pdo = null;

    header('Content-Type: application/json');

    echo json_encode([

        "masterstatus" => "Data successfully recieved!",
        "names" => $output,

    ]);
}


?>