<?php 

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  // inicializando API
  include_once('../core/initialize.php');


  //instancia a classe post
  $post = new Post($db);

  $result = $post->read();

  $numeroDeRows = $result->rowCount();;

  if($numeroDeRows > 0){
    $post_arr = array();
    $post_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      $post_item = array(
        'id' => $id,
        'title' => $title,
        'body' => html_entity_decode($body),
        'author' => $author,
        'category_id' => $category_id,
        'category_name' => $category_name,
      );
      array_push($post_arr['data'], $post_item);
    }

    echo json_encode($post_arr);
  } else {
    echo json_encode(array('message' => 'Nenhum registro encontrado'));
  }

?>