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
        body: JSON.stringify({ id: ID }),// $data = ['id' => 5]; dans le contrôleur
      })
        .then((result) => {
          return result.json();
        })
        .then((result) => {
          if (result.error_doublons) {
            alert(result.error_doublons)
          }
        })
        .catch((error) => {
          console.log(error);
        });
    });
  });

  const SUPP = document.querySelectorAll(".supp");

  SUPP.forEach(function (supp) {
    supp.addEventListener("click", function () {
      const ID = this.getAttribute("data-id");

      fetch("/supp", {
        method: "post",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ id: ID }),
      }).then((result) => {
        return result.json();
      });
    }
    )
  })
});