<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kamar Hotel - RETELL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,600&family=joan:400&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f1f5f9;
            color: #334155;
        }
        .font-joan {
            font-family: 'Joan', serif;
        }
        .btn-retell-primary {
            background: linear-gradient(135deg, #0f766e 0%, #134e4a 100%);
            color: white;
            padding: 0.875rem 1.75rem;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.4s cubic-bezier(0.22, 0.61, 0.36, 1);
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 16px rgba(15, 118, 110, 0.2);
            text-decoration: none;
            font-size: 0.95rem;
            letter-spacing: 0.25px;
        }
        .btn-retell-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(15, 118, 110, 0.35);
        }
        .btn-retell-primary:active {
            transform: translateY(-1px);
        }
        .btn-secondary {
            background: white;
            color: #0f766e;
            padding: 0.875rem 1.75rem;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.4s cubic-bezier(0.22, 0.61, 0.36, 1);
            border: 2px solid #0f766e;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-shadow: 0 2px 8px rgba(15, 118, 110, 0.1);
        }
        .btn-secondary:hover {
            background: #0f766e;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 4px 16px rgba(15, 118, 110, 0.2);
        }
        .btn-secondary:active {
            transform: translateY(-1px);
        }
        .room-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.07);
            transition: all 0.4s cubic-bezier(0.22, 0.61, 0.36, 1);
            border: 1px solid #e2e8f0;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .room-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.12);
        }
        .room-image-container {
            position: relative;
            overflow: hidden;
        }
        .room-image {
            width: 100%;
            height: 240px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .room-card:hover .room-image {
            transform: scale(1.05);
        }
        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.5), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .room-card:hover .image-overlay {
            opacity: 1;
        }
        .room-content {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .room-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }
        .room-title {
            font-size: 1.35rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
            line-height: 1.3;
        }
        .price-container {
            text-align: right;
        }
        .price-tag {
            color: #0f766e;
            font-weight: 800;
            font-size: 1.5rem;
            line-height: 1.2;
        }
        .price-period {
            font-size: 0.75rem;
            color: #64748b;
            font-weight: 500;
        }
        .room-description {
            color: #64748b;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            flex-grow: 1;
        }
        .room-features {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        .feature-item {
            display: flex;
            align-items: center;
            font-size: 0.85rem;
            color: #47569;
        }
        .feature-item i {
            color: #0f766e;
            margin-right: 0.5rem;
            font-size: 0.9rem;
        }
        .book-button-container {
            margin-top: auto;
        }
        .hero-section {
            background: linear-gradient(135deg, #0f766e 0%, #134e4a 100%);
            color: white;
            padding: 4rem 2rem;
            text-align: center;
        }
        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            letter-spacing: -0.5px;
        }
        .hero-subtitle {
            font-size: 1.25rem;
            opacity: 0.95;
            max-width: 600px;
            margin: 0 auto;
        }
        .stagger-animation {
            opacity: 0;
            transform: translateY(30px);
            animation: slideUp 0.8s cubic-bezier(0.22, 0.61, 0.36, 1) forwards;
        }
        .facility-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 12px;
            border-left: 4px solid #0f766e;
            transition: all 0.3s cubic-bezier(0.22, 0.61, 0.36, 1);
            margin-bottom: 0.75rem;
        }
        .facility-item:last-child {
            margin-bottom: 0;
        }
        .facility-item:hover {
            background: #f1f5f9;
            transform: translateX(6px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        .facility-item i {
            color: #0f766e;
            margin-right: 1rem;
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
        }
        .facility-item span {
            font-weight: 500;
            color: #334155;
        }
        #facilitiesModal {
            transition: opacity 0.4s cubic-bezier(0.22, 0.61, 0.36, 1);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }
        #modalContent {
            transition: all 0.4s cubic-bezier(0.22, 0.61, 0.36, 1);
            transform: scale(0.9);
            opacity: 0;
        }
        #facilitiesModal.show {
            opacity: 1;
        }
        #facilitiesModal.show #modalContent {
            transform: scale(1);
            opacity: 1;
        }
        .modal-show {
            display: flex !important;
        }
        .modal-header {
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e2e8f0;
        }
        .modal-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0 0.5rem 0;
        }
        .modal-subtitle {
            font-size: 0.95rem;
            color: #64748b;
            margin: 0;
        }
        .close-button {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #f1f5f9;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #64748b;
        }
        .close-button:hover {
            background: #e2e8f0;
            color: #0f766e;
            transform: rotate(90deg);
        }
        .facilities-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            max-height: 400px;
            overflow-y: auto;
            padding-right: 0.5rem;
        }
        .facilities-grid::-webkit-scrollbar {
            width: 6px;
        }
        .facilities-grid::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 3px;
        }
        .facilities-grid::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        .facilities-grid::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        /* Loading indicator */
        .loading-spinner {
            border-top-color: #0f766e;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        /* Smooth transitions */
        .fade-in {
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }
        .fade-in.loaded {
            opacity: 1;
        }
        /* Responsive improvements */
        @media (max-width: 768px) {
            .hero-section {
                padding: 2.5rem 1.5rem;
            }
            .hero-title {
                font-size: 2rem;
            }
            .hero-subtitle {
                font-size: 1.1rem;
            }
            .room-grid {
                grid-template-columns: 1fr;
            }
            .room-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            .price-container {
                text-align: left;
            }
            .facilities-grid {
                grid-template-columns: 1fr;
            }
        }
        @media (max-width: 480px) {
            .hero-title {
                font-size: 1.75rem;
            }
            .room-content {
                padding: 1.25rem;
            }
            .room-title {
                font-size: 1.25rem;
            }
            .price-tag {
                font-size: 1.25rem;
            }
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-4xl font-bold mb-3 font-joan">Pilih Kamar Ternyaman</h1>
            <p class="text-xl opacity-90">{{ $hotel->nama_hotel }} - {{ $hotel->kota->nama_kota }}</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-6 py-12">
        <!-- Room Cards Grid -->
        <div class="grid md:grid-cols-3 gap-8" id="roomGrid">
            <!-- Loading indicator -->
            <div class="col-span-3 hidden" id="loadingIndicator">
                <div class="flex justify-center items-center py-12">
                    <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-teal-500"></div>
                    <span class="ml-3 text-lg text-gray-600">Memuat kamar...</span>
                </div>
            </div>
            
            @foreach ( $kamars as $kamar )
            <div class="room-card stagger-animation cursor-pointer" data-room-name="{{ ucfirst($kamar->detailKamar->tipe_kamar) }} Room"
     data-room-type="{{ $kamar->detailKamar->tipe_kamar }}"
     data-facilities='@json(explode(",", $kamar->detailKamar->fasilitas))'
     data-price='{{ $kamar->harga_per_malam }}' style="animation-delay: 0.1s">
                <div class="room-image-container">
                    <img src="{{ $kamar->kamarImages->first() ? $kamar->kamarImages->first()->image_url : 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" alt="{{ ucfirst($kamar->detailKamar->tipe_kamar) }} Room" class="room-image h-72">
                    <div class="image-overlay"></div>
                </div>
                <div class="room-content">
                    <div class="room-header">
                        <h3 class="room-title">{{ ucfirst($kamar->detailKamar->tipe_kamar) . " Room" }}</h3>
                        <div class="price-container">
                            <div class="price-tag">{{ "Rp " . number_format($kamar->harga_per_malam,0, ",", ".") }}</div>
                            <p class="price-period">per malam</p>
                        </div>
                    </div>
                    
                    <p class="room-description">
                        {{ $kamar->detailKamar->deskripsi }}
                    </p>

                    <div class="room-features">
                        <div class="feature-item">
                            <i class="fas fa-user"></i>
                            <span>{{ $kamar->detailKamar->kapasitas }} Orang</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-bed"></i>
                            <span>{{ $kamar->detailKamar->jumlah_kasur }} Kasur</span>
                        </div>
                        <div class="feature-item">
                            <i class="fa-solid fa-building"></i>
                            <span>Lantai {{ $kamar->lantai }}</span>
                        </div>
                    </div>

                    <div class="book-button-container">
                        <a href="{{ route('guest.booking.form', [
                            'detail_id' => $kamar->detail_id,
                            'hotel_id' => $kamar->id_hotel,
                            'check_in' => request('check_in', now()->addDay()->format('Y-m-d')),
                            'check_out' => request('check_out', now()->addDays(2)->format('Y-m-d')),
                            'guests' => request('guests', 2),
                            'rooms' => 1
                        ]) }}" class="btn-retell-primary w-full block text-center">
                            Book Now
                        </a>
                    </div>
                </div>
            </div>
               @endforeach
        </div>
    </div>

   <!-- Modal Overlay -->
<div id="facilitiesModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <!-- Modal Content -->
    <div class="bg-white rounded-2xl p-8 max-w-lg w-full mx-4 relative transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
        <!-- Close Button -->
        <button id="closeModal" class="close-button">
            <i class="fas fa-times"></i>
        </button>
        
        <!-- Modal Header -->
        <div class="modal-header">
            <h3 class="modal-title" id="modalRoomTitle">Fasilitas Kamar</h3>
            <p class="modal-subtitle" id="modalRoomType"></p>
        </div>
        
        <!-- Facilities List -->
        <div class="facilities-grid" id="facilitiesList">
            <!-- Facilities akan muncul di sini -->
        </div>
    </div>
</div>


    <script>
        // Add click functionality to Book Now buttons
        // document.querySelectorAll('.btn-retell-primary').forEach(btn => {
        //     btn.addEventListener('click', function() {
        //         const roomName = this.closest('.room-card').querySelector('h3').textContent;
        //         const roomPrice = this.closest('.room-card').querySelector('.price-tag').textContent;
        //         alert(`Memulai pemesanan untuk ${roomName}\nHarga: ${roomPrice} per malam`);
        //     });
        // });

        // Staggered animation on load
        window.addEventListener('load', function() {
            const cards = document.querySelectorAll('.stagger-animation');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.animationDelay = `${index * 0.1}s`;
                }, 100);
            });
        });
    </script>

   <script>
// Modal elements
const modal = document.getElementById('facilitiesModal');
const modalContent = document.getElementById('modalContent');
const closeModal = document.getElementById('closeModal');
const modalRoomTitle = document.getElementById('modalRoomTitle');
const modalRoomType = document.getElementById('modalRoomType');
const facilitiesList = document.getElementById('facilitiesList');

// Fungsi untuk menampilkan modal
function showFacilitiesModal(roomName, roomType, facilities, price) {
    modalRoomTitle.textContent = `Fasilitas ${roomName}`;
    modalRoomType.textContent = "Berikut adalah fasilitas untuk kamar ini:";

    facilitiesList.innerHTML = '';
    if (facilities && facilities.length > 0) {
        facilities.forEach(facility => {
            const facilityItem = document.createElement('div');
            facilityItem.className = 'facility-item';
            facilityItem.innerHTML = `<i class="fas fa-check-circle"></i><span class="text-gray-700 font-medium">${facility}</span>`;
            facilitiesList.appendChild(facilityItem);
        });
    } else {
        facilitiesList.innerHTML = '<div class="text-gray-500 text-center py-4">Tidak ada fasilitas tersedia</div>';
    }

    // Show modal with proper animation
    modal.classList.remove('hidden');
    
    // Force reflow untuk memastikan hidden class hilang dulu
    modal.offsetHeight;
    
    // Baru tambahkan class show
    modal.classList.add('show');
}

// Fungsi untuk menutup modal
function hideFacilitiesModal() {
    modal.classList.remove('show');
    
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300); // sesuai dengan duration CSS transition
}

// Event listeners
closeModal.addEventListener('click', hideFacilitiesModal);
modal.addEventListener('click', e => {
    if (e.target === modal) hideFacilitiesModal();
});
document.addEventListener('keydown', e => {
    if (e.key === 'Escape' && !modal.classList.contains('hidden')) hideFacilitiesModal();
});

// Hanya klik card yang trigger modal
document.querySelectorAll('.room-card').forEach(card => {
    card.addEventListener('click', () => {
        const roomName = card.dataset.roomName;
        const roomType = card.dataset.roomType;
        const facilities = JSON.parse(card.dataset.facilities);
        const price = "Rp " + Number(card.dataset.price).toLocaleString('id-ID');
        showFacilitiesModal(roomName, roomType, facilities, price);
    });
});

</script>

    <script>
        // Add loading states and transitions
        document.addEventListener('DOMContentLoaded', function() {
            // Show loading indicator while page loads
            const loadingIndicator = document.getElementById('loadingIndicator');
            const roomGrid = document.getElementById('roomGrid');
            
            // Simulate loading delay for demonstration
            window.addEventListener('load', function() {
                // In a real application, you would hide the loading indicator
                // when the data is actually loaded
                setTimeout(function() {
                    if (loadingIndicator) {
                        loadingIndicator.classList.add('hidden');
                    }
                    if (roomGrid) {
                        roomGrid.classList.add('fade-in', 'loaded');
                    }
                }, 500);
            });
            
            // Add click effect to room cards
            const roomCards = document.querySelectorAll('.room-card');
            roomCards.forEach(card => {
                card.addEventListener('mousedown', function() {
                    this.style.transform = 'scale(0.98)';
                    this.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.1)';
                });
                
                card.addEventListener('mouseup', function() {
                    this.style.transform = '';
                    this.style.boxShadow = '';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = '';
                    this.style.boxShadow = '';
                });
            });
        });
    </script>

</body>

</html>