<?php  
$numbers = [];
$first = true;
$evenNumbers = "Even Numbers: ";
for ($i = 1; $i <=50; $i++){
  array_push($numbers, $i);
};
foreach($numbers as $number){
  if($first && ($number % 2 == 0)){
    $evenNumbers .= $number;
    $first = false;
  }
  elseif($number % 2 == 0){
    $evenNumbers .= " - " . $number;
  }
};
$form = <<<EOD
  <br>
  <br>
  <label for="email" class="form-label">Email address</label>
  <input type="text" id ="email" name="email" class="form-control" placeholder="name@example.com">
  <br>
  <label for="example" class="form-label">Example textarea</label>
  <textarea id="example" name="example" rows="3" class="form-control"></textarea>
  <br>
EOD;

function createTable($row,$col){
  $table = '<table class="table table-bordered">';
  for ($i = 1; $i <=$row; $i++){
    $table .= '<tr>';
    for ($j = 1; $j <=$col; $j++){
      $table .= "<td>Row $i, Col $j</td>";
    }
    $table .= '</tr>';
  }
  $table .= '</table>';
  
  return $table;
} 

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>PHP Basics Project</title>
  </head>
  <body class="container">
    <main>
      <?php
        echo $evenNumbers;
        echo $form;
        echo createTable(8, 6);
      ?>
    </main>
  </body>
</html>    