<?php

// trying to run phpmysqli using  u root p ""
// define('DB_SERVER','localhost') ;
// define('DB_USERNAME','root') ;
// define('DB_PASSWORD','') ;
// define('DB_NAME','login') ;
// ///////////////
$SERVER="sql107.epizy.com";
$USERNAME="epiz_31616404";
$PASSWORD="ckzpJz45GVKnU0z";
$DBName="epiz_31616404_stockhub";

// connection database
// $conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);
$conn = mysqli_connect($SERVER,$USERNAME,$PASSWORD,$DBName);
// check connection

if($conn==false){
    dir('Error: Cannot connect');
}
else{
    
}

?>