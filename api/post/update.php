<?php 
  /** Ficheiro semelhante ao controller num paradigam MVC 
   *  este vai retornar apenas uma linha da BD passar para um ficheiro Json 
  */

  /** Header do ficheiro  Access-Control-Allow-Origin: * permite que qualquer acesso
   * Já que estamos a suar uma Key publica
   * e no caso do Content-Type: application/json é necessário já que estamos a usar JSON 
   * e no caso como pretendemos acrescentar data temos que incorporar o metodo PUT, 
   * bem como temos que atorizar os metodos acima mencionados 
  */
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');//Metodo "PUT" já se pretendo alterar um registo
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Post.php';

  // Instancia e estabelece a ligação com a base de dados
  $database = new Database();
  $db = $database->connect();

  // Instancia a Class Post
  $post = new Post($db);

  // retorna a data em formato raw do json
  $data = json_decode(file_get_contents("php://input"));

  // estabelecemos a variavel ID para fazer o update
  $post->id = $data->id;
  //data que vamos atribuir ás propriedades
  $post->title = $data->title;
  $post->body = $data->body;
  $post->author = $data->author;
  $post->category_id = $data->category_id;

  // chama-se o metodo update() para alterar registo.
  if($post->update()) {
    echo json_encode(
      array('message' => 'Post Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Post Not Updated')
    );
  }

