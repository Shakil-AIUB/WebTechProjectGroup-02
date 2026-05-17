<?php

include_once '../Controller/BorrowController.php';

$controller = new BorrowController();

$requests = $controller->pendingRequests();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Pending Requests</title>
</head>
<body>

<h1>Pending Borrow Requests</h1>

<table border="1" cellpadding="10">

<tr>

    <th>Member</th>
    <th>Book</th>
    <th>Status</th>
    <th>Action</th>

</tr>

<?php foreach($requests as $r){ ?>

<tr id="row-<?= $r['borrow_id']; ?>">

    <td>
        <?= $r['member_name']; ?>
    </td>

    <td>
        <?= $r['book_title']; ?>
    </td>

    <td id="status-<?= $r['borrow_id']; ?>">
        <?= $r['status']; ?>
    </td>

    <td>

        <button
        class="approve-btn"
        data-id="<?= $r['borrow_id']; ?>"
        >
            Approve
        </button>

        <button
        class="reject-btn"
        data-id="<?= $r['borrow_id']; ?>"
        >
            Reject
        </button>

    </td>

</tr>

<?php } ?>

</table>

<script>

document.querySelectorAll(".approve-btn").forEach(btn => {

    btn.addEventListener("click", function(){

        let id = this.dataset.id;

        fetch("../api/borrow/approve.php", {

            method: "POST",

            body: new URLSearchParams({

                borrow_id: id

            })

        })

        .then(res => res.json())

        .then(data => {

            if(data.status === "success"){

                document.getElementById(
                    "status-" + id
                ).innerText = "Active";

            }

        });

    });

});

document.querySelectorAll(".reject-btn").forEach(btn => {

    btn.addEventListener("click", function(){

        let id = this.dataset.id;

        fetch("../api/borrow/reject.php", {

            method: "POST",

            body: new URLSearchParams({

                borrow_id: id

            })

        })

        .then(res => res.json())

        .then(data => {

            if(data.status === "success"){

                document.getElementById(
                    "row-" + id
                ).remove();

            }

        });

    });

});

</script>

</body>
</html>