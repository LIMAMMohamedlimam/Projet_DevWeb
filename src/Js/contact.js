function validateForm() {
  let isValid = true;
  const fields = ['date', 'nom', 'prenom', 'mail', 'naissance', 'sujet', 'message'];
  const messages = {
      'date': 'La date de contact ne doit pas être vide.',
      'nom': 'Le nom ne doit pas être vide.',
      'prenom': 'Le prénom ne doit pas être vide.',
      'mail': 'L\'email ne doit pas être vide.',
      'naissance': 'La date de naissance ne doit pas être vide.',
      'sujet': 'Le sujet ne doit pas être vide.',
      'message': 'Le contenu ne doit pas être vide.'
  };
  // Clear previous error messages
  fields.forEach(field => {
      document.getElementById(field + 'Error').innerHTML = '';
  });
  // Check each field
  fields.forEach(field => {
      if (document.getElementById(field).value.trim() === '') {
          document.getElementById(field + 'Error').innerHTML = messages[field];
          document.getElementById(field + 'Error').style.color = 'red';
          isValid = false;
      }
  });
  return isValid;
}
    
