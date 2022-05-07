<?php
function getPosts($connect){
    $posts = mysqli_query($connect,"SELECT * FROM `posts` ");
    $postList = [];
    while($post = mysqli_fetch_assoc($posts)){
        $postList[] = $post;
    }
    echo json_encode($postList);
}
function getPost($connect,$id){
    $post = mysqli_query($connect,"SELECT * FROM `posts` WHERE `posts`.`id` = '$id'");
    $post = mysqli_fetch_assoc($post);
    if(!$post){
        $response = [
            "status" => false,
            "message" => "Post not founded"
        ];
        http_response_code(404);
        echo json_encode($response);
    } else{
        echo json_encode($post);
    }
}
function addPost($connect ,$data){
    mysqli_query($connect,"INSERT INTO `posts` (`id`, `title`, `body`) VALUES (NULL, '{$data['title']}', '{$data['body']}')");
    $response = [
      "status" => true,
      "post_id" => mysqli_insert_id($connect),
      "message" => 'Post added',
    ];
    http_response_code('201');
    echo json_encode($response);
}
function updatePost($connect, $id, $data){
    $title = $data['title'];
    $body = $data['body'];
    mysqli_query($connect,"UPDATE `posts` SET `title` = '$title' , `body` = '$body' WHERE `posts`.`id` = '$id'");
    http_response_code(200);
    $response = [
        "status" => true,
        "message" => "Post updated"
    ];
    echo json_encode($response);
}
function deletePost($connect, $id){
    mysqli_query($connect,"DELETE FROM `posts` WHERE `posts`.`id` = '$id'");
    $response = [
        'status' => true,
        'message' => "Post deleted"
    ];
    http_response_code(200);
    echo json_encode($response);
}