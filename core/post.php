<?php 
  class Post{
    //db
    private $connection;
    private $table;

    //propriedades post
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $author;
    public $body;
    public $created_at;

    //construtor com conexao db
    public function __construct($db){
      $this->connection = $db;
    }

    public function read(){
      //cria query
      $query = 'SELECT c.name as category_name, p.id, p.category_id, p.title, p.author, p.body, p.created_at FROM ' . $this->table . ' 
      p  LEFT JOIN categories AS c ON p.category_id = c.id ORDER BY p.created_at DESC';


      $stmt = $this->connection->prepare($query);
      $stmt->execute();

      return $stmt;
    }
  }
?>