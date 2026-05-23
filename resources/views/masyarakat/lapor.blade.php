<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Laporan - Sahabat Laut</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Work+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            background-image: url("{{ asset('./images/background.jpg') }}");
            background-size: cover; background-position: center; background-attachment: fixed;
            margin: 0; padding: 0; background-color: #004d6b; 
        }
        .glass-text { color: white; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.4); }
        .form-section {
            position: relative; z-index: 10;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px; padding: 24px;
            margin-bottom: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        .input-field {
            border: 1px solid #000; border-radius: 5px;
            padding: 10px 12px; width: 100%;
            font-family: 'Work Sans', sans-serif; background: white; color: black;
        }
        .label-text { font-family: 'Work Sans', sans-serif; font-weight: 600; color: #000; display: block; margin-bottom: 8px; }
        .required { color: #fe0000; }
        header { transform: translateZ(0); -webkit-transform: translateZ(0); }
        #map { height: 400px; border-radius: 12px; border: 2px solid #000; z-index: 1; width: 100%; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="overflow-x-hidden min-h-screen">

    @if(session('success'))
        <script>Swal.fire({ icon: 'success', title: 'Berhasil!', text: "{{ session('success') }}", timer: 3000, showConfirmButton: false });</script>
    @endif

    <div class="relative w-full min-h-screen">
        <header class="fixed top-0 left-0 w-full h-[100px] flex items-center justify-between px-12 z-[100] bg-[#0077a9]/10 backdrop-blur-md border-b border-white/10">
            <div class="flex items-center gap-4">
                <img src="{{ asset('./images/logo.png') }}" class="w-12 h-12 object-contain mix-blend-multiply" alt="Logo">
                <h1 class="font-['Work_Sans'] font-semibold text-white text-3xl tracking-tight glass-text">Sahabat Laut</h1>
            </div>
            <div class="flex items-center gap-3 bg-white/10 p-1 pr-4 rounded-full border border-white/20">
                <div class="w-10 h-10 rounded-full border-2 border-white bg-white overflow-hidden">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->first_name . ' ' . $user->last_name) }}&background=random" alt="Profile">
                </div>
                <span class="font-semibold text-white text-sm glass-text">{{ $user->first_name }} {{ $user->last_name }}</span>
            </div>
        </header>

        <div class="flex items-start pt-[130px] px-10 pb-10 gap-10 min-h-screen">
            <aside class="w-72 h-fit sticky top-[120px] rounded-[32px] overflow-hidden backdrop-blur-xl bg-black/20 border border-white/20 p-8 flex flex-col z-20 text-white">
                <nav class="flex flex-col gap-10">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-4 text-white/60 hover:text-white transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        <span>Home Page</span>
                    </a>
                    <a href="#" class="flex items-center gap-4 text-white font-bold transition-all underline underline-offset-8">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                        <span class="glass-text">Kirim Laporan</span>
                    </a>
                    <a href="{{ route('laporan.history') }}" class="flex items-center gap-4 text-white/60 hover:text-white transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        <span>History Laporan</span>
                    </a>
                </nav>
                <form action="{{ route('logout') }}" method="POST" class="mt-12 pt-6 border-t border-white/10">
                    @csrf
                    <button type="submit" class="flex items-center gap-4 text-white/60 hover:text-red-400 w-full transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span>Logout</span>
                    </button>
                </form>
            </aside>

            <main class="flex-1" x-data="laporanManager()">
                <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-section">
                        <h2 class="text-xl font-bold mb-6 border-b border-black pb-2">Temuan Alam</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-6">
                            <div>
                                <label class="label-text">Spesies <span class="required">*</span></label>
                                <select name="species_category" class="input-field" x-model="speciesType" required>
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    <option value="Mamalia Laut">Mamalia Laut</option>
                                    <option value="Reptil Laut">Reptil Laut</option>
                                    <option value="Hiu dan Pari">Hiu dan Pari</option>
                                    <option value="Ikan Laut">Ikan Laut</option>
                                    <option value="Terumbu Karang">Terumbu Karang</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                <div x-show="speciesType === 'Lainnya'" class="mt-3" x-transition x-cloak>
                                    <input type="text" name="species_other" class="input-field" placeholder="Ketik nama spesies..." :required="speciesType === 'Lainnya'">
                                </div>
                            </div>
                            <div>
                                <label class="label-text">Aktivitas <span class="required">*</span></label>
                                <select name="aktivitas" class="input-field" required>
                                    <option value="" disabled selected>Pilih Aktivitas</option>
                                    <option value="Ancaman Lingkungan">Ancaman Lingkungan</option>
                                    <option value="Pemantauan">Pemantauan</option>
                                    <option value="Kondisi Satwa">Kondisi Satwa</option>
                                </select>
                            </div>
                            <div>
                                <label class="label-text">Tanggal Temuan <span class="required">*</span></label>
                                <input type="date" name="tanggal_temuan" class="input-field" required>
                            </div>
                            <div>
                                <label class="label-text">Deskripsi Temuan <span class="required">*</span></label>
                                <input type="text" name="deskripsi_temuan" class="input-field" placeholder="Kondisi temuan..." required>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h2 class="text-xl font-bold mb-4 border-b border-black pb-2">Bukti Visual</h2>
                        <div class="border-2 border-dashed border-black rounded-lg p-10 text-center cursor-pointer hover:bg-gray-50" @click="document.getElementById('file-input').click()">
                            <input type="file" id="file-input" name="attachments[]" multiple class="hidden" accept="image/*" @change="handleFileChange($event)">
                            <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p class="text-gray-500">Klik untuk pilih foto</p>
                            <div class="mt-6 grid grid-cols-3 md:grid-cols-5 gap-4" x-show="previews.length > 0">
                                <template x-for="src in previews">
                                    <img :src="src" class="w-full aspect-square object-cover rounded-lg border shadow-sm">
                                </template>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h2 class="text-xl font-bold mb-6 border-b border-black pb-2">Lokasi Temuan</h2>
                        <div class="flex flex-col lg:flex-row gap-10">
                            <div class="w-full lg:w-1/2 flex flex-col gap-6">
                                <div class="relative">
                                    <label class="label-text">Provinsi <span class="required">*</span></label>
                                    <input type="text" class="input-field" placeholder="Ketik untuk mencari provinsi..." 
                                           x-model="searchProv" @focus="openProv = true" @click.away="openProv = false">
                                    <ul class="absolute z-[110] w-full bg-white border border-gray-300 mt-1 rounded-lg shadow-xl max-h-48 overflow-y-auto" 
                                        x-show="openProv && filteredProvinces.length > 0" x-cloak>
                                        <template x-for="p in filteredProvinces" :key="p.id">
                                            <li class="px-4 py-2 hover:bg-blue-600 hover:text-white cursor-pointer text-black"
                                                @click="searchProv = p.name; selectedProv = p.name; openProv = false">
                                                <span x-text="p.name"></span>
                                            </li>
                                        </template>
                                    </ul>
                                    <input type="hidden" name="provinsi" :value="searchProv || selectedProv" required>
                                </div>

                                <div>
                                    <label class="label-text">Alamat / Nama Lokasi <span class="required">*</span></label>
                                    <input type="text" name="alamat_detail" class="input-field" placeholder="Contoh: Pantai Pangandaran" required>
                                </div>
                                <div>
                                    <label class="label-text">Deskripsi Detail Lokasi <span class="required">*</span></label>
                                    <textarea name="deskripsi_lokasi" class="input-field h-24 resize-none" placeholder="Titik kenal atau patokan..." required></textarea>
                                </div>

                                <input type="hidden" name="latitude" :value="lat">
                                <input type="hidden" name="longitude" :value="lng">
                                <div class="p-3 bg-blue-50 border border-blue-200 rounded-lg text-xs text-blue-800 font-mono">
                                    Koordinat: <span x-text="lat"></span>, <span x-text="lng"></span>
                                </div>
                            </div>

                            <div class="w-full lg:w-1/2">
                                <label class="label-text">Tandai di Peta <span class="required">*</span></label>
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pb-10">
                        <button type="submit" class="bg-black text-white px-12 py-3 rounded-xl font-bold shadow-xl hover:bg-gray-900 transition-all active:scale-95">
                            Kirim Laporan
                        </button>
                    </div>
                </form>
            </main>
        </div>
    </div>

    <script>
    function laporanManager() {
        return {
            speciesType: '',
            previews: [],
            provinces: [],
            searchProv: '',
            selectedProv: '',
            openProv: false,
            lat: -6.9175, lng: 107.6191,

            get filteredProvinces() {
                return this.provinces.filter(p => p.name.toLowerCase().includes(this.searchProv.toLowerCase()));
            },

            async init() {
                const res = await fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
                this.provinces = await res.json();

                const map = L.map('map').setView([this.lat, this.lng], 13);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
                const marker = L.marker([this.lat, this.lng], { draggable: true }).addTo(map);

                marker.on('dragend', () => {
                    const pos = marker.getLatLng();
                    this.lat = pos.lat.toFixed(8); this.lng = pos.lng.toFixed(8);
                });
                map.on('click', (e) => {
                    marker.setLatLng(e.latlng);
                    this.lat = e.latlng.lat.toFixed(8); this.lng = e.latlng.lng.toFixed(8);
                });
            },

            handleFileChange(event) {
                const files = Array.from(event.target.files);
                this.previews = files.filter(f => f.type.startsWith('image/')).map(f => URL.createObjectURL(f));
            }
        }
    }
    </script>
    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>