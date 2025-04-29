'use strict'

// Sidebar

const openSidebarLinks = document.querySelectorAll('#open-sidebar, #open-sidebar-icon');
const sidebar = document.getElementById('sidebar');
const closeSidebarButton = document.getElementById('close-sidebar');
const signupLoginLink = document.getElementById('signup-login-link');

openSidebarLinks.forEach(link => {
  link.addEventListener('click', openSidebar);
});

if (closeSidebarButton) {
  closeSidebarButton.addEventListener('click', closeSidebar);
}

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


// Popups

document.addEventListener('DOMContentLoaded', function () {
  const overlay = document.getElementById('recipe-overlay');
  const closeBtn = document.getElementById('close-popup-search');

  if (overlay && closeBtn) {
    closeBtn.addEventListener('click', function (e) {
      overlay.remove();
    });

    overlay.addEventListener('click', function (event) {
      if (event.target === overlay) {
        overlay.remove();
      }
    });
  }
});

function closeComingSoonPopup() {
  document.getElementById("comingSoonPopup").style.display = "none";
}

function showComingSoonPopup() {
  document.getElementById("comingSoonPopup").style.display = "flex";
}

document.addEventListener("DOMContentLoaded", function () {
  const form = document.forms["recipe-form"];
  if (form) {
    form.addEventListener("submit", function (event) {
      event.preventDefault();
      showComingSoonPopup();
    });
  }

  const myRecipesLink = document.getElementById("myRecipesLink");
  if (myRecipesLink) {
    myRecipesLink.addEventListener("click", function (event) {
      event.preventDefault();
      showComingSoonPopup();
    });
  }
});

document.addEventListener('DOMContentLoaded', function() {
  const isLoggedInElement = document.getElementById('isLoggedIn');
  const isLoggedIn = isLoggedInElement && isLoggedInElement.value === '1';

  const loginAlert = document.getElementById('login-alert');

  function showLoginMessage(action) {
    if (loginAlert) {
      loginAlert.innerHTML = `You must log in or sign up first to ${action} this recipe. <button>Close</button>`;
      loginAlert.style.display = 'block';

      const closeButton = loginAlert.querySelector('button');
      closeButton.addEventListener('click', function() {
        loginAlert.style.display = 'none';
      });
    }
  }

  function setupClick(id, action, popupId) {
    const element = document.getElementById(id);
    if (element) {
      element.addEventListener('click', function(e) {
        if (!isLoggedIn) {
          e.preventDefault();
          e.stopImmediatePropagation();
          showLoginMessage(action);
          return false;
        }
        const popup = document.getElementById(popupId);
        if (popup) {
          popup.style.display = 'block';
        }
      });
    }
  }

  setupClick('save-for-later', 'save', 'save-popup');
  setupClick('rate-star', 'rate', 'rating-popup');
  setupClick('rate-recipe-link', 'rate', 'rating-popup');

  const closePopupButton = document.getElementById('close-popup');
  if (closePopupButton) {
    closePopupButton.addEventListener('click', function() {
      document.getElementById('rating-popup').style.display = 'none';
    });
  }

  const cancelSaveButton = document.getElementById('cancel-save');
  if (cancelSaveButton) {
    cancelSaveButton.addEventListener('click', function() {
      document.getElementById('save-popup').style.display = 'none';
    });
  }
});

// Recipe Page

document.addEventListener('DOMContentLoaded', function () {
  const saveForLaterBtn = document.getElementById('save-for-later');
  const savePopup = document.getElementById('save-popup');
  const popupMessage = document.getElementById('popup-message');
  const confirmSaveBtn = document.getElementById('confirm-save');
  const cancelSaveBtn = document.getElementById('cancel-save');

  if (saveForLaterBtn) {
    saveForLaterBtn.addEventListener('click', function () {
      const recipeName = saveForLaterBtn.getAttribute('data-recipe-name');
      const recipeId = saveForLaterBtn.getAttribute('data-recipe-id');
      const userId = saveForLaterBtn.getAttribute('data-user-id');

      fetch('save-recipe.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({ recipe_id: recipeId, user_id: userId }).toString(),
      })
        .then(response => response.text())
        .then(data => {
          if (data === 'already_saved') {
            popupMessage.textContent = 'This recipe is already saved. Check your saved recipes!';
            confirmSaveBtn.style.display = 'none'
            cancelSaveBtn.textContent = 'OK';
          } else if (data === 'success') {
            popupMessage.textContent = `"${recipeName}" has been successfully saved!`;
            confirmSaveBtn.style.display = 'none';
            cancelSaveBtn.textContent = 'OK';
          } else {
            popupMessage.textContent = 'Failed to save recipe.';
            confirmSaveBtn.style.display = 'none';
            cancelSaveBtn.textContent = 'OK';
          }
          savePopup.style.display = 'flex';
        })
        .catch(error => {
          console.error('Error:', error);
        });

      cancelSaveBtn.addEventListener('click', function () {
        savePopup.style.display = 'none';
      });
    });
  };
});

document.addEventListener('DOMContentLoaded', function () {
  const closePopup = document.getElementById('close-popup');
  const ratingPopup = document.getElementById('rating-popup');
  const rateLink = document.getElementById('rate-recipe-link');
  const ratingInput = document.getElementById('rating-input');
  const ratingForm = document.getElementById('rating-form');
  const rateStar = document.getElementById('rate-star');
  const stars = document.querySelectorAll('#stars i');
  let selectedRating = 0;

  if (ratingPopup) {
    rateLink.addEventListener('click', function () {
      ratingPopup.style.display = 'flex';
    });

    rateStar.addEventListener('click', function () {
      ratingPopup.style.display = 'flex';
    });

    closePopup.addEventListener('click', function () {
      ratingPopup.style.display = 'none';
    });
  };

  stars.forEach((star, index) => {
    star.addEventListener('mouseenter', function () {
      stars.forEach((star, i) => {
        if (i <= index) {
          star.classList.add('fa-solid');
        } else {
          star.classList.remove('fa-solid');
        }
      });
    });

    star.addEventListener('mouseleave', function () {
      stars.forEach((star, i) => {
        if (i < selectedRating) {
          star.classList.add('fa-solid');
        } else {
          star.classList.remove('fa-solid');
        }
      });
    });

    star.addEventListener('click', function () {
      selectedRating = index + 1;
      ratingInput.value = selectedRating;

      stars.forEach((star, i) => {
        if (i < selectedRating) {
          star.classList.add('fa-solid');
        } else {
          star.classList.remove('fa-solid');
        }
      });
    });
  });

  if (ratingForm) {
    ratingForm.addEventListener('submit', function (e) {
      e.preventDefault();

      if (selectedRating === 0) {
        alert('Please select a rating.');
        return;
      }

      const formData = new FormData(ratingForm);

      fetch('submit-rating.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.text())
      .then(data => {
        console.log(data);
        ratingPopup.style.display = 'none';
        alert('Thanks for rating!');
      })
      .catch(error => {
        console.error('Error:', error);
      });
    });
  };
});

document.addEventListener('DOMContentLoaded', function () {
  const multiplierButtons = document.querySelectorAll('button[data-multiplier]');
  const resetButton = document.getElementById('reset-servings');
  const servingsText = document.getElementById('servings');
  const ingredientItems = document.querySelectorAll('table tbody td ul li');

  if (!servingsText) {
    return;
  }

  let originalServings = parseFloat(servingsText.textContent.replace(/[^\d.]/g, ''));
  const originalIngredients = Array.from(ingredientItems).map(item => {
    const text = item.textContent;
    const quantityMatch = text.match(/^(\d+(\.\d+)?|\d+\/\d+)/);
    return {
      quantity: quantityMatch ? quantityMatch[1] : '1',
      text: text
    };
  });

  function removeClickedClass() {
    multiplierButtons.forEach(btn => btn.classList.remove('clicked'));
    if (resetButton) {
      resetButton.classList.remove('clicked');
    }
  }

  function fractionToDecimal(fraction) {
    const parts = fraction.split('/');
    if (parts.length === 2) {
      return parseFloat(parts[0]) / parseFloat(parts[1]);
    }
    return parseFloat(fraction);
  }

  function updateServingsAndIngredients(multiplier) {
    servingsText.textContent = `Servings: ${originalServings * multiplier}`;
  
    ingredientItems.forEach((item, index) => {
      let { quantity, text } = originalIngredients[index];
      if (quantity.includes('/')) {
        quantity = fractionToDecimal(quantity);
      }
      const newQuantity = (quantity * multiplier).toFixed(2);
  
      item.textContent = text.replace(/^(\d+(\.\d+)?|\d+\/\d+)/, newQuantity);
    });
  }

  multiplierButtons.forEach(button => {
    button.addEventListener('click', function () {
      removeClickedClass();
      this.classList.add('clicked');

      const multiplier = parseFloat(this.getAttribute('data-multiplier'));

      updateServingsAndIngredients(multiplier);
    });
  });

  if (resetButton) {
    resetButton.addEventListener('click', function () {
      removeClickedClass();
      this.classList.add('clicked');
    
      servingsText.textContent = `Servings: ${originalServings}`;
      ingredientItems.forEach((item, index) => {
        const { text } = originalIngredients[index];
        item.textContent = text;
      });
    });
    
  }
});

function gcd(a, b) {
  while (b !== 0) {
    const temp = b;
    b = a % b;
    a = temp;
  }
  return a;
}

function formatQuantity(quantity) {
  if (Number.isInteger(quantity)) {
    return quantity;
  }

  const tolerance = 1e-6;
  for (let denominator = 2; denominator <= 100; denominator++) {
    const numerator = quantity * denominator;
    if (Math.abs(numerator - Math.round(numerator)) < tolerance) {
      let roundedNumerator = Math.round(numerator);
      const commonDivisor = gcd(roundedNumerator, denominator);
      const simplifiedNumerator = roundedNumerator / commonDivisor;
      const simplifiedDenominator = denominator / commonDivisor;

      if (simplifiedNumerator > simplifiedDenominator) {
        const wholeNumber = Math.floor(simplifiedNumerator / simplifiedDenominator);
        const remainder = simplifiedNumerator % simplifiedDenominator;
        if (remainder === 0) {
          return wholeNumber;
        } else {
          return `${wholeNumber} ${remainder}/${simplifiedDenominator}`;
        }
      } else {
        return `${simplifiedNumerator}/${simplifiedDenominator}`;
      }
    }
  }

  return quantity.toFixed(2);
}

function updateQuantities(multiplier) {
  let servingsElement = document.getElementById("servings");

  if (!updateQuantities.originalServings) {
    const servingsText = servingsElement.innerText;
    updateQuantities.originalServings = parseInt(servingsText.split(": ")[1]);
  }

  let ingredients = Array.from(document.querySelectorAll("#ingredients-directions tbody td:first-child ul li"));

  if (!updateQuantities.originalIngredientTexts) {
    updateQuantities.originalIngredientTexts = ingredients.map(li => li.innerText.trim());
  }

  const newServings = updateQuantities.originalServings * multiplier;
  servingsElement.innerText = "Servings: " + formatQuantity(newServings);

  ingredients.forEach(function(ingredient, index) {
    const originalText = updateQuantities.originalIngredientTexts[index];
    const parts = originalText.split(" ");

    if (parts.length >= 2) {
      let quantity = parseFloat(parts[0]);

      if (!isNaN(quantity)) {
        const updatedQuantityDecimal = quantity * multiplier;
        const formattedQuantity = formatQuantity(updatedQuantityDecimal);
        const unitAndName = parts.slice(1).join(" ");
        ingredient.innerText = formattedQuantity + " " + unitAndName;
      } 
    }
  });
}

document.addEventListener('DOMContentLoaded', function() {
  const servingsElementOnLoad = document.getElementById("servings");
  if (servingsElementOnLoad) {
    const initialServingsText = servingsElementOnLoad.innerText;
    updateQuantities.originalServings = parseInt(initialServingsText.split(": ")[1]);
  }

  const multiplierButtons = document.querySelectorAll('[id^="multiplier-"]');
  multiplierButtons.forEach(button => {
    button.addEventListener('click', function() {
      const multiplier = parseFloat(this.dataset.multiplier);
      updateQuantities(multiplier);
    });
  });

  const resetButton = document.getElementById('reset-servings');
  if (resetButton) {
    resetButton.addEventListener('click', function() {
      window.location.reload();
    });
  }
});

document.addEventListener('DOMContentLoaded', function () {
  const ingredientsContainer = document.getElementById('ingredients-container');
  const addIngredientBtn = document.getElementById('add-ingredient-btn');
  const directionsContainer = document.getElementById('directions-container');
  const addDirectionBtn = document.getElementById('add-direction-btn');
  let availableUnits = [];

  function fetchUnits() {
    return fetch('get-units.php')
      .then(response => {
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
      })
      .then(data => {
        availableUnits = data;
      })
      .catch(error => {
        console.error('Error fetching units:', error);
      });
  }

  function createUnitDropdown() {
    const select = document.createElement('select');
    select.name = 'ingredient-unit[]';
    select.required = true;
    const defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.textContent = 'Select Unit';
    defaultOption.disabled = true;
    defaultOption.selected = true;
    select.appendChild(defaultOption);
    availableUnits.forEach(unit => {
      const option = document.createElement('option');
      option.value = unit;
      option.textContent = unit;
      select.appendChild(option);
    });
    return select;
  }

  if (addIngredientBtn) {
    addIngredientBtn.addEventListener('click', function () {
      const li = document.createElement('li');
      const nameInput = document.createElement('input');
      nameInput.type = 'text';
      nameInput.name = 'ingredient-name[]';
      nameInput.placeholder = 'Ingredient Name';
      nameInput.required = true;

      const quantityInput = document.createElement('input');
      quantityInput.type = 'number';
      quantityInput.name = 'ingredient-quantity[]';
      quantityInput.min = '0.01';
      quantityInput.step = '0.01';
      quantityInput.placeholder = 'Quantity';
      quantityInput.required = true;

      const unitDropdown = createUnitDropdown();

      const removeButton = document.createElement('button');
      removeButton.type = 'button';
      removeButton.classList.add('remove-btn');
      removeButton.setAttribute('aria-label', 'Remove ingredient');
      removeButton.textContent = 'Remove';

      const marker = document.createElement('span');
      marker.className = 'custom-marker';
      marker.innerHTML = '<i class="fas fa-circle fa-2xs"></i>';
      li.appendChild(marker);

      li.appendChild(nameInput);
      li.appendChild(quantityInput);
      li.appendChild(unitDropdown);
      li.appendChild(removeButton);

      ingredientsContainer.appendChild(li);
    });
  };

  if (addDirectionBtn) {
    addDirectionBtn.addEventListener('click', function () {
      const li = document.createElement('li');
      li.innerHTML = `
        <span class="custom-marker"></span>
        <textarea name="directions[]" required></textarea>
        <button type="button" class="remove-btn" aria-label="Remove direction">Remove</button>
      `;
      directionsContainer.appendChild(li);
      updateDirectionMarkers();
    });
  };

  document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-btn')) {
      const li = e.target.closest('li');
      if (li) {
        const parentList = li.parentNode;
        li.remove();
        if (parentList === directionsContainer) {
          updateDirectionMarkers();
        }
      }
    }
  });

  function updateDirectionMarkers() {
    const markers = directionsContainer.querySelectorAll('.custom-marker');
    markers.forEach((marker, index) => {
      marker.textContent = `${index + 1}.`;
    });
  }
});

// Print

document.addEventListener("DOMContentLoaded", function() {
  const printLink = document.getElementById("print-recipe");
  const printTextLink = document.getElementById("print-recipe-text");

  function handlePrint(e) {
    e.preventDefault();

    const recipeId = e.currentTarget.getAttribute("data-recipe-id");
    if (!recipeId) {
      console.error('No recipe ID found.');
      return;
    }

    const printWindow = window.open(`print-recipe.php?id=${recipeId}`, '_blank');

    if (printWindow) {
      printWindow.addEventListener('load', function() {
        printWindow.print();
      });
    } else {
      alert('Please allow popups for this site to print the recipe.');
    }
  }

  if (printLink) {
    printLink.addEventListener("click", handlePrint);
  }

  if (printTextLink) {
    printTextLink.addEventListener("click", handlePrint);
  }
});

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
