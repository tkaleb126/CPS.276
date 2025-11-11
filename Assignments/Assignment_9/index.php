<?php
require_once('classes/StickyForm.php');
require_once('classes/Pdo_methods.php');

$formConfig = [
    'first_name' => [
        'type' => 'text',
        'regex' => 'name',
        'label' => 'First Name',
        'name' => 'first_name',
        'id' => 'first_name',
        'errorMsg' => 'You must enter a valid First Name',
        'error' => '',
        'required' => false,
        'value' => 'Kaleb'
    ],

    // Last name field configuration
    'last_name' => [
        'type' => 'text',
        'regex' => 'name',
        'label' => 'Last Name',
        'name' => 'last_name',
        'id' => 'last_name',
        'errorMsg' => 'You must enter a valid last name.',
        'error' => '',
        'required' => false,
        'value' => 'Tomanovich'
    ],
    // Email field configuration
    'email' => [
        'type' => 'text',
        'regex' => 'email',
        'label' => 'Email',
        'name' => 'email',
        'id' => 'email',
        'errorMsg' => 'You must enter a valid email address.',
        'error' => '',
        'required' => false,
        'value' => 'ktomanovich@wccnet.edu'
    ],
    //Password field configuration
    'password1' => [
        'type' => 'text',
        'regex' => 'password',
        'label' => 'Password',
        'name' => 'password1',
        'id' => 'password1',
        'errorMsg' => 'Must have at least (8 characters, 1 uppercase, 1 symbol, 1 number)',
        'error' => '',
        'required' => false,
        'value' => 'Pass$or1'
    ],
    //Confirm Password Field configuration
    'password2' => [
        'type' => 'text',
        'regex' => 'password',
        'label' => 'Confirm Password',
        'name' => 'password2',
        'id' => 'password2',
        'errorMsg' => 'Your passwords do not match',
        'error' => '',
        'required' => false,
        'value' => 'Pass$or2'
    ],

   
    
    
    // Master status for form validation
    'masterStatus' => [
        'error' => false
    ]
];

function createTable(){
    $pdo = new PdoMethods();
    $sql = "SELECT * FROM user";
    $records = $pdo->selectNotBinded($sql);
    if(count($records) != 0){
        $pdo = null;
        $table = "<form method='post' action='update_delete_name.php'>";
		$table .= "<table class='table table-bordered table-striped'><thead><tr>";
		$table .= "<th>First Name</th><th>Last Name</th><th>Email</th><th>Password</th><tbody>";
        foreach ($records as $row){
            $table .= "<tr><td>" . $row["firstname"] . "</td><td>" . $row["lastname"] . "</td><td>" . $row["email"] . "</td><td>" . $row["password"] . "</td></tr>";
        }
        $table .= "</tbody></table>"; 
        return $table; 
    }
    else{
        $pdo = null;
        return "No records to display";
    }
}

$stickyForm = new StickyForm();
$confirmError = "";
$alreadyExists = "";
$output = createTable();
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate form data and update form configuration
    if(!($_POST["password1"] === $_POST["password2"])){
        $confirmError = "<span class=\"text-danger\">Your passwords do not match</span><br>" ;
    }
    else{
        $formConfig = $stickyForm->validateForm($_POST, $formConfig);

        // Check if form is valid (no errors)
    if (!$stickyForm->hasErrors() && $formConfig['masterStatus']['error'] == false) {

        $pdo = new PdoMethods();

        $sql = "SELECT * FROM user WHERE email = :email";

        $bindings = [
			[':email',$_POST['email'],'str']
    ];
        $records = $pdo->selectBinded($sql, $bindings);

        if(count($records) != 0){
            $alreadyExists = "There is already a record with that email";
            $pdo = NULL;
        }
        else{
            $password = password_hash($_POST['password1'], PASSWORD_DEFAULT);
            $sql = "INSERT INTO user (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)";
            $bindings = [
			[':firstname',$_POST['first_name'],'str'],
			[':lastname',$_POST['last_name'],'str'],
            [':email',$_POST['email'],'str'],
            [':password',$password,'str']
        ];

            $result = $pdo->otherBinded($sql, $bindings);
            if($result === 'error'){
                $pdo = null;
			    echo 'There was an error adding the file';
		    }
            else{
                $pdo = null;
                $output = createTable();

            }
        }
    }
    }
    
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Sticky Form Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5"> 
<p><?php echo $alreadyExists; ?></p> 
<form method="post" action="">
        <div class="row">
            <!-- Render first name field -->
            <div class="col-md-6">
                <div class="mb-3">
    <?php echo $stickyForm->renderInput($formConfig['first_name'], 'mb-3'); ?>
    
</div>            </div>

            <!-- Render last name field -->
            <div class="col-md-6">
                <div class="mb-3">
    <?php echo $stickyForm->renderInput($formConfig['last_name'], 'mb-3'); ?>
    
</div>            </div>
        </div>

        
        <!-- Render email password password -->
        <div class="row">
           
            <div class="col-md-4">
                <div class="mb-3">
    <?php echo $stickyForm->renderInput($formConfig['email'], 'mb-3'); ?>
    
</div>            </div>
            <div class="col-md-4">
                <div class="mb-3">
    <?php echo $stickyForm->renderInput($formConfig['password1'], 'mb-3'); ?>
    
</div>            </div>
            <div class="col-md-4">
                <div class="mb-3">
    <?php echo $stickyForm->renderInput($formConfig['password2'], 'mb-3'); echo $confirmError; ?>
    
    
</div>            </div>
        </div>
     
        <input type="submit" class="btn btn-primary" value="Register">
    </form>
        </div>
        <div class="container">
                <p><?php echo $output; ?></p>
        </div>

</body>
</html>