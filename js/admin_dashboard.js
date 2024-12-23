// document.addEventListener("DOMContentLoaded", () => {
//     const links = document.querySelectorAll(".custom-link");
//     const sections = document.querySelectorAll("section");
//     const contentArea = document.querySelector('.col.py-3');

//     const showSection = (targetId) => {
//         sections.forEach((section) => {
//             section.classList.remove("active");
//         });

//         const targetSection = document.getElementById(targetId);
//         if (targetSection) {
//             targetSection.classList.add("active");
//         }
//     };

//     links.forEach((link) => {
//         link.addEventListener("click", (e) => {
//             e.preventDefault();  
//             const targetId = link.getAttribute("data-target");  
//             showSection(targetId);  

//             const url = link.getAttribute("href");
//             if (url) {
//                 fetch(url)
//                     .then(response => response.text())
//                     .then(data => {
//                         contentArea.innerHTML = data; 
//                     })
//                     .catch(err => console.error('Error loading page:', err));
//             }
//         });
//     });

//     showSection("home");
// });


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
