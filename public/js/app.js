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

// Choices.js

document.addEventListener('DOMContentLoaded', function () {
  const mealType = document.querySelector('#meal-type');
  const ethnicType = document.querySelector('#ethnic-type');
  const dietType = document.querySelector('#diet-type');

  if (mealType) {
    new Choices(mealType, {
      removeItemButton: true,
      placeholderValue: 'Select meal types',
      searchPlaceholderValue: 'Search meal types'
    });
  }

  if (ethnicType) {
    new Choices(ethnicType, {
      removeItemButton: true,
      placeholderValue: 'Select ethnic types',
      searchPlaceholderValue: 'Search styles'
    });
  }

  if (dietType) {
    new Choices(dietType, {
      removeItemButton: true,
      placeholderValue: 'Select diet types',
      searchPlaceholderValue: 'Search diets'
    });
  }
});