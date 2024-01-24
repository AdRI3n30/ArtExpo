var sidenav = document.getElementById("mySidenav");
var openBtn = document.getElementById("openBtn");

openBtn.onclick = openNav;

function openNav() {
    if (sidenav.classList.contains("active")){
        sidenav.classList.remove("active");
    }else{
        sidenav.classList.add("active");
    }
}



var sidenav2 = document.getElementById("mySidenav2");
var openBtn2 = document.getElementById("openBtn2");
var closeBtn2 = document.getElementById("closeBtn2");


openBtn2.onclick = openNav2;
closeBtn2.onclick = closeNav2;



/* Set the width of the side navigation to 250px */
function openNav2() {
  sidenav2.classList.add("active");
}

/* Set the width of the side navigation to 0 */
function closeNav2() {
  sidenav2.classList.remove("active");
}


