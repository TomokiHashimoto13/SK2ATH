<?php
session_start();
require_once __DIR__ . "/def.php";
//check data
$id = filter_input(INPUT_GET,"id");
$result = [];
try{
  $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET;

  $db = new PDO($dsn,DB_USER,DB_PASS);
  
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

  
  $sql = "SELECT * FROM SAFETY_REPORTS WHERE emp_no =:id";

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
  <title>社員安否詳細画面</title>
  <link rel="stylesheet" href="./CSS/shousai.css">
  <link rel="stylesheet" href="./CSS/home.css">
</head>
<body>
  <div class="container">
    <header>
  <div id="DP">
    <!-- Hamburger Menu Button (Only visible on mobile) -->
    <button class="menu-toggle">☰ Menu</button>

    <!-- Sidebar -->
    <ul id="sidebar">
      <li id="L">
        <img src="./images/profile-circle-svgrepo-com.svg" width="200" alt="Profile">
        <p id="USER"><?= isset($_SESSION["userName"]) ? $_SESSION["userName"] : "" ?></p>
      </li>
      <li><a href="./safeEmp.php">HOME <img src="./images/home.jpg" width="50" alt="Home"></a></li>
      <li><a href="./logout.php">Logout <img src="./images/logout.svg" width="50" alt="Logout"></a></li>
    </ul>
  </div>
</header>
    <!-- Main -->
    <div class="table-responsive">
      <div class="main">
        <div class="employee-header">
          <?php foreach($result as $viewData): ?>
          <span><?=$viewData["emp_name"]?></span>
          <?php if($viewData["safety_status"] == true && $viewData["attendance_flag"] == true ):?>
          <div class="status status-green"></div>
        </div>
            <div class="status-box">
              <div class="status-option">
                <div class="dot"></div>
                <div class="option-label">出勤可</div>
              </div>
              <div class="status-option">
                <div class="dot"></div>
                <div class="option-label">怪我なし</div>
              </div>
            </div>
          <?php elseif($viewData["injury"] == true && $viewData["attendance_flag"] == true ):?>
            <div class="status status-yellow"></div>
      </div>
            <div class="status-box">
              <div class="status-option">
                <div class="dot"></div>
                <div class="option-label">出勤可</div>
              </div>
              <div class="status-option">
                <div class="dot"></div>
                <div class="option-label">怪我あり</div>
              </div>
            </div>
          <?php elseif($viewData["injury"] == true && $viewData["attendance_flag"] == false ):?>
            <div class="status status-red"></div>
    </div>
            <div class="status-box">
              <div class="status-option">
                <div class="dot"></div>
                <div class="option-label">出勤不可</div>
              </div>
              <div class="status-option">
                <div class="dot"></div>
                <div class="option-label">怪我あり</div>
              </div>
            </div>
          <?php else: ?>
            <div class="status status-gray"></div>
      </div>
          <?php endif ?>
        </div>
      <?php endforeach ?>
      </div>
    </div>
  </div>
  <script>
    
      document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.querySelector(".menu-toggle");
    const sidebar = document.getElementById("sidebar");

    
    toggleBtn.addEventListener("click", function (e) {
      e.stopPropagation(); 
      sidebar.classList.toggle("active");
    });

    
    document.addEventListener("click", function (event) {
     
      if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
        sidebar.classList.remove("active");
      }
    });
  });
  </script>
</body>
</html>
