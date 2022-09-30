<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-8"> <br>
        <h4>Register form</h4>
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
            <button type="submit" class="btn btn-primary">submit</button>
            <a href="/index.php">login</a>

          </div>
        </form>
      </div>
    </div>
  </div>

</body>

</html>

<?php
if (isset($_POST['username']) && isset($_POST['password'])) {

  require_once 'connect.php';
  $username = $_POST['username'];
  $password = sha1($_POST['password']); //เก็บรหัสผ่านในรูปแบบ sha1 
  $stmt = $conn->prepare("SELECT id FROM user WHERE username = :username");
  $stmt->execute(array(':username' => $username));
  if ($stmt->rowCount() > 0) {
    echo "user ซ้ำกรุณาสมัครใหม่";
  } else {
    $stmt = $conn->prepare("INSERT INTO user (username, password)
              VALUES (:username, :password)");
    $stmt->execute(array(':username' => $username, ':password' => $password));
    echo
    "สมัครสมาชิกสำเร็จ";
  }
  $conn = null;
}
?>