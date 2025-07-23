$(document).ready(function(){
    // =================================================
    // BAGIAN PENGATURAN TAMPILAN (UI)
    // =================================================

    // Mengaktifkan filter kategori produk dengan Isotope
    var $grid = $('.collection-list').isotope({
        itemSelector: '.p-2',
        layoutMode: 'fitRows'
    });

    $('.filter-button-group').on('click', 'button', function() {
        var filterValue = $(this).attr('data-filter');
        $grid.isotope({ filter: filterValue });
        $('.filter-button-group button').removeClass('active-filter-btn');
        $(this).addClass('active-filter-btn');
    });

    // Menampilkan dan menyembunyikan kolom search saat ikon diklik
    $('#search-icon-btn').on('click', function(event) {
        event.stopPropagation();
        var searchForm = $('#search-form');
        searchForm.fadeToggle('fast', function() {
            if (searchForm.is(':visible')) {
                searchForm.find('input').focus();
            }
        });
    });

    $('#search-form').on('click', function(event){
        event.stopPropagation();
    });

    $(document).on('click', function(){
        $('#search-form').fadeOut('fast');
    });

    // =================================================
    // BAGIAN LOGIKA SHOPPING CART
    // =================================================
    
    function loadCart() {
        let cart = JSON.parse(sessionStorage.getItem('shoppingCart')) || [];
        updateCartBadge(cart);
    }

    function updateCartBadge(cart) {
        let totalItems = 0;
        cart.forEach(item => { totalItems += item.quantity; });
        $('.fa-shopping-cart').next('.badge').text(totalItems);
    }

    $('.special-list, .collection-list').on('click', '.btn', function(e){
        if ($(this).text().trim().toLowerCase() === "add to cart") {
            e.preventDefault();
            let productCard = $(this).closest('.p-2');
            let productName = productCard.find('p.text-capitalize').text().trim();
            let priceString = productCard.find('span.fw-bold').text();
            let productPrice = parseFloat(priceString.replace(/[^0-9]/g, ''));
            let productImage = productCard.find('img').attr('src');
            let productId = productName.replace(/\s+/g, '-').toLowerCase();
            addToCart(productId, productName, productPrice, productImage);
        }
    });

    function addToCart(id, name, price, image) {
        let cart = JSON.parse(sessionStorage.getItem('shoppingCart')) || [];
        let existingItem = cart.find(item => item.id === id);
        if (existingItem) {
            existingItem.quantity++;
        } else {
            cart.push({ id, name, price, image, quantity: 1 });
        }
        sessionStorage.setItem('shoppingCart', JSON.stringify(cart));
        updateCartBadge(cart);
        alert(name + " berhasil ditambahkan ke keranjang!");
    }

    // =================================================
    // BAGIAN LOGIKA WISHLIST
    // =================================================
    
    function loadWishlist() {
        let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
        updateWishlistBadge(wishlist);
        updateHeartIcons(wishlist);
    }

    function updateWishlistBadge(wishlist) {
        $('.fa-heart').next('.badge').text(wishlist.length);
    }
    
    function updateHeartIcons(wishlist) {
        $('.special-list .p-2').each(function() {
            let productCard = $(this);
            let productName = productCard.find('p.text-capitalize').text().trim();
            let productId = productName.replace(/\s+/g, '-').toLowerCase();
            let heartIcon = productCard.find('.fa-heart');
            if (wishlist.some(item => item.id === productId)) {
                heartIcon.removeClass('far').addClass('fas');
            } else {
                heartIcon.removeClass('fas').addClass('far');
            }
        });
    }

    $('.special-list').on('click', '.fa-heart', function(){
        let productCard = $(this).closest('.p-2');
        let productName = productCard.find('p.text-capitalize').text().trim();
        let priceString = productCard.find('span.fw-bold').text();
        let productPrice = parseFloat(priceString.replace(/[^0-9]/g, ''));
        let productImage = productCard.find('img').attr('src');
        let productId = productName.replace(/\s+/g, '-').toLowerCase();
        toggleWishlistItem(productId, productName, productPrice, productImage);
    });

    function toggleWishlistItem(id, name, price, image) {
        let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
        const itemIndex = wishlist.findIndex(item => item.id === id);
        if (itemIndex > -1) {
            wishlist.splice(itemIndex, 1);
            alert(name + ' dihapus dari wishlist.');
        } else {
            wishlist.push({ id, name, price, image });
            alert(name + ' ditambahkan ke wishlist.');
        }
        localStorage.setItem('wishlist', JSON.stringify(wishlist));
        updateWishlistBadge(wishlist);
        updateHeartIcons(wishlist);
    }

    // =================================================
    // MEMUAT SEMUA FUNGSI SAAT HALAMAN DIBUKA
    // =================================================
    loadCart();
    loadWishlist();
});