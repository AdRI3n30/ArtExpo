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



