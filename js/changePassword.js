// Thêm sự kiện click cho nút Change
document.addEventListener("DOMContentLoaded", function() {
    var changeButton = document.querySelector('.change');
    changeButton.addEventListener('click', function() {
        var currentPassword = document.getElementById('currentPass').value;
        var newPassword = document.getElementById('newPass').value;
        var confirmPassword = document.getElementById('confirmPass').value;

    
        // Gửi request đến server để thay đổi mật khẩu
        fetch('../php/changePassword.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                current_password: currentPassword,
                new_password: newPassword,
                confirm_password: confirmPassword
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Password updated successfully.');
                
            } else {
                alert('Failed to update password: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating password.');
        });
    });
});
