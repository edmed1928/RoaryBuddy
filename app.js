const menu = document.querySelector('#mobile-menu');
const menuLinks = document.querySelector('.navbar__menu');

menu.addEventListener('click', function (){
    menu.classList.toggle('is-active')
    menuLinks.classList.toggle('active');
})

// Get modal elements
const modal = document.getElementById("loginModal");
const loginBtns = document.querySelectorAll(".loginButton");
const closeBtn = document.querySelector(".close");

// Open modal when login button is clicked
loginBtns.forEach(btn => {
  btn.addEventListener("click", function(e) {
    if (!this.closest("form")) { // Only open modal if button is not in the form
      e.preventDefault();
      modal.style.display = "block";
    }
  });
});

// Close modal when X is clicked
closeBtn.addEventListener("click", function() {
  modal.style.display = "none";
});

// Close modal when clicking outside of it
window.addEventListener("click", function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
});