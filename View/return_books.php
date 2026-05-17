<?php

include_once '../Controller/BorrowController.php';

$controller = new BorrowController();

$keyword = $_GET['search'] ?? '';

$loans = $controller->searchLoans($keyword);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Return Books</title>
</head>
<body>

<h1>Return Books</h1>

<form>

<input
type="text"
name="search"
value="<?= $keyword; ?>"
placeholder="Search..."
>

<button>
    Search
</button>

</form>

<table border="1" cellpadding="10">

<tr>

    <th>Member</th>
    <th>Book</th>
    <th>Date</th>
    <th>Action</th>

</tr>

<?php foreach($loans as $l){ ?>

<tr id="row-<?= $l['borrow_id']; ?>">

    <td>
        <?= $l['member_name']; ?>
    </td>

    <td>
        <?= $l['book_title']; ?>
    </td>

    <td>
        <?= $l['borrow_date']; ?>
    </td>

    <td>

        <button
        class="return-btn"
        data-id="<?= $l['borrow_id']; ?>"
        >
            Return
        </button>

    </td>

</tr>

<?php } ?>

</table>

<script>

document.querySelectorAll(".return-btn").forEach(btn => {

    btn.addEventListener("click", function(){

        let id = this.dataset.id;

        fetch("../api/borrow/return.php", {

            method: "POST",

            body: new URLSearchParams({

                borrow_id: id

            })

        })

        .then(res => res.json())

        .then(data => {

            alert(data.message);

            document.getElementById(
                "row-" + id
            ).remove();

        });

    });

});

</script>

</body>
</html>