<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Control-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

//initializing our api
include_once('../core/initialize.php');

//instantiate post
$post = new Post($db);

//get raw posted data
$data = json_decode(file_get_contents("php://input"));

$post->title = $data->title;
$post->description = $data->description;
$post->deadline = $data->deadline;

//create post
if($post->create()) {
    echo json_encode(
        array('message' => 'Post created.')
    );
}
else {
    echo json_encode(
        array('message' => 'Post not created')
    );
}

?>