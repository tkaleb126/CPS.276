<?php

function init(){
    //global $name;
    //$output = "<p>Welcome " . $name . "</p>";
    $status = $_SESSION['status'] ?? "none";
    if($status === "none"){
        header("Location: index.php?page=login");
    }

    $name = $_SESSION['name'] ?? "User";

    return <<<HTML
    <h1>Welcome</h1>
    <p>Welcome {$name}</p>
HTML;
}
?>