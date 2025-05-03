<?php
session_start();
require_once __DIR__ . "/def.php";
$result = [];
try{
  $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET;

  $db = new PDO($dsn,DB_USER,DB_PASS);
  
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

  
  $sql = "SELECT * FROM SAFETY_REPORTS";

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
  <title>社員安否一覧画面</title>
  <link rel="stylesheet" href="./CSS/safetyad.css">
  <link rel="stylesheet" href="./CSS/home.css">
</head>
<body>
  <div class="container">
    <!-- Sidebar -->
    <div id="DP">
          <ul>
            <li id="L"><img src="./images/profile-circle-svgrepo-com.svg" width="200" alt="Profile"><p id="USER"><?= isset($_SESSION["userName"]) ? $_SESSION["userName"] : "" ?></p></li>
            <li><a href="">HOME <img src="./images/home.jpg" width="50" alt="Home"></a></li>
            <li><a href="">Setting</a></li>
            <li><a href="./logout.php">Logout <img src="./images/logout.svg" width="50" alt="Logout"></a></li>
          </ul>
        <div>

    <!-- Main -->
    <div class="table-responsive">
      <form action="./safedelete.php" method = "POST">
        <div class="main">
          <div class="employee-grid">
            <?php foreach($result as $viewData): ?>
              <div class="employee-card">
                <span><a href="./shousaiAd.php?id=<?=$viewData["emp_no"]?>"><?=$viewData["emp_name"]?></a></span>
                <?php if($viewData["safety_status"] == true && $viewData["attendance_flag"] == true ):?>
                  <div class="status status-green"></div>
                <?php elseif($viewData["injury"] == true && $viewData["attendance_flag"] == true ):?>
                  <div class="status status-yellow"></div>
                <?php elseif($viewData["injury"] == true && $viewData["attendance_flag"] == false ):?>
                  <div class="status status-red"></div>
                <?php else: ?>
                  <div class="status status-gray"></div>
                <?php endif ?>   
              </div>
            <?php endforeach ?>
            </div>
            <div  class="sdelBtn">
              <button type="submit">安否情報削除</button>
            </div>
          </div>
        </div>
      </form>
    </div>

  <script>
    function logout() {
      window.location.href = "安否情報確認.html";
    }
  </script>
</body>
</html>
