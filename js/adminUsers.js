document.addEventListener("DOMContentLoaded", function() {
    getUsers();
});

function getUsers() {
    fetch('../php/get_user2.php')
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
                    <td>
                    <select>
                        <option>${user.role_name}</option>
                        ${user.available_roles.map(role => `<option>${role}</option>`).join('')}
                    </select>
                    <td>${user.gender_name}</td>
                    <td>
                    <select>
                       <option>${user.status_name}</option>
                       ${user.available_statuses.map(status => `<option>${status}</option>`).join('')}
                    </select>
                    </td>
                    <td class="action">
                        <button>Delete</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
}