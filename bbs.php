<?php
$pdo = new PDO("sqlite:csrf.sqlite3");
$query = "INSERT INTO bbs (datetime, message) VALUES (?, ?)";
$stmt = $pdo->prepare("SELECT * from sqlite_master where name='bbs'");
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$result || isset($_POST["reset"]))
    setupDB($pdo);

if (isset($_POST["msg"])) {
    $query = "INSERT INTO bbs (datetime, message) VALUES (?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array(date("Y/m/d(D) H:i:s"), $_POST["msg"]));
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <style type="text/css">td {border: solid green 1px;}</style>
  </head>
  <body>
    <h1 id="title">XSS口コミ掲示板</h1>
    <a id="top" href="http://www.suzuka-ct.ac.jp">鈴鹿高専</a>
    <form action="bbs.php" method="POST">
      <label>メッセージ</label><br>
      <textarea name="msg" cols="60" rows="2"></textarea>
      <input type="submit" value="投稿">
    </form>
    <table>
<?php
$query = "SELECT * FROM bbs ORDER BY id";
$stmt = $pdo->prepare($query);
$stmt->execute();

while ($result = $stmt->fetch(PDO::FETCH_ASSOC))
    print("      <tr><td>" . $result["datetime"] . "</td><td>" . $result["message"] . "</td></tr>\n");
?>
    </table>
    <a href="bbs.php">再読み込み</a>
    <hr>
    <form action="bbs.php" method="POST">
       <input type="hidden" name="reset" value="true">
       <input type="submit" value="データベースのリセット">
    </form>
  </body>
</html>
        
<?php
               function setupDB($pdo) {
                   $query = "CREATE TABLE IF NOT EXISTS bbs (id INTEGER PRIMARY KEY, datetime TEXT, message TEXT)";
                   $pdo->exec($query);
                   $query = "DELETE FROM bbs";
                   $pdo->exec($query);
                   
                   $messages = array(
                       [date("Y/m/d(D) H:i:s", strtotime("-10 min")), "ここのチョコは絶品"],
                       [date("Y/m/d(D) H:i:s"), "珍しいガムでした"],
                   );
                   
                   $query = "INSERT INTO bbs (datetime, message) VALUES (?, ?)";
                   $stmt = $pdo->prepare($query);
                   foreach($messages as $message) {
                       $stmt->execute($message);
                   }
               }
 ?>
