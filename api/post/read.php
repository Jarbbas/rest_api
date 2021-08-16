<?php 

  /** Ficheiro semelhante ao controller num paradigam MVC 
   *  este vai retornar todas as linhas da BD passar para um ficheiro Json 
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

  /** Instancia a Class Database e estabelecemos uma
   * ligação através do metodo connect()
   */
  $database = new Database();
  $db = $database->connect();

  //Instancia a Class Post
  $post = new Post($db);

  // Query para retornar os blog posts da BD
  $result = $post->read();
  // retorna o número de linhas na BD para efeitos de validação mais tarde
  $num = $result->rowCount();

  // Validação se há linhas obtidas através da query Read()
  if($num > 0) {
    // inicialização de uma array vazia para ser usada mais tarde
    $posts_arr = array();
    // $posts_arr['data'] = array();

    /** Loop while para percorrer todas as linhas obtidas através do metodo Read */
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      /*função extract do php converte chaves de matriz 
      * em nomes variáveis e valores de matriz em valor variável.*/
      extract($row);

      /**nova array para guardar conteudo extraido da row */
      $post_item = array(
        'id' => $id,
        'title' => $title,
        'body' => html_entity_decode($body),
        'author' => $author,
        'category_id' => $category_id,
        'category_name' => $category_name
      );

      // função embutida PHP para copiar conteudos de uma array para o fim da outra.
      array_push($posts_arr, $post_item);
      // array_push($posts_arr['data'], $post_item);
    }

    // função para converter conteudo da array no formato Json
    echo json_encode($posts_arr);

  } else {
    // validação caso não haja registos.
    echo json_encode(
      array('message' => 'No Posts Found')
    );
  }
