let bookbtn = document.querySelector(".book");
let tourid = document.querySelector("input[name=tourid]").value;



// console.log('logged')
console.log(tourid);

let cookiearrstr = document.cookie.split(";");
let cookiearr2;
let cookierarr1 = cookiearrstr[0].split("=");
if (cookiearrstr[1]) {
  cookiearr2 = cookiearrstr[1].split("=");
}
let user;
if (cookierarr1[0].trim() == "user") {
  user = cookierarr1[1];
} else if (cookierarr1[0].trim() == "user") {
  user = cookierarr1[1];
} else user = "";

bookbtn.addEventListener("click", async function () {
  if (user !== "") {
    if (bookbtn.innerHTML.trim() == "Book Now") {
      console.log('clicked')
      await booktour();
      // +---------------------------------------------------------------------------------------
      window.location.href =
        "../Tour%20and%20Travel/detail.php?tourid=" + tourid;
    } else {
      unbooktour();
      window.location.href =
        "../Tour%20and%20Travel/detail.php?tourid=" + tourid;
    }
  } else {
    loginpage.style.display = "block";
    loginpage.style.transform = "translateY(0)";
  }
});


async function booktour() {
  try {
      let resp = await fetch(`./Controller/book.control.php?bookid=${tourid}&user=${user}`);
      let respdata = await resp.text();
      console.log(respdata)
  } catch (error) {
      console.error('Error in booktour:', error);
  }
}

async function unbooktour() {
  try {
      let resp = await fetch(`./Controller/book.control.php?unbookid=${tourid}&user=${user}`);
      let respdata = await resp.text();
      console.log(respdata)
  } catch (error) {
      console.error('Error in unbooktour:', error);
  }
}

