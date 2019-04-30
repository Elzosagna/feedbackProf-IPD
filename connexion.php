<?php
function connect(){
  $connection=NULL;
  try {
    $connection=new PDO('mysql:host=localhost;dbname=ipd','root');
    $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    return $connection;

  } catch (Exception $e) {
    die('Erreure lors de la connection à la base de données:'.$e->getMessage());
    return -1;
  }
};
 ?>
