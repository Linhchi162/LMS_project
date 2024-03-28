import { renderComments } from "./render.js";

const Form = document.querySelector(".comment-container");

document.addEventListener("DOMContentLoaded", function() {
    
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

    Form.addEventListener("submit", function(event) {
        event.preventDefault();
        addComments();
    });
    renderComments("comments", comment_data);
})

function addComments() {
    const addData = new FormData(Form);

    console.log(addData.comment);
    fetch("../php/add_comment.php", {
        method: "POST",
        body: addData
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
    })
}