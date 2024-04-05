function goToBookshelf() {
    window.location.href = "bookShelf.html";
}

function goToWishlist() {
    window.location.href = "wishList.html";
}

function logOut() {
    fetch("../php/log_out.php");
    window.location.href = "login.html";
}

function goToHome() {
    window.location.href = "home.html";
}

function goToActiveBorrowed() {
    window.location.href = "ActiveBorrowed.html";
}

function goToBorrowed() {
    window.location.href = "Borrowed.html";
}

function goToLogIn() {
    window.location.href = "login.html";
}

function goToSignUp() {
    window.location.href = "signUp.html";
}
function showError() {
    document.getElementById("error_message").style.display = "block";
}

document.addEventListener("DOMContentLoaded", userCheck);

function userCheck() {
    fetch("../php/user_now.php")
        .then(response => response.json())
        .then(data => {
            changeAva(data);
        })
        .catch(error => {
            console.error("Error:", error);
        });
}

function changeAva(data) {
    var ava_menu = document.querySelector('.ava_menu');
    ava_menu.innerHTML = '';

    var avatarContainerDiv = document.createElement('div');
    avatarContainerDiv.classList.add('avatar-container');

    var avatarImg = document.createElement('img');
    avatarImg.classList.add('ava');
    avatarImg.src = "../img/81nq+ewtkcL._AC_UF1000,1000_QL80_.jpg";

    avatarContainerDiv.appendChild(avatarImg);

    var accountNameDiv = document.createElement('div');
    accountNameDiv.classList.add('account_name');
    accountNameDiv.textContent = data.username;

    var dropdownImg = document.createElement('img');
    dropdownImg.classList.add('drop_down_menu');
    dropdownImg.src = "../img/icons8-expand-arrow-64.png";
    dropdownImg.width = "25";
    dropdownImg.height = "25";

    ava_menu.appendChild(avatarContainerDiv);
    ava_menu.appendChild(accountNameDiv);
    ava_menu.appendChild(dropdownImg);
}








