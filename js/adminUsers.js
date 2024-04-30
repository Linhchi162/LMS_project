document.addEventListener("DOMContentLoaded", function() {
    getUsers();
});

function getUsers() {
    fetch('../php/get_user.php')
        .then(response => response.json())
        .then(data => {
            var tableBody = document.querySelector('#issuedBookTable tbody');
            tableBody.innerHTML = '';


            data.forEach(user => {
                var row = document.createElement('tr');
                row.innerHTML = `
                    <td>${user.account_id}</td>
                    <td>${user.username}</td>
                    <td>${user.full_name}</td>
                    <td>${user.gmail}</td>
                    <td>${user.role_name}</td>
                    <td>${user.gender_name}</td>
                    <td>${user.status_name}</td>
                    <td class="action">
                        <button>Delete</button>
                        <button>Edit</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
}