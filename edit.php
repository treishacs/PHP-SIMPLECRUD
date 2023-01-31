<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "studentrecords";

$connection = new mysqli($servername, $username, $password, $database);


$id = "";
$name = "";
$email = "";
$mobile = "";
$department = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ( !isset ($_GET["id"]) ) {
        header ("Location: index.php");
        exit;
    }

    $id = $_GET["id"];

    $sql="SELECT * FROM students WHERE id = $id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header ("Location: index.php");
        exit;
    }

    $name = $row["name"];
    $email = $row["email"];
    $mobile = $row["mobile"];
    $department = $row["department"];
}
else {

    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $department = $_POST["department"];

    do {
      if ( empty ($id) || empty($name) || empty($email) || empty($mobile) || empty($department) ) {
        $errorMessage = "All the fields are required";
        break;
      }
      
      $sql = "UPDATE students ".
              "SET name = '$name', email = '$email', mobile = '$mobile', department = '$department' "."WHERE id = $id";

      $result = $connection->query($sql);

      if (!$result) {
        $errorMessage = "Invalid query: " . $connection->error;
        break;
      }

      $successMessage = "Student updated successfully";

      header ("Location: index.php");
      exit;

    }while(false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Records</title>
  <link rel="stylesheet" href="
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');">
  <link rel="stylesheet" href="style.css"> 
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <div class="container">
      <h2>Edit Student Details</h2>

      <?php
      if (!empty($errorMessage)) {
        echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
          <strong>$errorMessage</strong>
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
          ";
      }
      ?>

      <form method="post">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" placeholder="Enter Name">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="email" value="<?php echo $email; ?>" placeholder="Enter Student Email">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Mobile Number</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="mobile" value="<?php echo $mobile; ?>" placeholder="Enter Mobile Number">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Department</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="department" value="<?php echo $department; ?>" placeholder="Enter Department">
            </div>
          </div>
          
          <?php
          if (!empty($successMessage)) {
            echo "
            <div class='row mb-3'>
              <div class='offset-sm-3 col-sm-6'>
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                  <strong>$successMessage</strong>
                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
              </div>
            </div>
              ";
          }
          ?>

          <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                  <button type="submit" class="addstud-btn">Update Student Details</button>
            </div>
            <div class="col-sm-3 d-grid">
                  <a class="cancel-btn" href="index.php" role="button">Cancel</a>
            </div>
          </div>
      </form>
  </div>
</body>
</html>