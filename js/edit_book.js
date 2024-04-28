document.addEventListener("DOMContentLoaded", function () {
    const editSubmitButton = document.getElementById("edit-submit");

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const book_id = urlParams.get('id');
    // console.log(book_id);

    function areAllFieldsEmpty() {
        const newTitle = document.getElementById("newTitle").value.trim();
        const newAuthor = document.getElementById("newAuthor").value.trim();
        const newInstock = document.getElementById("newInstock").value.trim();
        const newISBN = document.getElementById("newISBN").value.trim();
        const newDescription = document.getElementById("newDescription").value.trim();
        return !newTitle && !newAuthor && !newInstock && !newISBN && !newDescription;
    }

    function toggleSubmitButton() {
        if (areAllFieldsEmpty()) {
            editSubmitButton.disabled = true;
        } else {
            editSubmitButton.disabled = false;
        }
    }

    toggleSubmitButton();

    const inputFields = document.querySelectorAll(".edit_container input, .edit_container textarea");
    inputFields.forEach(function (inputField) {
        inputField.addEventListener("input", toggleSubmitButton);
    });

    editSubmitButton.addEventListener("click", function () {
        const newTitle = document.getElementById("newTitle").value.trim();
        const newAuthorString = document.getElementById("newAuthor").value.trim();
        const newAuthors = newAuthorString.split(';').map(author => author.trim());
        const newInstock = document.getElementById("newInstock").value;
        const newISBN = document.getElementById("newISBN").value.trim();
        const newDescription = document.getElementById("newDescription").value.trim();

        // console.log(newAuthors);

        var editData = new FormData();
        editData.append('newTitle', newTitle);
        for (var i = 0; i < newAuthors.length; i++) {
            editData.append('newAuthors[]', newAuthors[i]);
        }
        editData.append('newInstock', parseInt(newInstock));
        editData.append('newISBN', newISBN);
        editData.append('newDescription', newDescription);


        // console.log(editData);
        // console.log(book_id);

        let url = "../php/edit_book.php?book_id=" + book_id;
        fetch(url, {
            method: "POST",
            body: editData
        })
            .then(Response => Response.json())
            .then(data => {
                if (data.success) {
                    console.log(data.success);
                }
                else {
                    console.log(data.error);
                }
            })
            .catch(err => {
                console.log(err);
            })
    });
});
