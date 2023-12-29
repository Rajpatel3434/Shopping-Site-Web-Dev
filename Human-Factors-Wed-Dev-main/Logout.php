<?php
session_start();
$_SESSION = session_id();
if (session_destroy()){
    header("location: index.php");
}
