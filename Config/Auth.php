<?php

<<<<<<< HEAD
<<<<<<< HEAD
session_start();

=======
>>>>>>> 4fdd6d3e3b9187c46a1e4f63c90092607aa87cc8
=======
session_start();

>>>>>>> aea489d (add jarif)
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