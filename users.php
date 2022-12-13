<?php session_start(); ?>

<?php
require_once('inc/connection.php');
?>

<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
}

$use_list = '';

// get data from db

$query = "SELECT * FROM user WHERE is_delete=0 ORDER BY first_name";
$users = mysqli_query($connection, $query);

if ($users) {
    while ($user = mysqli_fetch_assoc($users)) {
        $use_list .= "<tr>";
        $use_list .= "<td>{$user['id']}</td>";
        $use_list .= "<td>{$user['first_name']}</td>";
        $use_list .= "<td>{$user['last_name']}</td>";
        $use_list .= "<td>{$user['last_login']}</td>";
        $use_list .= "<td>{$user['email']}</td>";
        $use_list .= "<td><a href=\"modify-user.php?user_id={$user['id']}\">Edit</a></td>";
        $use_list .= "<td><a href=\"delete-user.php?user_id={$user['id']}\">Delete</a></td>";
        $use_list .= "</tr>";


    }


} else {
    echo "DB Query Fail";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>

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
        </nav>
    </header>


    <main class="usersmain">
        <center>
            <h3> Users Page</h3>
        </center>
        <a href="add-user.php"><button type="button" class="btn btn-outline-info" data-bs-toggle="button">Add
                User</button></a>
        <div class="userTable">
            <table class="table table-dark table-striped-columns">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Last Login</th>
                        <th scope="col">Email</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $use_list; ?>

                </tbody>
            </table>

        </div>
    </main>

    <!-- JavaScript Bundle with Popper
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script> -->
</body>

</html>