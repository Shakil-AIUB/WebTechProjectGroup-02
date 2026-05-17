<?php include "../Controller/AddBookController.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Book</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f0f4f8;
            min-height: 100vh;
            padding: 40px 20px;
        }

        .page-wrapper {
            max-width: 560px;
            margin: 0 auto;
        }

        .page-title {
            font-size: 22px;
            font-weight: 600;
            color: #1a3a5c;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 2px solid #1a3a5c;
        }

        .alert {
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 18px;
            font-weight: 500;
        }

        .alert-error {
            background: #fde8e8;
            color: #c0392b;
            border-left: 4px solid #c0392b;
        }

        .alert-success {
            background: #e8f8f0;
            color: #1e7a4c;
            border-left: 4px solid #1e7a4c;
        }

        .card {
            background: #ffffff;
            border: 1px solid #dde3eb;
            border-radius: 12px;
            padding: 28px 32px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table tr td {
            padding: 8px 4px;
            vertical-align: middle;
        }

        td:first-child {
            font-size: 13px;
            font-weight: 600;
            color: #555;
            white-space: nowrap;
            padding-right: 16px;
            width: 90px;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 9px 12px;
            font-size: 14px;
            font-family: inherit;
            background: #f7f9fc;
            color: #1a1a1a;
            border: 1px solid #c8d0da;
            border-radius: 8px;
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus {
            border-color: #1a3a5c;
            box-shadow: 0 0 0 3px rgba(26, 58, 92, 0.1);
            background: #fff;
        }

        select {
            cursor: pointer;
        }

        /* Button row */
        .btn-row {
            display: flex;
            gap: 10px;
            margin-top: 8px;
        }

        .btn-back,
        input[type="submit"] {
            flex: 1;
            padding: 10px;
            font-size: 14px;
            font-weight: 600;
            font-family: inherit;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.15s, transform 0.1s;
            border: none;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }

        .btn-back {
            background: #f0f4f8;
            color: #1a3a5c;
            border: 1.5px solid #1a3a5c;
        }

        .btn-back:hover {
            background: #dde3eb;
        }

        input[type="submit"] {
            background: #1a3a5c;
            color: #fff;
        }

        input[type="submit"]:hover {
            background: #133055;
        }

        .btn-back:active,
        input[type="submit"]:active {
            transform: scale(0.98);
        }
    </style>
</head>
<body>

<div class="page-wrapper">

    <h1 class="page-title">Add New Book</h1>

    <?php if ($error != ""): ?>
        <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if ($success != ""): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <div class="card">
        <form method="post">
            <table>
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title"></td>
                </tr>
                <tr>
                    <td>Author:</td>
                    <td><input type="text" name="author"></td>
                </tr>
                <tr>
                    <td>ISBN:</td>
                    <td><input type="text" name="isbn"></td>
                </tr>
                <tr>
                    <td>Genre:</td>
                    <td>
                        <select name="genre">
                            <?php foreach ($genres as $row): ?>
                                <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['genre_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Copies:</td>
                    <td><input type="number" name="copies" min="1"></td>
                </tr>
                <tr>
                    <td>Shelf:</td>
                    <td><input type="text" name="shelf"></td>
                </tr>
                <tr>
                    <td>Year:</td>
                    <td><input type="number" name="year" min="1000" max="<?= date('Y') ?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <div class="btn-row">
                            <a class="btn-back" href="../View/librarian_dashboard.php">← Back</a>
                            <input type="submit" name="addBook" value="Add Book">
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>

</div>

</body>
</html>