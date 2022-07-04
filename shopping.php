<?php
$pdo = new PDO("sqlite:csrf.sqlite3");

$user = null;
session_start();
if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
    $query = "SELECT kart FROM shopping WHERE user=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($user));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result)
        $kart = $result["kart"];

    if (isset($_REQUEST["item"])) {
        $kart = $kart . " " . $_REQUEST["item"];
        $query = "UPDATE shopping SET kart=? WHERE user=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array($kart, $user));
    }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  </head>
  <body>
    <h1>CSRFショッピング</h1>
<?php
if ($user) {
?>
    <p><?php echo $user; ?>さんログイン中</p>
    <h2>商品</h2>
    <form action="shopping.php" method="POST">
        <input type="radio" name="item" value="チョコ">チョコ<br>
        <input type="radio" name="item" value="ガム">ガム<br>
        <input type="submit" value="カートに追加">
    </form>

    <p>現在のカートの中身 : <?php echo $kart; ?></p>

    <a href="menu.php">メニューに戻る</a>
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
