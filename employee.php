<?php
session_start();
require_once __DIR__."/../def.php";
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
  <title>EMPLOYEE</title>
</head>
<body>
  <header>
    <h3>EMPLOYEE LIST</h3>
  </header>
  <main>
    <table>
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
        </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </main>
  <footer>

  </footer>
</body>
</html>