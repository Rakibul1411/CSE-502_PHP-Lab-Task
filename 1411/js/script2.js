document.addEventListener('DOMContentLoaded', function() {
  console.log('Script2 is working!');

  // Example function to validate the contact form
  function validateContactForm() {
      const form = document.getElementById('contact-form');
      form.addEventListener('submit', function(event) {
          const name = document.getElementById('name').value;
          const email = document.getElementById('email').value;
          const subject = document.getElementById('subject').value;
          const message = document.getElementById('message').value;

          if (!name || !email || !subject || !message) {
              alert('All fields are required!');
              event.preventDefault();
          }
      });
  }

  // Call the function to validate the contact form
  validateContactForm();
});