<?php 
include "../Controller/AdminReportsController.php"; 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Reports</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body{
            font-family: Arial;
            background: #f4f6f9;
            padding: 40px;
        }

        .container{
            max-width: 1100px;
            margin: auto;
        }

        h1, h2{
            color: #1a3a5c;
        }

        .grid{
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th{
            background: #1a3a5c;
            color: white;
            padding: 12px;
            text-align: left;
        }

        td{
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        .card{
            background: white;
            padding: 20px;
            margin-top: 25px;
            border-radius: 10px;
        }
            .report-link a{
        background: #1a3a5c;
        color: white;
        padding: 10px 18px;
        border-radius: 6px;
        text-decoration: none;
    }

    .report-link a:hover{
        background: #10263d;
    }

        @media(max-width:800px){
            .grid{
                grid-template-columns: 1fr;
            }
        }

        
    </style>
</head>

<body>

<div class="container">

    <h1>Admin Reports</h1>

    <div class="grid">

        <div>
            <h2>Top 10 Most Borrowed Books</h2>

            <table>
                <tr>
                    <th>#</th>
                    <th>Book</th>
                    <th>Total</th>
                </tr>

                <?php 
                $i = 1;

                if($books && $books->num_rows > 0)
                {
                    while($row = $books->fetch_assoc())
                    {
                ?>

                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo htmlspecialchars($row["title"]); ?></td>
                    <td><?php echo (int)$row["total"]; ?></td>
                </tr>

                <?php 
                    }
                }
                else
                {
                ?>

                <tr>
                    <td colspan="3">No data found.</td>
                </tr>

                <?php 
                }
                ?>
            </table>
        </div>


        <div>
            <h2>Top 10 Active Members</h2>

            <table>
                <tr>
                    <th>#</th>
                    <th>Member</th>
                    <th>Total</th>
                </tr>

                <?php 
                $i = 1;

                if($members && $members->num_rows > 0)
                {
                    while($row = $members->fetch_assoc())
                    {
                ?>

                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo htmlspecialchars($row["name"]); ?></td>
                    <td><?php echo (int)$row["total"]; ?></td>
                </tr>

                <?php 
                    }
                }
                else
                {
                ?>

                <tr>
                    <td colspan="3">No data found.</td>
                </tr>

                <?php 
                }
                ?>
            </table>
        </div>

    </div>


    <div class="card">
        <h2>Total Borrows Per Month - Past 6 Months</h2>

        <canvas id="borrowChart"></canvas>
    </div>


    <p>
        <a href="admin_dashboard.php">Back to Dashboard</a>
    </p>

</div>


<script>

const x = document.getElementById("borrowChart");

new Chart(x, {
    type: "bar",

    data: {
        labels: <?= json_encode($chartLabels) ?>,

        datasets: [{
            data: <?= json_encode($chartData) ?>
        }]
    }
});

</script>

</body>
</html>