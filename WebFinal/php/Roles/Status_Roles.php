<?php
session_start();
if (isset($_SESSION["admin"])) {
    echo "admin";
} else if (isset($_SESSION["user"])) {
    echo "user";
} else {
    echo "None";
}
