<?php

    session_start();

    require_once '../connection/Connection.php';
    require_once '../connection/queries/UserSelecting.php';

    $identifier = $_POST['identifier'];
    $password = $_POST['password'];

    $connection = new Connection();

    $user = $connection->Execute(new UserSelecting($identifier))[0];

    if (!$user || !password_verify($password, $user['password']))
    {
        $_SESSION['error_message'] = 'Invalid login/email or password';

        header('Location: ../../authorization.php');
        die();
    }

    $_SESSION['user'] = $user;
    header('Location: ../../personal_events.php');
