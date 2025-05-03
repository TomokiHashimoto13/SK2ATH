<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/employeehome.css">
    <title>安否情報登録</title>
</head>
<body>
    <ul>
        <li><img src="./images/profile-circle-svgrepo-com.svg" width="200" alt="Profile"><p id="USER"><?= isset($_SESSION["userName"]) ? $_SESSION["userName"] : "" ?></p></li>
        <li><a href="./logout.php">Logout <img src="./images/logout.svg" width="50" alt="Logout"></a></li>
    </ul>
    <p>安否情報登録</p>
    <form action="./safeEmp.php" method="POST">
      <div class="div">
          <div class="div1">
              <label for="card"></label>
              <select name="safety_status" id="safety_status">
                <option value="1">生存</option>
                <option value="0">怪我</option>
              </select>
          </div>

          <div class="div2">
              <label for="attendance_flag"></label>
              <select name="attendance_flag" id="attendance_flag">
                <option value="1">出勤可</option>
                <option value="0">出勤不可</option>
              </select>
          </div>
          <button type="submit" class="ss">送信</button>

      </div>
  </form>
    
</body>
</html>