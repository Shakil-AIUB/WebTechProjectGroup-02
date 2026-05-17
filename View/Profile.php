<?php

include "../Config/Auth.php";
include "../Model/db.php";

auth_check("admin");
auth_check("member");

$obj = new db();
$conn = $obj->connection();

$id = $_SESSION["member_id"];

$user = $obj->getUserById($conn, $id);

$data = $user->fetch_assoc();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>

    <style>

        body{
            font-family: Arial;
            background: #f4f6f9;
            padding: 40px;
        }

        form{
            background: white;
            padding: 20px;
            width: 400px;
        }

        input{
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 15px;
        }

        button{
            padding: 10px 20px;
            background: #1a3a5c;
            color: white;
            border: none;
        }

    </style>
</head>

<body>

<h2>Update Profile</h2>

<form method="post">

    <input type="text" name="name"
    value="<?php echo $data["name"]; ?>">

    <input type="email" name="email"
    value="<?php echo $data["email"]; ?>">

    <input type="text" name="phone"
    value="<?php echo $data["phone"]; ?>">

    <button type="submit">Update</button>

</form>

<?php

if(isset($_POST["name"]))
{
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    $obj->updateProfile($conn, $id, $name, $email, $phone);

    echo "<p>Profile Updated</p>";
}

?>

<br>

<a href="member_dashboard.php">Back</a>

</body>
</html>