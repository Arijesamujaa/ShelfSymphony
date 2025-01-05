function updatePriceCart(itemId, itemPrice) {
    const quantity = document.getElementById('quantity_' + itemId).value;

    const newPrice = itemPrice * quantity;

    document.getElementById('price_' + itemId).innerText =  newPrice + '€';
}

function updatePrice(itemId, itemPrice) {
    const quantity = document.getElementById('quantity_' + itemId).value;

    const newPrice = parseFloat(itemPrice) * parseInt(quantity);

    document.getElementById('price_' + itemId).innerText = 'Price: ' + newPrice + '€';
}

function updateTotalPrice() {
    let total = 0;
    const rows = document.querySelectorAll('table tbody tr');
    rows.forEach(row => {
        const price = parseFloat(row.querySelector('td p').innerText.replace('€', ''));
        const quantity = parseInt(row.querySelector('input[name="quantity"]').value);
        total += price * quantity;
    });
    document.getElementById('total-price').innerText = `${total.toFixed(2)}€`;
}

document.querySelectorAll('input[name="quantity"]').forEach(input => {
    input.addEventListener('input', updateTotalPrice);
});
