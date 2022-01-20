<?php
function getConnection(){
  try {
    $pdo = new PDO("mysql:host=localhost;dbname=bowlingbaan", 'root', '');
    return $pdo;
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
}

function insert($query, $parameters){
  try{
      $pdo = getConnection();
      $stmt = $pdo->prepare($query);
      return $stmt->execute($parameters);
  }catch(PDOException $e){
      echo "Error: ".$e->getMessage();
  }
}

function select($query){
  try{
      $pdo = getConnection();
      $stmt = $pdo->prepare($query);
      $stmt->execute();
      return $stmt;
  }catch(PDOException $e){
      echo "Error: ".$e->getMessage();
  }
}

function update($query, $parameters){
  try{
      $pdo = getConnection();
      $stmt = $pdo->prepare($query);
      $stmt->execute($parameters);
      return $stmt->execute($parameters);  
  }catch(PDOException $e){
      echo "Error: ".$e->getMessage();    
  }
}

function delete($query, $parameters){
  try{
      $pdo = getConnection();
      $stmt = $pdo->prepare($query);  
      return $stmt->execute($parameters);  
  }catch(PDOException $e){
      echo "Error: ".$e->getMessage();    
  }    
} 
?>