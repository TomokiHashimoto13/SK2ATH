<?php
session_start();
require_once __DIR__ . "/def.php";
$id = filter_input(INPUT_GET,"id");
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
    <title>Edit</title>
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
        <form action="./editkakunin.php" method="POST">
            <h1 class="DUN">修正社員</h1>
            <?php foreach($result as $views):?>
            <div class="SUN">
                <div class="fake-input">
                    <input type="text" name="id" id="id" placeholder="社員番号" value="<?=$views["emp_no"]?>" readonly>
                    <img src="./images/username.jpg" width=50 />
                </div>
            </div>
            <div class="SUN">
                <div class="fake-input">
                    <input type="text" name="username" id="username" placeholder="氏名" value="<?=$views["emp_name"]?>">
                    <img src="./images/username.jpg" width=50 />
                </div>
            </div>

            <div class="DUN">
                <h1 id="delflaglist">管理者:</h1>
                <div class="radio-group">
                  <label class="radio-option" for="yesad">
                    <input type="radio" name="adminsQ" id="yesad" value="true">
                    <span>はい</span> 
                  </label>
            
                  <label class="radio-option" for="noad">
                    <input type="radio" name="adminsQ" id="noad" value="false">
                    <span>いいえ</span> 
                  </label>
                </div>
              </div>
            
    
            <div class="SUN">
                <div class="fake-input">
                    <input type="text" name="status" id="status" placeholder="役職" value="<?=$views["status"]?>">
                </div>
            </div>
            
            <div class="SUN">
              <div class="fake-input">
                <input list="browsers" name="department" id="department" placeholder="部署">

                <datalist id="browsers" >
                  <option value="001" <?php echo ($views["department"] == '001' ?'checked':''); ?>>総務部</option>
                  <option value="002" <?php echo ($views["department"] == '002' ?'checked':''); ?>>人事部</option>
                  <option value="003" <?php echo ($views["department"] == '003' ?'checked':''); ?>>開発部</option>
                  <option value="004" <?php echo ($views["department"] == '004' ?'checked':''); ?>>営業部</option>
                  <option value="005" <?php echo ($views["department"] == '005' ?'checked':''); ?>>DX戦略部</option>
                </datalist> 
                  <img src="./images/departmant.svg" width=50 />
              </div>
          </div>
            
            <div class="SUN">
                <div class="fake-input">
                    <input type="tel" name="phone-no" id="phone-no" placeholder="電話番号"value="<?=$views["phone_no"]?>">
                    <img src="./images/phone.png" width=50 />
                </div>
            </div>
            <div class="SUN">
                <div class="fake-input">
                    <input type="text" name="address" id="address" placeholder="住所"value="<?=$views["address"]?>">
                    <img src="./images/address1.webp" width=50 />
                </div>
            </div>
            <div class="SUN">
                <div class="fake-input">
                    <input type="password" name="password" id="password" placeholder="パスワード" value="<?=$views["passwords"]?>">
                    <img src="./images/lock-icon-png-14.png" width=50 />
                </div>
            </div>
            <div class="DUN">
                <h1 id="delflaglist">削除フラグ:</h1>
                <div class="radio-group">
                  <label class="radio-option" for="delflag">
                    <input type="radio" name="delflag" id="delflag" value="true"  <?php echo ($views["del_flag"] == true ?'checked':''); ?>>
                    <span>はい</span> 
                  </label>
                  <label class="radio-option" for="undelflag">
                    <input type="radio" name="delflag" id="undelflag" value="false" <?php echo ($views["del_flag"] == false ?'checked':''); ?>>
                    <span>いいえ</span> 
                  </label>
                </div>
              </div>
      <div class="SUN">
        <div class="fake-input">
            <input type="text" name="adminsN" id="adminsN" placeholder="更新者"value="<?=$_SESSION["userName"]?>" readonly>
        </div>
    </div>
    <?php endforeach ?>
    <div class="DUN">
        <h2>保存する前に正しい情報を入力したことを確認してください。</h2>
      </div> 
            <button type="submit" id="B"><h1>修正</h1></button>
  
        </form>
      </div>
    </div>  
    </main>

</body>
</html>