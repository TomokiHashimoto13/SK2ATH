<?php
session_start();
require_once __DIR__ . "/def.php";
//check data
$employee["id"] = filter_input(INPUT_POST,"id");
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

    $sql = "DELETE FROM employee
            WHERE emp_no =:emp_no";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(":emp_no", $employee["id"], PDO::PARAM_STR);
    
    $stmt->execute();
    $db -> commit();
    $results["message"] = "社員情報を正常に登録しました。";
  } catch (PDOException $e) {
    $results["status"] = false;
    $results["message"] = "登録に失敗しました: " . $e->getMessage();
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