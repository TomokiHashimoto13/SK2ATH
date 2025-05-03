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
    $results["message"] = "成功しました。";
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
  <link rel="stylesheet" href="./CSS/kakunin.css">
  <title>削除確認</title>
</head>
<body>
    <header>
        <div id="DP">
          <ul>
            <li id="L"><img src="./images/profile-circle-svgrepo-com.svg" width="200" alt="Profile"><p id="USER"><?= isset($_SESSION["userName"]) ? $_SESSION["userName"] : "" ?></p></li>
            <li><a href="./home.php">HOME <img src="./images/home.jpg" width="50" alt="Home"></a></li>
            <li><a href="">Setting</a></li>
            <li><a href="./logout.php">Logout <img src="./images/logout.svg" width="50" alt="Logout"></a></li>
          </ul>
        <div>
    </header>
    <main>
      <div class="table-responsive">
        <div class="kakuninbox">
          <h2>Message</h2>
          <div class="messagebox">
            <p><?=$results["message"]?></p>
          </div>
          <div class="backBtn">
            <button><a href="./empList.php">社員一覧画面</a></button>
          </div>
        </div>
      </div>
    </main>
</body>
</html>