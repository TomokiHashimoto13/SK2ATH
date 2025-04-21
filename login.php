<?php
session_start();
require_once __DIR__ . "/../def.php";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = trim($_POST['userID']);
    $password = trim($_POST['password']);
  try {
    $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET;

    $db = new PDO($dsn, DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $db->prepare("SELECT passwords FROM EMPLOYEE WHERE emp_no = :userID");

    $stmt->bindParam(":userID", $userID, PDO::PARAM_STR);
    
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC); //database
    if ($user && password_verify($password, $user["passwords"])) {
      $_SESSION["userID"] = $userID; //session 
      // header("Location: "); 
      // exit;
    } else {
      $error = "Invalid username or password!";
    }
  } catch (PDOException $e) {
    exit("Database error: " . $e->getMessage());
  }finally{
    $stmt = null;
    $db = null;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/login.css">
    <title>Login</title>
</head>
<body>
    <header>
        <ul id="T">
        <Img  id="danger" src="images/1495749066Danger-Warning-Sign-PNG-Clipart.png"> 
            <h1 id="title">安否情報確認</h1>
        </ul>
    </header>
    <main>
        <form action="./login.php" method="POST">
            <div class="SUN">
                <div class="fake-input">
                    <input type="text" name="userID" placeholder="userID" />
                    <img src="./images/username.jpg" width=50 />
                </div>
            </div>
            <div class="SUN">
                <div class="fake-input">
                    <input type="password" name="password" placeholder="password" />
                    <img src="./images/lock-icon-png-14.png" width=50 />
                </div>
            </div>
            <button type="submit" id="B"><h1>LOGIN</h1></button>
        </form>
        
          
    

    </main>
</body>
</html>