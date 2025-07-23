$(document).ready(function() {
    const resultsContent = $('#results-content');
    const searchTitle = $('#search-title');

    // Dapatkan kata kunci dari URL
    const urlParams = new URLSearchParams(window.location.search);
    const query = urlParams.get('q');

    // Fungsi untuk format Rupiah atau Dollar
    function formatCurrency(number) {
        if (number < 1000) {
            return '$' + number.toFixed(2);
        }
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(number);
    }
    
    function displayResults(keyword) {
        resultsContent.empty();
        
        if (!keyword || keyword.trim() === "") {
            searchTitle.text('Silakan masukkan kata kunci pencarian.');
            return;
        }

        searchTitle.html(`Hasil Pencarian untuk: <span class="text-primary">${keyword}</span>`);
        
        const lowerCaseKeyword = keyword.toLowerCase();
        
        // --- PERUBAHAN LOGIKA PENCARIAN DI SINI ---
        const matchedProducts = allProducts.filter(product => {
            // Cek apakah kata kunci ada di nama produk
            const nameMatch = product.name.toLowerCase().includes(lowerCaseKeyword);
            
            // Cek apakah kata kunci ada di dalam salah satu tag
            const tagMatch = product.tags.some(tag => tag.toLowerCase().includes(lowerCaseKeyword));

            // Kembalikan true jika cocok di nama ATAU di tags
            return nameMatch || tagMatch;
        });

        if (matchedProducts.length === 0) {
            resultsContent.html('<div class="col-12 text-center"><p class="text-muted">Produk tidak ditemukan.</p></div>');
            return;
        }

        matchedProducts.forEach(item => {
            const productCard = `
                <div class="col-md-6 col-lg-4 col-xl-3 p-2">
                    <div class="collection-img position-relative">
                        <img src="${item.image}" class="w-100">
                    </div>
                    <div class="text-center">
                        <div class="rating mt-3">
                            <span class="text-primary"><i class="fas fa-star"></i></span>
                            <span class="text-primary"><i class="fas fa-star"></i></span>
                            <span class="text-primary"><i class="fas fa-star"></i></span>
                            <span class="text-primary"><i class="fas fa-star"></i></span>
                            <span class="text-primary"><i class="fas fa-star"></i></span>
                        </div>
                        <p class="text-capitalize my-1">${item.name}</p>
                        <span class="fw-bold">${formatCurrency(item.price)}</span>
                    </div>
                </div>
            `;
            resultsContent.append(productCard);
        });
    }

    // Tampilkan hasil saat halaman dimuat
    displayResults(query);
});