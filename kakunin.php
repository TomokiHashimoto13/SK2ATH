<?php
$employee = [];
$employee["id"] = filter_input(INPUT_POST,"id");
$employee["username"] = filter_input(INPUT_POST,"username");
$employee["safety"] = filter_input(INPUT_POST,"safety");
$employee["status"] = filter_input(INPUT_POST,"status");
$employee["department"] = filter_input(INPUT_POST,"department");
$employee["phone-no"] = filter_input(INPUT_POST,"phone-no");
$employee["address"] = filter_input(INPUT_POST,"address");
$employee["password"] = filter_input(INPUT_POST,"password");
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="kakunin.php" method="POST">
    <h3>New Employee</h3>
    <div>
      <label for="id">社員番号:</label>
      <input type="text" name="id" id="id" value=<?=$employee["id"]?>>
    </div>
    <div>
      <label for="username">氏名:</label>
      <input type="text" name="username" id="username" value=<?=$employee["username"]?>>
    </div>
    <div>
      <label for="safety">安否:</label>
      <input type="text" name="safety" id="safety" 
      value=
      <?php if($employee["safety"] == "1"){
        echo "はい";
      }else{
          echo "いいえ";
      }
        ?> >
    </div>
    <div>
      <label for="status">役職:</label>
      <input type="text" name="status" id="status" value=<?=$employee["status"]?>>
    </div>
    <div>
      <label for="department">部署:</label>
      <input type="text" name="department" id="department" value=<?=$employee["department"]?>>
    </div>
    <div>
      <label for="phone-no">電話番号:</label>
      <input type="tel" name="phone-no" id="phone-no" value=<?=$employee["phone-no"]?>>
    </div>
    <div>
      <label for="address">住所:</label>
      <input type="text" name="address" id="address" value=<?=$employee["address"]?>>
    </div>
    <div>
      <label for="password">パスワード:</label>
      <input type="text" name="password" id="password" value=<?=$employee["password"]?>>
    </div>
    <div>
      <button type="submit" id="saveBtn">保存</button>
    </div>
  </form>
</body>
</html>