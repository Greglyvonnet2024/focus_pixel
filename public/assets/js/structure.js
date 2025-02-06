document.addEventListener("DOMContentLoaded", function () {
  const BOUTONS = document.querySelectorAll(".ajout");

  BOUTONS.forEach(function (bouton) {
    bouton.addEventListener("click", function () {
      const ID = this.getAttribute("data-id");

      fetch("/add", {
        method: "post",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ id: ID }), // $data = ['id' => 5]; dans le contrôleur
      })
        .then((result) => {
          return result.json();
        })
        .then((result) => {
          if (result.error_doublons) {
            alert(result.error_doublons);
          }
          if (result.nb) {
            document.querySelector("#cart_nb").textContent = result.nb;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    });
  });

  const SUPP = document.querySelectorAll(".supp");
  console.log(SUPP);

  SUPP.forEach(function (supp) {
    supp.addEventListener("click", function (event) {
      event.preventDefault();
      const ID = this.getAttribute("data-id");

      fetch("/supp", {
        method: "post",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ id: ID }),
      })
        .then((result) => {
          return result.json();
        })
        .then((result) => {
          if (result.success) {
            this.parentElement.parentElement.remove();
            document.querySelector("#cart_nb").textContent = result.numb_cart;
            console.log(result.total)
            document.querySelector("#totalPanier").textContent = result.total;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    });
  });

const VALID = document.querySelectorAll(".commandValid");
  bouton.addEventListener("click", function (event) {
        let productIds = [];
  })


  
// let slideIndex = 0; // Index de l'image actuelle
//  const slides = document.querySelectorAll(".slide");

//  function showSlide(index) {
//    // Cache toutes les images
//    slides.forEach((slide) => (slide.style.display = "none"));

//    // Affiche l'image correspondante
//    slides[index].style.display = "block";
//  }

//  function changeSlide(step) {
//    slideIndex += step;

//    // Si on dépasse la dernière image, on revient à la première
//    if (slideIndex >= slides.length) slideIndex = 0;

//    // Si on recule avant la première image, on revient à la dernière
//    if (slideIndex < 0) slideIndex = slides.length - 1;

//    showSlide(slideIndex);
//  }

//  // Quand la page charge, on affiche la première image
//  document.addEventListener("DOMContentLoaded", () => {
//    showSlide(slideIndex);
//  });




});

 