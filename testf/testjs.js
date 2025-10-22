// Cart management
const cart = {
    items: [],
    
    add(book) {
        // Check if already exists
        const exists = this.items.some(item => item.title === book.title);
        
        if (exists) {
            console.log('Item already in cart');
            return false;
        }
        
        this.items.push(book);
        // console.log('Added to cart:', book);
        return true;
    },
    
    remove(title) {
        this.items = this.items.filter(item => item.title !== title);
        console.log('Removed from cart:', title);
        this.updateCartCount();
    },
    
    // updateCartCount() {
    //     // Update cart badge
    //     const cartBadge = document.querySelector('#cartCount');
    //     if (cartBadge) {
    //         cartBadge.textContent = this.items.length;
    //     }
    //     console.log('Cart total:', this.items.length);
    // },
    
    getTotal() {
        return this.items.reduce((sum, item) => {
            const price = parseFloat(item.price.replace('$', ''));
            return sum + price;
        }, 0);
    }
};



// 1. Add to Cart Functionality
document.querySelectorAll('.btn-outline-primary').forEach(button => {
    button.addEventListener('click', function(e) {
        const card = e.target.closest('.card');
        const title = card.querySelector('.card-title').textContent;
        const author = card.querySelector('.text-muted.small').textContent;
        const price = card.querySelector('.badge').textContent;
        
        // console.log('Added to cart:', { title, author, price });
        const book={title,author,price};
        const added=cart.add(book);

        if (added){
            // Visual feedback
        this.innerHTML = '<i class="bi bi-check"></i>';
        this.classList.add('btn-success');
        this.classList.remove('btn-outline-primary');
        this.disabled=true;
        }else{
            setTimeout(() => {
            this.innerHTML = '<i class="bi bi-cart-plus"></i>';
            this.classList.remove('btn-success');
            this.classList.add('btn-outline-primary');
        }, 1500);
        }
    });
});
console.log(cart.items);