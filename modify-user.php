<?php session_start(); ?>

<?php
require_once('inc/connection.php');
?>

<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
}

?>

<?php
$errors = array();

$user_id = '';
$first_name = '';
$last_name = '';
$email = '';
$password = '';

if (isset($_GET['user_id'])) {

    $user_id = mysqli_real_escape_string($connection, $_GET['user_id']);

    $query = "SELECT * FROM user WHERE id={$user_id}";
    $result_set = mysqli_query($connection, $query);

    if ($result_set) {
        if (mysqli_num_rows($result_set) == 1) {

            $result = mysqli_fetch_assoc($result_set);

            $first_name = $result['first_name'];
            $last_name = $result['last_name'];
            $email = $result['email'];
            $password = $result['password'];

        } else {

            header('Location: users.php?err=user_not_found');
        }
    } else {
        header('Location: users.php?err=query failed');
    }
}

if (isset($_POST['submit'])) {

    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    if (empty(trim($_POST['user_id']))) {
        $errors[] = 'user_id is required';
    }
    if (empty(trim($_POST['first_name']))) {
        $errors[] = 'First name is required';
    }

    if (empty(trim($_POST['last_name']))) {
        $errors[] = 'Last name is required';
    }

    if (empty(trim($_POST['email']))) {
        $errors[] = 'Email is required';
    }

    if (empty(trim($_POST['password']))) {
        $errors[] = 'password name is required';
    }

    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $query = "SELECT * FROM user WHERE email = '{$email}' AND id != {$user_id} ";

    $result_set = mysqli_query($connection, $query);

    if ($result_set) {
        if (mysqli_num_rows($result_set) == 1) {
            $errors[] = 'Email address already exists';
        }
    }

    if (empty($errors)) {
        $user_id = $_POST['user_id'];
        $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);

        $hashed_pw = sha1($password);

        $query = "UPDATE user SET first_name = '{$first_name}',last_name = '{$last_name}',email = '{$email}',password = '{$hashed_pw}' WHERE id = '{$user_id}' LIMIT 1";

        $result = mysqli_query($connection, $query);

        if ($result) {
            header('Location: users.php?user_modified=true');
        } else {
            $errors = 'Failed to update record ';
        }

    }

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Users</title>

    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">User Management System</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
                    aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="users.php">Home
                                <span class="visually-hidden">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>

                    </ul>
                    <form action="logout.php" class="d-flex">
                        <input class="form-control me-sm-2" type="search" value="<?php echo $_SESSION['user_name']; ?>"
                            disabled>
                        <button class="btn btn-danger my-2 my-sm-0" type="submit">LogOut</button>
                    </form>

                </div>
            </div>
            <!-- asa -->
        </nav>
    </header>


    <main class="usersmain">
        <center>
            <h3>Update User Page</h3>
        </center>



        <div class="adduserform">
            <?php
            if (!empty($errors)) {

                echo "<div class=\"alert alert-dismissible alert-warning\">
                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
                <h4 class=\"alert-heading\">Warning!</h4>
                <p class=\"mb-0\">";

                foreach ($errors as $error) {
                    echo $error;
                    echo "<br>";
                }
                echo "</p>
            </div>";
            }
            ?>
            <form action="modify-user.php" method="post">

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">User ID:</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="user_id" value=" <?php echo "$user_id"; ?> " readonly="readonly" >

                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">First Name:</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="first_name" value=" <?php echo "$first_name"; ?> " required>

                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Last Name:</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="last_name" value=" <?php echo "$last_name"; ?> " required>

                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="email" value=" <?php echo "$email"; ?> " required>

                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                </div>

                <button type="submit" class="btn btn-success" name="submit">Update User</button>
            </form>
        </div>


    </main>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

</html>