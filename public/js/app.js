'use strict'

// Sidebar

const openSidebarLinks = document.querySelectorAll('#open-sidebar, #open-sidebar-icon');
const sidebar = document.getElementById('sidebar');
const closeSidebarButton = document.getElementById('close-sidebar');

function openSidebar(e) {
  e.preventDefault();
  sidebar.classList.add('active');
}

function closeSidebar() {
  sidebar.classList.remove('active');
}

openSidebarLinks.forEach(link => {
  link.addEventListener('click', openSidebar);
});

closeSidebarButton.addEventListener('click', closeSidebar);

// Menu Drop Down


