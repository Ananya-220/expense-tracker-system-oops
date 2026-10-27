let change = document.getElementById("changePassword");
change.addEventListener("click", (e) => {
    let oldPassword = document.getElementById("old_password").value;
    let newPassword = document.getElementById("new_password").value;
    let confirmPassword = document.getElementById("confirm_password").value;
    let validation = true;

    if (oldPassword == "") {
        document.getElementById("oldPasswordErr").innerText = "Old Password is required !";
        validation = false;
    }
    else {
        document.getElementById("oldPasswordErr").innerText = "";
    }

    if (newPassword == "") {
        document.getElementById("newPasswordErr").innerText = "New Password is required !";
        validation = false;
    }
    else if (newPassword.length < 8) {
        document.getElementById("newPasswordErr").innerText = "Password must contain atleast 8 characters !";
        validation = false;
    }
    else {
        document.getElementById("newPasswordErr").innerText = "";
    }

    if (confirmPassword == "") {
        document.getElementById("confirmPasswordErr").innerText = "Confirm Password is required !";
        validation = false;
    }
    else if (newPassword != confirmPassword) {
        document.getElementById("confirmPasswordErr").innerText = "Password Does not match !";
        validation = false;
    }
    else {
        document.getElementById("confirmPasswordErr").innerText = "";
    }

    if (validation == false) {
        e.preventDefault();
    }

    if (validation) {
        console.log("Password Updated Successfully !");
    }
});