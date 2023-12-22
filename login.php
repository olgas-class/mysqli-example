<?php
// Questa funzione controlla se nel db c'è la corrispondenza.
// Se c'è imposta le variabili della session con dati dell'utente
// Altrimenti imposta nella session l'errore di login

function login($username, $password, $connection) {

    if (!isset($_SESSION)) {
        session_start();
    }

    $hashed_passwd = md5($password);
    
    // Utilizzeremo prepared queries per evitare attacchi di sql injection
    $stmt = $connection->prepare("SELECT * from `users` WHERE `username` = ? AND `password` = ?");
    $stmt->bind_param('ss', $username, $hashed_passwd);
    // Questa è la query nel db
    $stmt->execute();

    $results = $stmt->get_result();

    if($results->num_rows > 0) {
        $row = $results->fetch_assoc();
        $_SESSION['user_id'] = $row['ID'];
        $_SESSION['username'] = $row['username'];
    } else {
        echo "ERRORE!";
    }

}
