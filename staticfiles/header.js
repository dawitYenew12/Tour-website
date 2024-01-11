let search = document.querySelector(".search");

let search_bar = document.querySelector(".search-bar");
search_bar.style.top = "-200px";

let search_input = document.querySelector("#search-input");
let close_search_bar = document.querySelector(".close");
let search_items = document.querySelector(".search-items");
let loginaccountbtn = document.querySelector(".login");
let signupaccountbtn = document.querySelector(".signup");
let show = document.querySelector(".show");
let pinput = document.querySelector('input[type="password"]');
let loginpage = document.querySelector(".loginpage");
let close_loginpage = document.querySelector(".close-login-page");
let signuppage = document.querySelector(".signuppage");
let close_signuppage = document.querySelector(".close-signup-page");
let signupform = document.querySelector("#suform");
let phpsignupmessage = document.querySelector(".message");
let signupredirect = document.querySelector(".signupredirect");
let mypagenavoption = document.querySelector(".mypage");

phpsignupmessage.style.display = "none";
if (phpsignupmessage.innerHTML.trim() !== "nothing") {
  alert("Incorrect : " + phpsignupmessage.innerHTML);
  console.log(phpsignupmessage.innerHTML);
  window.location.href = "./package.php";
}

// console.log("hello");
getalltourplans();

let cookiearrstr1 = document.cookie.split(";");
let cookiearr3;
let cookierar = cookiearrstr1[0].split("=");
if (cookiearrstr1[1]) {
  cookiearr3 = cookiearrstr1[1].split("=");
}
let user2;
if (cookierar[0].trim() == "user") {
  user2 = cookierar[1];
} else if (cookierar[0].trim() == "user") {
  user2 = cookierar[1];
} else user2 = "";

mypagenavoption.addEventListener("click", function () {
  if (user2 !== "") {
    window.location.href = `./mytrip.php?user=${user2}`;
  } else {
    loginpage.style.display = "block";
    loginpage.style.transform = "translateY(0)";
  }
});
signupredirect.addEventListener("click", function () {
  loginpage.style.display = "none";
  loginpage.style.transform = "translateY(-1000px)";
  signuppage.style.display = "block";
  signuppage.style.transform = "translateY(0)";
});
search.addEventListener("click", function () {
  search_bar.style.top = "50px";
});

close_search_bar.addEventListener("click", function () {
  search_bar.style.top = "-200px";
  search_input.value = "";
  search_items.innerHTML = "";
  search_items.style.display = "none";
});

search_input.addEventListener("keyup", () => {
  let val = search_input.value;
  search_items.style.display = "block";
  search_items.innerHTML = "";
  checkitemexist(val);
});
show.addEventListener("click", function () {
  console.log("click");
  if (show.classList.contains("active")) {
    show.classList.remove("active");
    pinput.type = "password";
  } else {
    show.classList.add("active");
    pinput.type = "text";
  }
});

if(document.querySelector(".login") !== null){
  loginaccountbtn.addEventListener("click", function () {
    loginpage.style.display = "block";
    loginpage.style.transform = "translateY(0)";
  });
}
close_loginpage.addEventListener("click", function () {
  loginpage.style.display = "none";
  loginpage.style.transform = "translateY(-1000px)";
});
if(document.querySelector(".signup") !== null){
signupaccountbtn.addEventListener("click", function () {
  signuppage.style.display = "block";
  signuppage.style.transform = "translateY(0)";
});
}
close_signuppage.addEventListener("click", function () {
  signuppage.style.display = "none";
  signuppage.style.transform = "translateY(-1000px)";
});

async function getalltourplans() {
  let resp = await fetch(
    "Controller/search.controller.php"
  );

  let respdata = await resp.json();

  // console.log(respdata);
  return respdata;
}

async function checkitemexist(val) {
  let alltours = await getalltourplans();

  alltours.forEach((tour) => {
    if (tour[1].toLowerCase().indexOf(val.toLowerCase()) !== -1) {
      addtosearchitem(tour);
    }
  });
}

async function addtosearchitem(tour) {
  let searchitemdiv = document.createElement("div");
  searchitemdiv.classList.add("search-item");

  searchitemdiv.innerHTML = `
    <img src="${tour[3]}" alt="">
    <div class="title">
    ${tour[1]}
    </div>
    <button class="search-book">
       
    view
    
    </button>
    `;
  let viewbtn = searchitemdiv.querySelector(".search-book");
  viewbtn.addEventListener("click", function () {
    if (user2 !== "") {
      window.location.href = `./detail.php?tourid=${tour[0]}`;
    } else {
      loginpage.style.display = "block";
      loginpage.style.transform = "translateY(-200px)";
    }
  });
  search_items.appendChild(searchitemdiv);
}