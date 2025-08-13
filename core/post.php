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
       $this->table = 'post';
    }

    public function read(){
      //cria query
      $query = 'SELECT c.name as category_name, p.id, p.category_id, p.title, p.author, p.body, p.created_at FROM ' . $this->table . ' 
      p  LEFT JOIN categories AS c ON p.category_id = c.id ORDER BY p.created_at DESC';


      $stmt = $this->connection->prepare($query);
      $stmt->execute();

      return $stmt;
    }


    public function read_single(){
      $query = 'SELECT c.name as category_name, p.id, p.category_id, p.title, p.author, p.body, p.created_at FROM ' . $this->table . ' 
      p  LEFT JOIN categories AS c ON p.category_id = c.id
      WHERE p.id = ? LIMIT 1';


      $stmt = $this->connection->prepare($query);
      $stmt->bindParam(1, $this->id);
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);
  

      $this->title = $row['title'];
      $this->body = $row['body'];
      $this->author = $row['author'];
      $this->category_id = $row['category_id'];
      $this->category_name = $row['category_name'];

      return $stmt;
    }
  }
?>