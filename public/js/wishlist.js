$(document).ready(function(){
    const wishlistContent = $('#wishlist-content');
    let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
    
    // Fungsi untuk memformat angka menjadi Rupiah
    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(number);
    }

    // Fungsi untuk mengupdate badge di navbar
    function updateNavbarBadges() {
        // Update Wishlist Badge
        let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
        $('.fa-heart').next('.badge').text(wishlist.length);

        // Update Cart Badge
        let cart = JSON.parse(sessionStorage.getItem('shoppingCart')) || [];
        let totalCartItems = 0;
        cart.forEach(item => { totalCartItems += item.quantity; });
        $('.fa-shopping-cart').next('.badge').text(totalCartItems);
    }

    // Fungsi utama untuk menampilkan item wishlist
    function renderWishlist() {
        wishlistContent.empty();
        updateNavbarBadges();

        if (wishlist.length === 0) {
            wishlistContent.html('<div class="col-12 text-center"><p class="text-muted">Wishlist Anda kosong.</p><a href="index" class="btn btn-primary">Cari Produk</a></div>');
            return;
        }

        wishlist.forEach((item, index) => {
            // Kita gunakan style kartu produk dari "Special Selection"
            const productCard = `
                <div class = "col-md-6 col-lg-4 col-xl-3 p-2">
                    <div class = "special-img position-relative overflow-hidden">
                        <img src = "${item.image}" class = "w-100">
                        <span class = "position-absolute d-flex align-items-center justify-content-center text-primary fs-4 remove-from-wishlist" data-id="${item.id}" style="cursor: pointer;" title="Remove from Wishlist">
                            <i class = "fas fa-heart"></i>
                        </span>
                    </div>
                    <div class = "text-center">
                        <p class = "text-capitalize mt-3 mb-1">${item.name}</p>
                        <span class = "fw-bold d-block">${formatRupiah(item.price)}</span>
                        <button class = "btn btn-primary mt-3 add-to-cart-from-wishlist" data-id="${item.id}">Add to Cart</button>
                    </div>
                </div>
            `;
            wishlistContent.append(productCard);
        });
    }

    // Event listener untuk menghapus dari wishlist
    wishlistContent.on('click', '.remove-from-wishlist', function() {
        const itemIdToRemove = $(this).data('id');
        wishlist = wishlist.filter(item => item.id !== itemIdToRemove);
        localStorage.setItem('wishlist', JSON.stringify(wishlist));
        renderWishlist(); // Tampilkan ulang wishlist yang sudah diperbarui
        alert('Item telah dihapus dari wishlist.');
    });

    // Event listener untuk memindahkan ke keranjang
    wishlistContent.on('click', '.add-to-cart-from-wishlist', function() {
        const itemIdToAdd = $(this).data('id');
        const itemToAdd = wishlist.find(item => item.id === itemIdToAdd);

        if (itemToAdd) {
            // Tambahkan ke keranjang (logika dari script.js)
            let cart = JSON.parse(sessionStorage.getItem('shoppingCart')) || [];
            let existingCartItem = cart.find(item => item.id === itemToAdd.id);
            if (existingCartItem) {
                existingCartItem.quantity++;
            } else {
                cart.push({ ...itemToAdd, quantity: 1 });
            }
            sessionStorage.setItem('shoppingCart', JSON.stringify(cart));

            // Hapus dari wishlist
            wishlist = wishlist.filter(item => item.id !== itemIdToAdd);
            localStorage.setItem('wishlist', JSON.stringify(wishlist));
            
            alert(`"${itemToAdd.name}" telah dipindahkan ke keranjang belanja.`);
            renderWishlist();
        }
    });

    // Panggil fungsi render saat halaman dimuat
    renderWishlist();
});


function addToWishlist(id_produk) {
  fetch('/wishlist', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify({
      id_produk: id_produk
    })
  })
  .then(res => res.json())
  .then(data => {
    alert(data.message); // untuk feedback
  })
  .catch(error => {
    console.error('Error:', error);
  });
}
