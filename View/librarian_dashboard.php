<?php

<<<<<<< HEAD
<<<<<<< HEAD
include "../Config/Auth.php";

auth_check("librarian");
=======
include "../Controller/LibrarianDashboardController.php";
>>>>>>> 4fdd6d3e3b9187c46a1e4f63c90092607aa87cc8
=======
include "../Config/Auth.php";

auth_check("librarian");
>>>>>>> aea489d (add jarif)

?>

<!DOCTYPE html>
<html lang="en">
<<<<<<< HEAD
<<<<<<< HEAD
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
=======

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

>>>>>>> 4fdd6d3e3b9187c46a1e4f63c90092607aa87cc8
=======
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
>>>>>>> aea489d (add jarif)
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
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> aea489d (add jarif)
            font-size: 24px;
            font-weight: 600;
            color: #1a1a1a;
        }

        h2{
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #888;
<<<<<<< HEAD
=======
            font-size: 28px;
            font-weight: 700;
        }

        h2{
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #777;
>>>>>>> 4fdd6d3e3b9187c46a1e4f63c90092607aa87cc8
=======
>>>>>>> aea489d (add jarif)
            display: flex;
            align-items: center;
            gap: 10px;
        }

        h2::after{
            content: '';
            flex: 1;
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> aea489d (add jarif)
            height: 0.5px;
            background: rgba(0,0,0,0.1);
        }

        /* Summary */

<<<<<<< HEAD
=======
            height: 1px;
            background: rgba(0,0,0,0.1);
        }

>>>>>>> 4fdd6d3e3b9187c46a1e4f63c90092607aa87cc8
=======
>>>>>>> aea489d (add jarif)
        .summary-table{
            width: 100%;
            border-collapse: separate;
            border-spacing: 12px 0;
<<<<<<< HEAD
<<<<<<< HEAD
            margin: 0 -12px;
=======
>>>>>>> 4fdd6d3e3b9187c46a1e4f63c90092607aa87cc8
=======
            margin: 0 -12px;
>>>>>>> aea489d (add jarif)
        }

        .summary-table th,
        .summary-table td{
            background: #eceee8;
<<<<<<< HEAD
<<<<<<< HEAD
            border-radius: 8px;
=======
            border-radius: 10px;
>>>>>>> 4fdd6d3e3b9187c46a1e4f63c90092607aa87cc8
=======
            border-radius: 8px;
>>>>>>> aea489d (add jarif)
            padding: 1rem;
            width: 25%;
            text-align: left;
        }

        .summary-table th{
            font-size: 12px;
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> aea489d (add jarif)
            font-weight: 500;
            color: #666;
            padding-bottom: 4px;
        }

        .summary-table td{
            font-size: 28px;
            font-weight: 600;
            color: #1a1a1a;
            padding-top: 4px;
        }

        /* Cards */

        .card-grid{
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
<<<<<<< HEAD
=======
            color: #666;
        }

        .summary-table td{
            font-size: 30px;
            font-weight: bold;
        }

        .card-grid{
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
>>>>>>> 4fdd6d3e3b9187c46a1e4f63c90092607aa87cc8
=======
>>>>>>> aea489d (add jarif)
            gap: 1rem;
        }

        .card{
            background: #fff;
<<<<<<< HEAD
<<<<<<< HEAD
            border: 0.5px solid rgba(0,0,0,0.1);
            border-radius: 12px;
            padding: 1.5rem;
=======
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid rgba(0,0,0,0.08);
>>>>>>> 4fdd6d3e3b9187c46a1e4f63c90092607aa87cc8
=======
            border: 0.5px solid rgba(0,0,0,0.1);
            border-radius: 12px;
            padding: 1.5rem;
>>>>>>> aea489d (add jarif)
            transition: 0.2s;
        }

        .card:hover{
            transform: translateY(-2px);
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> aea489d (add jarif)
            box-shadow: 0 6px 16px rgba(0,0,0,0.05);
        }

        .card h3{
            font-size: 17px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .card p{
            font-size: 14px;
            color: #666;
            margin-bottom: 1rem;
        }

        .card a,
        .card button{
            display: inline-block;
            text-decoration: none;
            background: #1a1a1a;
            color: #fff;
            border: none;
            padding: 9px 18px;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            transition: opacity 0.15s;
            font-family: inherit;
        }

        .card a:hover,
        .card button:hover{
            opacity: 0.8;
        }

        /* Recent activities */

        .activity-box{
            background: #fff;
            border: 0.5px solid rgba(0,0,0,0.1);
            border-radius: 12px;
            overflow: hidden;
<<<<<<< HEAD
=======
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
>>>>>>> 4fdd6d3e3b9187c46a1e4f63c90092607aa87cc8
=======
>>>>>>> aea489d (add jarif)
        }

        .activity-table{
            width: 100%;
            border-collapse: collapse;
        }

        .activity-table th{
            background: #eceee8;
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> aea489d (add jarif)
            padding: 12px 16px;
            text-align: left;
            font-size: 13px;
            color: #666;
        }

        .activity-table td{
            padding: 14px 16px;
            border-top: 0.5px solid rgba(0,0,0,0.08);
            font-size: 14px;
        }

        .status{
            display: inline-block;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 500;
        }

        .issued{
            background: #fff6e8;
            color: #c27c00;
        }

        .returned{
            background: #f0faf4;
            color: #1a7a40;
<<<<<<< HEAD
=======
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
>>>>>>> 4fdd6d3e3b9187c46a1e4f63c90092607aa87cc8
=======
>>>>>>> aea489d (add jarif)
        }

    </style>

</head>

<body>

<div class="dashboard-container">

<<<<<<< HEAD
<<<<<<< HEAD
    <h1>Librarian Dashboard</h1>
=======
    <h1>
        Welcome,
        <?= $_SESSION['name']; ?>
    </h1>
>>>>>>> 4fdd6d3e3b9187c46a1e4f63c90092607aa87cc8
=======
    <h1>Librarian Dashboard</h1>
>>>>>>> aea489d (add jarif)

    <h2>Dashboard Summary</h2>

    <table class="summary-table">

        <tr>
            <th>Total Books</th>
            <th>Issued Today</th>
            <th>Returned Today</th>
            <th>Pending Returns</th>
        </tr>

        <tr>
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> aea489d (add jarif)
            <td>540</td>
            <td>12</td>
            <td>7</td>
            <td>18</td>
<<<<<<< HEAD
=======
            <td><?= $totalBooks ?></td>
            <td><?= $issuedToday ?></td>
            <td><?= $returnedToday ?></td>
            <td><?= $pendingReturns ?></td>
>>>>>>> 4fdd6d3e3b9187c46a1e4f63c90092607aa87cc8
=======
>>>>>>> aea489d (add jarif)
        </tr>

    </table>

<<<<<<< HEAD
<<<<<<< HEAD

=======
>>>>>>> 4fdd6d3e3b9187c46a1e4f63c90092607aa87cc8
=======

>>>>>>> aea489d (add jarif)
    <h2>Quick Actions</h2>

    <div class="card-grid">

        <div class="card">
<<<<<<< HEAD
<<<<<<< HEAD
            <h3>Manage Books</h3>
            <p>Add, edit and remove books from the library system.</p>
            <a href="../View/BookList.php">Open</a>
        </div>
=======
            <h3>Manage Books</h3>
            <p>Add, edit and remove books from the library system.</p>
            <a href="../View/Books.php">Open</a>
        </div>

        <div class="card">
            <h3>Issue Books</h3>
            <p>Issue books to members and manage borrowing records.</p>
            <a href="../View/IssueBook.php">Open</a>
        </div>

>>>>>>> aea489d (add jarif)
        <div class="card">
            <h3>Update Profile</h3>
            <p>Edit your personal information and account password.</p>
            <button onclick="window.location.href='../View/Profile.php'">
                Open
            </button>
        </div>

        <div class="card">
            <h3>Logout</h3>
            <p>Securely logout from the librarian dashboard.</p>
            <a href="../Controller/logout.php">Logout</a>
<<<<<<< HEAD
=======

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

>>>>>>> 4fdd6d3e3b9187c46a1e4f63c90092607aa87cc8
=======
>>>>>>> aea489d (add jarif)
        </div>

    </div>

<<<<<<< HEAD
<<<<<<< HEAD

=======
>>>>>>> 4fdd6d3e3b9187c46a1e4f63c90092607aa87cc8
=======

>>>>>>> aea489d (add jarif)
    <h2>Recent Activities</h2>

    <div class="activity-box">

        <table class="activity-table">

            <tr>
                <th>Member</th>
                <th>Book</th>
                <th>Status</th>
                <th>Date</th>
            </tr>

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> aea489d (add jarif)
            <tr>
                <td>Shakil Ahmed</td>
                <td>Web Technology</td>
                <td><span class="status issued">Issued</span></td>
                <td>13 May 2026</td>
            </tr>

            <tr>
                <td>Nusrat Jahan</td>
                <td>Database Systems</td>
                <td><span class="status returned">Returned</span></td>
                <td>12 May 2026</td>
            </tr>

            <tr>
                <td>Rakib Hasan</td>
                <td>Operating Systems</td>
                <td><span class="status issued">Issued</span></td>
                <td>11 May 2026</td>
            </tr>
<<<<<<< HEAD
=======
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
>>>>>>> 4fdd6d3e3b9187c46a1e4f63c90092607aa87cc8
=======
>>>>>>> aea489d (add jarif)

        </table>

    </div>

</div>

<<<<<<< HEAD
<<<<<<< HEAD
<p style="text-align:center;margin-top:20px;"><a href="LibrarianFineDashboard.php">Fine Dashboard</a></p>
=======
>>>>>>> 4fdd6d3e3b9187c46a1e4f63c90092607aa87cc8
=======
>>>>>>> aea489d (add jarif)
</body>
</html>