const profileDropDown = document.getElementById("profile");
if(profileDropDown!=null){
    const sideNav = document.getElementById("profileNav");
    profileDropDown.addEventListener('click',()=>{
        sideNav.classList.toggle("active");
    });
}


const menuDropDown = document.getElementById("navShow");
const menuNav = document.getElementById("sidebar");

menuDropDown.addEventListener('click',()=>{
    menuNav.classList.toggle("sidebar-active");
});


