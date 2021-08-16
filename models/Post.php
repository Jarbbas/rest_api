<?php 
  /** Classe Post */
  class Post {
   
    private $conn;  // parametros de ligação à BD
    private $table = 'posts'; // nome da tabela no mysql

    // propriedades da classe POST
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    // metodo construtor que estabelece a ligração com a BD
    public function __construct($db) {
      $this->conn = $db;
    }

    /** Metodo --> GET para a class POST 
     * Este metodo vai buscar todas as linhas(rows) presentes na BD
    */
    public function read() {
      // Query mysql
      $query = 'SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at
                                FROM ' . $this->table . ' p
                                LEFT JOIN
                                  categories c ON p.category_id = c.id
                                ORDER BY
                                  p.created_at DESC';
      
      // A função prepare() é do PDO que irá "preparar" a query previamente estabelecidade
      $stmt = $this->conn->prepare($query);

      // Executa a query
      $stmt->execute();

      return $stmt;
    }

    /** Metodo --> GET para a class POST 
     * Este metodo vai buscar apenas uma linha(row) da BD através de um ID
    */
    public function read_single() {
          // Query mysql
          $query = 'SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at
                                    FROM ' . $this->table . ' p
                                    LEFT JOIN
                                      categories c ON p.category_id = c.id
                                    WHERE
                                      p.id = :id
                                    LIMIT 0,1';

          // Prepara a query função do PDO
          $stmt = $this->conn->prepare($query);

          // A variavel $stmt vai conter o ID através de um função PDO bindParam()
          $stmt->bindParam(':id', $this->id);

          // Executa a query
          $stmt->execute();
          /** A variavel $row vai conter a linha da query prevaimente recolhida
           * através da função fetch() também do PDO */ 
          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // estabelece as propriedades em relação aos campos da base de dados
          $this->title = $row['title'];
          $this->body = $row['body'];
          $this->author = $row['author'];
          $this->category_id = $row['category_id'];
          $this->category_name = $row['category_name'];
    }

    /** Metodo --> POST para a class POST 
     * Este metodo vai criar apenas uma linha(row) na BD 
    */
    public function create() {
          // Query mysql
          $query = 'INSERT INTO ' . $this->table . ' SET title = :title, body = :body, author = :author, category_id = :category_id';

          // Prepara o conteudo da query
          $stmt = $this->conn->prepare($query);

          // limpa a data atarvés das funções htmlspecialchars() e strip_tags()
          $this->title = htmlspecialchars(strip_tags($this->title));
          $this->body = htmlspecialchars(strip_tags($this->body));
          $this->author = htmlspecialchars(strip_tags($this->author));
          $this->category_id = htmlspecialchars(strip_tags($this->category_id));

          // Faz o "bind" da data para a query acima
          $stmt->bindParam(':title', $this->title);
          $stmt->bindParam(':body', $this->body);
          $stmt->bindParam(':author', $this->author);
          $stmt->bindParam(':category_id', $this->category_id);

          // Executa a query
          if($stmt->execute()) {
            return true;
      }

      // Caso exista um erro
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    /** Metodo --> PUT para a class POST 
     * Este metodo vai fazer um update a uma linha, semalhante ao metodo create()
    */
    public function update() {
          // Query mysql
          $query = 'UPDATE ' . $this->table . '
                                SET title = :title, body = :body, author = :author, category_id = :category_id
                                WHERE id = :id';

          // Prepara o conteudo da query
          $stmt = $this->conn->prepare($query);

          // limpa a data atarvés das funções htmlspecialchars() e strip_tags()
          $this->title = htmlspecialchars(strip_tags($this->title));
          $this->body = htmlspecialchars(strip_tags($this->body));
          $this->author = htmlspecialchars(strip_tags($this->author));
          $this->category_id = htmlspecialchars(strip_tags($this->category_id));
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Faz o "bind" da data para a query acima
          $stmt->bindParam(':title', $this->title);
          $stmt->bindParam(':body', $this->body);
          $stmt->bindParam(':author', $this->author);
          $stmt->bindParam(':category_id', $this->category_id);
          $stmt->bindParam(':id', $this->id);

          // Executa a query
          if($stmt->execute()) {
            return true;
          }

          // Caso exista um erro
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

    /** Metodo --> DELETE para a class POST 
     * Este metodo vai apagar a uma linha da BD
    */
    public function delete() {
          // Query mysql
          $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

          // Prepara o conteudo da query
          $stmt = $this->conn->prepare($query);

          // Limpa a data
          $this->id = htmlspecialchars(strip_tags($this->id));

          // faz o bind da data
          $stmt->bindParam(':id', $this->id);

          // Executa a query
          if($stmt->execute()) {
            return true;
          }

          // Caso corra mal!
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
  }