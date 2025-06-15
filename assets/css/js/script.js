// Script for blog platform
document.addEventListener("DOMContentLoaded", () => {
    console.log("Blog Platform JS loaded");
    
    // Example: Handle like button (future expansion)
    const likeButtons = document.querySelectorAll('.like-btn');
    likeButtons.forEach(button => {
        button.addEventListener('click', () => {
            alert('Like clicked!');
            // AJAX or fetch() can go here to handle real-time liking
        });
    });
});
