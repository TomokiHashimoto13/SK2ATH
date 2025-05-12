<?php
session_start();
require_once __DIR__ . "/def.php";
$safety["safety_status"]=filter_input(INPUT_POST,"safety_status");
echo $safety["safety_status"];
if($safety["safety_status"] == "1"){
  $safety["injury"] = "0";
}else{
  $safety["injury"] = "1";
}

$safety["attendance_flag"]=filter_input(INPUT_POST,"attendance_flag");

$results =[
  "status" => true,
  "message" => null,
];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  try {
    $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET;
    $db = new PDO($dsn, DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Lấy ngày giờ hiện tại
    $now = date("Y-m-d H:i:s");
    $db->beginTransaction();
    $sql = "INSERT INTO SAFETY_REPORTS (
              emp_no,emp_name,safety_status,attendance_flag,injury,reported_at,updated_by,updated_at
            ) VALUES (
              :emp_no, :emp_name, :safety_status, :attendance_flag, :injury,:reported_at,:updated_by, :updated_at)";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(":emp_no", $_SESSION["userID"], PDO::PARAM_STR);
    $stmt->bindParam(":emp_name",$_SESSION["userName"], PDO::PARAM_STR);
    $stmt->bindValue(":safety_status",($safety["safety_status"] === "1")? 1: 0, PDO::PARAM_BOOL);
    $stmt->bindValue(":attendance_flag",($safety["attendance_flag"] === "1")? 1: 0, PDO::PARAM_BOOL);
    $stmt->bindValue(":injury",($safety["injury"] === "1")? 1: 0, PDO::PARAM_BOOL);
    $stmt->bindParam(":reported_at",$now, PDO::PARAM_STR);
    $stmt->bindParam(":updated_by", $_SESSION["userID"], PDO::PARAM_STR);
    $stmt->bindParam(":updated_at", $now);

    $stmt->execute();
    $db -> commit();
    $results["message"] = "社員情報を正常に登録しました。";
  } catch (PDOException $e) {
    $results["status"] = false;
    $results["message"] = "登録に失敗しました: " . $e->getMessage();
  }
}
$result = [];
try{
  $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET;

  $db = new PDO($dsn,DB_USER,DB_PASS);
  
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

  $db->beginTransaction();
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
      <li><a href="./safeEmp">HOME <img src="./images/home.jpg" width="50" alt="Home"></a></li>
      <li><a href="./logout.php">Logout <img src="./images/logout.svg" width="50" alt="Logout"></a></li>
    </ul>
  </div>
</header>

    <!-- Main -->
    <div class="table-responsive">
    <div class="main">
      <div class="employee-grid">
      <?php foreach($result as $viewData): ?>
        <div class="employee-card">
          <span><a href="./shousai.php?id=<?=$viewData["emp_no"]?>"><?=$viewData["emp_name"]?></a></span>
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
    </div>
    </div>
  </div>

  <script>
    function logout() {
      window.location.href = "安否情報確認.html";
    }

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
