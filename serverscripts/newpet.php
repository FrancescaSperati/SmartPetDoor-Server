<?php

$petname = $_REQUEST['petname'];

header('Content-type: application/json');

if( empty($petname) ){
    echo json_encode("missing 'petname'");
    die;
}

$folderpathname = '../photos/'.$petname.'_y';

mkdir($folderpathname, 0777);

echo json_encode("created $folderpathname");

?>