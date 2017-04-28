<?php
require 'vendor/autoload.php';
require 'validate.php';

$db = new PDO("sqlite:db/comics");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$app = new \Slim\Slim(array(
    'templates.path' => 'templates',
));

// default route
$app->get('/', function() use ($app) {
    echo "Welcome to Comic Book API! Use the node called /comics.<br/>" .
         "<ul>" .
            "<li>GET /comics: <em>Show all comics</em></li>" .
            "<li>GET /comics/{id}: <em>Show given comic if exists</em></li>" .
            "<li>POST /comics: <em>Include new comic (params: title, publisher, price)</em> <strong>** requires authentication</strong></li>" .
            "<li>PUT /comics{id}: <em>Update given comic if exists (params: title, publisher, price)</em> <strong>** requires authentication</strong></li>" .
            "<li>DELETE /comics{id}: <em>Delete given comic if exists</em> <strong>** requires authentication</strong></li>" .
         "</ul>"
    ;
});

// routes to node comics
$app->group('/comics',function() use ($app,  $db)
{

  // show all comics - GET method
  $app->get('/', function() use ($app, $db){
      $comics = array();
      $sql = "SELECT * FROM comics";
      $res = $db->query($sql);

      if ($res) {
          foreach($res as $row)
          {
              $comics[] = array(
                    'id' => $row['id'],
                    'title' => $row['title'],
                    'publisher' => $row['publisher'],
                    'price' => $row['price'],
                    'createdAt' => $row['createdAt'],
                    'updatedAt' => $row['updatedAt']
              );
          }
      } else {
          $comics = array('data'=>array('404' => 'Not found'));
      }

      $data = array('data' => $comics);
      $app->render('default.php', $data, 200);
  });


  // show comic - GET {id} method
  $app->get('/:id', function($request) use ($app, $db){
      $comics = array();
      $sql = "SELECT * FROM comics WHERE id = {$request}";
      $count = $db->query($sql)->fetch();

      if ($count) {
          $res = $db->query($sql);
          foreach($res as $row) {
              $comics[] = array(
                    'id' => $row['id'],
                    'title' => $row['title'],
                    'publisher' => $row['publisher'],
                    'price' => $row['price'],
                    'createdAt' => $row['createdAt'],
                    'updatedAt' => $row['updatedAt']
              );
          }
      } else {
          $comics = array('data'=>array('404' => 'Not found'));
      }

      $data = array('data' => $comics);
      $app->render('default.php', $data, 200);
  });


  // include new comic - POST method
  $app->post('/', function() use ($app, $db){
      $body = json_decode($app->request->getbody());
      $apiKey = $body->apiKey;
      $sever_apiKey = apiKey($body->user_id);

      if (gettype($body) == 'object' && $apiKey == $sever_apiKey) {

          if (validateParams(get_object_vars($body))) {
              $title = $body->title;
              $publisher = $body->publisher;
              $price = $body->price;
              $now = date('Y-m-d H:i:s');

              try {
                  $sql = "INSERT INTO comics (id, title, publisher, price, createdAt, updatedAt) VALUES(null, '$title', '$publisher', '$price', '$now', '$now')";
                  $db->query($sql);
              } catch(PDOException $e) {
                  echo $e->getMessage();
              }

              $comics = array('data'=>array('200' => "New comic [$title] inserted."));
          } else {
              $comics = array('data'=>array('500' => 'Invalid Parameters'));
          }

      } else {
          $comics = array('data'=>array('500' => 'Invalid Request'));
      }

      $data = array('data' => $comics);
      $app->render('default.php', $data, 200);
  });


  // update existing comic - PUT method
  $app->put('/:id', function($request) use ($app, $db){
      $sql = "SELECT * FROM comics WHERE id = {$request}";
      $count = $db->query($sql)->fetch();
      $body = json_decode($app->request->getbody());

      $apiKey = $body->apiKey;
      $sever_apiKey = apiKey($body->user_id);

      if ($count && gettype($body) == 'object' && $apiKey == $sever_apiKey) {

          if (validateParams(get_object_vars($body))) {
              $title = $body->title;
              $publisher = $body->publisher;
              $price = $body->price;
              $now = date('Y-m-d H:i:s');

              try {
                  $sql = "UPDATE comics SET title = '$title', publisher = '$publisher', price = '$price', updatedAt = '$now' WHERE id = $request";
                  $db->query($sql);
              } catch(PDOException $e) {
                  echo $e->getMessage();
              }

              $comics = array('data'=>array('200' => "New comic [$title] inserted."));
          } else {
              $comics = array('data'=>array('500' => 'Invalid Parameters'));
          }

      } else {

          if (!$count) {
              $comics = array('data'=>array('404' => 'Not found'));
          } else {
              $comics = array('data'=>array('500' => 'Invalid Request'));
          }

      }

      $data = array('data' => $comics);
      $app->render('default.php', $data, 200);
  });


  // delete comic - DELETE {id} method
  $app->delete('/:id', function($request) use ($app, $db){
      $comics = array();
      $sql = "SELECT * FROM comics WHERE id = {$request}";
      $count = $db->query($sql)->fetch();
      $body = json_decode($app->request->getbody());

      $apiKey = $body->apiKey;
      $sever_apiKey = apiKey($body->user_id);

      if ($count && $apiKey == $sever_apiKey) {

          try {
              $sql = "DELETE FROM comics WHERE id = {$request}";
              $db->query($sql);
          } catch(PDOException $e) {
              echo $e->getMessage();
          }

      } else {
          $comics = array('data'=>array('404' => 'Not found'));
      }

      $data = array('data' => $comics);
      $app->render('default.php', $data, 200);
  });


});

$db = null;
$app->run();
