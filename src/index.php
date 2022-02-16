<?php
/*
 * Copyright 2021 (c) Renzo Diaz
 * Licensed under MIT License
 * Index router
 */

require_once "mvc-init.php";
session_start();

require_once __CONTROLLER__ . "/ClassController.php";

route("/", function () {
    $class = new ClassController();
    $class->Home();
});
route("/qrcode/:data", function () {
    require __LIBS__ . "/QRCode.php";
    QRcode::png($_GET["data"]);
});
