import { renderComments } from "./render.js";

let comment_data = []   
const comment_section = document.querySelector(".error_message");

document.addEventListener("DOMContentLoaded", function () {
    const Form = document.querySelector(".comment-container");
    const reservation = document.querySelector(".borrow-button");
    const wishlist = document.querySelector(".bookmark-button");

    
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const book_id = urlParams.get('id');
    console.log(book_id);

    console.log(comment_data);
    getCommentData(book_id);

    reservation.addEventListener("click", function () {
        console.log("click on reservation");
    });

    wishlist.addEventListener("click", function () {
        console.log("click on wishlist");
    });

    Form.addEventListener("submit", function (event) {
        event.preventDefault();
        addComments(Form, book_id);
    });
})

function addComments(Form, book_id) {
    const addData = new FormData(Form);
    let url = "../php/add_comment.php?book_id=" + book_id;

    fetch(url, {
        method: "POST",
        body: addData
    })
        .then(response => response.text())
        .then(data => {
            comment_section.style.display = 'grid'; 
            comment_section.textContent = data; 
        })
        .catch(error => {
            console.error("Error:", error);
        });
}

function addToWishList(book_id) {
    let url = "../php/add_wishlist.php?book_id=" + book_id;

    fetch(url, {
        method: "POST",
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
        })
        .catch(error => {
            console.error("Error:", error);
        });
}

function addToReservation(book_id) {
    let url = "../php/add_Reservation.php?book_id=" + book_id;

    fetch(url, {
        method: "POST",
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
        })
        .catch(error => {
            console.error("Error:", error);
        });
}

function getCommentData(book_id) {
    let url = "../php/get_comment.php?book_id=" + book_id;
    fetch(url, {
        method: "POST",
    })
        .then(response => response.json())
        .then(data => {
            comment_data = data.success;
            console.log(comment_data);
            console.log(data);
            renderComments("comments", comment_data);
        })
        .catch(error => {
            console.error("Error:", error);
        });
}