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
            console.log(result.error_doublons);
            if (result.error_doublons) {
                alert(result.error_doublons)
            }
        })
        .catch((error) => {
          console.log(error);
        });
    });
  });
});

let tab = [1, 5, 7];

console.log(tab[0]);
