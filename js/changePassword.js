document.addEventListener("DOMContentLoaded", function() {
    const changePasswordForm = document.getElementById("changePasswordForm");

    changePasswordForm.addEventListener("submit", function(event) {
        event.preventDefault();

        const currentPass = document.getElementById("currentPass").value;
        const newPass = document.getElementById("newPass").value;
        const confirmPass = document.getElementById("confirmPass").value;

        if (newPass !== confirmPass) {
            alert("New password and confirm password do not match.");
            return;
        }

        fetch("../php/changePassword.php", {
            method: "POST",
            body: JSON.stringify({
                currentPass: currentPass,
                newPass: newPass
            }),
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Password changed successfully.");
            } else {
                alert("Failed to change password. Please try again.");
            }
        })
        .catch(error => console.error("Error:", error));
    });
});
