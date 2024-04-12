
    fetch('/src/php/session_data.php')
        .then(response => response.json())
        .then(data => {
            console.log("Logged in user:", data.username['name']);
            document.getElementById('account-name').textContent = data.username['name'];
        })
        .catch(error => console.error('Error fetching session data:', error));
