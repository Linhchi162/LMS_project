document.addEventListener("DOMContentLoaded", function() {
    const signUpForm = document.querySelector(".signInForm");

    signUpForm.addEventListener("submit", function(event) {
        event.preventDefault();

        const formData = new FormData(signUpForm);

        fetch("../php/signin_process.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            const errorMessage = document.getElementById("error_message");
            errorMessage.style.display = "block";
            if (data.error) {
                errorMessage.textContent = data.error;
            } else {
                errorMessage.textContent = data.success;
                location.href = "../html/home.html";
            }
        })
        .catch(error => {
            console.error("Error:",error);
            const errorMessage = document.getElementById("error_message");
            errorMessage.style.display = "block";
            errorMessage.textContent = "An unknown error occurred.";
        });
    });
});
