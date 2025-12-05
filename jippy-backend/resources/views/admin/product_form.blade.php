<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>JIPPY Admin - Tambah/Edit Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-50">

<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto flex items-center justify-between p-4">

        <div class="flex items-center gap-4">
            <img src="/frontend/assets/LOGO.png" alt="Jippy" class="w-[64px] h-[64px]">
            <h2 class="text-xl font-bold text-gray-700">JIPPY Admin</h2>
        </div>

        <nav class="flex gap-8 items-center">
            <a href="http://127.0.0.1:8000/admin/preorder" class="text-black font-medium hover:bg-[#fff2c9] px-4 py-1 rounded-lg transition">
                Dashboard
            </a>

            <a href="http://127.0.0.1:8000/admin/product/add"
               class="bg-[#FDE7A1] px-4 py-1 rounded-lg font-medium border border-black">
                Tambah Produk
            </a>

            <a href="http://127.0.0.1:8000/admin/orders#"
               class="text-black font-medium hover:bg-[#fff2c9] px-4 py-1 rounded-lg transition">
                Daftar Pesanan
            </a>
        </nav>
        
        <div class="flex gap-4 items-center">
            <img src="/frontend/assets/notif.png" class="w-[22px]">
            <img src="/frontend/assets/profil.png" class="w-[24px]">
        </div>

    </div>
</header>


<div class="max-w-6xl mx-auto mt-10 bg-red-100 text-red-600 p-4 rounded-lg font-semibold">
    {{ isset($id) ? 'Edit Produk' : 'Tambah Produk Baru' }}
</div>


<form id="productForm" class="max-w-6xl mx-auto mt-6 grid grid-cols-1 lg:grid-cols-3 gap-6">

    <div class="lg:col-span-2 space-y-6">

        <div class="bg-white rounded-xl p-6 shadow">
            <h3 class="text-lg font-semibold mb-4">Informasi Produk</h3>

            <label class="block mt-2 mb-2 font-medium">Nama Produk</label>
            <input id="name" class="w-full p-3 border rounded-lg" placeholder="Masukkan nama produk">

            <label class="block mt-4 mb-2 font-medium">Deskripsi Detail</label>
            <textarea id="description" class="w-full p-3 border rounded-lg h-28" placeholder="Masukkan deskripsi produk"></textarea>
        </div>

        <div class="bg-white rounded-xl p-6 shadow">
            <h3 class="text-lg font-semibold mb-4">Kategori & Variasi</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="font-medium">Kategori</label>
                    <select id="category" class="w-full p-3 border rounded-lg mt-2">
                        <option value="">Pilih kategori</option>
                        <option value="Korean Beauty">Korean Beauty</option>
                        <option value="Korean Fashion">Korean Fashion</option>
                        <option value="Korean Food">Korean Food</option>
                        <option value="KPOP Merchandise">KPOP Merchandise</option>
                    </select>
                </div>
            </div>

            <label class="block mt-6 font-medium">Variasi</label>
            <div class="flex gap-3 mt-2">
                <input id="sizes" class="p-3 border w-1/2 rounded-lg" placeholder="Contoh: Ukuran, Warna, dll">
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow">
            <h3 class="text-lg font-semibold mb-4">Foto Produk</h3>

            <div class="border-2 border-dashed rounded-xl p-6 text-center hover:bg-gray-50 transition relative">

                <div id="imagePreview" class="flex justify-center mb-4"></div>

                <div id="uploadInfo">
                    <div class="text-5xl text-gray-300 mb-3">☁️</div>
                    <p class="text-gray-600 font-medium">Unggah Foto Produk</p>
                    <p class="text-sm text-gray-400 mb-4">Klik tombol di bawah</p>
                </div>

                <input 
                    type="file"
                    id="productImage"
                    accept="image/*"
                    class="hidden"
                    onchange="previewImage(event)"
                >

                <button 
                    type="button"
                    id="chooseBtn"
                    class="mt-3 px-4 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600"
                    onclick="document.getElementById('productImage').click()">
                    + Pilih Gambar
                </button>

            </div>
        </div>

    </div>

    <div class="space-y-6">

        <div class="bg-white rounded-xl p-6 shadow">
            <h3 class="text-lg font-semibold mb-3">Harga & Batas PO</h3>

            <label class="block mb-2 font-medium">Harga Produk</label>
            <input id="price" type="number" class="w-full p-3 border rounded-lg" placeholder="Rp 0">

            <label class="block mt-4 mb-2 font-medium">Tanggal Tutup PO</label>
            <input id="close_po" type="date" class="w-full p-3 border rounded-lg">
        </div>

        <div class="flex justify-end gap-3">
            <a href="/admin/preorder" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg">Batal</a>
            <button type="submit" class="px-4 py-2 bg-pink-500 text-white rounded-lg">Simpan Produk</button>
        </div>

    </div>

</form>



<script>

const api = "/api/preorder";
const productId = "{{ $id ?? '' }}";

if (productId) {
    fetch(`${api}/${productId}`)
        .then(res => res.json())
        .then(data => {

            document.getElementById("name").value = data.name ?? "";
            document.getElementById("description").value = data.description ?? "";
            document.getElementById("category").value = data.category ?? "";
            document.getElementById("sizes").value = data.sizes ?? "";
            document.getElementById("price").value = data.price ?? "";

            document.getElementById("close_po").value = data.close_po_date ?? "";

            if (data.image) {
                const preview = document.getElementById("imagePreview");
                preview.innerHTML = `
                    <img src="/uploads/products/${data.image}" class="w-40 h-40 object-cover rounded-md border shadow">
                `;
                document.getElementById("uploadInfo").style.display = "none";
                document.getElementById("chooseBtn").style.display = "none";
            }
        })
        .catch(err => console.error("AUTO-FILL ERROR:", err));
}

document.getElementById("productForm").addEventListener("submit", async function(e) {
    e.preventDefault();

    let formData = new FormData();
    formData.append("name", document.getElementById("name").value);
    formData.append("description", document.getElementById("description").value);
    formData.append("category", document.getElementById("category").value);
    formData.append("sizes", document.getElementById("sizes").value);
    formData.append("price", document.getElementById("price").value);
    formData.append("close_po_date", document.getElementById("close_po").value);

    const file = document.getElementById("productImage").files[0];
    if (file) formData.append("image", file);

    let url = api;
    if (productId) {
        url = `${api}/${productId}`;
        formData.append("_method", "PUT");
    }

    const res = await fetch(url, { method: "POST", body: formData });

    if (!res.ok) {
        const text = await res.text();
        console.error("RESPONSE ERROR:", text);
        Swal.fire("Gagal!", "Cek konsol untuk detail error.", "error");
        return;
    }

    const json = await res.json();

    if (json.success) {
        Swal.fire("Berhasil!", "Produk berhasil disimpan!", "success");
        setTimeout(() => window.location.href = "/admin/preorder", 1200);
    } else {
        Swal.fire("Gagal!", "Terjadi kesalahan menyimpan produk!", "error");
    }
});
</script>


