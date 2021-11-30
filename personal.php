<?php
    session_start();

    require_once 'connection/Connection.php';
    require_once 'connection/queries/UserEventsSelecting.php';

    if (!isset($_SESSION['user']))
    {
        header("Location: login.php");
        die();
    }

    $connection = new Connection();
    $events = $connection->Execute(new UserEventsSelecting($_SESSION['user']['id']));
?>

<!doctype html>
<html lang="en">

<?php
require_once "src/head.php";
require_once "src/header.php";
?>

<body>
<span class="title">Your Events</span>
<div class="wrapper">
    <div class="events-list">
        <?php foreach ($events as $event):?>
            <?php $date = getdate(strtotime($event['date'])); ?>
            <div class="event">
                <div class="date">
                    <div class="day">
                        <span class="day-text">
                            <?=str_pad($date['mday'], 2, 0, STR_PAD_LEFT)?>
                        </span>
                    </div>
                    <div class="month-time">
                        <span class="month-text"><?=$date['month']?></span>
                        <span class="date-text"><?=$date['year']?></span>
                    </div>
                </div>
                <div class="info">
                    <span class="title-text"><?=$event['title']?></span>
                </div>
                <button class="button button-view">Edit</button>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>