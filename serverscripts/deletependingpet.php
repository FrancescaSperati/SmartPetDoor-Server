<?php

$filename = $_REQUEST['filename'];

header('Content-type: application/json');

if( empty($filename) ){
    echo json_encode("missing 'filename'");
    die;
}

if (file_exists("../pendingpet/$filename.jpg")) {
    unlink("../pendingpet/$filename.jpg");
    echo json_encode("deleted");
} else {
    echo json_encode("no file: $filename");
}

?>