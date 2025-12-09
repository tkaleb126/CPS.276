<?php
require_once 'controllers/deleteAdminProc.php';

function init(){
    $status = $_SESSION['status'] ?? "none";
    if($status === "none"){
        header("Location: index.php?page=login");
    }
    elseif($status === "staff"){
        header('Location: ' .'index.php?page=welcome');
    }
    global $records, $msg, $deleted;
    if(count($records) === 0){
        $msg = "<p></p>";
        $output = "<p>There are no records to display</p>";
    }
    else {
        $output = <<<HTML
        <h1>Delete Admin(s)</h1>
        <form method='post' action='index.php?page=deleteAdmins'>
            <input type='submit' class='btn btn-danger' name='delete' value='Delete'/><br><br><table class='table table-striped table-bordered'>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Status</th>
                </tr>
            </thead>
        <tbody>

HTML;

        foreach($records as $row){
            $splitString = explode(" ", $row['name']);
            $firstName = $splitString[0];
            $lastName = $splitString[1];
            $output .= "<tr><td>{$firstName}</td>
            <td>{$lastName}</td>
            <td>{$row['email']}</td>
            <td>{$row['password']}</td>
            <td>{$row['status']}</td>
            <td><input type='checkbox' name='chkbx[]' value='{$row['id']}' /></td></tr>";
        }

        $output .= "</tbody></table></form>";

        if($records == "error"){
            $msg = "<p style='color:red'>Could not display records</p>";
        }
        else {
            if(!$deleted){
                $msg = "<p>&nbsp;</p>";
            }
            else {
                $msg = "<p style='color: green'>Contact(s) deleted</p>";
            }
            
        }
        
    }

    return $msg.$output;
}