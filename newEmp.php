<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/sign-up.css">
     <link rel="stylesheet" href="./CSS/home.css">
    <title>管理者用-社員登録</title>
</head>
<body>
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
      <li><a href="./home.php">HOME <img src="./images/home.jpg" width="50" alt="Home"></a></li>
      <li><a href="">Setting</a></li>
      <li><a href="./logout.php">Logout <img src="./images/logout.svg" width="50" alt="Logout"></a></li>
    </ul>
  </div>
</header>
<main>
   
        <div class="title">
          <h2>社員登録</h2>
        </div>
        <form action="./newkakunin.php" method="POST">
            <div class="SUN">
                <div class="fake-input">
                    <input type="text" name="id" id="id" placeholder="社員番号" required>
                    <img src="./images/username.jpg" width=50 />
                </div>
            </div>
            <div class="SUN">
                <div class="fake-input">
                    <input type="text" name="username" id="username" placeholder="氏名" required>
                    <img src="./images/username.jpg" width=50 />
                </div>
            </div>

            <div class="DUN">
                <h1 id="delflaglist">管理者:</h1>
                <div class="radio-group">
                  <label class="radio-option" for="yesad">
                    <input type="radio" name="adminsQ" id="yesad" value="1" required>
                    <span>はい</span> 
                  </label>
            
                  <label class="radio-option" for="noad">
                    <input type="radio" name="adminsQ" id="noad" value="0" required>
                    <span>いいえ</span> 
                  </label>
                </div>
              </div>
            
    
            <div class="SUN">
                <div class="fake-input">
                    <input type="text" name="status" id="status" placeholder="役職" required>
                </div>
            </div>
            
            <div class="SUN">
              <div class="fake-input">
                <input list="browsers" name="department" id="department1" placeholder="部署" required>

                <datalist id="browsers" >
                  <option value="001">総務部</option>
                  <option value="002">人事部</option>
                  <option value="003">開発部</option>
                  <option value="004">営業部</option>
                  <option value="005">DX戦略部</option>
                </datalist> 
                  <img src="./images/departmant.svg" width=50 />
              </div>
          </div>
            
            <div class="SUN">
                <div class="fake-input">
                    <input type="tel" name="phone-no" id="phone-no" placeholder="電話番号" required>
                    <img src="./images/phone.png" width=50 />
                </div>
            </div>
            <div class="SUN">
                <div class="fake-input">
                    <input type="text" name="address" id="address" placeholder="住所" required>
                    <img src="./images/address1.webp" width=50 />
                </div>
            </div>
            <div class="SUN">
                <div class="fake-input">
                    <input type="password" name="password" id="password" placeholder="パスワード" required>
                    <img src="./images/lock-icon-png-14.png" width=50 />
                </div>
            </div>
            <div class="DUN">
                <h1 id="delflaglist">削除フラグ:</h1>
                <div class="radio-group">
                  <label class="radio-option" for="delflag">
                    <input type="radio" name="delflag" id="delflag" value="1" required>
                    <span>はい</span> 
                  </label>
            
                  <label class="radio-option" for="undelflag">
                    <input type="radio" name="delflag" id="undelflag" value="0" required>
                    <span>いいえ</span> 
                  </label>
                </div>
              </div>
      <div class="SUN">
        <div class="fake-input">
            <input type="text" name="adminsN" id="adminsN" placeholder="更新者" value="<?=$_SESSION["userName"]?>" readonly>
        </div>
    </div>
    <div class="DUN">
        <h2>保存する前に正しい情報を入力したことを確認してください。</h2>
      </div>

            
            <button type="submit" id="B"><h1>Sign-UP</h1></button>

           
        </form>
      </div>
    </div>  
        
          
    

    </main>
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