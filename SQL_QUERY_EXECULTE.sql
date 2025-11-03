CREATE TABLE hotel_gallery_image (
    id SERIAL PRIMARY KEY,
    hotel_id INTEGER NOT NULL,
    image_url TEXT NOT NULL,
    title VARCHAR(150),
    description TEXT,
    ordem INTEGER DEFAULT 0,
    created_at TIMESTAMP DEFAULT NOW(),
    updated_at TIMESTAMP DEFAULT NOW()
);
