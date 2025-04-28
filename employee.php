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
  <link rel="stylesheet" href="./CSS/employee.css">
  <title>EMPLOYEE</title>
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
        <h3 id="T">EMPLOYEE LIST</h3>
        <table class="table">
          <thead>
            <tr>
              <th>社員番号</th>
              <th>氏名</th>
              <th>管理者</th>
              <th>役職</th>
              <th>部署</th>
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