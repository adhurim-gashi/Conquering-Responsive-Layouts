let hamburgerButton = document.querySelector(".hamburger-menu"); 
let navList = document.querySelector(".navigation");

hamburgerButton.addEventListener("click", (e) => {
    e.preventDefault();
    setTimeout(() => {
        navList.classList.toggle("show");
    }, 100);
})

// Form validation for sign-up page
const form = document.querySelector("form");

if (form) {
    form.addEventListener("submit", (e) => {
        e.preventDefault();
        
        // Get form fields
        const name = document.getElementById("name").value.trim();
        const surname = document.getElementById("surname").value.trim();
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value.trim();
        
        // Validation checks
        let isValid = true;
        let errorMessages = [];
        
        if (!name) {
            isValid = false;
            errorMessages.push("Name is required");
        } else if (name.length < 2) {
            isValid = false;
            errorMessages.push("Name must be at least 2 characters");
        }
        
        if (!surname) {
            isValid = false;
            errorMessages.push("Surname is required");
        } else if (surname.length < 2) {
            isValid = false;
            errorMessages.push("Surname must be at least 2 characters");
        }
        
        if (!email) {
            isValid = false;
            errorMessages.push("Email is required");
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            isValid = false;
            errorMessages.push("Please enter a valid email address");
        }
        
        if (!password) {
            isValid = false;
            errorMessages.push("Password is required");
        } else if (password.length < 6) {
            isValid = false;
            errorMessages.push("Password must be at least 6 characters");
        }
        
        // Display results
        if (isValid) {
            alert("✓ Form submitted successfully!\n\nName: " + name + "\nSurname: " + surname + "\nEmail: " + email);
            // Uncomment the line below to actually submit the form
            // form.submit();
        } else {
            alert("❌ Please fix the following errors:\n\n" + errorMessages.join("\n"));
        }
    });
}


