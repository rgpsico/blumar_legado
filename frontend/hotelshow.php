<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ hotel.nome || 'Hotel' }} | BLUMAR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Vue.js -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <style>
        :root {
            --blumar-dark: #0a2540;
            --blumar-accent: #00d4ff;
            --blumar-orange: #ff6b35;
            --blumar-gradient: linear-gradient(135deg, #0a2540 0%, #1a4d7a 100%);
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.12);
            --shadow-lg: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-dark);
            background: #f8fafc;
        }

        /* Header / Navbar */
        .topbar {
            background: var(--blumar-gradient);
            color: #fff;
            padding: 0.8rem 0;
            box-shadow: var(--shadow-md);
        }

        .brand {
            font-weight: 800;
            letter-spacing: 2px;
            color: #fff !important;
            font-size: 1.5rem;
            text-transform: uppercase;
        }

        .flag {
            width: 28px;
            height: 20px;
            object-fit: cover;
            border-radius: 4px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        .topbar a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1.5rem;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.3);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .topbar a:hover {
            background: white;
            color: var(--blumar-dark);
            transform: translateY(-2px);
        }

        /* Breadcrumb */
        .breadcrumb-wrap {
            background: #fff;
            border-bottom: 2px solid var(--border);
            padding: 1rem 0;
        }

        .breadcrumb {
            margin: 0;
            padding: 0;
            font-size: 0.9rem;
            background: none;
        }

        .breadcrumb a {
            text-decoration: none;
            color: var(--text-muted);
            transition: color 0.3s ease;
        }

        .breadcrumb a:hover {
            color: var(--blumar-accent);
        }

        .breadcrumb .active {
            color: var(--text-dark);
            font-weight: 600;
        }

        /* Loading */
        .loading {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 60vh;
            color: var(--text-muted);
        }

        .loading i {
            font-size: 3rem;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Page title */
        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .page-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, var(--blumar-accent), transparent);
            border-radius: 2px;
        }

        /* Gallery */
        .gallery-main {
            aspect-ratio: 16/9;
            width: 100%;
            border-radius: 16px;
            object-fit: cover;
            box-shadow: var(--shadow-lg);
            transition: all 0.3s ease;
        }

        .thumb {
            height: 110px;
            width: 100%;
            border-radius: 12px;
            object-fit: cover;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
        }

        .thumb:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .thumb-wrap {
            position: relative;
        }

        .more-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(10, 37, 64, 0.85);
            color: #fff;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.9rem;
            backdrop-filter: blur(5px);
        }

        /* Side cards */
        .side-card {
            border: 2px solid var(--border);
            border-radius: 16px;
            padding: 1.5rem;
            background: white;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
        }

        .side-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-3px);
        }

        .side-card h6 {
            font-weight: 700;
            font-size: 1rem;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: 2px solid var(--border);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.85rem;
            background: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .chip:hover {
            transform: scale(1.05);
            box-shadow: var(--shadow-sm);
        }

        .rating .bi {
            color: #fbbf24;
            font-size: 1.1rem;
        }

        /* Section blocks */
        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .divider {
            height: 3px;
            width: 80px;
            background: linear-gradient(90deg, var(--blumar-orange), transparent);
            border-radius: 2px;
            margin: 1rem 0 1.5rem;
        }

        .icon-title {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            font-weight: 700;
            color: var(--text-dark);
            font-size: 1.3rem;
            margin-bottom: 1rem;
        }

        .icon-title .bi {
            color: var(--blumar-orange);
            font-size: 1.5rem;
        }

        /* Buttons */
        .btn-outline-orange {
            background: linear-gradient(135deg, var(--blumar-orange) 0%, #ff8c42 100%);
            color: white;
            border: none;
            padding: 0.7rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(255, 107, 53, 0.3);
        }

        .btn-outline-orange:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(255, 107, 53, 0.4);
            color: white;
        }

        .btn-outline-secondary {
            border: 2px solid var(--border);
            color: var(--text-dark);
            border-radius: 50px;
            padding: 0.5rem 1.2rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            background: var(--blumar-accent);
            border-color: var(--blumar-accent);
            color: white;
        }

        /* Map */
        .map {
            width: 100%;
            height: 200px;
            border-radius: 12px;
            object-fit: cover;
            box-shadow: var(--shadow-sm);
        }

        /* Footer */
        .site-footer {
            background: var(--blumar-gradient);
            color: white;
            padding: 3rem 0 2rem;
            margin-top: 4rem;
        }

        .site-footer .brand-small {
            color: #fff;
            font-weight: 800;
            letter-spacing: 2px;
            font-size: 1.5rem;
        }

        .footer-sep {
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            margin: 1.5rem 0;
        }

        .logo-pill {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            padding: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 70px;
            transition: all 0.3s ease;
        }

        .logo-pill:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-3px);
        }

        .logo-pill img {
            max-height: 40px;
            object-fit: contain;
            opacity: 0.9;
        }

        .footer-mini {
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.8);
        }

        .footer-mini a {
            color: var(--blumar-accent);
            text-decoration: none;
            transition: opacity 0.3s ease;
        }

        .footer-mini a:hover {
            opacity: 0.8;
        }

        /* Sticky sidebar */
        @media (min-width: 992px) {
            .sticky-lg-top-80 {
                position: sticky;
                top: 100px;
            }
        }

        /* Description text */
        .description-text {
            line-height: 1.8;
            color: var(--text-muted);
            font-size: 1rem;
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 0.8s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <div id="app">
        <!-- Top bar -->
        <div class="topbar">
            <div class="container d-flex align-items-center justify-content-between">
                <a href="index.html" class="brand text-decoration-none">BLUMAR</a>
                <div class="d-flex align-items-center gap-3">
                    <a href="#"><i class="bi bi-box-arrow-up-right me-2"></i>Back to Main Site</a>
                    <img class="flag" alt="US" src="https://flagcdn.com/us.svg">
                </div>
            </div>
        </div>

        <!-- Breadcrumb -->
        <div class="breadcrumb-wrap">
            <div class="container py-2">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="index.html">Hotels</a></li>
                            <li class="breadcrumb-item"><a href="#">{{ hotel.cidade || 'Rio de Janeiro' }}'s hotels selection</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ hotel.nome || 'Loading...' }}</li>
                        </ol>
                    </nav>
                    <button class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-geo-alt me-1"></i> Change the city
                    </button>
                </div>
            </div>
        </div>

        <!-- Loading State -->
        <div v-if="loading" class="loading">
            <i class="bi bi-arrow-repeat"></i>
        </div>

        <!-- Page container -->
        <div v-else class="container py-4 fade-in">
            <!-- Title -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-title">{{ hotel.nome }}</h1>
                    <p class="text-muted">
                        <i class="bi bi-geo-alt-fill text-primary"></i>
                        {{ hotel.cidade }}, {{ hotel.uf }} • {{ hotel.categoria }}
                    </p>
                </div>
            </div>

            <div class="row g-4 mt-2">
                <!-- Left: gallery + body -->
                <div class="col-lg-9">
                    <!-- Gallery -->
                    <div class="row g-3">
                        <div class="col-md-8">
                            <img :src="hotel.htlimgfotofachada" class="gallery-main" alt="Hotel photo">
                        </div>
                        <div class="col-md-4 d-flex flex-column gap-2">
                            <img v-if="hotel.imagem_fachada"
                                class="thumb"
                                :src="hotel.imagem_fachada"
                                @click="hotel.imagem_fachada"
                                alt="Fachada">
                            <img v-if="hotel.fotoextra_recep || hotel.htlfotopiscina"
                                class="thumb"
                                :src="hotel.fotoextra_recep"
                                @click="hotel.fotoextra_recep"
                                alt="Piscina">
                            <img v-if="hotel.htlimgfotofachada"
                                class="thumb"
                                :src="hotel.htlimgfotofachada"
                                @click="hotel.htlimgfotofachada"
                                alt="Extra">
                            <div v-if="hotel.url_htl_360" class="thumb-wrap">
                                <a :href="hotel.url_htl_360" target="_blank" class="text-decoration-none">
                                    <div class="thumb" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);"></div>
                                    <div class="more-overlay">Ver Tour 360º</div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mt-4">
                        <div class="divider"></div>
                        <h5 class="section-title">Hotel Description</h5>
                        <div class="description-text" v-html="descricaoFormatada"></div>
                    </div>

                    <!-- Hotel Info -->
                    <div v-if="hotel.email" class="mt-4">
                        <h5 class="icon-title">
                            <i class="bi bi-info-circle"></i> Contact Information
                        </h5>
                        <p class="description-text">
                            <strong>Email:</strong> <a :href="'mailto:' + hotel.email">{{ hotel.email }}</a>
                        </p>
                        <p v-if="hotel.googlemapa" class="description-text">
                            <strong>Location:</strong> <a :href="hotel.googlemapa" target="_blank">View on Google Maps</a>
                        </p>
                    </div>

                    <!-- Video -->
                    <div v-if="hotel.url_video" class="mt-4">
                        <h5 class="icon-title">
                            <i class="bi bi-play-circle"></i> Video Tour
                        </h5>
                        <div class="ratio ratio-16x9" style="border-radius: 16px; overflow: hidden;">
                            <iframe :src="hotel.url_video" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>

                <!-- Right: sidebar -->
                <div class="col-lg-3">
                    <div class="sticky-lg-top-80 d-flex flex-column gap-3">
                        <div class="side-card">
                            <button class="btn btn-outline-orange w-100">
                                <i class="bi bi-link-45deg me-2"></i> Create Product Link
                            </button>
                        </div>

                        <div class="side-card">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <span class="chip">
                                    <i class="bi bi-award"></i> {{ hotel.classificacao || '4 estrelas' }}
                                </span>
                                <span class="chip">
                                    <i class="bi bi-shield-check"></i> {{ hotel.categoria }}
                                </span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="rating">
                                    <i v-for="n in estrelas" :key="n" class="bi bi-star-fill"></i>
                                </div>
                                <div class="small text-muted">
                                    <i class="bi bi-heart text-danger me-1"></i>{{ hotel.codigo }}
                                </div>
                            </div>
                        </div>

                        <div class="side-card">
                            <h6>Personal note from the team</h6>
                            <p class="small mb-0 text-muted">
                                {{ hotel.descricao_ingles || 'Excellent property with great facilities and service. Perfect for leisure and business travelers.' }}
                            </p>
                        </div>

                        <div v-if="hotel.googlemapa" class="side-card">
                            <h6 class="mb-3">Map Location</h6>
                            <a :href="hotel.googlemapa" target="_blank">
                                <img class="map w-100" alt="Map"
                                    src="https://via.placeholder.com/400x250/e2e8f0/64748b?text=View+on+Maps">
                            </a>
                            <div class="small text-muted mt-2">
                                <i class="bi bi-geo-alt-fill"></i> {{ hotel.cidade }}, {{ hotel.uf }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Site footer -->
        <footer class="site-footer">
            <div class="container">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div class="brand-small">BLUMAR</div>
                    <div class="footer-mini">
                        Rua Siqueira Campos, 43 - Copacabana - Rio de Janeiro - RJ - Brasil •
                        <a href="tel:+552121429200">+55 21 2142-9200</a> •
                        <a href="mailto:incoming@blumar.com.br">incoming@blumar.com.br</a> •
                        <i class="bi bi-linkedin ms-2"></i>
                    </div>
                </div>

                <div class="footer-sep"></div>

                <!-- Logos grid -->
                <div class="row g-3">
                    <div class="col-6 col-sm-4 col-md-2" v-for="n in 12" :key="n">
                        <div class="logo-pill">
                            <img :src="'https://via.placeholder.com/140x40/ffffff/1a4d7a?text=Partner+' + n" alt="">
                        </div>
                    </div>
                </div>

                <div class="text-center small mt-4 pb-2" style="color: rgba(255,255,255,0.7);">
                    © {{ currentYear }} Blumar Turismo. All rights reserved.
                </div>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        new Vue({
            el: '#app',
            data: {
                hotel: {},
                loading: true,
                imagemPrincipal: '',
                currentYear: new Date().getFullYear(),
                apiUrl: 'http://localhost/blumar_legado/blumar/api/hotels.php'
            },
            computed: {
                estrelas() {
                    const match = this.hotel.classificacao?.match(/(\d+)/);
                    return match ? parseInt(match[1]) : 4;
                },
                descricaoFormatada() {
                    const desc = this.hotel.descricao || this.hotel.descricao_ingles || 'No description available.';
                    return desc.replace(/\n/g, '<br>');
                }
            },
            methods: {
                async carregarHotel() {
                    try {
                        this.loading = true;
                        // Pega o ID da URL
                        const urlParams = new URLSearchParams(window.location.search);
                        const hotelId = urlParams.get('id');

                        if (!hotelId) {
                            console.error('ID do hotel não encontrado na URL');
                            return;
                        }

                        // Busca o hotel específico
                        const response = await axios.get(`${this.apiUrl}?request=listar_hoteis`);
                        this.hotel = response.data.find(h => h.codigo === hotelId) || {};

                        // Define imagem principal com prefixo correto
                        this.imagemPrincipal = this.getImageUrl(this.hotel.imagem_fachada || this.hotel.htlimgfotofachada);

                        // Atualiza o título da página
                        document.title = `${this.hotel.nome || 'Hotel'} | BLUMAR`;

                    } catch (error) {
                        console.error('Erro ao carregar hotel:', error);
                    } finally {
                        this.loading = false;
                    }
                },
                trocarImagem(novaImagem) {
                    if (novaImagem) {
                        this.imagemPrincipal = this.getImageUrl(novaImagem);
                    }
                },
                getImageUrl(imagePath) {
                    // Se não houver imagem, retorna placeholder
                    if (!imagePath) {
                        return 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80';
                    }

                    // Se já for URL completa, retorna direto
                    if (imagePath.startsWith('http://') || imagePath.startsWith('https://')) {
                        return imagePath;
                    }

                    // Adiciona o prefixo da Blumar
                    const baseUrl = 'https://www.blumar.com.br/';

                    // Remove barras duplicadas
                    const cleanPath = imagePath.replace(/^\/+/, '');
                    console.log(baseUrl + cleanPath)
                    return baseUrl + cleanPath;
                }
            },
            mounted() {
                this.carregarHotel();
            }
        });
    </script>

</body>

</html>