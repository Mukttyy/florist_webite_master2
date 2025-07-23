<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pesanan | Admin Vinskanna</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        /* ... CSS Anda tetap sama ... */
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .sidebar {
            width: 220px;
            background-color: #d2a5bd;
            padding-top: 20px;
            color: #fff;
        }

        .sidebar h2 {
            text-align: center;
            font-size: 22px;
        }

        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #ba86a6;
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .header {
            background-color: #c49ab0;
            padding: 15px 20px;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .profile-icon {
            background: #fff;
            color: #c49ab0;
            padding: 8px;
            border-radius: 50%;
            font-size: 20px;
        }

        .content {
            padding: 20px;
            overflow-y: auto;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .content-header h2 {
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        }

        th {
            background-color: #a05fb8;
            color: white;
            padding: 12px;
            text-align: left;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        .badge {
            color: white;
            padding: 5px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-selesai {
            background-color: #28a745;
        }

        .badge-pending {
            background-color: #f59e0b;
        }

        .badge-dibatalkan {
            background-color: #e53e3e;
        }

        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            color: white;
            margin-right: 5px;
        }

        .btn-add {
            background-color: #2c5282;
        }

        .btn-edit {
            background-color: #f59e0b;
        }

        .btn-delete {
            background-color: #e53e3e;
        }

        .btn-submit {
            background-color: #28a745;
        }

        .action-buttons {
            display: flex;
        }

        /* Gaya untuk Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 8px;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .modal-header h2 {
            margin: 0;
        }

        .close-button {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Gaya untuk Notifikasi */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    @include('admin.sidebar')
    {{-- <div class="sidebar">
        <h2><strong>Admin</strong>Vinskanna</h2>
        <a href="#"><i class="fas fa-home"></i> Beranda</a>
        <a href="{{ route('admin.pesanan') }}" class="active"><i class="fas fa-shopping-cart"></i> Pesanan</a>
        <a href="#"><i class="fas fa-box"></i> Produk</a>
        <a href="#"><i class="fas fa-users"></i> Pengguna</a>
        <a href="#"><i class="fas fa-envelope"></i> Kontak Masuk</a>
    </div> --}}

    <!-- Konten Utama -->
    <div class="main-content">
        <div class="header">
            <div>Manajemen Pesanan</div>
            <i class="fas fa-user profile-icon"></i>
        </div>

        <div class="content">
            <div class="content-header">
                <h2>DAFTAR PESANAN</h2>
                <button class="btn btn-add" onclick="openAddModal()"><i class="fas fa-plus"></i> Tambah Pesanan</button>
            </div>

            <!-- Notifikasi -->
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Pelanggan</th>
                        <th>Tanggal</th>
                        <th>Total Harga</th>
                        <th>Metode Pembayaran</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pesanans as $pesanan)
                        <tr>
                            <td>#{{ $pesanan->id }}</td>
                            <td>{{ $pesanan->nama_pelanggan }}</td>
                            <td>{{ \Carbon\Carbon::parse($pesanan->tanggal_pesan)->format('d-M-Y') }}</td>
                            <td>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                            <td>{{ $pesanan->metode_pembayaran }}</td>
                            <td>
                                @php
                                    $statusClass = '';
                                    if ($pesanan->status == 'Selesai') {
                                        $statusClass = 'badge-selesai';
                                    } elseif ($pesanan->status == 'Pending') {
                                        $statusClass = 'badge-pending';
                                    } else {
                                        $statusClass = 'badge-dibatalkan';
                                    }
                                @endphp
                                <span class="badge {{ $statusClass }}">{{ $pesanan->status }}</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-edit" onclick="openEditModal({{ json_encode($pesanan) }})">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <form action="{{ route('admin.pesanan.destroy', $pesanan->id) }}" method="POST"
                                        onsubmit="return confirm('Anda yakin ingin menghapus pesanan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete"><i class="fas fa-trash"></i>
                                            Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center;">Belum ada data pesanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah Pesanan -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Tambah Pesanan Baru</h2>
                <span class="close-button" onclick="closeModal('addModal')">×</span>
            </div>
            <form action="{{ route('admin.pesanan.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_pelanggan">Nama Pelanggan</label>
                    <input type="text" name="nama_pelanggan" required>
                </div>
                <div class="form-group">
                    <label for="total_harga">Total Harga (Rp)</label>
                    <input type="number" name="total_harga" step="1000" required>
                </div>
                <div class="form-group">
                    <label for="metode_pembayaran">Metode Pembayaran</label>
                    <select name="metode_pembayaran" required>
                        <option value="Transfer Bank">Transfer Bank</option>
                        <option value="Kartu Kredit">Kartu Kredit</option>
                        <option value="PayPal">PayPal</option>
                        <option value="COD">COD (Cash on Delivery)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" required>
                        <option value="Pending">Pending</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Dibatalkan">Dibatalkan</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-submit">Simpan Pesanan</button>
            </form>
        </div>
    </div>

    <!-- Modal Edit Pesanan -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Edit Pesanan</h2>
                <span class="close-button" onclick="closeModal('editModal')">×</span>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="edit_nama_pelanggan">Nama Pelanggan</label>
                    <input type="text" id="edit_nama_pelanggan" name="nama_pelanggan" required>
                </div>
                <div class="form-group">
                    <label for="edit_total_harga">Total Harga (Rp)</label>
                    <input type="number" id="edit_total_harga" name="total_harga" step="1000" required>
                </div>
                <div class="form-group">
                    <label for="edit_metode_pembayaran">Metode Pembayaran</label>
                    <select id="edit_metode_pembayaran" name="metode_pembayaran" required>
                        <option value="Transfer Bank">Transfer Bank</option>
                        <option value="Kartu Kredit">Kartu Kredit</option>
                        <option value="PayPal">PayPal</option>
                        <option value="COD">COD (Cash on Delivery)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="edit_status">Status</label>
                    <select id="edit_status" name="status" required>
                        <option value="Pending">Pending</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Dibatalkan">Dibatalkan</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-submit">Perbarui Pesanan</button>
            </form>
        </div>
    </div>

    <script>
        // Fungsi untuk membuka modal
        function openAddModal() {
            document.getElementById('addModal').style.display = 'block';
        }

        function openEditModal(pesanan) {
            // Set action form
            document.getElementById('editForm').action = `/admin/pesanan/${pesanan.id}`;

            // Isi field form dengan data pesanan
            document.getElementById('edit_nama_pelanggan').value = pesanan.nama_pelanggan;
            document.getElementById('edit_total_harga').value = pesanan.total_harga;
            document.getElementById('edit_metode_pembayaran').value = pesanan.metode_pembayaran;
            document.getElementById('edit_status').value = pesanan.status;

            // Tampilkan modal
            document.getElementById('editModal').style.display = 'block';
        }

        // Fungsi untuk menutup modal
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Tutup modal jika user klik di luar area modal
        window.onclick = function(event) {
            const addModal = document.getElementById('addModal');
            const editModal = document.getElementById('editModal');
            if (event.target == addModal) {
                addModal.style.display = "none";
            }
            if (event.target == editModal) {
                editModal.style.display = "none";
            }
        }
    </script>

</body>

</html>
