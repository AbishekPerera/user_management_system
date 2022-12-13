<?php
require_once('inc/connection.php');
?>

<?php
$query = "SELECT * FROM user";
$result_set = mysqli_query($connection, $query);

if ($result_set) {
    # code...

    echo "ela bng " . mysqli_num_rows($result_set);



    // while ( $records = mysqli_fetch_assoc($result_set)) {
    //     # code...
    //     echo $records['first_name'] .  "<br>";
    // }

} else {
    # code...
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select QUery</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <h1>page</h1>



    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
            
            </tr>
        </thead>
        <tbody>

            <?php

                while ($records = mysqli_fetch_assoc($result_set)) {
                    # code...
             echo "<tr>" .
                    "<td>" . $records['first_name'] . "</td>" .
                    "<td>" . $records['last_name'] . "</td>" .
                    "<td>" . $records['email'] . "</td>" .
                    "</tr>";
                }

                 ?>

        </tbody>
    </table>

</body>

</html>

<?php mysqli_close($connection); ?>