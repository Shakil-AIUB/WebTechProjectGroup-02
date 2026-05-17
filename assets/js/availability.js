function updateAvailability(){

    fetch(

        "http://localhost/WebTechProjectGroup-02/api/books/availability.php?id=" + BOOK_ID

    )

    .then(function(response){

        return response.json();

    })

    .then(function(data){

        let badge =
        document.getElementById("availability-badge");



        if(data.available > 0){

            badge.innerHTML =

            `
            
            <span class="badge available">
                Available
            </span>

            `;

        }
        else{

            badge.innerHTML =

            `
            
            <span class="badge unavailable">
                Unavailable
            </span>

            `;

        }

    });

}


updateAvailability();


