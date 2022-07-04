<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  </head>
  <body>
    <h1>ショッピング</h1>
    <h2>ログイン</h2>
    <form action="menu.php" method="POST">
        <label>user:</label>
        <input type="text" name="user">
        <label>password:</label>
        <input type="password" name="password">
        <input type="submit" value="login">
    </form>

    <hr>
    <h3>（データベースのユーザ情報）</h3>
<?php
$pdo = new PDO("sqlite:csrf.sqlite3");
$query = "SELECT * FROM shopping";
$stmt = $pdo->prepare($query);
if ($stmt) {
    $stmt->execute();
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC))
        printf("    <p>user: %s, password: %s, kart: %s</p>\n",
               $result["user"], $result["password"], $result["kart"]);
} else
    print("    <p>データベースの初期化をしてください</p>\n");
?>
    <a href="setupDB.php">データベースの初期化</a>
  </body>
</html>
