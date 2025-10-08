🏨 Projeto Blumar — Sistema de Exibição de Hotéis

Este projeto tem como objetivo apresentar de forma dinâmica informações de hotéis cadastrados no banco de dados, permitindo ao usuário visualizar detalhes, fotos, localização e outras informações relevantes através de uma interface moderna e responsiva.

🚀 Funcionalidades

✅ Listagem de hotéis por cidade

🏞️ Exibição da imagem principal (fachada) e galeria de fotos adicionais

🗺️ Exibição do mapa (iframe do Google Maps)

⭐ Exibição da classificação por estrelas

📄 Descrição detalhada do hotel em múltiplos idiomas

📌 Badges de categoria (ex.: Luxury, Top Rated)

📸 Visualização ampliada das fotos em nova aba

🔗 Compartilhamento do link direto do hotel

🧰 Tecnologias Utilizadas

Front-end:

HTML5

CSS3 / Bootstrap

JavaScript (fetch API)

Back-end:

PHP 7+

Conexão com banco via pg_connect (PostgreSQL)

Banco de dados:

PostgreSQL

📂 Estrutura de Pastas
blumar_legado/
│
├── api/
│   └── hotels.php        # Endpoints de listagem e busca de hotéis
│
├── util/
│   └── connection.php    # Conexão com o banco de dados PostgreSQL
│
├── img/                  # Imagens estáticas (caso necessário)
├── js/                   # Scripts adicionais
├── css/                  # Estilos personalizados
│
├── index.php             # Página inicial com listagem de hotéis
├── show.php              # Página de detalhes de cada hotel
└── README.md             # Documentação do projeto

⚙️ Requisitos

PHP 7.4 ou superior

Extensão pgsql habilitada no PHP

Servidor local (ex.: Laragon, XAMPP, WAMP)

PostgreSQL configurado e com dados dos hotéis

🖥️ Como Rodar o Projeto

Clone o repositório:

git clone https://seu-repositorio-bitbucket.git


Configure o ambiente local (por exemplo, Laragon ou outro servidor).

Certifique-se de habilitar a extensão do PostgreSQL no php.ini:

extension=pgsql


Configure util/connection.php com as credenciais corretas do banco:

$conn = pg_connect("host=localhost dbname=blumar user=usuario password=senha");


Acesse no navegador:

http://localhost/blumar_legado/

🧪 Endpoints da API

GET /api/hotels.php?request=listar_hoteis&cidade=Rio
→ Lista todos os hotéis da cidade informada.

GET /api/hotels.php?request=buscar_hotel&id=HTL1
→ Retorna informações detalhadas de um hotel específico.