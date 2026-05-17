<?php 
include "../Controller/LibrarianFineController.php"; 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Librarian Fine Dashboard</title>

    <style>
        body{
            font-family: Arial;
            background: #f4f6f9;
            padding: 40px;
        }

        .container{
            max-width: 1200px;
            margin: auto;
        }

        h1{
            color: #1a3a5c;
        }

        input{
            padding: 10px;
            margin: 4px;
        }

        .btn{
            background: #1a3a5c;
            color: white;
            border: 0;
            border-radius: 6px;
            cursor: pointer;
            padding: 10px 15px;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            background: white;
            margin-top: 20px;
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

        .msg{
            margin-top: 12px;
            font-weight: bold;
            color: green;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Librarian Fine Dashboard</h1>

    <form method="get">
        <input 
            type="text" 
            name="search" 
            placeholder="Search member name"
            value="<?php echo htmlspecialchars($search); ?>"
        >

        <input class="btn" type="submit" value="Search">
    </form>

    <div id="message" class="msg"></div>

    <table>
        <tr>
            <th>Member</th>
            <th>Book</th>
            <th>Due Date</th>
            <th>Days</th>
            <th>Amount</th>
            <th>Action</th>
        </tr>

        <?php 
        if($fines && $fines->num_rows > 0)
        {
            while($row = $fines->fetch_assoc())
            {
        ?>

        <tr id="fine-row-<?php echo $row['id']; ?>">
            <td><?php echo htmlspecialchars($row["name"]); ?></td>
            <td><?php echo htmlspecialchars($row["title"]); ?></td>
            <td><?php echo htmlspecialchars($row["due_date"]); ?></td>
            <td><?php echo (int)$row["overdue_days"]; ?></td>
            <td><?php echo number_format((float)$row["amount"], 2); ?> TK</td>

            <td>
                <button 
                    type="button" 
                    class="btn" 
                    onclick="payFine(<?php echo $row['id']; ?>)"
                >
                    Mark as Paid
                </button>
            </td>
        </tr>

        <?php 
            }
        }
        else
        {
        ?>

        <tr>
            <td colspan="6">No unpaid fines found.</td>
        </tr>

        <?php 
        }
        ?>

    </table>

    <p>
        <a href="librarian_dashboard.php">Back to Dashboard</a>
    </p>

</div>


<script>
function payFine(id)
{
    var xhr = new XMLHttpRequest();

    xhr.open("POST", "../api/fines/pay.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function()
    {
        var message = document.getElementById("message");

        if(xhr.status === 200)
        {
            var data = JSON.parse(xhr.responseText);

            if(data.success)
            {
                var row = document.getElementById("fine-row-" + id);

                if(row)
                {
                    row.remove();
                }

                message.innerHTML = "Fine marked as paid.";
            }
            else
            {
                message.innerHTML = data.message;
            }
        }
        else
        {
            message.innerHTML = "Request failed.";
        }
    };

    xhr.send("fine_id=" + id);
}
</script>

</body>
</html>