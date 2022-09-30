<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  </head>
    <body>
    <div class="container">
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-8"> <br> 
          <h4>Login Form</h4>
          <form action="" method="post">
                <div class="mb-2">
                <div class="col-sm-9">
                  <input type="text" name="username" class="form-control" required minlength="3" placeholder="username">
                </div>
                </div>
                <div class="mb-3">
                <div class="col-sm-9">
                  <input type="password" name="password" class="form-control" required minlength="3" placeholder="password">
                </div>
                </div>
                <div class="d-grid gap-2 col-sm-9 mb-3">
                <button type="submit" class="btn btn-primary">Login</button>
                <a href="/register.php">register</a>
              </div>
              </form>
            </div>
          </div>
        </div>
      </body>
    </html>  

    <?php
   if(isset($_POST['username']) && isset($_POST['password']) ){

    require_once 'connect.php';
      $username = $_POST['username'];
    $password = sha1($_POST['password']); //เก็บรหัสผ่านในรูปแบบ sha1 
    $stmt = $conn->prepare("SELECT id FROM user WHERE username = :username AND password = :password ") ;
    $stmt->bindParam(':username', $username , PDO::PARAM_STR);
      $stmt->bindParam(':password', $password , PDO::PARAM_STR);
      $stmt->execute();
      if($stmt->rowCount() == 1){
        //fetch เพื่อเรียกคอลัมภ์ที่ต้องการไปสร้างตัวแปร session
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        //สร้างตัวแปร session
        $_SESSION['id'] = $row['id'];
      
        header('Location: /submitfile.php'); //login ถูกต้องและกระโดดไปหน้าตามที่ต้องการ
      }else{
      echo "user ซ้ำกรุณาสมัครใหม่";
      }
      $conn = null;

    

   }

   
   
   
   
  
   
   
   ?>

