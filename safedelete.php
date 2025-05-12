<?php
session_start();
require_once __DIR__ . "/def.php";
// insert data
$results =[
  "status" => true,
  "message" => null,
];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  try {
    $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET;
    $db = new PDO($dsn, DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DELETE FROM SAFETY_REPORTS";

    $stmt = $db->prepare($sql);
    
    $stmt->execute();
    $db -> commit();
    $results["message"] = "削除しました。";
  } catch (PDOException $e) {
    $results["status"] = false;
    $results["message"] = "失敗しました: " . $e->getMessage();
  }
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h3>Message</h3>
  <div class="messagebox">
    <p><?=$results["message"]?></p>
  </div>
</body>
</html>