/* AGRO PROJECT - JavaScript Validations */

// 1. Registration Validation
function validateRegisterForm() {
    let form = document.forms["regForm"];
    let email = form["email"].value;
    let pass = form["password"].value;
    let confirmPass = form["confirm_password"].value;
    let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address.");
        return false;
    }
    if (pass.length < 6) {
        alert("Password must be at least 6 characters.");
        return false;
    }
    if (pass !== confirmPass) {
        alert("Passwords do not match!");
        return false;
    }
    return true;
}

// 2. Login Validation
function validateLoginForm() {
    let form = document.forms["loginForm"];
    let email = form["email"].value;
    let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address.");
        return false;
    }
    return true;
}

// 3. Checkout/Payment Validation
function validatePaymentForm() {
    let card = document.getElementById('card_number').value;
    let cvv = document.getElementById('cvv').value;

    // Check if fields are empty
    if (card == "" || cvv == "") {
        alert("Please fill in all payment details.");
        return false;
    }

    // Card must be 16 digits
    if (card.length !== 16 || isNaN(card)) {
        alert("Invalid Card Number (Must be 16 digits)");
        return false;
    }

    // CVV must be 3 digits
    if (cvv.length !== 3 || isNaN(cvv)) {
        alert("Invalid CVV (Must be 3 digits)");
        return false;
    }
    
    return true; 
}