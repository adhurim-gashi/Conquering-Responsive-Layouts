let loader = document.getElementById("preloader");

window.addEventListener("load", function () {

  setTimeout(() => {
    loader.style.opacity = "0";
    loader.style.transition = "opacity 0.5s ease";

    setTimeout(() => {
      loader.style.display = "none";
    }, 500);

  }, 600);
});
