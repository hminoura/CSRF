<?php
$pdo = new PDO("sqlite:csrf.sqlite3");
$query = "CREATE TABLE IF NOT EXISTS shopping (user TEXT, password TEXT, kart TEXT)";
$pdo->exec($query);
$query = "DELETE FROM shopping";
$pdo->exec($query);

$messages = array(
    ["userA", "pass"],
    ["userB", "passpass"],
);

$query = "INSERT INTO shopping (user, password) VALUES (?, ?)";
$stmt = $pdo->prepare($query);
foreach($messages as $message) {
    $stmt->execute($message);
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  </head>
  <body>
    <p>データベースを初期化しました．</p>
    <a href="login.php">ログインページに戻る</a>
  </body>
</html>
