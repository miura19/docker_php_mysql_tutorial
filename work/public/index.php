<?php

require_once(__DIR__ . '/../app/config.php');

createToken();

$pdo = getPdoInstance();

$todos = getTodos($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  validateToken();
  $action = filter_input(INPUT_GET,'action');
  switch($action){
    case 'add':
      postTodos($pdo);
      break;
    case 'toggle':
      toggleTodos($pdo);  
      break;
  }

  header('Location:' . SITE_URL);
  exit;
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>My Todos</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <h1>Todos</h1>
  <form action="?action=add" method="post">
    <input type="text" name="title">
    <input type="hidden" name="token" value="<?php echo h($_SESSION['token'])?>">
  </form>
  <ul>
    <?php foreach($todos as $todo): ?>
    <li>
      <form action="?action=toggle" method="post">
        <input type="checkbox" <?php echo $todo->is_done == 1 ? 'checked' : ''?> >
        <input type="hidden" name="id" value="<?php echo h($todo->id)?>">
        <input type="hidden" name="token" value="<?php echo h($_SESSION['token'])?>">
      </form>
      <span class="<?php echo $todo->is_done == 1 ? 'done' : ''?>">
      <?php echo h($todo->title)?></span>
    </li>
    <?php endforeach; ?>
  </ul>
  <script src="js/main.js"></script>
</body>
</html>