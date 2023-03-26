<?php

require("lib/extras.php");

match ($_SERVER["REQUEST_URI"]) {
    '/' => require_once('views/home/index.php'),
    default => require_once('views/notfound.php'),
};
