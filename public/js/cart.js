$(document).ready(function(){
    const cartContent = $('#cart-content');
    let cart = JSON.parse(sessionStorage.getItem('shoppingCart')) || [];

    // Fungsi untuk update badge keranjang di navbar
    function updateCartBadge(cart) {
        let totalItems = 0;
        cart.forEach(item => {
            totalItems += item.quantity;
        });
        $('.fa-shopping-cart').next('.badge').text(totalItems);
    }

    // Fungsi untuk memformat angka menjadi Rupiah
    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(number);
    }

    function renderCart() {
        updateCartBadge(cart);
        cartContent.empty();

        if (cart.length === 0) {
            cartContent.html('<p class="text-center text-muted">Keranjang belanja Anda kosong.</p><div class="text-center"><a href="index" class="btn btn-primary">Mulai Belanja</a></div>');
            return;
        }

        let grandTotal = 0;
        const table = `
            <table class="table table-hover align-middle">
                <thead class="text-center">
                    <tr>
                        <th>Gambar</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Hapus</th>
                    </tr>
                </thead>
                <tbody id="cart-table-body" class="text-center">
                </tbody>
            </table>
            <div class="text-end mt-4">
                <h4>Total Belanja: <span class="fw-bold" id="grand-total">${formatRupiah(0)}</span></h4>
            </div>
            <hr>
        `;
        cartContent.append(table);

        const cartTableBody = $('#cart-table-body');
        cart.forEach((item, index) => {
            let subtotal = item.price * item.quantity;
            grandTotal += subtotal;

            let row = `
                <tr>
                    <td><img src="${item.image}" alt="${item.name}" style="width: 80px; height: auto; object-fit: cover;"></td>
                    <td class="text-capitalize">${item.name}</td>
                    <td>${formatRupiah(item.price)}</td>
                    <td>
                        <input type="number" class="form-control quantity-input" value="${item.quantity}" min="1" data-index="${index}" style="width: 75px; margin: auto;">
                    </td>
                    <td>${formatRupiah(subtotal)}</td>
                    <td>
                        <button class="btn btn-danger btn-sm remove-item" data-index="${index}"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            `;
            cartTableBody.append(row);
        });

        $('#grand-total').text(formatRupiah(grandTotal));
        renderCheckoutForm();
    }

    function renderCheckoutForm() {
        const checkoutForm = `
            <div class="checkout-form mt-5">
                <div class="title text-center">
                    <h2 class="position-relative d-inline-block">Checkout</h2>
                </div>
                <div class="row justify-content-center mt-4">
                    <div class="col-lg-6">
                        <form id="checkout-form">
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="fullName" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Alamat Email</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat Pengiriman</label>
                                <textarea class="form-control" id="address" rows="3" required></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary text-uppercase">Pesan Sekarang</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        `;
        cartContent.append(checkoutForm);
    }
    
    // Event listener untuk menghapus item
    cartContent.on('click', '.remove-item', function() {
        let index = $(this).data('index');
        cart.splice(index, 1);
        sessionStorage.setItem('shoppingCart', JSON.stringify(cart));
        renderCart();
    });

    // Event listener untuk mengubah kuantitas
    cartContent.on('change', '.quantity-input', function() {
        let index = $(this).data('index');
        let newQuantity = parseInt($(this).val());
        if (newQuantity > 0) {
            cart[index].quantity = newQuantity;
            sessionStorage.setItem('shoppingCart', JSON.stringify(cart));
            renderCart();
        } else {
            cart.splice(index, 1);
            sessionStorage.setItem('shoppingCart', JSON.stringify(cart));
            renderCart();
        }
    });

    // Event listener untuk form checkout
    cartContent.on('submit', '#checkout-form', function(e) {
        e.preventDefault();
        alert('Terima kasih atas pesanan Anda! Pesanan akan segera kami proses.');
        
        cart = [];
        sessionStorage.removeItem('shoppingCart');
        window.location.href = 'index';
    });

    // Panggil renderCart saat halaman keranjang dimuat
    renderCart();
});