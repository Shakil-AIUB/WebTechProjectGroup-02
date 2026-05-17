<<<<<<< HEAD
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
=======
<?php include "../Controller/ProfileValid.php"; ?>
>>>>>>> aea489d (add jarif)

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
<<<<<<< HEAD
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

=======
    <style>
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            font-size: 15px;
            line-height: 1.6;
            background: #f4f4f1;
            color: #1a1a1a;
            min-height: 100vh;
            padding: 2rem 1rem;
        }

        .profile-container {
            max-width: 620px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        h1 {
            font-size: 22px;
            font-weight: 600;
            color: #1a1a1a;
        }

        h2 {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #888;
        }

        /* Messages */
        .error {
            background: #fff0f0;
            color: #c0392b;
            border: 0.5px solid #f5c6c6;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 14px;
        }

        .success {
            background: #f0faf4;
            color: #1a7a40;
            border: 0.5px solid #b7e4c7;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 14px;
        }

        /* Summary cards */
        .summary-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 12px 0;
            margin: 0 -12px;
        }

        .summary-table th,
        .summary-table td {
            background: #eceee8;
            border-radius: 8px;
            padding: 1rem;
            width: 33.33%;
            text-align: left;
        }

        .summary-table th {
            font-size: 12px;
            font-weight: 500;
            color: #666;
            padding-bottom: 4px;
        }

        .summary-table td {
            font-size: 26px;
            font-weight: 600;
            color: #1a1a1a;
            padding-top: 4px;
        }

        /* Form card */
        form {
            background: #fff;
            border: 0.5px solid rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        /* Profile table rows → field layout */
        .profile-table {
            width: 100%;
            border-collapse: collapse;
        }

        .profile-table tr td:first-child {
            width: 140px;
            font-size: 13px;
            color: #666;
            padding: 6px 0;
            vertical-align: middle;
        }

        .profile-table tr td:last-child {
            padding: 6px 0;
        }

        /* Inputs */
        .profile-table input[type="text"],
        .profile-table input[type="email"],
        .profile-table input[type="password"] {
            width: 100%;
            padding: 8px 12px;
            font-size: 14px;
            color: #1a1a1a;
            background: #fff;
            border: 0.5px solid rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            transition: border-color 0.15s, box-shadow 0.15s;
            outline: none;
            font-family: inherit;
        }

        .profile-table input:hover {
            border-color: rgba(0, 0, 0, 0.35);
        }

        .profile-table input:focus {
            border-color: rgba(0, 0, 0, 0.4);
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.06);
        }

        /* Section divider label */
        h2 {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        h2::after {
            content: '';
            flex: 1;
            height: 0.5px;
            background: rgba(0, 0, 0, 0.1);
        }

        /* Submit button */
        .profile-table input[type="submit"] {
            padding: 9px 22px;
            font-size: 14px;
            font-weight: 500;
            background: #1a1a1a;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-family: inherit;
            transition: opacity 0.15s;
        }

        .profile-table input[type="submit"]:hover {
            opacity: 0.8;
        }
>>>>>>> aea489d (add jarif)
    </style>
</head>

<body>
<<<<<<< HEAD

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

=======
<div class="profile-container">

    <h1>Profile</h1>

    <?php
    if ($error != "") {
        echo "<p class='error'>$error</p>";
    }
    if ($success != "") {
        echo "<p class='success'>$success</p>";
    }
    ?>

    <h2>Dashboard summary</h2>

    <table class="summary-table">
        <tr>
            <th>Active loans</th>
            <th>Due in 7 days</th>
            <th>Outstanding fines</th>
        </tr>
        <tr>
            <td><?php echo $counts['active_loans']; ?></td>
            <td><?php echo $counts['upcoming_dues']; ?></td>
            <td><?php echo $counts['outstanding_fines']; ?></td>
        </tr>
    </table>

    <form method="post">

        <h2>Personal info</h2>

        <table class="profile-table">
            <tr>
                <td>Name</td>
                <td><input type="text" name="name" value="<?php echo $user['name']; ?>"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="email" name="email" value="<?php echo $user['email']; ?>"></td>
            </tr>
            <tr>
                <td>Phone</td>
                <td><input type="text" name="phone" value="<?php echo $user['phone']; ?>"></td>
            </tr>
        </table>

        <h2>Change password</h2>

        <table class="profile-table">
            <tr>
                <td>Current password</td>
                <td><input type="password" name="current_password" placeholder="••••••••"></td>
            </tr>
            <tr>
                <td>New password</td>
                <td><input type="password" name="new_password" placeholder="••••••••"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right; padding-top: 8px;">
                    <input type="submit" value="Save changes">
                </td>
            </tr>
        </table>

    </form>

</div>
>>>>>>> aea489d (add jarif)
</body>
</html>