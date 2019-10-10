<?php
header("Access-Control-Allow-Origin: *");

$petname = $_REQUEST['petname'];
$petimage = $_REQUEST['petimage'];

header('Content-type: application/json');

if( empty($petname) || empty($petimage)  ){
    echo json_encode("missing 'petname' or petimage");
    die;
}

$folderpathname = '../photos/'.$petname.'_y';

mkdir($folderpathname, 0777);

$milliseconds = round(microtime(true) * 1000);

// open the output file for writing
$ifp = fopen( '../photos/'.$petname.'_y/'.$milliseconds.'.jpg', 'wb' ); 

// split the string on commas
// $data[ 0 ] == "data:image/png;base64"
// $data[ 1 ] == <actual base64 string>
$data = explode( ',', $petimage );

// we could add validation here with ensuring count( $data ) > 1
fwrite( $ifp, base64_decode( $data[ 1 ] ) );

// clean up the file resource
fclose( $ifp );

echo json_encode("created $folderpathname");

?> 