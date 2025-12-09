<?php
require_once 'controllers/addContactProc.php';
function init(){
    $status = $_SESSION['status'] ?? "none";
    if($status === "none"){
       header("Location: index.php?page=login");
    }
    global $formConfig, $stickyForm, $output, $acknowledgment;
    return<<<HTML

    <div class="container mt-5">

    <h1>Add Contact</h1>
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
            <div class = "row">
                <div class="col-md-12">
                    {$stickyForm->renderInput($formConfig['address'], 'mb-3')}
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    {$stickyForm->renderInput($formConfig['city'], 'mb-3')}
                </div>
                <div class="col-md-4">
                    {$stickyForm->renderSelect($formConfig['state'], 'mb-3')}
                </div>
                <div class="col-md-4">
                    {$stickyForm->renderInput($formConfig['zip_code'], 'mb-3')}
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    {$stickyForm->renderInput($formConfig['phone'], 'mb-3')}
                </div>
                <div class="col-md-4">
                    {$stickyForm->renderInput($formConfig['email'], 'mb-3')}
                </div>
                <div class="col-md-4">
                    {$stickyForm->renderInput($formConfig['dob'], 'mb-3')}
                </div>
            </div>
            <div class ="row">
                {$stickyForm->renderRadio($formConfig['age_range'], 'mb-3', $formConfig['age_range']['layout'])}
            </div>
            <div class ="row">
                {$stickyForm->renderCheckboxGroup($formConfig['contactMethod'], 'mb-3', $formConfig['contactMethod']['layout'])}
            </div>

            <input type="submit" class="btn btn-primary" value="Add Contact">
        </form>
    </div>

    HTML;

    

}

?>