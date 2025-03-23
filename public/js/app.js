'use strict'

// Sidebar

const openSidebarLinks = document.querySelectorAll('#open-sidebar, #open-sidebar-icon');
const sidebar = document.getElementById('sidebar');
const closeSidebarButton = document.getElementById('close-sidebar');
const signupLoginLink = document.getElementById('signup-login-link');

document.addEventListener("DOMContentLoaded", function () {
  if (localStorage.getItem("sidebarClosed") === "true") {
    sidebar.classList.remove("active");
    sidebar.style.transition = "none";
    setTimeout(() => { sidebar.style.transition = ""; }, 10);
  }
});

function openSidebar(e) {
  e.preventDefault();
  sidebar.classList.add("active");
  localStorage.removeItem("sidebarClosed");
}

function closeSidebar() {
  sidebar.classList.remove("active");
  localStorage.setItem("sidebarClosed", "true");
}

openSidebarLinks.forEach(link => {
  link.addEventListener('click', openSidebar);
});

closeSidebarButton.addEventListener('click', closeSidebar);

if (signupLoginLink) {
  signupLoginLink.addEventListener('click', openSidebar);
}

document.addEventListener("DOMContentLoaded", function () {
  if (localStorage.getItem("clearSidebar") === "true") {
    localStorage.removeItem("sidebarClosed");
    localStorage.removeItem("clearSidebar");
  }
});

// Menu Drop Down


