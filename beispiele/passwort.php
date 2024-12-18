<?php
 $salt = "emensa";
 $admin = "SWE24";
 $passwort = sha1($salt . $admin);
 echo $passwort;