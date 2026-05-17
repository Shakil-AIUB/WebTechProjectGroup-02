<?php

function auth_check($required_role = null)
{
    // User not logged in
    if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] != true)
    {
        header("Location: ../View/login.php");
        exit();
    }

    // Role check
    if($required_role != null)
    {
        if($_SESSION["role"] != $required_role)
        {
            echo "Access Denied";
            exit();
        }
    }
}
?>