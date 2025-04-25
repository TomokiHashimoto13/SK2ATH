<?php
session_start();
require_once __DIR__ . "/def.php";
$id = filter_input(INPUT_GET,"id");
echo "id: $id";
$result = [];
try{
  $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET;

  $db = new PDO($dsn,DB_USER,DB_PASS);
  
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

  
  $sql = "SELECT * FROM EMPLOYEE WHERE emp_no =:id";

  $stmt = $db->prepare($sql);
  $stmt->bindParam(":id", $id, PDO::PARAM_STR);
  $stmt->execute();
  while($rows = $stmt ->fetch(PDO::FETCH_ASSOC)){
    $result[] = $rows;
  }
}catch(PDOException $poe){
  exit ("DBError".$poe->getMessage());
}finally{

  $stmt = null;
  $db = null;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delete Employee</title>
</head>
<body>
  <form action="./deletekakunin.php" method="POST">
    <h3>削除社員</h3>
    <?php foreach($result as $views):?>
      <div>
        <label for="id">社員番号:</label>
        <input type="text" name="id" id="id" value="<?=$views["emp_no"]?>" readonly>
      </div>
      <div>
        <label for="username">氏名:</label>
        <input type="text" name="username" id="username" value="<?=$views["emp_name"]?>" readonly>
      </div>
      <?php endforeach ?>
      <div class="messagebox">
        <p>保存する前に正しい情報を入力したことを確認してください。</p>
      </div>
      <div>
        <button type="submit" id="saveBtn">Delete</button>
      </div>
    </form>
</body>
</html>