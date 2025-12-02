let hamburgerButton = document.querySelector(".hamburger-menu"); 
let navList = document.querySelector(".navigation");

hamburgerButton.addEventListener("click", (e) => {
    e.preventDefault();
   navList.classList.toggle("show")
})