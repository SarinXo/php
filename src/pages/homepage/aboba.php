<?php
 $password = "amogus";
 $password_hash = password_hash($password, PASSWORD_DEFAULT);
 echo $password_hash;
 echo "<br>";
 echo password_verify($password , $password_hash);
