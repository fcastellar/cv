<?php

    session_start();

    require_once "init.php";

    require_once "controllers/Cv.controller.php";
    require_once "controllers/User.controller.php";
    require_once "models/User.model.php";

    include_once "include/head.php";

?>

<body>

    <?php
        CvController::showCV(1);
    ?>

</body>