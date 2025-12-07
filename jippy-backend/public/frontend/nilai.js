//Ambil transaction ID dari URL
const urlParams = new URLSearchParams(window.location.search);
const transactionId = urlParams.get("transaction_id");

//API
const API_LIST        = "http://127.0.0.1:8000/api/review/list";
const API_STORE       = "http://127.0.0.1:8000/api/review/store";
const API_UPDATE      = "http://127.0.0.1:8000/api/review/";
const API_DELETE      = "http://127.0.0.1:8000/api/review/";
const API_TRANSACTION = "http://127.0.0.1:8000/api/transaction/";

let reviews = [];
let editingId = null;

//TOAST
function showToast(message) {
    const t = document.createElement("div");
    t.className = "toast";
    t.textContent = message;
    document.body.appendChild(t);

    setTimeout(() => t.classList.add("show"), 50);
    setTimeout(() => {
        t.classList.remove("show");
        setTimeout(() => t.remove(), 300);
    }, 2000);
}
//LOAD PRODUCT INFO
async function loadProductInfo() {
    try {
        const res = await fetch(API_TRANSACTION + transactionId);
        const data = await res.json();

        if (!data || !data.product) return;

        document.getElementById("productTitle").textContent =
            "Nilai - " + data.product.name;

        document.getElementById("productImage").src =
            `http://127.0.0.1:8000/uploads/products/${data.product.image}`;

    } catch (err) {
        console.error("Gagal load product:", err);
    }
}
// LOAD REVIEWS
async function loadReviews() {
    const res = await fetch(API_LIST);
    const all = await res.json();

    reviews = all.filter(r => r.transaction_id == transactionId);

    calculateAverageRating();
    applyFilter();
}

//DEFAULT RENDER REVIEW LIST
function renderReviewsForFilter(list) {
    const container = document.getElementById("reviewsList");
    const empty = document.getElementById("emptyState");

    container.innerHTML = "";

    if (list.length === 0) {
        empty.style.display = "flex";
        return;
    }
    empty.style.display = "none";

    list.forEach((r, index) => {
        let img = r.image_path
            ? `<img src="http://127.0.0.1:8000/storage/${r.image_path}" 
                 style="width:100px;height:100px;border-radius:8px;margin:10px 0;">`
            : "";

        container.innerHTML += `
            <div class="review-card">
                <div class="review-header">
                    <div>
                        <span class="review-username">${r.username}</span>
                        <span class="review-date">${r.date}</span>
                    </div>

                    <div>
                        <button class="btn-small btn-edit" onclick="openEditModal(${reviews.indexOf(r)})">Edit</button>
                        <button class="btn-small btn-delete" onclick="deleteReview(${r.id})">Delete</button>
                    </div>
                </div>

                <div class="review-rating">
                    ${"★".repeat(r.rating)}${"☆".repeat(5 - r.rating)}
                </div>

                ${img}

                <div class="review-title">${r.summary}</div>

                <div class="review-details">
                    <p><strong>Texture:</strong> ${r.texture}</p>
                    <p><strong>Expired:</strong> ${r.expired}</p>
                </div>
            </div>
        `;
    });
}

//FILTER SYSTEM (DITAMBAHKAN — TIDAK MENGGANGGU KODE LAIN)
function applyFilter() {
    const activeBtn = document.querySelector(".filter-btn.active");
    if (!activeBtn) return;

    const filterValue = activeBtn.dataset.filter;

    const filtered = (filterValue === "all")
        ? reviews
        : reviews.filter(r => r.rating == filterValue);

    renderReviewsForFilter(filtered);
}

//AVERAGE RATING
function calculateAverageRating() {
    const avgElem = document.getElementById("avgRating");
    const starsElem = document.getElementById("avgStars");
    const countElem = document.getElementById("reviewCount");

    if (reviews.length === 0) {
        avgElem.textContent = "0.0";
        starsElem.textContent = "☆☆☆☆☆";
        countElem.textContent = "0 Reviews";
        return;
    }

    const total = reviews.reduce((a, r) => a + r.rating, 0);
    const avg = (total / reviews.length).toFixed(1);

    avgElem.textContent = avg;
    countElem.textContent = `${reviews.length} Reviews`;

    const rounded = Math.round(avg);
    starsElem.textContent = "★".repeat(rounded) + "☆".repeat(5 - rounded);
}

//CREATE REVIEW
async function submitNewReview(e) {
    e.preventDefault();

    const formData = new FormData();
    formData.append("transaction_id", transactionId);
    formData.append("username", document.getElementById("usernameInput").value);
    formData.append("rating", document.getElementById("ratingInput").value);
    formData.append("summary", document.getElementById("summaryInput").value);
    formData.append("texture", document.getElementById("textureInput").value);
    formData.append("expired", document.getElementById("expiredInput").value);

    const file = document.getElementById("fileInput").files[0];
    if (file) formData.append("image", file);

    await fetch(API_STORE, { method: "POST", body: formData });

    closeCreateModal();
    loadReviews();
    showToast("Review berhasil ditambahkan!");
}

//OPEN EDIT MODAL
function openEditModal(index) {
    const r = reviews[index];
    editingId = r.id;

    document.getElementById("editSummaryInput").value = r.summary;
    document.getElementById("editTextureInput").value = r.texture;
    document.getElementById("editExpiredInput").value = r.expired;
    document.getElementById("editRatingInput").value = r.rating;

    setEditStars(r.rating);

    document.getElementById("editModal").classList.add("show");
}

//SUBMIT EDIT
async function submitEditReview(e) {
    e.preventDefault();

    const data = {
        rating: document.getElementById("editRatingInput").value,
        summary: document.getElementById("editSummaryInput").value,
        texture: document.getElementById("editTextureInput").value,
        expired: document.getElementById("editExpiredInput").value,
    };

    await fetch(API_UPDATE + editingId, {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data),
    });

    closeEditModal();
    loadReviews();
    showToast("Review berhasil diperbarui!");
}

//DELETE REVIEW + CONFIRM
async function deleteReview(id) {
    if (!confirm("Yakin ingin menghapus review ini?")) return;

    await fetch(API_DELETE + id, { method: "DELETE" });
    loadReviews();
    showToast("Review berhasil dihapus!");
}

//STAR SELECTOR — CREATE
document.addEventListener("DOMContentLoaded", () => {
    const stars = document.querySelectorAll("#starSelector .star-btn");

    stars.forEach(btn => {
        btn.addEventListener("click", () => {
            const val = btn.dataset.rating;
            document.getElementById("ratingInput").value = val;

            stars.forEach(s => {
                if (s.dataset.rating <= val) {
                    s.textContent = "★";
                    s.classList.add("active");
                } else {
                    s.textContent = "☆";
                    s.classList.remove("active");
                }
            });
        });
    });
});

//STAR SELECTOR — EDIT
function setEditStars(current) {
    const stars = document.querySelectorAll("#editStarSelector .star-btn");

    stars.forEach(s => {
        s.textContent = s.dataset.rating <= current ? "★" : "☆";
        s.classList.toggle("active", s.dataset.rating <= current);
    });

    stars.forEach(btn => {
        btn.addEventListener("click", () => {
            const val = btn.dataset.rating;
            document.getElementById("editRatingInput").value = val;

            stars.forEach(s => {
                if (s.dataset.rating <= val) {
                    s.textContent = "★";
                    s.classList.add("active");
                } else {
                    s.textContent = "☆";
                    s.classList.remove("active");
                }
            });
        });
    });
}

// OPEN CREATE MODAL
function openCreateModal() {
    document.getElementById("reviewForm").reset();

    document.querySelectorAll("#starSelector .star-btn").forEach(s => {
        s.classList.remove("active");
        s.textContent = "☆";
    });

    document.getElementById("ratingInput").value = 0;
    document.getElementById("charCount").textContent = "0/100";

    document.getElementById("previewContainer").style.display = "none";
    document.getElementById("uploadBox").style.display = "block";
    document.getElementById("fileInput").value = "";

    document.getElementById("createModal").classList.add("show");
}

//CLOSE MODAL
function closeCreateModal() {
    document.getElementById("createModal").classList.remove("show");
}

function closeEditModal() {
    document.getElementById("editModal").classList.remove("show");
}

//TEXT COUNTER
document.getElementById("summaryInput").addEventListener("input", (e) => {
    document.getElementById("charCount").textContent = `${e.target.value.length}/100`;
});

// PREVIEW GAMBAR
document.getElementById("fileInput").addEventListener("change", function() {
    const file = this.files[0];
    if (!file) return;

    const previewImage = document.getElementById("previewImage");
    const previewContainer = document.getElementById("previewContainer");
    const uploadBox = document.getElementById("uploadBox");

    previewImage.src = URL.createObjectURL(file);
    previewContainer.style.display = "block";
    uploadBox.style.display = "none";
});

//FILTER BUTTON HANDLER (DITAMBAHKAN)
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".filter-btn").forEach(btn => {
        btn.addEventListener("click", () => {

            document.querySelectorAll(".filter-btn").forEach(b =>
                b.classList.remove("active")
            );

            btn.classList.add("active");
            applyFilter();
        });
    });
});

//INIT
document.addEventListener("DOMContentLoaded", () => {
    loadProductInfo();
    loadReviews();

    document.getElementById("reviewForm").addEventListener("submit", submitNewReview);
    document.getElementById("editForm").addEventListener("submit", submitEditReview);
});
