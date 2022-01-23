<?php

function insert($pdo, $query, $parameters){
  try{
      $stmt = $pdo->prepare($query);
      return $stmt->execute($parameters);
  } catch(PDOException $e){
      echo "Error: ".$e->getMessage();
  }
}

function selectAll($pdo, $query){
  try{
      $stmt = $pdo->prepare($query);
      $stmt->execute();
      return $stmt;
  } catch(PDOException $e){
      echo "Error: ".$e->getMessage();
  }
}

function select($pdo, $query, $parameters){
  try{
      $stmt = $pdo->prepare($query);
      $stmt->execute($parameters);
      return $stmt;
  } catch(PDOException $e){
      echo "Error: ".$e->getMessage();
  }
}

function update($pdo, $query, $parameters){
  try{
      $stmt = $pdo->prepare($query);
      $stmt->execute($parameters);
      return $stmt->execute($parameters);  
  } catch(PDOException $e){
      echo "Error: ".$e->getMessage();    
  }
}

function delete($pdo, $query, $parameters){
  try{
      $stmt = $pdo->prepare($query);  
      return $stmt->execute($parameters);  
  } catch(PDOException $e){
      echo "Error: ".$e->getMessage();    
  }    
}
