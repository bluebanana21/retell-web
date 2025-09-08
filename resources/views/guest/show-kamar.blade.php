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
            background: #f8fafc;
        }
        .font-joan {
            font-family: 'Joan', serif;
        }
        .btn-retell-primary {
            background: linear-gradient(135deg, #0f766e 0%, #134e4a 100%);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(15, 118, 110, 0.25);
            text-decoration: none;
            font-size: 0.875rem;
        }
        .btn-retell-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(15, 118, 110, 0.35);
        }
        .btn-secondary {
            background: white;
            color: #0f766e;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid #0f766e;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }
        .btn-secondary:hover {
            background: #0f766e;
            color: white;
            transform: translateY(-2px);
        }
        .room-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
            cursor: pointer;
        }
        .room-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }
        .room-image {
            width: 100%;
            height: 240px;
            object-fit: cover;
        }
        .hero-section {
            background: linear-gradient(135deg, #0f766e 0%, #134e4a 100%);
            color: white;
            padding: 3rem 2rem;
            text-align: center;
        }
        .price-tag {
            color: #0f766e;
            font-weight: 700;
            font-size: 1.25rem;
        }
        .icon-feature {
            display: inline-flex;
            align-items: center;
            color: #6b7280;
            font-size: 0.875rem;
            margin-right: 1.5rem;
        }
        .icon-feature i {
            margin-right: 0.5rem;
            color: #0f766e;
        }
        .stagger-animation {
            opacity: 0;
            transform: translateY(30px);
            animation: slideUp 0.8s ease forwards;
        }
      .facility-item {
    display: flex;
    align-items: center;
    padding: 0.75rem;
    background: #f8fafc;
    border-radius: 8px;
    border-left: 3px solid #0f766e;
    transition: all 0.2s ease;
}

.facility-item:hover {
    background: #f1f5f9;
    transform: translateX(4px);
}

.facility-item i {
    color: #0f766e;
    margin-right: 0.75rem;
    font-size: 1.1rem;
    width: 20px;
    text-align: center;
}

#facilitiesModal {
    transition: opacity 0.3s ease;
}

#modalContent {
    transition: all 0.3s ease;
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
        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
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
        <div class="grid md:grid-cols-3 gap-8">
            @foreach ( $kamars as $kamar )
            <div class="room-card stagger-animation cursor-pointer" data-room-name="{{ ucfirst($kamar->detailKamar->tipe_kamar) }} Room"
     data-room-type="{{ $kamar->detailKamar->tipe_kamar }}"
     data-facilities='@json(explode(",", $kamar->detailKamar->fasilitas))'
     data-price='{{ $kamar->harga_per_malam }}' style="animation-delay: 0.1s">
                <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="The Classic Twin" class="room-image">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-xl font-bold text-gray-800">{{ ucfirst($kamar->detailKamar->tipe_kamar) . " Room" }}</h3>
                        <div class="text-right">
                            <div class="price-tag">{{ "Rp " . number_format($kamar->harga_per_malam,0, ",", ".") }}</div>
                            <p class="text-sm text-gray-500">per malam</p>
                        </div>
                    </div>
                    
                    <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                        {{ $kamar->detailKamar->deskripsi }}
                    </p>

                    <div class="mb-4">
                        <div class="icon-feature">
                            <i class="fas fa-user"></i>
                            {{ $kamar->detailKamar->kapasitas }} Orang
                        </div>
                        <div class="icon-feature">
                            <i class="fas fa-bed"></i>
                            {{ $kamar->detailKamar->jumlah_kasur }} Kasur
                        </div>
                        <div class="icon-feature">
                            <i class="fa-solid fa-building"></i>
                            Lantai {{ $kamar->lantai }}
                        </div>
                    </div>

                    <button class="btn-retell-primary w-full">
                        Book Now
                    </button>
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
        <button id="closeModal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-2xl font-bold transition-colors duration-200">
            <i class="fas fa-times"></i>
        </button>
        
        <!-- Modal Header -->
        <div class="mb-6">
            <h3 class="text-2xl font-bold text-gray-800 mb-2" id="modalRoomTitle">Fasilitas Kamar</h3>
            <p class="text-sm text-gray-500" id="modalRoomType"></p>
        </div>
        
        <!-- Facilities List -->
        <div class="grid grid-cols-2 gap-3" id="facilitiesList">
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

</body>

</html>