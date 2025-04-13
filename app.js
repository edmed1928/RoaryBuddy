// Modal elements
const studygroupcreateModal = document.getElementById("studygroupcreateModal");

// Open study group create modal
document.querySelectorAll(".createStudyGroupButton").forEach(btn => {
  btn.addEventListener("click", (e) => {
    e.preventDefault();
    studygroupcreateModal.style.display = "block";
  });
});