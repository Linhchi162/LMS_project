function goToBookshelf() {
    window.location.href = "bookShelf.html";
}

function goToWishlist() {
    window.location.href = "wishList.html";
}

function logOut() {
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
    document.querySelector(".add-container").style.display = "none";
}
function goToAdd() {
    document.querySelector(".add-container").style.display = "block";
}
function hideBookDetail() {
    document.querySelector(".white_container .top .right-column").style.display = "none";
    document.querySelector(".top .book_cover").style.display = "none";
    document.querySelector(".bottom").style.display = "none";
}
function showBookDetail() {
    document.querySelector(".white_container .top .right-column").style.display = "block";
    document.querySelector(".top .book_cover").style.display = "block";
    document.querySelector(".bottom").style.display = "block";
}
function backToBookDetail() {
    showBookDetail()
    document.querySelector(".edit_container").style.display = "none";
    document.querySelector(".delete-container").style.display = "none";
    document.querySelector(".move-container").style.display = "none";
    document.querySelector(".details-container").style.display = "none";
    document.querySelector(".blur").style.display = "none";
}

function goToDetail() {
    document.querySelector(".add-container").style.display = "none";
}
function goToEdit() {
    hideBookDetail();
    document.querySelector(".edit_container").style.display = "flex";
    document.querySelector(".delete-container").style.display = "none";
    document.querySelector(".move-container").style.display = "none";
    document.querySelector(".details-container").style.display = "none";
    document.querySelector(".blur").style.display = "none";
}
function goToDelete() {
    showBookDetail()
    document.querySelector(".delete-container").style.display = "block";
    document.querySelector(".blur").style.display = "block";
    document.querySelector(".edit_container").style.display = "none";
    document.querySelector(".move-container").style.display = "none";
    document.querySelector(".details-container").style.display = "none";
}
function goToMove() {
    showBookDetail()
    document.querySelector(".move-container").style.display = "block";
    document.querySelector(".blur").style.display = "block";
    document.querySelector(".delete-container").style.display = "none";
    document.querySelector(".edit_container").style.display = "none";    
    document.querySelector(".details-container").style.display = "none";
}
function goTodetails() {
    hideBookDetail();

    document.querySelector(".edit_container").style.display = "none";  
    document.querySelector(".details-container").style.display = "block";
    document.querySelector("blur").style.display = "none";
    document.querySelector(".move-container").style.display = "none";
    document.querySelector(".delete-container").style.display = "none";
}
function drop_down_menu() {
    var dropdown = document.querySelector('.ava-dropdown');
    if (dropdown.style.display === 'none') {
        dropdown.style.display = 'block';
    } else {
        dropdown.style.display = 'none';
    }
}



