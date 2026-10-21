let submit = document.getElementById("login");
submit.addEventListener("click", (e) => {
    
    let enteredEmail = document.getElementById("email").value;
    let enteredPassword = document.getElementById("password").value;
    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    let validation = true;

    if (enteredEmail == "") {
        document.getElementById("emailErr").innerText = "Email is required !";
        validation = false;
    }
    else if (!emailPattern.test(enteredEmail)) {
        document.getElementById("emailErr").innerText = "Enter Valid Email !";
        validation = false;
    }
    else {
        document.getElementById("emailErr").innerText = "";
    }

    if (enteredPassword == "") {
        document.getElementById("passwordErr").innerText = "Password is required !";
        validation = false;
    }
    else if (enteredPassword.length < 6) {
        document.getElementById("passwordErr").innerText = "Password must contain at least 6 characters !";
        validation = false;
    }
    else {
        document.getElementById("passwordErr").innerText = "";
    }

    if (validation == false)
    {
        e.preventDefault();
    }

    if (validation) {
        console.log("Form submitted Successfully !");
    }
});