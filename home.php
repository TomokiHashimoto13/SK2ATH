<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/home.css">
    <title>管理者用メニュー画面</title>
</head>
<body>
    <header>
        <div id="DP">
          <ul>
            <li id="L"><img src="./images/profile-circle-svgrepo-com.svg" width="200" alt="Profile"><p id="USER"><?= isset($_SESSION["userName"]) ? $_SESSION["userName"] : "" ?></p></li>
            <li><a href="">HOME <img src="./images/home.jpg" width="50" alt="Home"></a></li>
            <li><a href="">Setting</a></li>
            <li><a href="./logout.php">Logout <img src="./images/logout.svg" width="50" alt="Logout"></a></li>
          </ul>
        <div>
    </header>
    <main>
      <div class="table-responsive">
        <div class="bodybar">
            <div class="SUN">
                <div class="fake-input">
                  <a href="./empList.php">
                    <input type="button" value="社員一覧">
                  </a>
                </div>
            </div>
            <div class="SUN">
                <div class="fake-input">
                  <a href="./empHome.php">
                    <input type="button" value="安否登録">
                  </a>
                </div>
            </div>
            <div class="SUN">
                <div class="fake-input">
                  <a href="./safetyad.php">
                    <input type="button" value="安否一覧">
                  </a>
                </div>
            </div>
            <div class="SUN">
                <div class="fake-input">
                  <a href="./newEmp.php">
                    <input type="button" value="社員新規登録">
                  </a>
                </div>
            </div>
        </div>
      </div>
    </main>
</body>
</html>