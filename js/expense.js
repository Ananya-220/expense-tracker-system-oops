let submit = document.getElementById("addExpense");
submit.addEventListener("click", (e) => {

    let name = document.getElementById("expenseName").value;
    let amount = document.getElementById("amount").value;
    let payment = document.getElementById("payment").value;
    let category = document.getElementById("category").value;
    let validation = true;

    // Name Validation
    if (name == "") {
        document.getElementById("nameErr").innerText = "Expense Name is required !";
        validation = false;
    }
    else if (name.length < 4) {
        document.getElementById("nameErr").innerText = "Expense Name must contain atleast 4 characters !";
        validation = false;
    }
    else {
        document.getElementById("nameErr").innerText = "";
    }

    // Amount Validation
    if (amount == "") {
        document.getElementById("amountErr").innerText = "Amount is required !";
        validation = false;
    }
    else if (amount <= 0) {
        document.getElementById("amountErr").innerText = "Amount must be greator than zero !";
        validation = false;
    }
    else {
        document.getElementById("amountErr").innerText = "";
    }

    // Payment Validation
    if (payment == "") {
        document.getElementById("paymentErr").innerText = "Payment Method is required !";
        validation = false;
    }
    else {
        document.getElementById("paymentErr").innerText = "";
    }

    // Category Validation
    if (category == "") {
        document.getElementById("categoryErr").innerText = "Category is required !";
        validation = false;
    }
    else {
        document.getElementById("categoryErr").innerText = "";
    }

    if (validation == false) {
        e.preventDefault();
    }

    if (validation) {
        console.log("Form submitted Successfully !");
    }
});