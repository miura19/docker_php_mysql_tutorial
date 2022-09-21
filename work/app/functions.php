<?php

function getPdoInstance()
{
    try{
        $pdo = new PDO(
            DSN,DB_USER,DB_PASS,
            [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES => false
            ],
        );
        return $pdo;

    } catch(PDOException $e){
    echo $e->getMessage();
    exit;
    }
}

function getTodos($pdo)
{
  $stmt = $pdo->query('SELECT * FROM todos ORDER BY id DESC');
  $todos = $stmt->fetchAll();
  return $todos;
}

function postTodos($pdo)
{
  $title = trim(filter_input(INPUT_POST, 'title'));
  if ($title === ''){
    return;
  }
  $sql = "INSERT INTO todos (title) VALUES (:title)";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(":title",$title,PDO::PARAM_STR);
  $stmt->execute();
}

function toggleTodos($pdo)
{
    $id = filter_input(INPUT_POST,'id');
    if (empty($id)){
        return;
    }

    $sql = "UPDATE todos SET is_done = NOT is_done WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id",$id,PDO::PARAM_INT);
    $stmt->execute();
}

function createToken()
{
  if(!isset($_SESSION['token'])){
    $_SESSION['token'] = bin2hex(random_bytes(32)); 
  }
}

function validateToken()
{
  if(empty($_SESSION['token']) || $_SESSION['token'] !== filter_input(INPUT_POST, 'token')) {
    exit('Invalid post request!!');
  }
}

function h($str)
{
  return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
}
