let dot1 = document.querySelector(".dot1");
let dot2 = document.querySelector(".dot2");
let dot3 = document.querySelector(".dot3");
let btn1 = document.querySelector(".btn1");
let btn2 = document.querySelector(".btn2");
let btn3 = document.querySelector(".btn3");
let starttravel = document.querySelector(".enter");
let pagecover = document.querySelector(".parentdiv");
let covers = document.querySelectorAll(".cover");
covers = Array.from(covers);

btn1.addEventListener("click", function () {
  pagecover.style.backgroundImage = `url(${covers[0].src})`;
  dot1.style.backgroundColor = "black";
  dot2.style.backgroundColor = "transparent";
  dot3.style.backgroundColor = "transparent";
});
btn2.addEventListener("click", function () {
  pagecover.style.backgroundImage = `url(${covers[1].src})`;
  dot1.style.backgroundColor = "transparent";
  dot2.style.backgroundColor = "black";
  dot3.style.backgroundColor = "transparent";
});
btn3.addEventListener("click", function () {
  pagecover.style.backgroundImage = `url(${covers[2].src})`;
  dot1.style.backgroundColor = "transparent";
  dot2.style.backgroundColor = "transparent";
  dot3.style.backgroundColor = "black";
});

starttravel.addEventListener("click", function () {
  window.location.href = "./package.php";
});
