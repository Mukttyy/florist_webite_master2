// File ini berfungsi sebagai database produk sederhana dengan tags untuk pencarian
const allProducts = [
    // Produk dari "New Collection"
    { id: 'gray-shirt', name: 'kemeja formal abu-abu', price: 45.50, image: 'images/c_formal_gray_shirt.png', category: 'best', tags: ['kemeja', 'shirt', 'formal', 'pria'] },
    { id: 'pant-girl', name: 'celana wanita', price: 45.50, image: 'images/c_pant_girl.png', category: 'feat', tags: ['celana', 'pants', 'wanita'] },
    { id: 'polo-shirt', name: 'kaos polo', price: 45.50, image: 'images/c_polo-shirt.png', category: 'new', tags: ['kaos', 'shirt', 'polo', 'pria'] },
    { id: 'shirt-girl', name: 'kemeja wanita', price: 45.50, image: 'images/c_shirt-girl.png', category: 'best', tags: ['kemeja', 'shirt', 'wanita'] },
    { id: 't-shirt-men', name: 'kaos oblong pria', price: 45.50, image: 'images/c_t-shirt_men.png', category: 'feat', tags: ['kaos', 't-shirt', 'pria'] },
    { id: 'tunic-shirt-girl', name: 'kemeja tunik', price: 45.50, image: 'images/c_tunic-shirt_girl.png', category: 'new', tags: ['kemeja', 'tunic', 'wanita'] },
    { id: 'undershirt', name: 'kaos dalam', price: 45.50, image: 'images/c_undershirt.png', category: 'best', tags: ['kaos', 'undershirt', 'pria'] },
    { id: 'western-shirt', name: 'kemeja western', price: 45.50, image: 'images/c_western-shirt.png', category: 'feat', tags: ['kemeja', 'shirt', 'western', 'pria'] },

    // Produk dari "Special Selection"
    { id: 'kaos-polos', name: 'kaos polos', price: 80000, image: 'images/special_product_1.jpg', category: 'special', tags: ['kaos', 'polos', 't-shirt'] },
    { id: 'kaos-polo', name: 'kaos polo spesial', price: 100000, image: 'images/special_product_2.jpg', category: 'special', tags: ['kaos', 'polo', 'shirt'] },
    { id: 'celana-lose-pants', name: 'celana longgar', price: 120000, image: 'images/special_product_3.jpg', category: 'special', tags: ['celana', 'pants', 'wanita'] },
    { id: 'celana-kantor', name: 'celana kantor', price: 130000, image: 'images/special_product_4.jpg', category: 'special', tags: ['celana', 'pants', 'formal'] }
];