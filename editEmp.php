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
  <title>Edit Employee</title>
</head>
<body>
    <form action="./editkakunin.php" method="POST">
    <h3>修正社員</h3>
    <?php foreach($result as $views):?>
      <div>
        <label for="id">社員番号:</label>
        <input type="text" name="id" id="id" value="<?=$views["emp_no"]?>" readonly>
      </div>
      <div>
        <label for="username">氏名:</label>
        <input type="text" name="username" id="username" value="<?=$views["emp_name"]?>">
      </div>
      <div>
        <p id="adminsList">管理者:</p>

        <label for="yesad">はい:</label>
        <input type="radio" name="adminsQ" id="yesad" value="true" <?php echo ($views["is_admin"] == true ?'checked':''); ?>>

        <label for="noad">いいえ  :</label>
        <input type="radio" name="adminsQ" id="noad" value="false" <?php echo ($views["is_admin"] == false ?'checked':''); ?>>
      </div>
      <div>
        <label for="status">役職:</label>
        <input type="text" name="status" id="status" value="<?=$views["status"]?>">
      </div>
      <div>
        <label for="department">部署:</label>
        <input type="radio" name="department" id="department1" value="001" <?php echo ($views["department"] == '001' ?'checked':''); ?>>
        <input type="radio" name="department" id="department2" value="002" <?php echo ($views["department"] == '002' ?'checked':''); ?>>
        <input type="radio" name="department" id="department3" value="003" <?php echo ($views["department"] == '003' ?'checked':''); ?>>
        <input type="radio" name="department" id="department4" value="004" <?php echo ($views["department"] == '004' ?'checked':''); ?>>
        <input type="radio" name="department" id="department5" value="005" <?php echo ($views["department"] == '005' ?'checked':''); ?>> 
      </div>
      <div>
        <label for="phone-no">電話番号:</label>
        <input type="tel" name="phone-no" id="phone-no" value="<?=$views["phone_no"]?>">
      </div>
      <div>
        <label for="address">住所:</label>
        <input type="text" name="address" id="address" value="<?=$views["address"]?>">
      </div>
      <div>
        <label for="password">パスワード:</label>
        <input type="password" name="password" id="password" value="<?=$views["passwords"]?>">
      </div>
      <div>
        <p id="delflaglist">削除フラグ:</p>

        <label for="delflag">はい:</label>
        <input type="radio" name="delflag" id="delflag" value="true" <?php echo ($views["del_flag"] == true ?'checked':''); ?>>

        <label for="undelflag">いいえ  :</label>
        <input type="radio" name="delflag" id="undelflag" value="false" <?php echo ($views["del_flag"] == false ?'checked':''); ?>>
      </div>
      <div>
        <label for="adminsN">更新者:</label>
        <input type="text" name="adminsN" id="adminsN" value="<?=$_SESSION["userName"]?>" readonly>
      </div>
      <?php endforeach ?>
      <div class="messagebox">
        <p>保存する前に正しい情報を入力したことを確認してください。</p>
      </div>
      <div>
        <button type="submit" id="saveBtn">Edit</button>
      </div>
    </form>
</body>
</html>