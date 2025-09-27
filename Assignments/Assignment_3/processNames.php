<?php
function addClearNames(){
    $output = "";
    if (isset($_POST['clearNames'])){
        return "";
    }

    $names = isset($_POST["namelist"]) ? $_POST["namelist"] : "";

    $namesList = explode ("\n", $names);

    if(isset($_POST['addName'])) {
        $newName = $_POST["name"];
        $parts = explode(" ", $newName);
        $firstName = $parts[0];
        $lastName = $parts[1];
        $newName = "$lastName, $firstName";
        array_push($namesList, $newName);
    }

    sort($namesList);

    $output = implode("\n", $namesList);

    return $output;
}


?>