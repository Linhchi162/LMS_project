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

function goToAddBook() {
    window.location.href = "addBook.html";
}
function goToGenre() {
    window.location.href = "adminGenre.html";
}
function goToManual() {
    document.querySelector(".manual-container").style.display = "block";
    document.querySelector(".white_container").style.display = "none";
}
function goToSearch() {
    document.querySelector(".manual-container").style.display = "none";
    document.querySelector(".white_container").style.display = "block";
}
function goToModify() {
    document.querySelector(".white_container").style.display = "block";
    document.querySelector(".add-container").style.display = "none";
}
function goToAdd() {
    document.querySelector(".add-container").style.display = "block";
    document.querySelector(".white_container").style.display = "none";
}

function goToDetail() {
    document.querySelector(".add-container").style.display = "none";
}

function showBookDetail() {
    document.querySelector(".white_container .top .right-column").style.display = "block";
    document.querySelector(".top .book_cover").style.display = "block";
    document.querySelector(".bottom").style.display = "block";
}

function hideBookDetail() {
    document.querySelector(".white_container .top .right-column").style.display = "none";
    document.querySelector(".top .book_cover").style.display = "none";
    document.querySelector(".bottom").style.display = "none";
    document.querySelector(".comments").style.display = "none";
}

function backToBookDetail() {
    showBookDetail()
    document.querySelector(".edit_container").style.display = "none";
    document.querySelector(".delete-container").style.display = "none";
    document.querySelector(".move-container").style.display = "none";
    document.querySelector(".details-container").style.display = "none";
    document.querySelector(".blur").style.display = "none";
    document.querySelector(".choose_action_bar").style.display = "block";
    document.querySelector(".comments").style.display = "flex";
}

function goToEdit() {
    hideBookDetail();
    document.querySelector(".edit_container").style.display = "inline-block";
    document.querySelector(".delete-container").style.display = "none";
    document.querySelector(".move-container").style.display = "none";
    document.querySelector(".details-container").style.display = "none";
    document.querySelector(".blur").style.display = "none";
    document.querySelector(".choose_action_bar").style.display = "none";
}
function goToDelete() {
    showBookDetail();
    document.querySelector(".delete-container").style.display = "block";
    document.querySelector(".blur").style.display = "flex";
    document.querySelector(".edit_container").style.display = "none";
    document.querySelector(".move-container").style.display = "none";
    document.querySelector(".details-container").style.display = "none";
    document.querySelector(".choose_action_bar").style.display = "none";
}
function goToMove() {
    showBookDetail()
    document.querySelector(".move-container").style.display = "block";
    document.querySelector(".blur").style.display = "block";
    document.querySelector(".delete-container").style.display = "none";
    document.querySelector(".edit_container").style.display = "none";    
    document.querySelector(".details-container").style.display = "none";
    document.querySelector(".choose_action_bar").style.display = "none";
}
function goToDetails() {
    hideBookDetail();
    document.querySelector(".edit_container").style.display = "none";  
    document.querySelector(".details-container").style.display = "block";
    document.querySelector("blur").style.display = "none";
    document.querySelector(".move-container").style.display = "none";
    document.querySelector(".delete-container").style.display = "none";
    document.querySelector(".choose_action_bar").style.display = "none";
}
function drop_down_menu() {
    var dropdown = document.querySelector('.ava-dropdown');
    if (dropdown.style.display === 'none') {
        dropdown.style.display = 'block';
    } else {
        dropdown.style.display = 'none';
    }
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








