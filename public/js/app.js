'use strict'

// Sidebar

const openSidebarLinks = document.querySelectorAll('#open-sidebar, #open-sidebar-icon');
const sidebar = document.getElementById('sidebar');
const closeSidebarButton = document.getElementById('close-sidebar');
const signupLoginLink = document.getElementById('signup-login-link');

openSidebarLinks.forEach(link => {
  link.addEventListener('click', openSidebar);
});

closeSidebarButton.addEventListener('click', closeSidebar);

if (signupLoginLink) {
  signupLoginLink.addEventListener('click', openSidebar);
}

document.addEventListener('DOMContentLoaded', function () {
  if (localStorage.getItem('sidebarClosed') === 'true') {
    sidebar.classList.remove('active');
  }
});

document.addEventListener('DOMContentLoaded', function () {
  if (localStorage.getItem('clearSidebar') === 'true') {
    localStorage.removeItem('sidebarClosed');
    localStorage.removeItem('clearSidebar');
  }
});

function openSidebar(e) {
  e.preventDefault();
  sidebar.classList.add('active');
  localStorage.removeItem('sidebarClosed'); 
}

function closeSidebar() {
  sidebar.classList.remove('active');
  localStorage.setItem('sidebarClosed', 'true');
}

// Menu Drop Down


// Search Bar



// Recipe Page
const closePopup = document.getElementById('close-popup');
const popupOverlay = document.getElementById('recipe-overlay');
const recipeData = document.getElementById('recipe-data');
const form = document.getElementById('filter-form');

if (popupOverlay) {
  document.addEventListener('DOMContentLoaded', popup());
}

function popup() {
  closePopup.addEventListener('click', function () {
    popupOverlay.style.display = 'none';
  });

  popupOverlay.addEventListener('click', function (e) {
    if (e.target === popupOverlay) {
      popupOverlay.style.display = 'none';
    }
  });
}

function getFilterValues() {
  return {
    meal: document.getElementById("meal-type")?.value || "",
    ethnic: document.getElementById("ethnic-type")?.value || "",
    diet: document.getElementById("diet-type")?.value || ""
  };
}

function applyFilters(recipes, ) {

}
  
