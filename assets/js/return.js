document.addEventListener("DOMContentLoaded", function(){

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

                document.getElementById("row-" + id).remove();

            });

        });

    });

});