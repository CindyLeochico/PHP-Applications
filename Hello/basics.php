<?php
// $name = "Cindy";
$number = 4;
// var_dump($name);

// $a = (string) 5;
// var_dump($a);
//echo "The name is: $name";

// const HELLO = "123";
//  HELLO = "456";

//////////////IF STATEMENT//////////

// if ($number == '4'){
//     echo "GOOD";

// }
// else{
//     echo "BAD";
// }

////////////ARRAY////////////////

// $fruits = ["apple","banana", "cherry"];
// $fruits[]="orange ";
// echo $fruits[3];

// foreach($fruits as $f){
//     echo $f . " ";
// }

/////////////ASSOCIATIVE ARRAY//////////////////

// $person = [
//     "name"=>"Lily",
//     "age" => 20,
//     "city" => "Calgary"];

//     //echo $person['name'];

//     foreach($person as $k => $v){
//         echo $k . ": " . $v . " ";
//         echo "<br>";
//     }

/////////////MULTIPLE ARRAY//////////////////

// $persons = [
//     ["name"=>"Lily",
//      "age" => 10,
//      "city" => "Calgary"],
//     ["name"=>"Tom",
//      "age" => 20,
//      "city" => "Calgary"],
//     ["name"=>"Mary",
//      "age" => 30,
//      "city" => "Calgary"]
// ];

// foreach($persons as $p){
//     foreach($p as $key => $item){
// echo $key .": " . $item . " ";
// echo "<br>";
//     }
//     echo "<br>";
// }

$ages=[25,30,35,20,40];

foreach($ages as $age)
if($age>=30){
    echo $age . " ";
}
 ?>

 