let submit = document.getElementById("updateProfile");
submit.addEventListener("click", (e) => {     
    let enteredFirstName = document.getElementById("first_name").value;
    let enteredLastName = document.getElementById("last_name").value;
    let enteredEmail = document.getElementById("email").value;
    let enteredMobile = document.getElementById("mobile").value;
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

    if (enteredMobile == "") {
        document.getElementById("mobileErr").innerText = "";
    }
    else {
        if (enteredMobile.length != 10) {
            document.getElementById("mobileErr").innerText = "Mobile Number must contain 10 numbers !";
            validation = false;
    }
    }

    if (validation == false)
    {
        e.preventDefault();
    }
    
    if (validation) {
        console.log("Profile Updated Successfully !");
    }
});