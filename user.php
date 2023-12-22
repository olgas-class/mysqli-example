<?php
if (!isset($_SESSION)) {
    session_start();
}

if (empty($_SESSION['user_id']) || empty($_SESSION['username'])) {
    header("Location: index.php");
    die;
}
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

    <h2>Ciao <?php echo $_SESSION['username']; ?></h2>


</body>

</html>