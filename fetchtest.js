fetch('http://localhost:8000/test_post.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: 'param1=value1&param2=value2'
})
.then(response => response.text())
.then(data => console.log(data))
.catch(error => console.error('Error:', error));
