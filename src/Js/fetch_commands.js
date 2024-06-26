
// Fetch the commands from the server
  fetch('/src/php/fetch_commands.php')
    .then(response => response.json())
    .then(data => {
      // Process the received JSON data here
      console.log(data);
      if (data!==null ) {
        console.log(data.length);
        console.log('Data is not empty');
        // Get the div that will contain the commands that's inside the basket-button
        const commandContainer = document.querySelector('.basket-button .dropdown-content');

        // Clear the innerHtml of the div
        commandContainer.innerHTML = '';
  
        data.forEach(command => {
          const liElement = document.createElement('li');
          const spanElement = document.createElement('span');
          spanElement.textContent = `${command.product.name}: ${command.product.description}`;
          liElement.appendChild(spanElement);
          commandContainer.appendChild(liElement);
        });
      }
    })
    .catch(error => {
      // Handle any errors that occurred during the request
      console.error('Error:', error);
    });

    //if the data is not empty, then change remove the innerhtml of the div and add the data as li span containing the command name and the description
    
