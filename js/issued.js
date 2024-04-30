
function filterBooks() {
    var filter = document.querySelector('.filterDropdown').value;

    
    fetch('../php/issued.php?filter=' + filter)
        .then(response => response.json())
        .then(data => {
            
            var tableBody = document.querySelector('#issuedBookTable tbody');
            tableBody.innerHTML = '';

            
            data.forEach(book => {
                var row = document.createElement('tr');
                row.innerHTML = `
                    <td>${book.title}</td>
                    <td>${book.borrower_name}</td>
                    <td>${book.borrow_date}</td>
                    <td>${book.design_return_date}</td>
                    <td>${book.status}</td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

document.addEventListener("DOMContentLoaded", function() {
    var dropdown = document.querySelector('.filterDropdown');
    dropdown.selectedIndex = 0;
    filterBooks();
});