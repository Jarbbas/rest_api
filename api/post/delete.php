<?php 
/** Ficheiro semelhante ao controller num paradigam MVC 
   *  este vai retornar apenas uma linha da BD passar para um ficheiro Json 
  */

  /** Header do ficheiro  Access-Control-Allow-Origin: * permite que qualquer acesso
   * Já que estamos a suar uma Key publica
   * e no caso do Content-Type: application/json é necessário já que estamos a usar JSON 
   * e no caso como pretendemos acrescentar data temos que incorporar o metodo DELETE, 
   * bem como temos que atorizar os metodos acima mencionados 
  */
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');//Metodo "DELETE" já se pretendo alterar um registo
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

  // chama-se o metodo delete() para alterar registo.
  if($post->delete()) {
    echo json_encode(
      array('message' => 'Post Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Post Not Deleted')
    );
  }

