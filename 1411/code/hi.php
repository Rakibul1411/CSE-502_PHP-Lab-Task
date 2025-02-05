document.addEventListener("DOMContentLoaded", function () {
    console.log("Script loaded successfully");

    // Form validation function
    function validateForm(form) {
        let isValid = true;
        form.querySelectorAll("input, textarea").forEach(input => {
            if (input.hasAttribute("required") && input.value.trim() === "") {
                isValid = false;
                input.classList.add("error");
            } else {
                input.classList.remove("error");
            }
        });
        return isValid;
    }

    // AJAX Form Submission
    function submitForm(form, url) {
        if (!validateForm(form)) {
            alert("Please fill out all required fields.");
            return;
        }
        
        let formData = new FormData(form);
        fetch(url, {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message || "Form submitted successfully!");
            form.reset();
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Something went wrong!");
        });
    }

    // Attach event listener to forms
    document.querySelectorAll("form").forEach(form => {
        form.addEventListener("submit", function (event) {
            event.preventDefault();
            let actionUrl = form.getAttribute("action") || "insert.php";
            submitForm(form, actionUrl);
        });
    });

    // Admin login functionality
    const loginForm = document.querySelector("#admin-login-form");
    if (loginForm) {
        loginForm.addEventListener("submit", function (event) {
            event.preventDefault();
            
            let formData = new FormData(loginForm);
            fetch("admin-login.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = "admin.php";
                } else {
                    alert("Invalid credentials!");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Login failed!");
            });
        });
    }
});
