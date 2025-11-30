function toggleSidebar() {
    document.getElementById("sidebar").classList.toggle("open");
}

function toggleDropdown(id) {
    const submenu = document.getElementById(id);
    submenu.style.display = submenu.style.display === "block" ? "none" : "block";
}

const API_KATEGORI = "http://jippy-backend.test/api/kategori";

async function loadKategori() {
    try {
        const res = await fetch(API_KATEGORI);
        const data = await res.json();

        const menuContainer = document.querySelector("#sidebar .menu");
        menuContainer.innerHTML = "";

        data.forEach(cat => {
            const li = document.createElement("li");

            li.innerHTML = `
                <div class="menu-title" onclick="toggleDropdown('cat-${cat.id}')">
                    ${cat.name} ▾
                </div>
                <ul class="submenu" id="cat-${cat.id}">
                    ${cat.subcategories.map(s => `
                        <li><a href="#" onclick="loadProduk(null, ${s.id})">${s.name}</a></li>
                    `).join("")}
                    <li><a href="#" onclick="loadProduk(${cat.id}, null)">View All</a></li>
                </ul>
            `;

            menuContainer.appendChild(li);
        });

    } catch (err) {
        console.error("Gagal load kategori:", err);
    }
}
async function loadProdukByCategory(catId) {
    const res = await fetch(`http://jippy-backend.test/api/produk/kategori/${catId}`);
    const data = await res.json();
    renderProduk(data);
}

async function loadProdukBySub(subId) {
    const res = await fetch(`http://jippy-backend.test/api/produk/subkategori/${subId}`);
    const data = await res.json();
    renderProduk(data);
}

function renderProduk(data) {
    const container = document.getElementById("produk-container");
    if (!container) {
        console.error("produk-container tidak ditemukan!");
        return;
    }

    if (data.length === 0) {
        container.innerHTML = `<p class="text-center text-gray-500">No products found.</p>`;
        return;
    }

    container.innerHTML = data
        .map(
            p => `
            <div class="product">
                <img src="${p.image_url}" alt="${p.name}" class="product-image">
                <div class="product-name">${p.name}</div>
                <div class="product-price">IDR ${p.price}</div>
            </div>
        `
        )
        .join("");
}
loadKategori();

