document.querySelectorAll(".approve-btn").forEach(btn => {

    btn.addEventListener("click", function(){

        let id = this.dataset.id;

        fetch("../api/borrow/approve.php", {
            method: "POST",
            body: new URLSearchParams({borrow_id: id})
        })
        .then(res => res.json())
        .then(data => {

            if(data.status === "success"){

                document.getElementById("status-" + id).innerText = "Active";

            }

        });

    });

});

document.querySelectorAll(".reject-btn").forEach(btn => {

    btn.addEventListener("click", function(){

        let id = this.dataset.id;

        fetch("../api/borrow/reject.php", {
            method: "POST",
            body: new URLSearchParams({borrow_id: id})
        })
        .then(res => res.json())
        .then(data => {

            if(data.status === "success"){

                document.getElementById("row-" + id).remove();

            }

        });

    });

});