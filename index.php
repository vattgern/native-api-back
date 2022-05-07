<?php
require 'connect.php';
require 'functions.php';
header("Content-Type: json/application");

$method = $_SERVER['REQUEST_METHOD'];

if(isset($_GET['q'])){
    $type = $_GET['q'];
    $params = explode('/',$type);
    $type = $params[0];
    if(!empty($params[1])) {
        $id = $params[1];
    }
    if($method === 'GET'){
        if($type === 'posts'){
            if(isset($id)){
                getPost($connect,$id);
            } else{
                getPosts($connect);
            }
        }
    } elseif ($method === 'POST'){
        if($type === 'posts'){
            addPost($connect,$_POST);
        }
    } elseif ($method === 'PATCH'){
        if($type === 'posts'){
            if(isset($id)){
                $data = file_get_contents('php://input');
                $data = json_decode($data, true);
                updatePost($connect,$id,$data);
            }
        }
    } elseif($method === 'DELETE'){
        if($type === 'posts'){
            if(isset($id)){
                deletePost($connect,$id);
            }
        }
    }

}