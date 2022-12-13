<?php
require_once('inc/connection.php');
?>

<?php
$query = "UPDATE user SET first_name = 'Lochani' WHERE id = 5";
$result_set = mysqli_query($connection, $query);

if ($result_set) {
    echo mysqli_affected_rows($connection);
} else {
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

<?php mysqli_close($connection);?>