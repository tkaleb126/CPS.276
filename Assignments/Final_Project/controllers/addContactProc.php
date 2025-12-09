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
    'address' => [
        'type' => 'text',
        'regex' => 'address',
        'label' => 'Address',
        'name' => 'address',
        'id' => 'address',
        'errorMsg' => 'You must enter a valid address',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    'city' => [
        'type' => 'text',
        'regex' => 'city',
        'label' => 'City',
        'name' => 'city',
        'id' => 'city',
        'errorMsg' => 'You must enter a valid city.',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    'state' => [
        'type' => 'select',
        'label' => 'State',
        'name' => 'state',
        'id' => 'state',
        'errorMsg' => 'You must select a state',
        'error' => '',
        'selected' => '0',
        'required' => true,
        'options' => [
            '0' => 'Please Select a State',
            'California' => 'California',
            'Texas' => 'Texas',
            'Michigan' => 'Michigan',
            'New York' => 'New York',
            'Florida' => 'Florida'
        ]
    ],
    'zip_code' => [
        'type' => 'text',
        'regex' => 'zip',
        'label' => 'Zip Code',
        'name' => 'zip_code',
        'id' => 'zip_code',
        'errorMsg' => 'You must enter a valid zip code',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    'phone' => [
        'type' => 'text',
        'regex' => 'phone',
        'label' => 'Phone',
        'name' => 'phone',
        'id' => 'phone',
        'errorMsg' => 'You must enter a valid phone number.',
        'error' => '',
        'required' => true,
        'value' => '999.999.9999'
    ],
    'email' => [
        'type' => 'text',
        'regex' => 'email',
        'label' => 'Email',
        'name' => 'email',
        'id' => 'email',
        'errorMsg' => 'You must enter a valid email.',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    'dob' => [
        'type' => 'text',
        'regex' => 'dob',
        'label' => 'Date of Birth',
        'name' => 'dob',
        'id' => 'dob',
        'errorMsg' => 'You must enter a valid date of birth.',
        'error' => '',
        'required' => true,
        'value' => '9/9/1999'
    ],
    'age_range' => [
        'type' => 'radio',
        'label' => 'Choose an Age Range',
        'name' => 'age_range',
        'id' => 'age_range',
        'errorMsg' => 'You must select an age range',
        'error' => '',
        'required' => true,
        'options' => [
            ['value' => '0-17', 'label' => '0-17', 'checked' => false],
            ['value' => '18-30', 'label' => '18-30', 'checked' => false],
            ['value' => '30-50', 'label' => '30-50', 'checked' => false],
            ['value' => '50+', 'label' => '50+', 'checked' => false]
        ],
        'layout' => 'horizontal'
    ],
    'contactMethod' => [
        'type' => 'checkbox',
        'label' => 'Select One or More Options',
        'name' => 'contactMethod',
        'id' => 'contactMethod',
        'errorMsg' => 'You must select at least one item.',
        'error' => '',
        'required' => false,
        'options' => [
            ['value' => 'newsletter', 'label' => 'newsletter', 'checked' => false],
            ['value' => 'email', 'label' => 'email', 'checked' => false],
            ['value' => 'text', 'label' => 'text', 'checked' => false]
        ],
        'layout' => 'horizontal'
    ],

    'masterStatus' => [
        'error' => false
    ]
];

$stickyForm = new StickyForm();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $formConfig = $stickyForm->validateForm($_POST, $formConfig);
    if (!$stickyForm->hasErrors() && $formConfig['masterStatus']['error'] == false) {
      $contacts = isset($_POST['contactMethod']) && is_array($_POST['contactMethod'])
      ? implode(",", $_POST['contactMethod'])
      : "";
      $pdo = new PdoMethods;

      $sql = "INSERT INTO contacts (fname, lname, address, city, state, phone, email, dob, contacts, age)
              VALUES (:fname, :lname, :address, :city, :state, :phone, :email, :dob, :contacts, :age)";

      $bindings = [
        [':fname',$_POST['first_name'],'str'],
        [':lname',$_POST['last_name'],'str'],
        [':address',$_POST['address'],'str'],
        [':city',$_POST['address'],'str'],
        [':state',$_POST['state'],'str'],
        [':phone',$_POST['phone'],'str'],
        [':email',$_POST['email'],'str'],
        [':dob',$_POST['phone'],'str'],
        [':contacts',$contacts,'str'],
        [':age',$_POST['age_range'],'str'],
      ];

      $result = $pdo->otherBinded($sql, $bindings);

      if($result === 'error'){
        $pdo = null;
        $acknowledgment = '<p style="color: red">There was an error adding the name</p>';
      }
      else {
        $pdo = null;
        $acknowledgment = '<p>Contact Added</p>';
        $formConfig['state']['selected'] = "0";
        foreach ($formConfig as $key => $field) {
        $formConfig[$key]['value'] = '';
        }
        foreach($formConfig['age_range']['options'] as $key => $field){
            $formConfig['age_range']['options'][$key]['checked'] = false;
        }
        foreach($formConfig['contactMethod']['options'] as $key => $field){
            $formConfig['contactMethod']['options'][$key]['checked'] = false;
        }
      }
    }  
}