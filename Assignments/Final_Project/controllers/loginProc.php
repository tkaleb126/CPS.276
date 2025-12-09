<?php

require_once('classes/StickyForm.php');
require_once('classes/Pdo_methods.php');

$acknowledgment = "<p></p>";

$formConfig = [
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
        'regex' => 'none',
        'label' => 'Password',
        'name' => 'password',
        'id' => 'password',
        'errorMsg' => 'You must enter a password',
        'error' => '',
        'required' => true,
        'value' => ''
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
        $acknowledgment = '<p>Login credentials incorrect</p>';
      }
      else{
        $result = $result[0];

        if (password_verify($_POST['password'], $result['password'])){

            $_SESSION['name'] = $result['name'];

            if($result['status'] === "Admin"){
              $_SESSION['status'] = "admin";
              header('Location: ' .'index.php?page=welcome');
            }
            else{
              $_SESSION['status'] = "staff";
              header('Location: ' .'index.php?page=welcome');
            }
        }
        else{
            $acknowledgment = "<p>Login credentials incorrect</p>";
        }
      }
    }  
}
