
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLUMAR - Hotels in Rio de Janeiro</title>
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
        }

        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .lang-selector {
            cursor: pointer;
            padding: 0.3rem 0.8rem;
            background: rgba(255,255,255,0.1);
            border-radius: 20px;
            transition: all 0.3s;
        }

        .lang-selector:hover {
            background: rgba(255,255,255,0.2);
        }

        .page-header {
            background: linear-gradient(135deg, var(--primary-blue) 0%, #2c4a6f 100%);
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
        }

        .city-selector {
            background: white;
            color: var(--primary-blue);
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }

        .city-selector:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .hotel-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: all 0.3s;
            margin-bottom: 2rem;
            height: 100%;
        }

        .hotel-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .hotel-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            position: relative;
        }

        .badge-container {
            position: absolute;
            top: 1rem;
            right: 1rem;
            display: flex;
            gap: 0.5rem;
            z-index: 10;
        }

        .badge-unique {
            background: var(--accent-yellow);
            color: var(--primary-blue);
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: bold;
        }

        .badge-favorite {
            background: var(--accent-red);
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: bold;
        }

        .hotel-content {
            padding: 1.5rem;
        }

        .hotel-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
        }

        .hotel-stars {
            color: var(--accent-yellow);
            margin-bottom: 1rem;
        }

        .hotel-info {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 1rem;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .hotel-description {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .btn-view-details {
            background: var(--primary-blue);
            color: white;
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s;
            width: 100%;
        }

        .btn-view-details:hover {
            background: #2c4a6f;
            transform: scale(1.02);
        }

        .filter-section {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .image-wrapper {
            position: relative;
            overflow: hidden;
        }

        .photo-count {
            position: absolute;
            bottom: 1rem;
            left: 1rem;
            background: rgba(0,0,0,0.7);
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.85rem;
        }

        @media (max-width: 768px) {
            .hotel-image {
                height: 200px;
            }
            
            .page-header {
                padding: 2rem 0;
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
                    <div class="lang-selector">
                        <i class="fas fa-flag"></i> EN
                    </div>
                    <button class="btn btn-sm btn-outline-light">Back to Main Site</button>
                </div>
            </div>
        </div>
    </header>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="mb-2">Hotels</h1>
            <p class="mb-3">Rio de Janeiro's hotels selection</p>
            <button class="city-selector">
                <i class="fas fa-map-marker-alt me-2"></i>Change the city
            </button>
        </div>
    </section>

    <!-- Filters -->
    <div class="container">
        <div class="filter-section">
            <div class="row g-3">
                <div class="col-md-4">
                    <select class="form-select">
                        <option>All Categories</option>
                        <option>Luxury</option>
                        <option>Favorites</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-select">
                        <option>All Star Ratings</option>
                        <option>5 Stars</option>
                        <option>4 Stars</option>
                        <option>3 Stars</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Search hotels...">
                </div>
            </div>
        </div>
    </div>

    <!-- Hotels Listing -->
    <div class="container mb-5">
        <div class="row" id="hotelsContainer">
            <!-- Hotels will be loaded here -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    async function loadHotels() {
        const apiUrl = `http://localhost/blumar_legado/api/hotels.php?request=listar_hoteis&cidade=Rio`;

        try {
            const response = await fetch(apiUrl);
            if (!response.ok) throw new Error("Erro ao carregar hotéis");

            const hotelsData = await response.json();
            console.log(hotelsData)
            // ✅ Agora a URL da imagem já vem completa do PHP
            const hotels = hotelsData.map(h => ({
            codigo: h.codigo,
            name: h.nome,
            city: h.cidade,
            stars: parseInt(h.estrelas) || 0,
            rooms: h.quartos || 0,
            description: h.descricao ?? `Descubra o luxo em ${h.nome}, localizado em ${h.cidade}.`,
            image: h.imagem_fachada ?? "https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800",
            isLuxury: h.classificacao === "Luxo",
            isFavorite: parseInt(h.estrelas) >= 5,
            photoCount: Math.floor(Math.random() * 20) + 10,
        }));

            renderHotels(hotels);
        } catch (error) {
            console.error(error);
            alert("Não foi possível carregar os hotéis.");
        }
    }

    function renderHotels(hotelsToRender) {
        const container = document.getElementById('hotelsContainer');
        container.innerHTML = '';

        hotelsToRender.forEach(hotel => {
            const stars = '<i class="fas fa-star"></i>'.repeat(hotel.stars);
            const badges = `
                ${hotel.isLuxury ? '<span class="badge-unique">UNIQUE</span>' : ''}
                ${hotel.isFavorite ? '<span class="badge-favorite">FAVORITE</span>' : ''}
            `;

            const card = `
                <div class="col-md-6 col-lg-4">
                    <div class="hotel-card">
                        <div class="image-wrapper">
                            <img src="${hotel.image}" alt="${hotel.name}" class="hotel-image">
                            <div class="badge-container">
                                ${badges}
                            </div>
                            <div class="photo-count">
                                <i class="fas fa-camera me-1"></i>${hotel.photoCount} photos
                            </div>
                        </div>
                        <div class="hotel-content">
                            <h3 class="hotel-title">${hotel.name}</h3>
                            <div class="hotel-stars">
                                ${stars}
                            </div>
                            <div class="hotel-info">
                                <span><i class="fas fa-bed me-1"></i>${hotel.rooms} rooms</span>
                                <span><i class="fas fa-map-marker-alt me-1"></i>${hotel.city}</span>
                            </div>
                            <p class="hotel-description">${hotel.description}</p>
                            <button class="btn-view-details" onclick="viewHotelDetails('${hotel.codigo}')">
                                View Details <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
            container.innerHTML += card;
        });
    }

    function viewHotelDetails(codigo) {
        window.location.href = `show.php?codigo=${codigo}`;
    }

    // 📌 Carregar os hotéis assim que a página for aberta
    document.addEventListener('DOMContentLoaded', loadHotels);
</script>

</body>
</html>
```