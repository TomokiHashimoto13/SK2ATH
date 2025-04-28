<?php
session_start();
require_once __DIR__ . "/def.php";
$id = filter_input(INPUT_GET,"id");
// echo "id: $id";
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/sign-up.css">
    <title>Delete</title>
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
        <form action="./deletekakunin.php" method="POST">
            <h1 class="DUN">削除社員</h1>
            <?php foreach($result as $views):?>
            <div class="SUN">
                <div class="fake-input">
                    <input type="text" name="id" id="id" placeholder="社員番号" value="<?=$views["emp_no"]?>" readonly>
                    <img src="./images/username.jpg" width=50 />
                </div>
            </div>
            <div class="SUN">
                <div class="fake-input">
                    <input type="text" name="username" id="username" placeholder="氏名" value="<?=$views["emp_name"]?>" readonly>
                    <img src="./images/username.jpg" width=50 />
                </div>
            </div>
    <?php endforeach ?>
    <div class="DUN">
        <h2>保存する前に正しい情報を入力したことを確認してください。</h2>
      </div> 
            <button type="submit" id="B"><h1>削除</h1></button>
  
        </form>
      </div>
    </div>  
    </main>

</body>
</html>