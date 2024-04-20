document.addEventListener("DOMContentLoaded", function() {
    // Get all the navigation links
    var navLinks = document.querySelectorAll('.nav-link');
  
    // Add click event listeners to each link
    navLinks.forEach(function(link) {
      link.addEventListener('click', function() {
        // Remove the 'active' class from all links
        navLinks.forEach(function(innerLink) {
          innerLink.classList.remove('active');
        });
  
        // Add the 'active' class to the clicked link
        link.classList.add('active');
      });
    });
});

