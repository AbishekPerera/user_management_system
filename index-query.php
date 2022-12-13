<?php
require_once('inc/connection.php');
?>
<?php
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$is_delete = 0;

$hashed_pw = sha1($password);

$query = "INSERT INTO user (first_name, last_name, email, password, is_delete) VALUES ('{$first_name}', '{$last_name}', '{$email}', '{$hashed_pw}', '{$is_delete}')";

$result = mysqli_query($connection, $query);

if ($result) {
    echo "Done";        
} else {
    # code...
    echo "fail";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>

<body>
    <h1>page</h1>
</body>

</html>

<?php mysqli_close($connection); ?>