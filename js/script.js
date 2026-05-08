// Global configuration
const API = {
  baseURL: '/drive-rent/',
  endpoints: {
    login: 'pages/login.php',
    register: 'pages/register.php',
    vehicles: 'pages/vehicles.php',
    booking: 'pages/booking.php',
    dashboard: 'pages/dashboard.php'
  }
};

// Mobile menu toggle
function toggleMobileMenu() {
  const nav = document.querySelector('nav ul');
  if (nav) {
    nav.classList.toggle('active');
  }
}

// Form validation
function validateForm(formId) {
  const form = document.getElementById(formId);
  if (!form) return true;

  const formData = new FormData(form);
  let isValid = true;
  const errors = {};

  // Email validation
  const emailInputs = form.querySelectorAll('input[type="email"]');
  emailInputs.forEach(input => {
    if (input.value && !isValidEmail(input.value)) {
      isValid = false;
      errors[input.name] = 'Please enter a valid email';
    }
  });

  // Password validation
  const passwordInputs = form.querySelectorAll('input[type="password"]');
  if (passwordInputs.length > 0 && passwordInputs[0].value.length < 6) {
    isValid = false;
    errors['password'] = 'Password must be at least 6 characters';
  }

  // Display errors
  displayFormErrors(errors);
  return isValid;
}

function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

function displayFormErrors(errors) {
  // Clear previous errors
  document.querySelectorAll('.form-error').forEach(el => el.remove());

  // Display new errors
  Object.keys(errors).forEach(fieldName => {
    const field = document.querySelector(`[name="${fieldName}"]`);
    if (field) {
      const errorEl = document.createElement('div');
      errorEl.className = 'form-error';
      errorEl.style.color = '#dc3545';
      errorEl.style.fontSize = '0.85rem';
      errorEl.style.marginTop = '0.3rem';
      errorEl.textContent = errors[fieldName];
      field.parentElement.appendChild(errorEl);
    }
  });
}

// Format date
function formatDate(date) {
  if (typeof date === 'string') {
    return new Date(date).toLocaleDateString('en-US', {
      year: 'numeric',
      month: 'long',
      day: 'numeric'
    });
  }
  return date.toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  });
}

// Calculate days between dates
function calculateDaysBetween(startDate, endDate) {
  const start = new Date(startDate);
  const end = new Date(endDate);
  const diffTime = Math.abs(end - start);
  const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
  return diffDays;
}

// Calculate booking price
function calculateBookingPrice(pricePerDay, startDate, endDate) {
  const days = calculateDaysBetween(startDate, endDate);
  return pricePerDay * days;
}

// Update booking summary
function updateBookingSummary() {
  const pickupDate = document.getElementById('pickup_date')?.value;
  const returnDate = document.getElementById('return_date')?.value;
  const pricePerDay = parseFloat(document.getElementById('price_per_day')?.value || 0);

  if (pickupDate && returnDate && pricePerDay > 0) {
    const totalPrice = calculateBookingPrice(pricePerDay, pickupDate, returnDate);
    const totalEl = document.getElementById('total_price');
    if (totalEl) {
      totalEl.textContent = '$' + totalPrice.toFixed(2);
    }
  }
}

// Search and filter vehicles
function filterVehicles() {
  const searchTerm = document.getElementById('search')?.value.toLowerCase() || '';
  const vehicleType = document.getElementById('vehicle_type')?.value || '';
  const maxPrice = parseFloat(document.getElementById('max_price')?.value) || Infinity;

  const vehicles = document.querySelectorAll('.vehicle-card');
  let visibleCount = 0;

  vehicles.forEach(vehicle => {
    const name = vehicle.querySelector('.vehicle-name')?.textContent.toLowerCase() || '';
    const type = vehicle.dataset.type || '';
    const price = parseFloat(vehicle.dataset.price) || 0;

    const matchesSearch = name.includes(searchTerm);
    const matchesType = !vehicleType || type === vehicleType;
    const matchesPrice = price <= maxPrice;

    if (matchesSearch && matchesType && matchesPrice) {
      vehicle.style.display = 'block';
      visibleCount++;
    } else {
      vehicle.style.display = 'none';
    }
  });

  const noResults = document.getElementById('no-results');
  if (noResults) {
    noResults.style.display = visibleCount === 0 ? 'block' : 'none';
  }
}

// Modal functions
function openModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.style.display = 'block';
  }
}

function closeModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.style.display = 'none';
  }
}

function closeModalOnOutsideClick(event) {
  if (event.target.classList.contains('modal')) {
    event.target.style.display = 'none';
  }
}

// Delete confirmation
function confirmDelete(itemName = 'this item') {
  return confirm(`Are you sure you want to delete ${itemName}?`);
}

// Show alert message
function showAlert(message, type = 'success') {
  const alertDiv = document.createElement('div');
  alertDiv.className = `alert alert-${type}`;
  alertDiv.textContent = message;
  alertDiv.style.marginBottom = '1.5rem';
  alertDiv.style.padding = '1rem';
  alertDiv.style.borderRadius = '5px';
  alertDiv.style.borderLeft = '4px solid';

  const container = document.querySelector('.container');
  if (container) {
    container.insertBefore(alertDiv, container.firstChild);
    setTimeout(() => alertDiv.remove(), 5000);
  }
}

// Logout
function logout() {
  if (confirm('Are you sure you want to logout?')) {
    window.location.href = 'pages/logout.php';
  }
}

// Session timeout warning
function setupSessionTimeout(timeoutMinutes = 30) {
  let timeoutId;
  const resetTimeout = () => {
    clearTimeout(timeoutId);
    timeoutId = setTimeout(() => {
      logout();
    }, timeoutMinutes * 60 * 1000);
  };

  document.addEventListener('mousemove', resetTimeout);
  document.addEventListener('click', resetTimeout);
  document.addEventListener('keypress', resetTimeout);

  resetTimeout();
}

// Format currency
function formatCurrency(amount) {
  return '$' + parseFloat(amount).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}

// Local storage helpers
const Storage = {
  set(key, value) {
    localStorage.setItem(key, JSON.stringify(value));
  },
  get(key) {
    const item = localStorage.getItem(key);
    return item ? JSON.parse(item) : null;
  },
  remove(key) {
    localStorage.removeItem(key);
  },
  clear() {
    localStorage.clear();
  }
};

// Document ready
document.addEventListener('DOMContentLoaded', function () {
  // Add event listeners for form validation
  const forms = document.querySelectorAll('form');
  forms.forEach(form => {
    form.addEventListener('submit', function (e) {
      if (!validateForm(this.id)) {
        e.preventDefault();
      }
    });
  });

  // Setup date inputs minimum date
  const pickupDate = document.getElementById('pickup_date');
  if (pickupDate) {
    const today = new Date().toISOString().split('T')[0];
    pickupDate.setAttribute('min', today);
  }

  // Setup return date minimum
  const returnDate = document.getElementById('return_date');
  const pickupDateInput = document.getElementById('pickup_date');
  if (returnDate && pickupDateInput) {
    pickupDateInput.addEventListener('change', function () {
      returnDate.setAttribute('min', this.value);
    });
  }

  // Add listeners for price calculation
  if (document.getElementById('pickup_date') || document.getElementById('return_date')) {
    document.addEventListener('change', updateBookingSummary);
  }

  // Setup mobile menu toggle
  const menuToggle = document.querySelector('.menu-toggle');
  if (menuToggle) {
    menuToggle.addEventListener('click', toggleMobileMenu);
  }

  // Close modal on outside click
  document.addEventListener('click', closeModalOnOutsideClick);
});

// Utility function for API calls
async function apiCall(endpoint, method = 'GET', data = null) {
  const options = {
    method: method,
    headers: {
      'Content-Type': 'application/json'
    }
  };

  if (data && method !== 'GET') {
    options.body = JSON.stringify(data);
  }

  try {
    const response = await fetch(endpoint, options);
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    return await response.json();
  } catch (error) {
    console.error('API call failed:', error);
    throw error;
  }
}