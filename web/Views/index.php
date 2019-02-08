<!DOCTYPE html>
<html lang="en">

<head>
    <title>David Durrant</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <?php 
    //get root directory
    $root = $_SERVER['DOCUMENT_ROOT'];
    //include main menu
    include_once($root . "/Views/menu.php"); 
    ?>
    <div class="bgMtn1 mrgn">
        <div class="media">
            <div class="spacer-top-img"></div>
            <div class="media-body">
                <p class="text-center txt-styling-img">My Interests include hiking the various mountains native to Utah. </p>
            </div>
            <div class="media-right">
                <img src="/media/images/profile.jpg" class="img-circle size-img-small" alt="David Durrant">
            </div>
        </div>
    </div>
    <div class="row container">
        <div class="col-sm-6 text-center">
            <img src="/media/images/vivoactive_hr.jpg" class="size-img-large responsive" alt="vivoactive watch">
        </div>
        <div class="col-sm-4 item">
            <div class="spacer-top-img hidden-xs"></div>
            <p class="txt-styling">I use a GPS watch to track my adventures!</p>
        </div>
        <div class="col-sm-2">
        </div>
    </div>
    <div class="row bgMtn2 mrgn">
        <div class="col-sm-12">
            <p class="text-center txt-styling-img spacer-top-img">Included are some pictures I have taking on some of my hikes.</p>
        </div>
    </div>
    <div class="row container mrgn">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-4 item">
            <div class="spacer-top-img hidden-xs"></div>
            <p class="txt-styling">My friends have nicknamed me Mountain goat</p>
        </div>
        <div class="col-sm-6">
            <img src="/media/images/mountain_goat.jpg" class="size-img-large img-circle" alt="vivoactive watch">
        </div>
    </div>
</body>

</html>
