<?php

function login($username, $password) {

include "db.php";
$search = mysql_query("SELECT * FROM `profile` WHERE `username`='".mysql_escape_string(trim($_POST['username']))."' AND `password`='".mysql_escape_string(trim($_POST['password']))."'");
if (mysql_num_rows($search) == 1) 
    {
        return true;
        
	}

}

?>
