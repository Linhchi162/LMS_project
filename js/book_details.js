import { renderComments } from "./render.js";

document.addEventListener("DOMContentLoaded", function () {
    const Form = document.querySelector(".comment-container");
    const reservation = document.querySelector(".borrow-button");
    const wishlist = document.querySelector(".bookmark-button");

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const book_id = urlParams.get('id');
    console.log(book_id);

    let comment_data = [
        {
            username: "ABC",
            comment: "Không hay!"
        },
        {
            username: "tôi",
            comment: "Good"
        },
        {
            username: "Ai là tôi",
            comment: "Tuyệt vời."
        }
    ]

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
    
    renderComments("comments", comment_data);
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
            console.log(data);
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
