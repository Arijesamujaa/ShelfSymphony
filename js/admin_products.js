document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".description-container").forEach((container) => {
        const description = container.querySelector(".description");
        const button = container.querySelector(".toggle-btn");

        if (!description || !button) {
            console.error("Missing description or button in container:", container);
            return;
        }

        const lineHeight = parseFloat(getComputedStyle(description).lineHeight);
        const maxLinesHeight = lineHeight * parseInt(getComputedStyle(description).getPropertyValue("--max-lines"));

        if (description.scrollHeight <= maxLinesHeight) {
            button.style.display = "none"; 
        } else {
            button.style.display = "inline"; 
        }
    });
});

function toggleDescription(button) {
    const description = button.previousElementSibling;
    const card = button.closest(".card"); 

    if (!description || !card) {
        console.error("Description ose card nuk u gjet!");
        return;
    }

    const isExpanded = description.classList.toggle("expanded");
    card.classList.toggle("expanded", isExpanded); 

    button.textContent = isExpanded ? "Read Less" : "Read More";
}


