let submit = document.getElementById("addCategory");
submit.addEventListener("click", (e) => {

    let name = document.getElementById("categoryName").value;
    let status = document.getElementById("status").value;
    let validation = true;

    if (name == "") {
        document.getElementById("nameErr").innerText = "Category Name is required !";
        validation = false;
    }
    else if (name.length < 4) {
        document.getElementById("nameErr").innerText = "Category Name must contain atleast 4 characters !";
        validation = false;
    }
    else {
        document.getElementById("nameErr").innerText = "";
    }

    if (status === "" && status !== 0) {
        document.getElementById("statusErr").innerText = "Status is required !";
        validation = false;
    }
    else {
        document.getElementById("statusErr").innerText = "";
    }

    if (validation == false) {
        e.preventDefault();
    }

    if (validation) {
        console.log("Form submitted Successfully !");
    }
});