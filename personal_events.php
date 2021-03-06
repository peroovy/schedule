<?php
    session_start();

    require_once 'vendor/connection/Connection.php';
    require_once 'vendor/connection/queries/EventsSelecting.php';

    if (!isset($_SESSION['user']))
    {
        header("Location: authorization.php");
        die();
    }

    $connection = new Connection();
    $events = $connection->Execute(new EventsSelecting($_SESSION['user']['id']));
?>

<!doctype html>
<html lang="en">

<?php
require_once "sources/head.php";
require_once "sources/header.php";
?>

<body>
<div class="wrapper">
    <span class="title">Your Events</span>
    <div class="events-list">
        <div class="button-add-wrapper">
            <a href="new_event.php">
                <button class="button button-add">New</button>
            </a>
        </div>
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
                <div class="info-event">
                    <span class="title-text"><?=$event['title']?></span>
                </div>
                <div class="buttons">
                    <button type="button" class="button button-view">View more</button>
                    <form action="edit.php" method="get">
                        <input type="hidden" value="<?=$event['id']?>" name="id">
                        <button class="button button-view">Edit</button>
                    </form>
                    <form action="vendor/event/remove.php" method="get">
                        <input type="hidden" value="<?= $event['id']?>" name="id">
                        <button onclick="return confirm('Are you sure?')" class="button button-view">Remove</button>
                    </form>
                </div>

                <div class="popup">
                    <div class="popup-body">
                        <div class="popup-content">
                            <button type="button" class="popup-close">
                                <img src="images/cross.png" alt="Exit">
                            </button>
                            <div class="popup-title">
                                <div class="label">Title:</div>
                                <div class="popup-text"><?=$event['title']?></div>
                            </div>
                            <div class="popup-date">
                                <div class="label">Date:</div>
                                <div class="popup-text"><?=date('d F Y', strtotime($event['date']))?></div>
                            </div>
                            <div class="popup-author">
                                <div class="label">Author:</div>
                                <div class="popup-text"><?=$event['author']?></div>
                            </div>
                            <div class="popup-description">
                                <div class="label">Description:</div>
                                <pre class="popup-text"><?=$event['description']?></pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<script src="sources/popup.js"></script>
</body>
</html>
