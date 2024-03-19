<?php
    $str =  "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $str = substr("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", 0, strrpos($str, "/")) . "/";
    echo $str;
?>