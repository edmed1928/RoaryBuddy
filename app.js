// Modal elements
const loginModal = document.getElementById("loginModal");
const signupModal = document.getElementById("signupModal");

// Open login modal
document.querySelectorAll(".loginButton").forEach(btn => {
  btn.addEventListener("click", (e) => {
    e.preventDefault();
    loginModal.style.display = "block";
  });
});

// Open signup modal from login modal
document.getElementById("switchToSignup").onclick = () => {
  loginModal.style.display = "none";
  signupModal.style.display = "block";
};

// Switch back to login from signup modal
document.getElementById("switchToLogin").onclick = () => {
  signupModal.style.display = "none";
  loginModal.style.display = "block";
};

// Close modals when clicking outside the modal box
window.onclick = function (event) {
  if (event.target === loginModal) loginModal.style.display = "none";
  if (event.target === signupModal) signupModal.style.display = "none";
};

// Close modals when clicking the close (×) button
document.querySelectorAll(".close").forEach(closeBtn => {
  closeBtn.addEventListener("click", () => {
    loginModal.style.display = "none";
    signupModal.style.display = "none";
  });
});