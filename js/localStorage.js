function addToCart(product) {
    // Fetch existing cart data or initialize an empty array
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Check if the product is already in the cart
    const existingProduct = cart.find(item => item.id === product.id);

    if (existingProduct) {
        // Increase quantity if product exists
        existingProduct.quantity += 1;
    } else {
        // Add new product to the cart
        cart.push({ ...product, quantity: 1 });
    }

    // Save updated cart back to Local Storage
    localStorage.setItem('cart', JSON.stringify(cart));

    alert(`${product.name} added to the cart!`);
}

// Example product object
const exampleProduct = {
    id: 1,
    name: "Thinking, Fast and Slow",
    author: "Daniel Kahneman",
    price: 9.99,
    image: "https://i.imgur.com/2DsA49b.webp"
};

// Bind the addToCart function to a button
document.getElementById("add-to-cart-btn").addEventListener("click", () => addToCart(exampleProduct));
