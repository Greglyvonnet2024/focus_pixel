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
          }
        })
        .catch((error) => {
          console.log(error);
        });
    });
  });
});


document.addEventListener("click", function (event) {

   const prevBtn = document.querySelector(".prev-btn");
   const nextBtn = document.querySelector(".next-btn");

})

document.addEventListener("DOMContentLoaded", () => {

  const prevBtn = document.querySelector(".prev-btn");
  const nextBtn = document.querySelector(".next-btn");

  let index = 0;

  prevBtn.addEventListener("click", () => {
    index = index > 0 ? index - 1 : images.length - 1;
    updateCarousel();
  });

  nextBtn.addEventListener("click", () => {
    index = index < images.length - 1 ? index + 1 : 0;
    updateCarousel();
  });
});









// document.querySelector("add").addEventListener("click", function (event) {
//   if (event.target.classList.contains("add")) {
//     const ID = event.target.getAttribute("data-id");
//     fetch("/add", {
//       method: "post",
//       headers: { "Content-Type": "application/json" },
//       body: JSON.stringify({ id: ID }),
//     })
//       .then((result) => result.json())
//       .then((result) => {
//         if (result.success) {
//           mettreAJourPanier(result.cart); // Mise à jour dynamique
//         }
//       })
//       .catch((error) => console.log(error));
//   }
// });
