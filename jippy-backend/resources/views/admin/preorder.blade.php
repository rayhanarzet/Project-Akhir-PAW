<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JIPPY Admin - Preorder List</title>
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
            <a href="http://127.0.0.1:8000/admin/preorder" class="bg-[#FDE7A1] px-4 py-1 rounded-lg font-medium border border-black">
                Dashboard
            </a>

            <a href="http://127.0.0.1:8000/admin/product/add"
               class="text-black font-medium hover:bg-[#fff2c9] px-4 py-1 rounded-lg transition">
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

<div class="max-w-6xl mx-auto mt-10 flex justify-between items-center">
    <h1 class="text-2xl font-bold">Pre-Order Products</h1>

    <button onclick="window.location='/admin/product/add'"
            class="px-5 py-2 bg-pink-500 hover:bg-pink-600 text-white rounded-lg shadow">
        + Add Product
    </button>
</div>

<div class="max-w-6xl mx-auto mt-6">
    <div class="bg-white shadow rounded-xl overflow-hidden">

        <table class="w-full text-left">
            <thead class="bg-gray-100 text-gray-700 uppercase text-sm border-b">
                <tr>
                    <th class="p-4">Product</th>
                    <th class="p-4">Category</th>
                    <th class="p-4">Price</th>
                    <th class="p-4">PO Close</th>
                    <th class="p-4 text-center">Actions</th>
                </tr>
            </thead>

            <tbody id="tableBody" class="text-gray-700">
                <tr>
                    <td colspan="5" class="text-center py-6">Loading data...</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<script>
    const api = "/api/preorder";

    async function loadData() {
        const res = await fetch(api);
        const data = await res.json();

        const body = document.getElementById("tableBody");
        body.innerHTML = "";

        if (data.length === 0) {
            body.innerHTML = `
                <tr><td colspan="5" class="text-center py-6 text-gray-500">
                    No products yet. Click "Add Product" to create one.
                </td></tr>`;
            return;
        }

        data.forEach(item => {
            body.innerHTML += `
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-4 font-medium">${item.name}</td>
                    <td class="p-4">${item.category}</td>
                    <td class="p-4">Rp ${item.price.toLocaleString()}</td>
                    <td class="p-4">${item.close_po_date}</td>

                    <td class="p-4 text-center">
                        <button onclick="editProduct(${item.id})"
                            class="px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-white rounded">
                            Edit
                        </button>

                        <button onclick="deleteProduct(${item.id})"
                            class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded">
                            Delete
                        </button>
                    </td>
                </tr>
            `;
        });
    }
    loadData();


    function editProduct(id) {
        window.location = `/admin/preorder/${id}/edit`;
    }


    function deleteProduct(id) {
        Swal.fire({
            title: "Hapus Produk?",
            text: "Tindakan ini tidak dapat dibatalkan",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#e11d48",
            cancelButtonColor: "#6b7280",
            confirmButtonText: "Ya, hapus"
        }).then(async (result) => {
            if (result.isConfirmed) {
                await fetch(`${api}/${id}`, { method: "DELETE" });

                Swal.fire("Terhapus!", "Produk sudah terhapus.", "success");
                loadData();
            }
        });
    }

</script>

</body>
</html>
