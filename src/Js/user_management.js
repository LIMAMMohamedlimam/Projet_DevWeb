// Function to manage user state and handle AJAX requests to the PHP backend
let isLoggedIn = false; // Track user login state

// Function to make AJAX requests with given action and data
function makeRequest(action, data) {
  const xhr = new XMLHttpRequest();
  const method = data ? 'POST' : 'GET';
  const url = data ? '/src/php/loginUser.php' : `/src/php/user_management.php?action=${action}`;

  xhr.open(method, url, true);
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4) {
      const response = JSON.parse(xhr.responseText);
      handleResponse(action, response);
    }
  };
  xhr.send(data ? JSON.stringify(data) : null);
}

// Handle response based on the action performed
function handleResponse(action, response) {
  if (action === 'check' && !response.isLoggedIn) {
    console.log('User is not logged in');
    isLoggedIn = false;
    redirectToLogin();
  } else if (action === 'login' && response.isLoggedIn) {
    console.log('Login successful');
    isLoggedIn = true;
    console.log('Redirecting to home page...');
    window.location.href = '/src/modules/acceuil.html'; // Redirect to home page on successful login
  } else if (action === 'logout' && !response.isLoggedIn) {
    console.log('User logged out successfully');
    isLoggedIn = false;

    redirectToLogin();
  } else if (action === 'logout' && response.isLoggedIn) {
    console.log('Logging out...');
    makeRequest('logout'); // Trigger logout
  }
}

// Redirect to login if needed
function redirectToLogin() {
  if (window.location.pathname !== '/src/modules/signin.html') {
    window.location.href = '/src/modules/signin.html';
  }
}

// Setup UI elements and event listeners
function setupUI() {
  const accountName = document.getElementById('account-name');
  const logoutDropdown = document.getElementById('logout-dropdown');
  const logoutButton = document.getElementById('logout');

  if (isLoggedIn) {
    accountName.addEventListener('click', function() {
      logoutDropdown.style.display = 'block';
    });
    logoutButton.addEventListener('click', function() {
      logoutDropdown.style.display = 'none';
      makeRequest('logout');
    });
  } else {
    accountName.addEventListener('click', redirectToLogin);
  }
}

// Event listener for login form submission
document.getElementById('loginForm').addEventListener('submit', function(event) {
  event.preventDefault();
  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;

  if (!email || !password) {
    alert('All fields are required.');
    return;
  }

  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email)) {
    alert('Please enter a valid email address.');
    return;
  }

  makeRequest('login', {email: email, password: password});
});

// Initial user state check and UI setup
makeRequest('check');
setupUI();
