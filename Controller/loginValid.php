<?php

include "../Model/db.php";

session_start();

$email = "";
$password = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST["email"];
    $password = $_POST["password"];
    

    if(!empty($email) && !empty($password)){
        
    $database = new db();

        $connection = $database->connection();
        $result = $database->signin($connection,"members",$email);

        if($result->num_rows>0){

            $row = $result->fetch_assoc();
<<<<<<< HEAD
<<<<<<< HEAD
            if(password_verify($password, $row["password_hash"]) || $row["password_hash"] == $password)
=======
            if($row["password_hash"] == $password)
>>>>>>> 4fdd6d3e3b9187c46a1e4f63c90092607aa87cc8
=======
            if($row["password_hash"] == $password)
>>>>>>> aea489d (add jarif)
            {
                $_SESSION["member_id"] =$row["id"];
                $_SESSION["name"] =$row["name"];
                $_SESSION["role"] = $row["role"];
                $_SESSION["loggedIn"] = true;

                setcookie("name",$row["name"],time()+3600,"/");

                if($row["role"] == "member")
                {
                    header("Location:../View/member_dashboard.php");
                }
                elseif(
                    $row["role"] == "librarian"
                )
                {
                    header("Location:../View/librarian_dashboard.php");
                }

                elseif(
                    $row["role"] == "admin"
                )
                {
                    header("Location:../View/admin_dashboard.php");
                }
            }else{
                echo "Incorrect Password";
            }
        }
        else
        {
            echo "Email Not Found";
        }
    }
    else
    {
        echo "Please Fill All Fields";
    }
}
?>