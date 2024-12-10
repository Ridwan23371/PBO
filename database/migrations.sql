-- Tabel untuk pengguna (user)
CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    role TEXT NOT NULL CHECK (role IN ('dokter', 'pasien', 'admin'))
);

-- Tabel untuk pasien
CREATE TABLE IF NOT EXISTS pasien (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    nama TEXT NOT NULL,
    tanggal_lahir DATE NOT NULL,
    alamat TEXT NOT NULL,
    nomor_telepon TEXT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
);

-- Tabel untuk dokter
CREATE TABLE IF NOT EXISTS dokter (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    nama TEXT NOT NULL,
    spesialisasi TEXT NOT NULL,
    jadwal TEXT NOT NULL, -- Format JSON untuk menyimpan jadwal
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
);

-- Tabel untuk jadwal
CREATE TABLE IF NOT EXISTS jadwal (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    dokter_id INTEGER NOT NULL,
    tanggal DATE NOT NULL,
    waktu_mulai TIME NOT NULL,
    waktu_selesai TIME NOT NULL,
    status TEXT NOT NULL CHECK (status IN ('tersedia', 'tidak tersedia')),
    FOREIGN KEY (dokter_id) REFERENCES dokter (id) ON DELETE CASCADE
);

-- Tabel untuk antrian
CREATE TABLE IF NOT EXISTS antrian (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    pasien_id INTEGER NOT NULL,
    dokter_id INTEGER NOT NULL,
    jadwal_id DATE NOT NULL,
    keluhan TEXT NOT NULL,
    status TEXT NOT NULL CHECK (status IN ('menunggu', 'selesai')),
    FOREIGN KEY (pasien_id) REFERENCES pasien (id) ON DELETE CASCADE,
    FOREIGN KEY (dokter_id) REFERENCES dokter (id) ON DELETE CASCADE,
    FOREIGN KEY (jadwal_id) REFERENCES jadwal (id) ON DELETE CASCADE
);

-- Tabel untuk resep
CREATE TABLE IF NOT EXISTS resep (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    pasien_id INTEGER NOT NULL,
    dokter_id INTEGER NOT NULL,
    obat TEXT NOT NULL,
    ketentuan TEXT NOT NULL,
    FOREIGN KEY (pasien_id) REFERENCES pasien (id) ON DELETE CASCADE,
    FOREIGN KEY (dokter_id) REFERENCES dokter (id) ON DELETE CASCADE
);

-- Tabel untuk obat
CREATE TABLE IF NOT EXISTS obat (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nama_obat TEXT NOT NULL,
    stok INTEGER NOT NULL,
    deskripsi TEXT
);
