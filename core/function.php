<?php

function check_login (){
    return isset($_SESSION["user"]) ? true : false;
}

// var_dump(check_login());