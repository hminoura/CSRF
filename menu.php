<?php
$user = null;
session_start();
if (isset($_SESSION["user"]))
    $user = $_SESSION["user"];
    
if (isset($_POST["user"]) && isset($_POST["password"])) {
    $pdo = new PDO("sqlite:csrf.sqlite3");
    $query = "SELECT * FROM shopping WHERE user=? AND password=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($_POST["user"], $_POST["password"]));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $user = $_POST["user"];
        
        $_SESSION["user"] = $user;
    }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  </head>
  <body>
    <h1>ショッピング</h1>
<?php
if ($user) {
?>
    <p><?php echo $user; ?>さんログイン中</p>
    <h2>メニュー</h2>
    <ul>
      <li><a href="shopping.php">ショッピング</a></li>
      <li><a href="logout.php">ログアウト</a></li>
    </ul>
<?php
} else {
?>
    <p>ログインエラー</p>
    <a href="login.php">ログイン画面に戻る</a>

<?php  
}
?>
  </body>
</html>
