<?php

include "../Controller/LibrarianDashboardController.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Librarian Dashboard</title>

    <style>

        *, *::before, *::after{
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body{
            font-family: 'Segoe UI', system-ui, sans-serif;
            font-size: 15px;
            line-height: 1.6;
            background: #f4f4f1;
            color: #1a1a1a;
            min-height: 100vh;
            padding: 2rem 1rem;
        }

        .dashboard-container{
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        h1{
            font-size: 28px;
            font-weight: 700;
        }

        h2{
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #777;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        h2::after{
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(0,0,0,0.1);
        }

        .summary-table{
            width: 100%;
            border-collapse: separate;
            border-spacing: 12px 0;
        }

        .summary-table th,
        .summary-table td{
            background: #eceee8;
            border-radius: 10px;
            padding: 1rem;
            width: 25%;
            text-align: left;
        }

        .summary-table th{
            font-size: 12px;
            color: #666;
        }

        .summary-table td{
            font-size: 30px;
            font-weight: bold;
        }

        .card-grid{
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1rem;
        }

        .card{
            background: #fff;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid rgba(0,0,0,0.08);
            transition: 0.2s;
        }

        .card:hover{
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(0,0,0,0.08);
        }

        .card h3{
            margin-bottom: 10px;
            font-size: 18px;
        }

        .card p{
            color: #666;
            font-size: 14px;
            margin-bottom: 16px;
        }

        .card a{
            background: #1a1a1a;
            color: white;
            border-radius: 8px;
            padding: 10px 18px;
            text-decoration: none;
            display: inline-block;
        }

        .activity-box{
            background: white;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid rgba(0,0,0,0.08);
        }

        .activity-table{
            width: 100%;
            border-collapse: collapse;
        }

        .activity-table th{
            background: #eceee8;
            padding: 14px;
            text-align: left;
            font-size: 13px;
            color: #555;
        }

        .activity-table td{
            padding: 14px;
            border-top: 1px solid rgba(0,0,0,0.06);
        }

        .status{
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .issued{
            background: #fff4d6;
            color: #9b6500;
        }

        .returned{
            background: #e7f8ee;
            color: #157347;
        }

    </style>

</head>

<body>

<div class="dashboard-container">

    <h1>
        Welcome,
        <?= $_SESSION['name']; ?>
    </h1>

    <h2>Dashboard Summary</h2>

    <table class="summary-table">

        <tr>
            <th>Total Books</th>
            <th>Issued Today</th>
            <th>Returned Today</th>
            <th>Pending Returns</th>
        </tr>

        <tr>
            <td><?= $totalBooks ?></td>
            <td><?= $issuedToday ?></td>
            <td><?= $returnedToday ?></td>
            <td><?= $pendingReturns ?></td>
        </tr>

    </table>

    <h2>Quick Actions</h2>

    <div class="card-grid">

        <div class="card">

            <h3>Add Book</h3>

            <p>
                Add new books to library.
            </p>

            <a href="AddBook.php">
                Open
            </a>

        </div>

        <div class="card">

            <h3>Book List</h3>

            <p>
                Manage all books and availability.
            </p>

            <a href="BookList.php">
                Open
            </a>

        </div>

        <div class="card">

            <h3>Genres</h3>

            <p>
                Add and manage genres.
            </p>

            <a href="Genres.php">
                Open
            </a>

        </div>

        <div class="card">

            <h3>Logout</h3>

            <p>
                Securely logout from system.
            </p>

            <a href="../Controller/logout.php">
                Logout
            </a>

        </div>

    </div>

    <h2>Recent Activities</h2>

    <div class="activity-box">

        <table class="activity-table">

            <tr>
                <th>Member</th>
                <th>Book</th>
                <th>Status</th>
                <th>Date</th>
            </tr>

            <?php while($row = $activities->fetch_assoc()) { ?>

            <tr>

                <td>
                    <?= $row['member_name']; ?>
                </td>

                <td>
                    <?= $row['book_title']; ?>
                </td>

                <td>

                    <?php
                    if($row['status'] == "Returned")
                    {
                    ?>

                    <span class="status returned">
                        Returned
                    </span>

                    <?php
                    }
                    else
                    {
                    ?>

                    <span class="status issued">
                        Issued
                    </span>

                    <?php
                    }
                    ?>

                </td>

                <td>

                    <?php

                    if($row['status'] == "Returned")
                    {
                        echo date(
                            "d M Y",
                            strtotime($row['return_date'])
                        );
                    }
                    else
                    {
                        echo date(
                            "d M Y",
                            strtotime($row['borrow_date'])
                        );
                    }

                    ?>

                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>