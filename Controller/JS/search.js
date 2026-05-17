function searchBook()
{
    let search = document.getElementById("search").value;

    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200)
        {
            let books = JSON.parse(this.responseText);

            let output = "";

            books.forEach(book => {

                let className = (book.available_copies == 0) ? "red-row" : "";

                output += `
                <tr class="${className}">
                    <td>${book.title}</td>
                    <td>${book.author}</td>
                    <td>${book.genre_name}</td>
                    <td>${book.total_copies}</td>
                    <td>${book.available_copies}</td>
                    <td>
                        <a href="EditBook.php?id=${book.id}">Edit</a>
                        |
                        <a href="../Controller/DeleteBookController.php?id=${book.id}">Delete</a>
                    </td>
                </tr>
                `;
            });

            document.getElementById("tableBody").innerHTML = output;
        }
    }

    xhttp.open("GET", "../api/books/search.php?q=" + search, true);
    xhttp.send();
}