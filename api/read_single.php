<?php 

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  // inicializando API
  include_once('../core/initialize.php');


  //instancia a classe post
  $post = new Post($db);

  $result = $post->read();

  $numeroDeRows = $result->rowCount();;

  $post->id = isset($_GET['id']) ? $_GET['id'] : die();
  $post-> read_single();

  $post_arr = array(
    'id' => $post->id,
    'title' => $post->title,
    'body' => $post->body,
    'author' => $post->author,
    'category' => $post->category,
    'category_name' => $post->category_name,
  );

  print_r(json_encode($post_arr))
?>