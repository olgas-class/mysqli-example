<?php

require_once __DIR__ . "/login.php";

// Se l'utente è loggato nella session troverò user_id (diverso da 0) e username
if (!isset($_SESSION)) {
    session_start();
}

// Collegamento al mysql
define("DB_SERVER", "localhost:8889");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "university_2_db");

$connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($connection && $connection->connect_error) {
    echo "Connection failed";
    echo $connection->connect_error;
    die;
}


// Verifichiamo se eseguire operazione di login
if (isset($_POST['username']) && isset($_POST['password'])) {
    login($_POST['username'], $_POST['password'], $connection);
}

// Imposto la stringa della query
$sql = "SELECT `id`, `name`, `email` FROM `departments`";
$results = $connection->query($sql);


$connection->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>

<body>
    <?php include __DIR__ . "/partials/header.php"; ?>

    <div class="container mt-5">
        <?php if (!empty($_SESSION['user_id']) && !empty($_SESSION['username'])) { ?>
            <!-- Visibile all'utente loggato -->
            <?php if ($results && $results->num_rows > 0) { ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $results->fetch_assoc()) { ?>
                            <tr>
                                <th scope="row"><?php echo $row['id']; ?></th>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
        <?php } else { ?>
            <!-- Se arrivo da logout stampo il messagio di comunicazione -->
            <?php if (isset($_GET['logout']) && $_GET['logout'] === 'success') { ?>
                <div class="alert alert-success">
                    Logout è avvenuto con successo
                </div>
            <?php } ?>

            <!-- Se l'utente non è loggato vedrà form di login -->
            <h2 class="text-center">Login</h2>

            <div class="card w-50 mx-auto">
                <div class="card-body">
                    <form action="index.php" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Username</label>
                            <input type="text" class="form-control" id="name" name="username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <button type="submit" class="btn btn-primary">Invia</button>
                    </form>
                </div>
            </div>

        <?php } ?>


    </div>
</body>

</html>