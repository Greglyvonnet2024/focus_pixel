document.addEventListener("DOMContentLoaded", function () {
  const BOUTONS = document.querySelectorAll(".addBasket");

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
            console.log(result.total);
            document.querySelector("#totalPanier").textContent = result.total;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    });
  });

  document.querySelectorAll(".fav").forEach((button) => {
    console.log("coucou");
    button.addEventListener("click", function () {
      let productId = this.dataset.id;
      let icon = this.querySelector("i");

      fetch(`/favorite`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          id: productId,
        }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.isFavorite) {
            this.innerHTML = `<i class="fa-solid fa-bookmark" style="color: #7530ca;"></i>`;
            
        } else {
            this.innerHTML=`<i class="fa-regular fa-bookmark fa-sm"></i>`;
          }
        });
    });
  });
});
