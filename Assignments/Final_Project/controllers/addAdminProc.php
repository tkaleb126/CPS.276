<?php

require_once('classes/StickyForm.php');
require_once('classes/Pdo_methods.php');

$acknowledgment = "<p></p>";

$formConfig = [
    'first_name' => [
        'type' => 'text',
        'regex' => 'name',
        'label' => 'First Name',
        'name' => 'first_name',
        'id' => 'first_name',
        'errorMsg' => 'You must enter a valid First Name',
        'error' => '',
        'required' => true,
        'value' => ''
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
        'required' => true,
        'value' => ''
    ],
    'email' => [
        'type' => 'text',
        'regex' => 'email',
        'label' => 'Email',
        'name' => 'email',
        'id' => 'email',
        'errorMsg' => 'You must enter a valid email',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    'password' => [
        'type' => 'text',
        'regex' => 'password',
        'label' => 'Password',
        'name' => 'password',
        'id' => 'password',
        'errorMsg' => 'You must enter a password',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    
    'status' => [
        'type' => 'select',
        'label' => 'Status',
        'name' => 'status',
        'id' => 'status',
        'errorMsg' => 'You must select a status',
        'error' => '',
        'selected' => '0',
        'required' => true,
        'options' => [
            '0' => 'Please Select a Status',
            'Admin' => 'Admin',
            'Staff' => 'Staff',
        ]
    ],

    'masterStatus' => [
        'error' => false
    ]
];

$stickyForm = new StickyForm();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $formConfig = $stickyForm->validateForm($_POST, $formConfig);
    if (!$stickyForm->hasErrors() && $formConfig['masterStatus']['error'] == false) {
      $pdo = new PdoMethods;
      

      $sql = "SELECT * FROM admins WHERE email = :email";

      $bindings = [
        [':email',$_POST['email'],'str'],
      ];

      $result = $pdo->selectBinded($sql, $bindings);

      if ($result === "error"){
        echo "Database error.";

      }
      elseif (count($result) === 0){
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $username = $_POST['first_name'] . " " . $_POST['last_name'];
        $sql = "INSERT INTO admins (name, email, password, status) VALUES (:uName, :email, :password, :status)";
        
        $bindings = [
            [':uName',$username,'str'],
            [':email',$_POST['email'],'str'],
            [':password',$password,'str'],
            [':status',$_POST['status'],'str'],
        ];

        $result = $pdo->otherBinded($sql, $bindings); 
        if($result === 'error'){
                    $pdo = null;
                    $acknowledgment = "There was an error adding to the database";
                }
        else{
            $pdo = null;
            $acknowledgment = "Administrator added";
            $formConfig['status']['selected'] = "0";
            foreach ($formConfig as $key => $field) {
                $formConfig[$key]['value'] = '';
            }
        }
      }
      else{
        $pdo = null;
        $acknowledgment = "Someone with that email already exists";
      }

      
     
    }
}
