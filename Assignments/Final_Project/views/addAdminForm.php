<?php
require_once 'controllers/addAdminProc.php';
function init(){
    $status = $_SESSION['status'] ?? "none";
    if($status === "none"){
        header("Location: index.php?page=login");
    }
    elseif($status === "staff"){
        header('Location: ' .'index.php?page=welcome');
    }
    global $formConfig, $stickyForm, $output, $acknowledgment;
    return<<<HTML

    <div class="container mt-5">

    <h1>Add Admin</h1>
        {$acknowledgment}
        <form method="post" action="">
            <div class = "row">
                <div class="col-md-6">
                    {$stickyForm->renderInput($formConfig['first_name'], 'mb-3')}
                </div>
                <div class="col-md-6">
                    {$stickyForm->renderInput($formConfig['last_name'], 'mb-3')}
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    {$stickyForm->renderInput($formConfig['email'], 'mb-3')}
                </div>
                <div class="col-md-4">
                    {$stickyForm->renderInput($formConfig['password'], 'mb-3')}
                </div>
                <div class="col-md-4">
                    {$stickyForm->renderSelect($formConfig['status'], 'mb-3')}
                </div>
            </div>

            <input type="submit" class="btn btn-primary" value="Add Admin">
        </form>
    </div>

    HTML;

    

}

?>