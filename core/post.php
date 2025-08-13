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

    public function create(){
      $query = 'INSERT INTO ' . $this->table . ' SET title = :title, body = :body, author = :author, category_id = :category_id';

      $stmt = $this->connection->prepare($query);

      $this->title = htmlspecialchars(strip_tags($this->title));
      $this->body = htmlspecialchars(strip_tags($this->body));
      $this->author = htmlspecialchars(strip_tags($this->author));
      $this->category_id = htmlspecialchars(strip_tags($this->category_id));

      //bindando parametros
      $stmt->bindParam(':title', $this->title);
      $stmt->bindParam(':body', $this->body);
      $stmt->bindParam(':author', $this->author);
      $stmt->bindParam(':category_id', $this->category_id);

      if($stmt->execute()){
        return true;
      }

      printf("ERROR %s. \n", $stmt->error);
      return false;
    }
  }
?>