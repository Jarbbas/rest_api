<?php 
   /** Ficheiro semelhante ao controller num paradigam MVC 
   *  este vai retornar apenas uma linha da BD passar para um ficheiro Json 
  */

  /** Header do ficheiro  Access-Control-Allow-Origin: * permite que qualquer acesso
   * Já que estamos a suar uma Key publica
   * e no caso do Content-Type: application/json é necessário já que estamos a usar JSON 
   * e no caso como pretendemos acrescentar data temos que incorporar o metodo POST, 
   * bem como temos que atorizar os metodos acima mencionados 
  */
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');//Metodo "POST" já se pretendo criar um registo
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  // Instancia e estabelece a ligação com a base de dados
  include_once '../../config/Database.php';
  include_once '../../models/Post.php';

  // Instancia e estabelece a ligação com a base de dados
  $database = new Database();
  $db = $database->connect();

  // Instancia a Class Post
  $post = new Post($db);

  // retorna a data em formato raw do json
  $data = json_decode(file_get_contents("php://input"));

  //data que vamos atribuir ás propriedades
  $post->title = $data->title;
  $post->body = $data->body;
  $post->author = $data->author;
  $post->category_id = $data->category_id;

  // chama-se o metodo create() para criar registo.
  if($post->create()) {
    echo json_encode(
      array('message' => 'Post Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Post Not Created')
    );
  }

