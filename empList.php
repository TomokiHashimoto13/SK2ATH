<?php
session_start();
require_once __DIR__ . "/def.php";
$result = [];
try{
  $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET;

  $db = new PDO($dsn,DB_USER,DB_PASS);
  
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

  
  $sql = "SELECT * FROM EMPLOYEE";

  $stmt = $db->prepare($sql);
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="./CSS/employee1.css">
  <title>EMPLOYEE for ADMIN</title>
</head>
<body>
<main>
    <div id="DP">
      <ul>
        <li id="L"><img src="./images/profile-circle-svgrepo-com.svg" width="200" alt="Profile"><p id="USER"><?= isset($_SESSION["userName"]) ? $_SESSION["userName"] : "" ?></p></li>
        <li><a href="">HOME <img src="./images/home.jpg" width="50" alt="Home"></a></li>
        <li><a href="">Setting</a></li>
        <li><a href="./logout.php">Logout <img src="./images/logout.svg" width="50" alt="Logout"></a></li>
      </ul>

      <div class="table-responsive">
      <h3 id="T" >EMPLOYEE LIST FOR ADMIN</h3>
    <div>
      <button id="B" type="button"><a href="./newEmp.php">新規</a></button>
    </div>
        <table class="table">
          <thead>
            <tr>
              <th>社員番号</th>
              <th>氏名</th>
              <th>管理者</th>
              <th>役職</th>
              <th>部署</th>
              <th>電話番号</th>
              <th>住所</th>
              <th>パスワード</th>
              <th>削除フラグ</th>
              <th>更新者</th>
              <th>更新日時</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
          <?php foreach($result as $views):?>
        <tr>
          <td><?=$views["emp_no"]?></td>
          <td><?=$views["emp_name"]?></td>
          <td><?=$views["is_admin"]?></td>
          <td><?=$views["status"]?></td>
          <td><?=$views["department"]?></td>
          <td><?=$views["phone_no"]?></td>
          <td><?=$views["address"]?></td>
          <td><?=$views["passwords"]?></td>
          <td><?=$views["del_flag"]?></td>
          <td><?=$views["updated_by"]?></td>
          <td><?=$views["updated_at"]?></td>
          <td class="action-cell">
            <button class="edit-btn" title="edit"><a href="./editEmp.php?id=<?=$views["emp_no"]?>"><i class="fas fa-pen"></i></a></button>
            <button class="delete-btn" title="delete"><a href="./deleteEmp.php?id=<?=$views["emp_no"]?>"><i class="fas fa-trash-alt"></i></a></button>
          </td>
        </tr>
        <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <footer>

  </footer>
</body>
</html>