// document.addEventListener("DOMContentLoaded", function () {
//   const BOUTONS = document.querySelectorAll(".ajout");


document.querySelector("").addEventListener("click", function (event) {
  if (event.target.classList.contains("add")) {
    const ID = event.target.getAttribute("data-id");
    fetch("/add", {
      method: "post",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ id: ID }),
    })
      .then((result) => result.json())
      .then((result) => {
        if (result.success) {
          mettreAJourPanier(result.cart); // Mise à jour dynamique
        }
      })
      .catch((error) => console.log(error));
  }
});



  // BOUTONS.forEach(function (bouton) {
  //   bouton.addEventListener("click", function () {
  //     const ID = this.getAttribute("data-id");

  //     fetch("/add", {
  //       method: "post",
  //       headers: {
  //         "Content-Type": "application/json",
  //       },
  //       body: JSON.stringify({ id: ID }),// $data = ['id' => 5]; dans le contrôleur
  //     })
  //       .then((result) => {
  //         return result.json();
  //       })
  //       .then((result) => {
  //         if (result.error_doublons) {
  //           alert(result.error_doublons)
  //         }
  //       })
  //       .catch((error) => {
  //         console.log(error);
  //       });
  //   });
  // });

document.querySelector("#panier").addEventListener("click", function (event) {
  if (event.target.classList.contains("supp")) {
    const ID = event.target.getAttribute("data-id");
    fetch("/supp", {
      method: "post",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ id: ID }),
    })
      .then((result) => result.json())
      .then((result) => {
        if (result.success) {
          mettreAJourPanier(result.cart); // Mise à jour dynamique
        }
      })
      .catch((error) => console.log(error));
  }
});

});