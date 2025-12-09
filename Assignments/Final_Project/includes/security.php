<?php
    session_start();

    $status = $_SESSION['status'] ?? "none";

    

    function modularPage(){
        global $content, $adminNav, $nav;

        $status = $_SESSION['status'] ?? "none";
        
        if($status === "none"){
            echo $content;
        }
        elseif($status === "admin"){
            echo $adminNav;
            echo $content;
        }
        elseif($status === "staff"){
            echo $nav;
            echo $content;
        }


    }






?>