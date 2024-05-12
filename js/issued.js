
function filterBooks() {
    var filter = document.querySelector('.filterDropdown').value;

    fetch('../php/issued.php?filter=' + filter)
        .then(response => response.json())
        .then(data => {
            var tableBody = document.querySelector('#issuedBookTable tbody');
            tableBody.innerHTML = '';

            // Check if data is not empty and get the keys of the first object
            if (data.length > 0) {
                // Filter out the 'id' field
                // console.log(Object.keys(data[0]));
                var filteredKeys = Object.keys(data[0]).filter(key => key != 'id' && key != 'return_date');

                // Create table headers
                var headerRow = document.createElement('tr');
                filteredKeys.forEach(key => {
                    if (key != 'id' || key != 'return_date') {
                        var headerCell = document.createElement('th');
                        headerCell.textContent = key;
                        headerRow.appendChild(headerCell);
                    }
                });
                // Add an additional header cell for the "Action" column
                var actionHeaderCell = document.createElement('th');
                actionHeaderCell.textContent = 'Action';
                headerRow.appendChild(actionHeaderCell);

                // Append header row to thead
                var thead = document.querySelector('#issuedBookTable thead');
                thead.innerHTML = ''; // Clear existing header rows
                thead.appendChild(headerRow);

                // Populate table rows
                data.forEach(book => {
                    var row = document.createElement('tr');
                    filteredKeys.forEach(key => {
                        if (key == 'id' || key == 'return_date') {
                            var cell = document.createElement('td');
                            cell.style.display = "none";
                        } else {
                            var cell = document.createElement('td');
                        }
                        cell.textContent = book[key];
                        row.appendChild(cell);
                    });

                    console.log(book.id);

                    // Add a cell for the "Action" column
                    var actionCell = document.createElement('td');
                    if (book.status === 'Issued' || book.status === 'Overdue') {
                        var returnButton = document.createElement('button');
                        returnButton.textContent = 'Return';
                        returnButton.onclick = function () {
                            returnBook(book.id);
                        };
                        actionCell.appendChild(returnButton);
                    } else if (book.status === 'Need checking') {
                        let AcceptButton = document.createElement('button');
                        let RejectButton = document.createElement('button');
                        AcceptButton.textContent = 'Accept';
                        RejectButton.textContent = 'Reject';

                        AcceptButton.onclick = function () {
                            acceptReservation(book.id)
                        };
                        RejectButton.onclick = function () {
                            rejectReservation(book.id)
                        };
                        actionCell.appendChild(AcceptButton);
                        actionCell.appendChild(RejectButton);
                    }
                    row.appendChild(actionCell);

                    tableBody.appendChild(row);
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function returnBook(Id) {
    fetch(`../php/returnBook.php?id=${Id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Book returned successfully');
                filterBooks();

            } else {
                console.error('Failed to return book');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function acceptReservation(bookId) {
    fetch(`../php/acceptReservation.php?id=${bookId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Reservation accepted successfully');
                filterBooks();
            } else {
                console.error('Failed to accept reservation');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function rejectReservation(bookId) {
    fetch(`../php/rejectReservation.php?id=${bookId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Reservation rejected successfully');
                filterBooks();
            } else {
                console.error('Failed to reject reservation');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

document.addEventListener("DOMContentLoaded", function () {
    var dropdown = document.querySelector('.filterDropdown');
    dropdown.selectedIndex = 0;
    filterBooks();
});