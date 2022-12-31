let sidebarToggle = document.querySelector(".sidebarToggle");
sidebarToggle.addEventListener("click", function(){
  document.querySelector("body").classList.toggle("active");
  document.getElementById("sidebarToggle").classList.toggle("active");
})