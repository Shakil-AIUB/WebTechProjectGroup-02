let buttons = document.querySelectorAll('.borrow-button');

buttons.forEach(button => {
    button.addEventListener("click", function() {
        let book_id = this.dataset.id;

        let formData = new FormData();

        formData.append("book_id", book_id);

        fetch("../api/borrow/request.php", {

            method: "POST",

            body: formData

        })

        .then(response => response.json())

        .then(data => {

            alert(data.message);

            location.reload();

        });

    });
});