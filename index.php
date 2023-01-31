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
</head>

<body>
  <div class="container my-5">
    <h2>List of Students</h2>
    <a class="add-btn" href="create.php" role="button">Add New Student</a>
    <br>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Full Name</th>
          <th>Email</th>
          <th>Mobile Number</th>
          <th>Department</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "studentrecords";

        $connection = new mysqli($servername, $username, $password, $database);

        if ($connection->connect_error) {
          die("Connection failed: " . $connection->connect_error);
        }

        $sql = "SELECT * FROM students";
        $result = $connection->query($sql);

        if (!$result) {
          trigger_error('Invalid query: ' . $connection->error);
        }

        while ($row = $result->fetch_assoc()) {
          echo "<tr>
              <td>$row[id]</td>
              <td>$row[name]</td>
              <td>$row[email]</td>
              <td>$row[mobile]</td>
              <td>$row[department]</td>
              <td>
                <a class='btn btn-secondary btn-sm' href='edit.php?id=$row[id]' role='button'>Edit</a>
                <a class='btn btn-danger btn-sm' href='delete.php?id=$row[id]' role='button'>Delete</a>
              </td>
            </tr>";
        }
        ?>

      </tbody>
    </table>
  </div>
</body>

</html>