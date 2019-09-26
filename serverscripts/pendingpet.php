<?php

$files = array_diff(scandir("../pendingpet"), array('..', '.'));

$allFiles = [];

foreach ($files as $f){
    $singleFile = [];
    $singleFile["id"] = preg_replace('/\\.[^.\\s]{3,4}$/', '', $f);
    $img = file_get_contents("../pendingpet/".$f); 
    $singleFile["file"] = base64_encode($img);
    array_push($allFiles, $singleFile);
}

header('Content-type: application/json');
echo json_encode($allFiles);

?>