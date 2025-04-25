<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Employee Ad</title>
</head>
<body>
    <form action="./newkakunin.php" method="POST">
      <h3>新規社員</h3>
      <div>
        <label for="id">社員番号:</label>
        <input type="text" name="id" id="id">
      </div>
      <div>
        <label for="username">氏名:</label>
        <input type="text" name="username" id="username">
      </div>
      <div>
        <p id="adminsList">管理者:</p>

        <label for="yesad">はい:</label>
        <input type="radio" name="adminsQ" id="yesad" value="true">

        <label for="noad">いいえ  :</label>
        <input type="radio" name="adminsQ" id="noad" value="false">
      </div>
      <div>
        <label for="status">役職:</label>
        <input type="text" name="status" id="status">
      </div>
      <div>
        <label for="department">部署:</label>
        <input type="radio" name="department" id="department1" value="001">
        <input type="radio" name="department" id="department2" value="002">
        <input type="radio" name="department" id="department3" value="003">
        <input type="radio" name="department" id="department4" value="004">
        <input type="radio" name="department" id="department5" value="005"> 
      </div>
      <div>
        <label for="phone-no">電話番号:</label>
        <input type="tel" name="phone-no" id="phone-no">
      </div>
      <div>
        <label for="address">住所:</label>
        <input type="text" name="address" id="address">
      </div>
      <div>
        <label for="password">パスワード:</label>
        <input type="password" name="password" id="password">
      </div>
      <div>
        <p id="delflaglist">削除フラグ:</p>

        <label for="delflag">はい:</label>
        <input type="radio" name="delflag" id="delflag" value="true">

        <label for="undelflag">いいえ  :</label>
        <input type="radio" name="delflag" id="undelflag" value="false">
      </div>
      <div>
        <label for="adminsN">更新者:</label>
        <input type="text" name="adminsN" id="adminsN" value="<?=$_SESSION["userName"]?>" readonly>
      </div>
      <div class="messagebox">
        <p>保存する前に正しい情報を入力したことを確認してください。</p>
      </div>
      <div>
        <button type="submit" id="saveBtn">保存</button>
      </div>
    </form>
</body>
</html>