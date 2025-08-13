<?php 

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  // inicializando API
  include_once('../core/initialize.php');


  //instancia a classe post
  $post = new Post($db);

  $data = json_decode(file_get_contents("php://input"));

  $post->id = $data->id;

  if($post->delete()){
    echo json_encode(
      array('message' => 'post deletado.')
    );
  }else{
    echo json_encode(
        array('message' => 'Erro ao deletar post.')
    );
  }

?>