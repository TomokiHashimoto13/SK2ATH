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

    $sql = "UPDATE EMPLOYEE
            SET emp_name = :emp_name,
                is_admin = :is_admin,
                status = :status,
                department = :department,
                phone_no = :phone_no,
                address = :address,
                passwords = :passwords,
                del_flag = :del_flag,
                updated_by = :updated_by,
                updated_at = :updated_at
            WHERE emp_no = :emp_no";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(":emp_no", $employee["id"], PDO::PARAM_STR);
    $stmt->bindParam(":emp_name", $employee["username"], PDO::PARAM_STR);
    $stmt->bindValue(":is_admin", $employee["adminsQ"], PDO::PARAM_BOOL);
    $stmt->bindParam(":status", $employee["status"], PDO::PARAM_STR);
    $stmt->bindParam(":department", $employee["department"], PDO::PARAM_STR);
    $stmt->bindParam(":phone_no", $employee["phone-no"], PDO::PARAM_STR);
    $stmt->bindParam(":address", $employee["address"], PDO::PARAM_STR);
    $stmt->bindParam(":passwords", $employee["password"], PDO::PARAM_STR);
    $stmt->bindValue(":del_flag", $employee["delflag"], PDO::PARAM_BOOL);
    $stmt->bindParam(":updated_by", $_SESSION["userID"], PDO::PARAM_STR);
    $stmt->bindParam(":updated_at", $now);

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