<?php
$user = null;
session_start();
if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
    session_destroy();
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
    <p><?php echo $user; ?>さんログアウトしました</p>
    <a href="login.php">ログインメニューへ</a>
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
