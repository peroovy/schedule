<?php
    session_start();
    require_once 'vendor/config.php';

    if (!isset($_SESSION['user']))
    {
        header("Location: authorization.php");
        die();
    }
?>

<!doctype html>
<html lang="en">
<?php require_once "sources/head.php"; ?>
<body>
<?php require_once "sources/header.php"; ?>
<div class="wrapper">
    <span class="title">New Event</span>
    <form class="form" action="vendor/event/add.php" method="post">
        <?php require_once "sources/info_messages.php"; ?>
        <label>Title*</label>
        <input type="text" name="title" placeholder="Input title (max <?=Config::$MAX_TITLE_LENGTH?> symbols)"
               maxlength="<?=Config::$MAX_TITLE_LENGTH?>" required>
        <label>Description</label>
        <textarea class="description-event" name="description"
                  placeholder="Input description (max <?=Config::$MAX_DESCRIPTION_LENGTH?> symbols)"
                  maxlength="<?=Config::$MAX_DESCRIPTION_LENGTH?>"></textarea>
        <label>Day*</label>
        <select class="days" name="day"></select>
        <label>Month*</label>
        <select class="months" name="month">
            <option selected>January</option>
            <option>February</option>
            <option>March</option>
            <option>April</option>
            <option>May</option>
            <option>June</option>
            <option>July</option>
            <option>August</option>
            <option>September</option>
            <option>October</option>
            <option>November</option>
            <option>December</option>
        </select>
        <label>Year*</label>
        <select class="years" name="year"></select>
        <button class="button button-submit" type="submit">Create</button>
    </form>
</div>
    <script src="sources/date.js"></script>
    <script>setDateNow()</script>
</body>
</html>