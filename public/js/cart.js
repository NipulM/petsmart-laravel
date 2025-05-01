// Function to add item to cart
function addToCart(productId, price, name, imageUrl, stockQuantity, category) {
    // Prevent navigation when clicking the add to cart button
    event.stopPropagation();
    
    // Get current cart from localStorage or initialize empty array
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    
    // Check if product already exists in cart
    const existingItemIndex = cart.findIndex(item => item.id === productId);
    
    if (existingItemIndex > -1) {
        // Increment quantity if already in cart
        if (cart[existingItemIndex].quantity < stockQuantity) {
            cart[existingItemIndex].quantity += 1;
            showNotification('Item quantity updated in cart');
        } else {
            showNotification('Cannot add more of this item - stock limit reached', 'error');
            return;
        }
    } else {
        // Add new item to cart
        cart.push({
            id: productId,
            name: name,
            price: price,
            imageUrl: imageUrl,
            quantity: 1,
            category: category,
            stockQuantity: stockQuantity
        });
        showNotification('Item added to cart');
    }
    
    // Save updated cart to localStorage
    localStorage.setItem('cart', JSON.stringify(cart));
    
    // Update cart counter
    updateCartCounter();
}

// Function to update cart counter in UI
function updateCartCounter() {
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    
    // Update UI element that shows cart count
    const cartCounter = document.getElementById('cart-counter');
    if (cartCounter) {
        cartCounter.textContent = totalItems;
        cartCounter.style.display = totalItems > 0 ? 'flex' : 'none';
    }
}

// Function to show notification
function showNotification(message, type = 'success') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `fixed bottom-4 right-4 p-4 rounded-md ${
        type === 'success' ? 'bg-green-500' : 'bg-red-500'
    } text-white font-bold shadow-lg z-50 transition-opacity duration-300`;
    notification.textContent = message;
    
    // Add to document
    document.body.appendChild(notification);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.style.opacity = '0';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

// Initialize cart counter when page loads
document.addEventListener('DOMContentLoaded', updateCartCounter);