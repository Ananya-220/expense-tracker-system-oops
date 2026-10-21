let submit = document.getElementById("register");
submit.addEventListener("click", (e) => {     
    let enteredFirstName = document.getElementById("firstName").value;
    let enteredLastName = document.getElementById("lastName").value;
    let enteredEmail = document.getElementById("email").value;
    let enteredPassword = document.getElementById("password").value;
    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    let validation = true;

    if (enteredFirstName == "") {
        document.getElementById("first_nameErr").innerText = "First Name is required !";
        validation = false;
    }
    else {
        document.getElementById("first_nameErr").innerText = "";
    }

    if (enteredLastName == "") {
        document.getElementById("last_nameErr").innerText = "Last Name is required !";
        validation = false;
    }
    else {
        document.getElementById("last_nameErr").innerText = "";
    }

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