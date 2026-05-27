function validateForm(){

    let email =
    document.getElementById("email").value;

    let password =
    document.getElementById("password").value;

    let valid = true;

    document.getElementById("emailError").innerHTML = "";

    document.getElementById("passwordError").innerHTML = "";

    // EMAIL VALIDATION

    if(email === ""){

        document.getElementById("emailError").innerHTML =
        "Email is required";

        valid = false;
    }

    // PASSWORD VALIDATION

    if(password === ""){

        document.getElementById("passwordError").innerHTML =
        "Password is required";

        valid = false;
    }

    return valid;
}

function validateRegisterForm(){

    let fullname =
    document.getElementById("fullname").value;

    let email =
    document.getElementById("email").value;

    let password =
    document.getElementById("password").value;

    let role =
    document.getElementById("role").value;

    let valid = true;

    document.getElementById("fullnameError").innerHTML = "";

    document.getElementById("emailError").innerHTML = "";

    document.getElementById("passwordError").innerHTML = "";

    document.getElementById("roleError").innerHTML = "";

    if(fullname === ""){

        document.getElementById("fullnameError").innerHTML =
        "Full name is required";

        valid = false;
    }

    if(email === ""){

        document.getElementById("emailError").innerHTML =
        "Email is required";

        valid = false;
    }

    if(password === ""){

        document.getElementById("passwordError").innerHTML =
        "Password is required";

        valid = false;
    }

    if(role === ""){

        document.getElementById("roleError").innerHTML =
        "Please select a role";

        valid = false;
    }

    return valid;
}

function checkPasswordStrength(){

    let password =
    document.getElementById("password").value;

    let message =
    document.getElementById("strengthMessage");

    if(password.length < 4){

        message.innerHTML = "Weak Password";

        message.style.color = "red";
    }
    else if(password.length < 8){

        message.innerHTML = "Medium Password";

        message.style.color = "orange";
    }
    else{

        message.innerHTML = "Strong Password";

        message.style.color = "green";
    }
}