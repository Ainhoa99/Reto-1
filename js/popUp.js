var abrir = document.getElementById("abrir");
var popup = document.getElementById("popup");

function abrirPopUp() {
  abrir.classList.add("active");
  popup.classList.add("active");
}

function cerrarPopUp() {
  abrir.classList.remove("active");
  popup.classList.remove("active");
}
