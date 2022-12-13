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

if (isset($_POST['submit'])) {
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
                            <a class="nav-link active" href="#">Home
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
            <h3>Add Users Page</h3>
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
            <form action="add-user.php" method="post">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">First Name:</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="first_name" required>

                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Last Name:</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="last_name" required>

                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="email" required>

                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                </div>

                <button type="submit" class="btn btn-success" name="submit">Save User</button>
            </form>
        </div>


    </main>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

</html>