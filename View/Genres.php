<?php

include "../Controller/GenreController.php";

?>

<!DOCTYPE html>
<html>
<head>

    <title>Genres</title>

    <style>

        *{
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body{
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f0f4f8;
            min-height: 100vh;
            padding: 40px 20px;
        }

        .page-wrapper{
            max-width: 700px;
            margin: 0 auto;
        }

        .top-bar{
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
        }

        .page-title{
            font-size: 22px;
            font-weight: 600;
            color: #1a3a5c;
        }

        .back-btn{
            background: #ffffff;
            color: #1a3a5c;
            border: 1.5px solid #1a3a5c;
            border-radius: 8px;
            padding: 10px 16px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: 0.2s;
        }

        .back-btn:hover{
            background: #dde3eb;
            transform: translateY(-1px);
        }

        .alert{
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 18px;
            font-weight: 500;
        }

        .alert-error{
            background: #fde8e8;
            color: #c0392b;
            border-left: 4px solid #c0392b;
        }

        .alert-success{
            background: #e8f8f0;
            color: #1e7a4c;
            border-left: 4px solid #1e7a4c;
        }

        .card{
            background: #ffffff;
            border: 1px solid #dde3eb;
            border-radius: 12px;
            padding: 28px 32px;
            margin-bottom: 25px;
        }

        form{
            display: flex;
            gap: 12px;
        }

        input[type="text"]{
            flex: 1;
            padding: 10px 12px;
            font-size: 14px;
            font-family: inherit;
            background: #f7f9fc;
            color: #1a1a1a;
            border: 1px solid #c8d0da;
            border-radius: 8px;
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        input[type="text"]:focus{
            border-color: #1a3a5c;
            box-shadow: 0 0 0 3px rgba(26, 58, 92, 0.1);
            background: #fff;
        }

        input[type="submit"]{
            padding: 10px 18px;
            font-size: 14px;
            font-weight: 600;
            font-family: inherit;
            border: none;
            border-radius: 8px;
            background: #1a3a5c;
            color: #fff;
            cursor: pointer;
            transition: background 0.15s, transform 0.1s;
        }

        input[type="submit"]:hover{
            background: #133055;
        }

        input[type="submit"]:active{
            transform: scale(0.98);
        }

        table{
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #dde3eb;
        }

        th{
            background: #1a3a5c;
            color: white;
            text-align: left;
            padding: 14px;
            font-size: 14px;
        }

        td{
            padding: 14px;
            border-top: 1px solid #e6ebf2;
            font-size: 14px;
            color: #333;
        }

        tr:hover{
            background: #f8fafc;
        }

        .delete-btn{
            display: inline-block;
            padding: 7px 12px;
            background: #fde8e8;
            color: #c0392b;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: background 0.15s;
        }

        .delete-btn:hover{
            background: #f9d4d4;
        }

    </style>

</head>

<body>

<div class="page-wrapper">

    <div class="top-bar">

        <h1 class="page-title">
            Genre Management
        </h1>

        <a class="back-btn"
           href="librarian_dashboard.php">
            ← Back
        </a>

    </div>

    <?php
    if($error != "")
    {
    ?>
        <div class="alert alert-error">
            <?php echo $error; ?>
        </div>
    <?php
    }

    if($success != "")
    {
    ?>
        <div class="alert alert-success">
            <?php echo $success; ?>
        </div>
    <?php
    }
    ?>

    <div class="card">

        <form method="post">

            <input type="text"
                   name="genre"
                   placeholder="Genre Name">

            <input type="submit"
                   name="addGenre"
                   value="Add Genre">

        </form>

    </div>

    <table>

        <tr>

            <th>ID</th>
            <th>Genre</th>
            <th>Action</th>

        </tr>

        <?php
        while($row = mysqli_fetch_assoc($genres))
        {
        ?>

        <tr>

            <td>
                <?php echo $row['id']; ?>
            </td>

            <td>
                <?php echo $row['genre_name']; ?>
            </td>

            <td>

                <a class="delete-btn"
                   href="?delete=<?php echo $row['id']; ?>">
                    Delete
                </a>

            </td>

        </tr>

        <?php
        }
        ?>

    </table>

</div>

</body>
</html>