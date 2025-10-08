<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLUMAR - Hotel Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-blue: #1a2942;
            --accent-yellow: #ffd700;
            --accent-red: #dc3545;
            --light-gray: #f8f9fa;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-gray);
        }

        .header-top {
            background-color: var(--primary-blue);
            color: white;
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .breadcrumb {
            background: white;
            padding: 1rem 0;
            margin: 0;
        }

        .breadcrumb-item a {
            color: var(--primary-blue);
            text-decoration: none;
        }

        .hero-section {
            position: relative;
            height: 500px;
            overflow: hidden;
            background: #000;
        }

        .hero-media {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent 50%, rgba(0,0,0,0.7));
        }

        .hero-title {
            position: absolute;
            bottom: 2rem;
            left: 2rem;
            color: white;
            z-index: 10;
        }

        .hero-title h1 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .gallery-trigger {
            position: absolute;
            bottom: 2rem;
            right: 2rem;
            background: rgba(255,255,255,0.9);
            color: var(--primary-blue);
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            z-index: 10;
        }

        .gallery-trigger:hover {
            background: white;
            transform: scale(1.05);
        }

        .sidebar {
            position: sticky;
            top: 100px;
        }

        .info-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
        }

        .info-card h4 {
            color: var(--primary-blue);
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        .badge-unique {
            background: var(--accent-yellow);
            color: var(--primary-blue);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: bold;
            display: inline-block;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .badge-favorite {
            background: var(--accent-red);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 0.5rem;
        }

        .stat-item {
            display: flex;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #eee;
        }

        .stat-item:last-child {
            border-bottom: none;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            background: var(--primary-blue);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary-blue);
        }

        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .btn-action {
            width: 100%;
            padding: 0.8rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-bottom: 0.8rem;
        }

        .btn-primary-action {
            background: var(--primary-blue);
            color: white;
        }

        .btn-primary-action:hover {
            background: #2c4a6f;
            transform: translateY(-2px);
        }

        .btn-secondary-action {
            background: white;
            color: var(--primary-blue);
            border: 2px solid var(--primary-blue);
        }

        .btn-secondary-action:hover {
            background: var(--primary-blue);
            color: white;
        }

        .team-note {
            background: #fff3cd;
            border-left: 4px solid var(--accent-yellow);
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .team-note h5 {
            color: var(--primary-blue);
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        .content-section {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
        }

        .content-section h2 {
            color: var(--primary-blue);
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .map-container {
            width: 100%;
            height: 400px;
            background: #e9ecef;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            overflow: hidden;
        }

        .stars {
            color: var(--accent-yellow);
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        .thumbnail-gallery {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .thumbnail {
            width: 100%;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .thumbnail:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        @media (max-width: 992px) {
            .hero-section {
                height: 350px;
            }
            
            .hero-title h1 {
                font-size: 2rem;
            }
            
            .sidebar {
                position: static;
                margin-top: 2rem;
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                height: 250px;
            }
            
            .hero-title {
                left: 1rem;
                bottom: 1rem;
            }
            
            .hero-title h1 {
                font-size: 1.5rem;
            }
            
            .gallery-trigger {
                bottom: 1rem;
                right: 1rem;
                padding: 0.6rem 1rem;
                font-size: 0.9rem;
            }

            .map-container {
                height: 250px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header-top">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">BLUMAR</div>
                <div class="d-flex gap-3 align-items-center">
                    <div class="lang-selector" style="cursor: pointer; padding: 0.3rem 0.8rem; background: rgba(255,255,255,0.1); border-radius: 20px;">
                        <i class="fas fa-flag"></i> EN
                    </div>
                    <button class="btn btn-sm btn-outline-light" onclick="window.history.back()">
                        <i class="fas fa-arrow-left me-2"></i>Back to List
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Breadcrumb -->
    <nav class="breadcrumb-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Hotels</a></li>
                    <li class="breadcrumb-item"><a href="#">Rio de Janeiro</a></li>
                    <li class="breadcrumb-item active" aria-current="page" id="breadcrumbHotel">Loading...</li>
                </ol>
            </nav>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <img id="heroImage" src="" alt="Hotel" class="hero-media">
        <div class="hero-overlay"></div>
        <div class="hero-title">
            <h1 id="hotelName">Loading...</h1>
            <div class="stars" id="hotelStars"></div>
        </div>
        <button class="gallery-trigger" onclick="openGallery()">
            <i class="fas fa-images me-2"></i>More <span id="photoCount">24</span> photos
        </button>
    </section>

    <!-- Main Content -->
    <div class="container my-5">
        <div class="row">
            <!-- Main Content Column -->
            <div class="col-lg-8">
                <!-- Team Note -->
                <div class="team-note">
                    <h5><i class="fas fa-star me-2"></i>Team's Note</h5>
                    <p id="teamNote" class="mb-0">Loading...</p>
                </div>

                <!-- Description -->
                <div class="content-section">
                    <h2>About this Hotel</h2>
                    <p id="hotelDescription" style="line-height: 1.8; color: #555;">Loading...</p>
                </div>

                <!-- Photo Gallery -->
                <div class="content-section">
                    <h2>Photo Gallery</h2>
                    <div class="thumbnail-gallery" id="thumbnailGallery">
                        <!-- Thumbnails will be loaded here -->
                    </div>
                </div>

                <!-- Map -->
                <div class="content-section">
                    <h2>Location</h2>
                    <div class="map-container" id="mapContainer">
                        <div class="text-center">
                            <i class="fas fa-map-marked-alt fa-3x mb-2"></i>
                         <iframe
                            width="100%"
                            height="450"
                            style="border:0"
                            loading="lazy"
                            allowfullscreen
                            referrerpolicy="no-referrer-when-downgrade"
                            src="https://www.google.com/maps?q=R.+Paulino+Fernandes,+39+-+Botafogo,+Rio+de+Janeiro+-+RJ,+22270-050&output=embed">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar">
                    <!-- Actions -->
                    <div class="info-card">
                        <h4>Quick Actions</h4>
                        <button class="btn-action btn-primary-action" onclick="createProductLink()">
                            <i class="fas fa-link me-2"></i>Create Product Link
                        </button>
                        <button class="btn-action btn-secondary-action" onclick="shareHotel()">
                            <i class="fas fa-share-alt me-2"></i>Share Hotel
                        </button>
                    </div>

                    <!-- Badges -->
                    <div class="info-card" id="badgesSection">
                        <h4>Categories</h4>
                        <!-- Badges will be loaded here -->
                    </div>

                    <!-- Statistics -->
                    <div class="info-card">
                        <h4>Hotel Information</h4>
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fas fa-bed"></i>
                            </div>
                            <div>
                                <div class="stat-value" id="roomCount">0</div>
                                <div class="stat-label">Total Rooms</div>
                            </div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fas fa-star"></i>
                            </div>
                            <div>
                                <div class="stat-value" id="starRating">0</div>
                                <div class="stat-label">Star Rating</div>
                            </div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fas fa-images"></i>
                            </div>
                            <div>
                                <div class="stat-value" id="totalPhotos">0</div>
                                <div class="stat-label">Photos Available</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   
<script>
    const urlParams = new URLSearchParams(window.location.search);
    const hotelCodigo = urlParams.get("codigo");

    async function loadHotelData() {
        const apiUrl = `http://localhost/blumar_legado/api/hotels.php?request=buscar_hotel&id=${hotelCodigo}`;

        try {
            const response = await fetch(apiUrl);
            if (!response.ok) throw new Error("Erro ao carregar hotel");
            const hotel = await response.json();

            // 🧭 Breadcrumb e Título
            document.getElementById('breadcrumbHotel').textContent = hotel.nome || "Hotel";
            document.getElementById('hotelName').textContent = hotel.nome || "Hotel sem nome";

            // 🏞️ Hero Image (fachada do hotel)
            const fachada = hotel.imagem_fachada 
                || hotel.fotofachada_tbn 
                || "https://images.unsplash.com/photo-1566073771259-6a8506099945?w=1200";
            document.getElementById('heroImage').src = fachada;

            // ⭐ Estrelas
            const stars = parseInt(hotel.estrelas) || 0;
            document.getElementById('hotelStars').innerHTML =
                '<i class="fas fa-star"></i>'.repeat(stars);

            // 📝 Descrição
            document.getElementById('hotelDescription').textContent =
                hotel.descricao || "Descrição não disponível.";

            // 📊 Dados gerais
            document.getElementById('roomCount').textContent = hotel.quartos || 0;
            document.getElementById('starRating').textContent = stars;

            // 👥 Observação da equipe
            document.getElementById('teamNote').textContent =
                `Hotel localizado em ${hotel.cidade || 'local não informado'}.`;
            console.log(hotel)
            // 🏷️ Categorias
            loadBadges(hotel);

            // 🖼️ Galeria de fotos real
            loadGallery(hotel);

            // 🗺️ Mapa (Google Maps)
            loadMap(hotel);

        } catch (error) {
            console.error(error);
            alert("Não foi possível carregar os dados do hotel.");
        }
    }

    function loadBadges(hotel) {
        const badgesSection = document.getElementById('badgesSection');
        let badgesHtml = '<h4>Categories</h4>';

        if (hotel.classificacao && hotel.classificacao.toLowerCase().includes("luxo")) {
            badgesHtml += '<span class="badge-unique"><i class="fas fa-gem me-2"></i>LUXURY</span>';
        }
        if (hotel.estrelas >= 5) {
            badgesHtml += '<span class="badge-favorite"><i class="fas fa-heart me-2"></i>TOP RATED</span>';
        }

        if (badgesHtml === '<h4>Categories</h4>') {
            badgesHtml += '<p class="text-muted mb-0">No special categories</p>';
        }

        badgesSection.innerHTML = badgesHtml;
    }

    function loadGallery(hotel) {
        const gallery = document.getElementById('thumbnailGallery');
        gallery.innerHTML = '';

        // Monta array de imagens reais
        const fotos = [
            hotel.imagem_fachada,
            hotel.imagem_piscina,
            hotel.fotoextra,
            hotel.fotoextra_recep,
            hotel.ft_resort1,
            hotel.ft_resort2,
            hotel.ft_resort3
        ].filter(img => img && img.trim() !== "");

        // Se não houver fotos, mostra placeholder
        if (fotos.length === 0) {
            gallery.innerHTML = '<p class="text-muted">Nenhuma imagem disponível.</p>';
            document.getElementById('totalPhotos').textContent = 0;
            document.getElementById('photoCount').textContent = 0;
            return;
        }

        // Renderiza miniaturas
        fotos.forEach((foto, index) => {
            const img = document.createElement('img');
            img.src = foto;
            img.alt = `Hotel photo ${index + 1}`;
            img.className = 'thumbnail';
            img.onclick = () => viewPhoto(foto);
            gallery.appendChild(img);
        });

        document.getElementById('totalPhotos').textContent = fotos.length;
        document.getElementById('photoCount').textContent = fotos.length;
    }

    function loadMap(hotel) {
        const mapaContainer = document.getElementById('mapContainer');
        if (hotel.googlemapa && hotel.googlemapa.trim() !== "") {
            // Ajusta largura para 100% e altura dinâmica baseada no tamanho da tela
            const altura = window.innerWidth <= 768 ? '250' : '400';
            let iframe = hotel.googlemapa
                .replace(/width="\d+"/, 'width="100%"')
                .replace(/height="\d+"/, `height="${altura}"`);
            // Remove aspas extras se houver no JSON
            iframe = iframe.replace(/&quot;/g, '"');
            mapaContainer.innerHTML = iframe;
        } else {
            mapaContainer.innerHTML = `
                <div class="text-center text-muted">
                    <i class="fas fa-map-marked-alt fa-3x mb-2"></i>
                    <p>Localização não disponível</p>
                </div>
            `;
        }
    }

    function viewPhoto(fotoUrl) {
        const novaJanela = window.open(fotoUrl, '_blank');
        novaJanela.focus();
    }

    function createProductLink() {
        const url = window.location.href;
        navigator.clipboard.writeText(url)
            .then(() => alert('Link copiado: ' + url))
            .catch(() => alert('Link: ' + url));
    }

    function shareHotel() {
        if (navigator.share) {
            navigator.share({
                title: document.getElementById('hotelName').textContent,
                url: window.location.href
            });
        } else {
            alert('Compartilhamento não suportado neste navegador');
        }
    }

    function openGallery() {
        // Placeholder para abrir galeria modal - pode ser expandido
        alert('Galeria de fotos aberta!');
    }

    loadHotelData();
</script>

</body>
</html>