function addToCart(productId, price, name, imageUrl, stockQuantity, category, event) {
    if (event) {
        event.stopPropagation();
    }
    console.log(productId);
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    
    const existingItemIndex = cart.findIndex(item => item.id === parseInt(productId));
    
    if (existingItemIndex > -1) {
        if (cart[existingItemIndex].quantity < stockQuantity) {
            cart[existingItemIndex].quantity += 1;
            showNotification('Item quantity updated in cart');
        } else {
            showNotification('Cannot add more of this item - stock limit reached', 'error');
            return;
        }
    } else {
        cart.push({
            id: parseInt(productId),
            name: name,
            price: price,
            imageUrl: imageUrl,
            quantity: 1,
            category: category,
            stockQuantity: stockQuantity
        });
        showNotification('Item added to cart');
    }
    
    localStorage.setItem('cart', JSON.stringify(cart));
    
    updateCartCounter();
    updateCartModal();
}

function updateCartCounter() {
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    const uniqueItems = cart.length; // Count unique products instead of total quantities
    
    const cartCounter = document.getElementById('cart-counter');
    if (cartCounter) {
        cartCounter.textContent = uniqueItems;
        cartCounter.style.display = uniqueItems > 0 ? 'flex' : 'none';
    }
}

function updateCartModal() {
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    const cartItems = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    
    if (cartItems) {
        cartItems.innerHTML = '';
        let total = 0;
        
        if (cart.length === 0) {
            const emptyCartMessage = document.createElement('div');
            emptyCartMessage.className = 'text-center py-6 text-gray-500';
            emptyCartMessage.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                <p>Your cart is empty</p>
            `;
            cartItems.appendChild(emptyCartMessage);
        } else {
            cart.forEach(item => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;
                
                const itemElement = document.createElement('div');
                itemElement.className = 'flex items-center gap-3 border-b pb-3';
                itemElement.innerHTML = `
                    <div class="flex-shrink-0">
                        <img src="${item.imageUrl}" alt="${item.name}" class="w-16 h-16 object-cover rounded">
                    </div>
                    <div class="flex-grow min-w-0">
                        <h4 class="font-medium text-sm text-gray-800 truncate">${item.name}</h4>
                        <p class="text-xs text-gray-500">$${item.price.toFixed(2)} each</p>
                        <div class="flex items-center mt-1">
                            <button onclick="updateItemQuantity(${item.id}, ${item.quantity - 1})" class="px-2 text-xs bg-gray-100 rounded hover:bg-gray-200 border">-</button>
                            <span class="px-2 text-sm">${item.quantity}</span>
                            <button onclick="updateItemQuantity(${item.id}, ${item.quantity + 1})" class="px-2 text-xs bg-gray-100 rounded hover:bg-gray-200 border">+</button>
                        </div>
                    </div>
                    <div class="flex flex-col items-end gap-1">
                        <span class="font-medium text-sm">$${itemTotal.toFixed(2)}</span>
                        <button onclick="updateItemQuantity(${item.id}, 0)" class="text-red-500 hover:text-red-700 text-xs">
                            Remove
                        </button>
                    </div>
                `;
                cartItems.appendChild(itemElement);
            });
        }
        
        if (cartTotal) {
            cartTotal.textContent = total.toFixed(2);
        }
    }
}

function checkout() {
    // You can implement checkout logic here
    alert('Proceeding to checkout...');
    // closeCartModal();
}


function updateItemQuantity(productId, newQuantity) {
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    const itemIndex = cart.findIndex(item => item.id === productId);
    
    if (itemIndex > -1) {
        if (newQuantity <= 0) {
            cart.splice(itemIndex, 1);
        } else if (newQuantity <= cart[itemIndex].stockQuantity) {
            cart[itemIndex].quantity = newQuantity;
        } else {
            showNotification('Cannot add more of this item - stock limit reached', 'error');
            return;
        }
        
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartCounter();
        updateCartModal();
    }
}

function showCartModal() {
    const modal = document.getElementById('cart-modal');
    if (modal) {
        modal.classList.remove('hidden');
        updateCartModal();
    }
}

function closeCartModal() {
    const modal = document.getElementById('cart-modal');
    if (modal) {
        modal.classList.add('hidden');
    }
}

function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.className = `fixed bottom-4 right-4 p-4 rounded-md ${
        type === 'success' ? 'bg-green-500' : 'bg-red-500'
    } text-white font-bold shadow-lg z-50 transition-opacity duration-300`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.opacity = '0';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

document.addEventListener('DOMContentLoaded', () => {
    updateCartCounter();
    
    // Add click event listener to cart button
    const cartButton = document.getElementById('cart-button');
    if (cartButton) {
        cartButton.addEventListener('click', showCartModal);
    }
    
    // Close modal when clicking outside
    const modal = document.getElementById('cart-modal');
    if (modal) {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeCartModal();
            }
        });
    }
});