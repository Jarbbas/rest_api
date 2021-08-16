<?php 
  /** Ficheiro semelhante ao controller num paradigam MVC 
   *  este vai retornar apenas uma linha da BD passar para um ficheiro Json 
  */

  /** Header do ficheiro  Access-Control-Allow-Origin: * permite que qualquer acesso
   * Já que estamos a suar uma Key publica
   * e no caso do Content-Type: application/json é necessário já que estamos a usar JSON 
  */
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  /** include os ficheiros de configuração da BD e os models da Class Post */
  include_once '../../config/Database.php';
  include_once '../../models/Post.php';

  // Instancia e estabelece a ligação com a base de dados
  $database = new Database();
  $db = $database->connect();

  // Instancia a Class Post
  $post = new Post($db);

  /** validação com "IF tenario" 
   *  para ver se há um ID no url através do metodo GET
   * caso contrario termina o script com a função die()
   */
  $post->id = isset($_GET['id']) ? $_GET['id'] : die();

  // retorna o metodo através da CLass Post
  $post->read_single();

  // cria uma array com os campos extraidos do metodo read_single()
  $post_arr = array(
    'id' => $post->id,
    'title' => $post->title,
    'body' => $post->body,
    'author' => $post->author,
    'category_id' => $post->category_id,
    'category_name' => $post->category_name
  );

  // metodo para transformar a array em formato Json
  print_r(json_encode($post_arr));