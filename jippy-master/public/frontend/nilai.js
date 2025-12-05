// ===============================================
// KODE FULL NILAI.JS (FINAL: VALIDASI SIZE + ERROR HANDLING)
// ===============================================

// 1. KONFIGURASI API
const API_URL = 'http://127.0.0.1:8000/api/reviews';

// Variabel Global
let reviews = [];
let editingId = null; // Menyimpan ID database saat mode edit

// ===================================
// BAGIAN 1: READ (AMBIL DATA & RENDER)
// ===================================

async function loadReviews() {
    try {
        const response = await fetch(API_URL);
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        reviews = await response.json();
        renderReviews();
        calculateAverageRating(); 
    } catch (error) {
        console.error('Error loading reviews:', error);
        // Tetap render agar kalau kosong muncul state kosong
        renderReviews(); 
    }
}

function renderReviews() {
    const reviewsList = document.getElementById('reviewsList');
    const emptyState = document.getElementById('emptyState');
    
    reviewsList.innerHTML = '';

    if (reviews.length === 0) {
        emptyState.style.display = 'flex';
        return;
    } else {
        emptyState.style.display = 'none';
    }

    reviews.forEach((review, index) => {
        const reviewCard = document.createElement('div');
        reviewCard.className = 'review-card';

        // Tampilkan Gambar (Jika Ada)
        const imageHtml = review.image_url 
            ? `<div class="review-image" style="margin-top: 10px; margin-bottom: 10px;">
                 <img src="${review.image_url}" alt="Review Image" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px; border: 1px solid #eee;">
               </div>` 
            : '';

        reviewCard.innerHTML = `
            <div class="review-header">
                <div class="review-user-date">
                    <span class="review-username">${review.username}</span>
                    <span class="review-date">${review.date}</span>
                </div>
                <div class="review-actions">
                    <button class="btn-small btn-edit" onclick="openEditModal(${index})">Edit</button>
                    <button class="btn-small btn-delete" onclick="deleteReview(${review.id})">Delete</button>
                </div>
            </div>
            
            <div class="review-rating">${'★'.repeat(review.rating)}${'☆'.repeat(5 - review.rating)}</div>
            
            ${imageHtml}

            <div class="review-title">${review.summary}</div>
            
            <div class="review-details">
                <div class="review-detail-item">
                    <span class="review-detail-label">Texture:</span> ${review.texture}
                </div>
                <div class="review-detail-item">
                    <span class="review-detail-label">Expired:</span> ${review.expired}
                </div>
            </div>
        `;
        reviewsList.appendChild(reviewCard);
    });
}

function calculateAverageRating() {
    const avgRatingElem = document.getElementById('avgRating');
    const avgStarsElem = document.getElementById('avgStars');
    const reviewCountElem = document.getElementById('reviewCount');
    
    if (reviews.length === 0) {
        if(avgRatingElem) avgRatingElem.textContent = '0.0';
        if(avgStarsElem) avgStarsElem.textContent = '☆☆☆☆☆';
        if(reviewCountElem) reviewCountElem.textContent = '0 Reviews';
        return;
    }

    const total = reviews.reduce((sum, rev) => sum + rev.rating, 0);
    const avg = (total / reviews.length).toFixed(1);
    
    if(avgRatingElem) avgRatingElem.textContent = avg;
    if(reviewCountElem) reviewCountElem.textContent = `${reviews.length} Reviews`;
    
    const starCount = Math.round(avg);
    if(avgStarsElem) avgStarsElem.textContent = '★'.repeat(starCount) + '☆'.repeat(5 - starCount);
}

// ===================================
// BAGIAN 2: CREATE (UPLOAD DENGAN VALIDASI SIZE)
// ===================================

async function submitNewReview(e) {
    e.preventDefault();
    
    // 1. Ambil Element
    const summary = document.getElementById('summaryInput').value;
    const texture = document.getElementById('textureInput').value;
    const expired = document.getElementById('expiredInput').value;
    const rating = document.getElementById('ratingInput').value;
    const username = document.getElementById('usernameInput').value;
    const fileInput = document.getElementById('fileInput');

    // 2. Validasi Bintang
    if (!rating || rating === "0") {
        alert('Mohon berikan bintang!');
        return;
    }

    // 3. VALIDASI UKURAN FILE (MAX 10MB)
    if (fileInput.files.length > 0) {
        const file = fileInput.files[0];
        const fileSizeInMB = file.size / (1024 * 1024); // Byte ke MB
        
        if (fileSizeInMB > 10) {
            alert(`File terlalu besar! Ukuran file Anda: ${fileSizeInMB.toFixed(2)}MB.\nMaksimum yang diizinkan adalah 10MB.`);
            return; // Stop, jangan kirim ke server
        }
    }

    // 4. SIAPKAN FORM DATA
    const formData = new FormData();
    formData.append('username', username);
    formData.append('rating', rating);
    formData.append('summary', summary);
    formData.append('texture', texture);
    formData.append('expired', expired);

    if (fileInput.files.length > 0) {
        formData.append('image', fileInput.files[0]);
    }

    // 5. Kirim ke Backend
    try {
        const response = await fetch(API_URL, {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json' // Agar error direturn sebagai JSON
            }
        });

        // Cek Response
        if (!response.ok) {
            const errorData = await response.json();
            console.error("Server Error:", errorData);
            
            // Susun pesan error yang enak dibaca user
            let pesan = 'Gagal menyimpan review.';
            if (errorData.message) pesan += `\nInfo: ${errorData.message}`;
            if (errorData.errors && errorData.errors.image) pesan += `\nMasalah File: ${errorData.errors.image[0]}`;
            
            throw new Error(pesan);
        }

        await loadReviews(); 
        closeCreateModal();
        alert('Review Berhasil di Upload!');
        
    } catch (error) {
        console.error('Error:', error);
        alert(error.message); // Tampilkan pesan error detail
    }
}

// ===================================
// BAGIAN 3: UPDATE (EDIT DATA)
// ===================================

function openEditModal(index) {
    const review = reviews[index];
    editingId = review.id; // ID Database

    document.getElementById('editSummaryInput').value = review.summary;
    document.getElementById('editTextureInput').value = review.texture;
    document.getElementById('editExpiredInput').value = review.expired;
    setEditStars(review.rating);
    
    document.getElementById('editModal').classList.add('show');
    document.body.style.overflow = 'hidden';
}

async function submitEditReview(e) {
    e.preventDefault();

    if (!editingId) {
        alert("Error ID tidak ditemukan, silakan refresh.");
        return;
    }

    const updatedRating = parseInt(document.getElementById('editRatingInput').value);
    
    if (!updatedRating || updatedRating === 0) {
        alert('Mohon berikan bintang!');
        return;
    }

    const updateData = {
        rating: updatedRating,
        summary: document.getElementById('editSummaryInput').value,
        texture: document.getElementById('editTextureInput').value,
        expired: document.getElementById('editExpiredInput').value
    };

    try {
        const response = await fetch(`${API_URL}/${editingId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(updateData)
        });

        if (!response.ok) {
            const errorData = await response.json();
            throw new Error(errorData.message || 'Gagal update review');
        }

        await loadReviews();
        closeEditModal();
        alert('Perubahan ulasan berhasil disimpan!');

    } catch (error) {
        console.error('Error:', error);
        alert(error.message);
    }
}

// ===================================
// BAGIAN 4: DELETE
// ===================================

async function deleteReview(id) {
    if (confirm('Apakah Anda yakin ingin menghapus ulasan ini?')) {
        try {
            const response = await fetch(`${API_URL}/${id}`, {
                method: 'DELETE',
                headers: { 'Accept': 'application/json' }
            });

            if (!response.ok) throw new Error('Gagal menghapus');

            await loadReviews();
            alert('Ulasan berhasil dihapus!');
            
        } catch (error) {
            console.error('Error:', error);
            alert('Gagal menghapus ulasan.');
        }
    }
}

// ===================================
// BAGIAN 5: HELPER UI & EVENT LISTENERS
// ===================================

function openCreateModal() {
    document.getElementById('createModal').classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeCreateModal() {
    document.getElementById('createModal').classList.remove('show');
    document.body.style.overflow = 'auto';
    document.getElementById('reviewForm').reset();
    
    // Reset teks upload
    const uploadText = document.querySelector('#uploadArea p');
    if(uploadText) uploadText.textContent = 'Pilih file atau seret file kesini';
    
    resetStarSelection('starSelector');
}

function closeEditModal() {
    document.getElementById('editModal').classList.remove('show');
    document.body.style.overflow = 'auto';
    editingId = null;
}

function resetStarSelection(selectorId) {
    const starBtns = document.getElementById(selectorId).querySelectorAll('.star-btn');
    starBtns.forEach(btn => {
        btn.classList.remove('selected');
        btn.textContent = '☆';
    });
    document.getElementById('ratingInput').value = '';
}

function setEditStars(rating) {
    const selector = document.getElementById('editStarSelector');
    const input = document.getElementById('editRatingInput');
    input.value = rating;

    const starBtns = selector.querySelectorAll('.star-btn');
    starBtns.forEach(btn => {
        const btnRating = parseInt(btn.getAttribute('data-rating'));
        if (btnRating <= rating) {
            btn.classList.add('selected');
            btn.textContent = '★';
        } else {
            btn.classList.remove('selected');
            btn.textContent = '☆';
        }
    });
}

function setupStarListeners(selector, inputId) {
    const starBtns = selector.querySelectorAll('.star-btn');
    starBtns.forEach(button => {
        button.addEventListener('click', () => {
            const ratingValue = parseInt(button.getAttribute('data-rating'));
            document.getElementById(inputId).value = ratingValue;
            
            starBtns.forEach(btn => {
                const btnRating = parseInt(btn.getAttribute('data-rating'));
                btn.textContent = (btnRating <= ratingValue) ? '★' : '☆';
                btn.classList.toggle('selected', btnRating <= ratingValue);
            });
        });
    });
}

// INIT
document.addEventListener('DOMContentLoaded', () => {
    loadReviews();

    const reviewForm = document.getElementById('reviewForm');
    if (reviewForm) reviewForm.addEventListener('submit', submitNewReview);

    const editForm = document.getElementById('editForm');
    if (editForm) editForm.addEventListener('submit', submitEditReview);

    const starSelector = document.getElementById('starSelector');
    if (starSelector) setupStarListeners(starSelector, 'ratingInput');

    const editStarSelector = document.getElementById('editStarSelector');
    if (editStarSelector) setupStarListeners(editStarSelector, 'editRatingInput');

    const summaryInput = document.getElementById('summaryInput');
    const charCount = document.getElementById('charCount');
    if (summaryInput && charCount) {
        summaryInput.addEventListener('input', () => {
            charCount.textContent = `${summaryInput.value.length}/${summaryInput.getAttribute('maxlength')}`;
        });
    }

    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('fileInput');
    if (uploadArea && fileInput) {
        uploadArea.addEventListener('click', () => fileInput.click());
        fileInput.addEventListener('change', () => {
            const fileName = fileInput.files.length > 0 
                ? `File: ${fileInput.files[0].name}` 
                : 'Pilih file atau seret file kesini';
            // Pastikan kita hanya ubah teks paragraf pertama agar info (Max 10MB) tidak hilang
            const pFirst = uploadArea.querySelector('p'); 
            if(pFirst) pFirst.textContent = fileName;
        });
    }

    // Filter Sederhana
    const filterButtons = document.querySelectorAll('.filter-btn');
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            
            const filterValue = button.getAttribute('data-filter');
            const reviewCards = document.querySelectorAll('.review-card');
            
            reviewCards.forEach(card => {
                const ratingText = card.querySelector('.review-rating').textContent;
                const starCount = (ratingText.match(/★/g) || []).length;
                if (filterValue === 'all' || starCount == filterValue) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});