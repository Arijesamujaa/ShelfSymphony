document.addEventListener("DOMContentLoaded", () => {
    const links = document.querySelectorAll(".custom-link");
    const contentArea = document.querySelector('#dynamic-content'); 

    const loadContent = (url) => {
        fetch(url)
            .then(response => response.text())
            .then(data => {
                contentArea.innerHTML = data; 
            })
            .catch(err => console.error('Error loading page:', err));
    };

    links.forEach((link) => {
        link.addEventListener("click", (e) => {
            e.preventDefault();  
            const url = link.getAttribute("href"); 

            window.history.pushState({ path: url }, "", url);

            loadContent(url);
        });
    });

    loadContent(window.location.pathname);

    window.onpopstate = () => {
        loadContent(window.location.pathname); 
    };
});
