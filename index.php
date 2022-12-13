<?php session_start(); ?>

<?php
require_once('inc/connection.php');
?>
<?php
//check for form submition
if (isset($_POST['submit'])) {

    $errors = array();
    //check user name password

    if (!isset($_POST['email']) || strlen(trim($_POST['email'])) < 1) {
        $errors[] = 'email is missing / invalid';
    }

    if (!isset($_POST['password']) || strlen(trim($_POST['password'])) < 1) {
        $errors[] = 'password is missing / invalid';
    }

    // chechk if there any arrors in the form
    if (empty($errors)) {

        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        $hashedpassword = sha1($password);

        $query = "SELECT * FROM user
                    WHERE email = '{$email}'
                    AND password = '{$hashedpassword}'
                    LIMIT 1";

        $result_set = mysqli_query($connection, $query);

        if ($result_set) {
            if (mysqli_num_rows($result_set) == 1) {

                $userlg = mysqli_fetch_assoc($result_set);
                $_SESSION['user_id'] = $userlg['id'];
                $_SESSION['user_name'] = $userlg['first_name'];

                //update last login
                $query = "UPDATE user SET last_login = NOW() WHERE id={$_SESSION['user_id']} LIMIT 1";
                $result_set = mysqli_query($connection, $query);

                if(!$result_set){
                    die("db query fail");
                }
                //validation
                //redirect

                header('Location: users.php');
            } else {
                $errors[] = 'invalid user name or password';
            }
        } else {
            $errors[] = 'Database query faild';

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
    <title>Index</title>

    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <div class="loginpage" style="width: 30%; margin:100px auto;">
        <center>
            <h1>Login</h1>
        </center>
        <form action="index.php" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="Enter email" name="email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"
                    name="password">
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <?php
            if (isset($errors) && !empty($errors)) {
                echo
                    '<div class="alert alert-dismissible alert-danger">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <h4 class="alert-heading">ERROR !</h4>
                    <p class="mb-0"> Invalid inputs.</p>
                  </div>';
            }
            ?>

            <?php
            if (isset($_GET['logout'])) {
            echo
            '<div class="alert alert-dismissible alert-warning">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <h4 class="alert-heading">Successfully Logout!</h4>
                    <p class="mb-0"> come back again.</p>
                  </div>';
}
?>
            <button type="submit" class="btn btn-success" name="submit">Submit</button>
        </form>
    </div>
</body>

</html>

<?php mysqli_close($connection); ?>