<?php
session_start();
require_once __DIR__."/../def.php";
$result = [];
// try{
//   $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET;

//   $db = new PDO($dsn,DB_USER,DB_PASS);
  
//   $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

  
//   $sql = "SELECT * FROM EMPLOYEE";

//   $stmt = $db->prepare($sql);
//   $stmt->execute();
//   while($rows = $stmt ->fetch(PDO::FETCH_ASSOC)){
//     $result[] = $rows;
//   }
// }catch(PDOException $poe){
//   exit ("DBError".$poe->getMessage());
// }finally{

//   $stmt = null;
//   $db = null;
// }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Employee Ad</title>
</head>
<body>
    <form action="./kakunin.php" method="POST">
      <h3>New Employee</h3>
      <div>
        <label for="id">社員番号:</label>
        <input type="text" name="id" id="id">
      </div>
      <div>
        <label for="username">氏名:</label>
        <input type="text" name="username" id="username">
      </div>
      <div>
        <p id="safetyList">安否:</p>

        <label for="safety">はい:</label>
        <input type="radio" name="safety" id="safety" value="1">

        <label for="unsafe">いいえ  :</label>
        <input type="radio" name="safety" id="unsafe" value="2">
      </div>
      <div>
        <label for="status">役職:</label>
        <input type="text" name="status" id="status">
      </div>
      <div>
        <label for="department">部署:</label>
        <input type="text" name="department" id="department">
      </div>
      <div>
        <label for="phone-no">電話番号:</label>
        <input type="tel" name="phone-no" id="phone-no">
      </div>
      <div>
        <label for="address">住所:</label>
        <input type="text" name="address" id="address">
      </div>
      <div>
        <label for="password">パスワード:</label>
        <input type="password" name="password" id="password">
      </div>
      <div>
        <button type="submit" id="saveBtn">保存</button>
      </div>
    </form>
</body>
</html>