document.addEventListener('DOMContentLoaded', function() {
  console.log('JavaScript is working!');

  // Function to show the dropdown menu
  function showDropdown() {
      const aboutLink = document.querySelector('.nav-item a[href="about.php"]');
      const dropdown = aboutLink.nextElementSibling;

      aboutLink.addEventListener('mouseover', function() {
          dropdown.style.display = 'block';
      });

      aboutLink.addEventListener('mouseout', function() {
          dropdown.style.display = 'none';
      });

      dropdown.addEventListener('mouseover', function() {
          dropdown.style.display = 'block';
      });

      dropdown.addEventListener('mouseout', function() {
          dropdown.style.display = 'none';
      });

      // Redirect to personal-info.php when "About Me" is clicked
      aboutLink.addEventListener('click', function(event) {
          event.preventDefault();
          window.location.href = 'personal-info.php';
      });
  }

  // Call the function to show the dropdown menu
  showDropdown();
});