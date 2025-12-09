<?php
$path = "index.php?page=login";
$status = $_SESSION['status'] ?? "none";
if (isset($_GET['page'])) {
    
    if ($_GET['page'] === "addContact") {
        require_once('views/addContactForm.php');
        $content = init();
    }

    else if ($_GET['page'] === "deleteContacts") {
        require_once('views/deleteContactsTable.php');
        $content = init();
    }

    else if ($_GET['page'] === "addAdmin") {
        require_once('views/addAdminForm.php');
        $content = init();
    }

    else if ($_GET['page'] === "deleteAdmins") {
        require_once('views/deleteAdminsTable.php');
        $content = init();
    }

    else if ($_GET['page'] === "welcome") {
        require_once('views/welcome.php');
        $content = init();
    }
    else{
        require_once('views/loginForm.php');
        $content = init();
    }
}
elseif($status === "none") {
    header("Location: index.php?page=login");
    
}





?>