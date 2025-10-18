// Cart state
let cart = [];

// Book data
const books = [
    {
        id: 1,
        title: "The Silent Patient",
        author: "Alex Michaelides",
        price: 14.99,
        rating: 4.2,
        image: "https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=300&h=400&fit=crop"
    },
    // Add more books here as needed
];

// Initialize cart functionality
function initCart() {
    // Add click event to all cart buttons
    document.querySelectorAll('.btn-outline-primary').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const card = this.closest('.card');
            addToCart(card);
        });
    });
}

// Add item to cart
function addToCart(card) {
    const title = card.querySelector('.card-title').textContent;
    const author = card.querySelector('.text-muted.small').textContent;
    const priceText = card.querySelector('.badge').textContent;
    const price = parseFloat(priceText.replace('$', ''));
    const image = card.querySelector('.card-img-top').src;
    
    // Check if item already exists
    const existing = cart.find(item => item.title === title);
    
    if (existing) {
        existing.quantity++;
        showNotification(`Added another "${title}" to cart`);
    } else {
        cart.push({
            title,
            author,
            price,
            image,
            quantity: 1
        });
        showNotification(`"${title}" added to cart`);
    }
    
    updateCartUI();
}

// Update cart UI (badge count)
function updateCartUI() {
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    
    // Update cart badge if it exists
    let badge = document.querySelector('.cart-badge');
    if (!badge) {
        // Create badge if it doesn't exist
        const cartBtn = document.querySelector('[data-cart-button]');
        if (cartBtn) {
            badge = document.createElement('span');
            badge.className = 'cart-badge position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger';
            badge.style.fontSize = '0.7rem';
            cartBtn.style.position = 'relative';
            cartBtn.appendChild(badge);
        }
    }
    
    if (badge) {
        badge.textContent = totalItems;
        badge.style.display = totalItems > 0 ? 'inline-block' : 'none';
    }
}

// Show notification
function showNotification(message) {
    // Remove existing notification
    const existing = document.querySelector('.cart-notification');
    if (existing) existing.remove();
    
    // Create notification
    const notification = document.createElement('div');
    notification.className = 'cart-notification position-fixed bottom-0 end-0 m-3 alert alert-success alert-dismissible fade show';
    notification.style.zIndex = '9999';
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(notification);
    
    // Auto remove after 3 seconds
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Get cart items
function getCart() {
    return cart;
}

// Get cart total
function getCartTotal() {
    return cart.reduce((sum, item) => sum + (item.price * item.quantity), 0).toFixed(2);
}

// Remove from cart
function removeFromCart(title) {
    cart = cart.filter(item => item.title !== title);
    updateCartUI();
}

// Clear cart
function clearCart() {
    cart = [];
    updateCartUI();
}

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCart);
} else {
    initCart();
}
