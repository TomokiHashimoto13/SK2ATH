<?php
session_start();
require_once __DIR__ . "/def.php";
//check data
$employee = [];
$employee["id"] = filter_input(INPUT_POST,"id");
$employee["username"] = filter_input(INPUT_POST,"username");
$employee["adminsQ"] = filter_input(INPUT_POST,"adminsQ");
$employee["status"] = filter_input(INPUT_POST,"status");
$employee["department"] = filter_input(INPUT_POST,"department");
$employee["phone-no"] = filter_input(INPUT_POST,"phone-no");
$employee["address"] = filter_input(INPUT_POST,"address");
$employee["password"] = filter_input(INPUT_POST,"password");
$employee["delflag"] = filter_input(INPUT_POST,"delflag");
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

    // Lấy ngày giờ hiện tại
    $now = date("Y-m-d H:i:s");

    $sql = "INSERT INTO employee (
              emp_no, emp_name, is_admin, status, department,
              phone_no, address, passwords, del_flag,
              updated_by, updated_at
            ) VALUES (
              :emp_no, :emp_name, :is_admin, :status, :department,
              :phone_no, :address, :passwords, :del_flag,
              :updated_by, :updated_at
            )";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(":emp_no", $employee["id"], PDO::PARAM_STR);
    $stmt->bindParam(":emp_name", $employee["username"], PDO::PARAM_STR);
    $stmt->bindValue(":is_admin", ($employee["adminsQ"] === "1")? 1: 0, PDO::PARAM_BOOL);
    $stmt->bindParam(":status", $employee["status"], PDO::PARAM_STR);
    $stmt->bindParam(":department", $employee["department"], PDO::PARAM_STR);
    $stmt->bindParam(":phone_no", $employee["phone-no"], PDO::PARAM_STR);
    $stmt->bindParam(":address", $employee["address"], PDO::PARAM_STR);
    $stmt->bindParam(":passwords", $employee["password"], PDO::PARAM_STR);
    $stmt->bindValue(":del_flag", ($employee["delflag"] === "1")? 1: 0, PDO::PARAM_BOOL);
    $stmt->bindParam(":updated_by", $_SESSION["userID"], PDO::PARAM_STR);
    $stmt->bindParam(":updated_at", $now);

    $stmt->execute();
    $db->commit();
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
  <link rel="stylesheet" href="./CSS/kakunin.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>登録確認</title>
</head>
<body>
<main>
<body>
    <header>
        <div id="DP">
          <ul>
            <li id="L"><img src="./images/profile-circle-svgrepo-com.svg" width="200" alt="Profile"><p id="USER"><?= isset($_SESSION["userName"]) ? $_SESSION["userName"] : "" ?></p></li>
            <li><a href="">HOME <img src="./images/home.jpg" width="50" alt="Home"></a></li>
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