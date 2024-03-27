document.addEventListener("DOMContentLoaded", function() {
    const signUpForm = document.querySelector(".signUpForm");

    signUpForm.addEventListener("submit", function(event) {
        event.preventDefault();

        const formData = new FormData(signUpForm);

        fetch("../php/signup_process.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            const errorMessage = document.getElementById("error_message");
            errorMessage.style.display = "block";
            errorMessage.textContent = data;
        })
        .catch(error => {
            console.error("Error:", error);
            const errorMessage = document.getElementById("error_message");
            errorMessage.style.display = "block";
            errorMessage.textContent = "An error occurred while processing your request.";
        });
    });
});
