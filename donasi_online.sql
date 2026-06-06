DROP DATABASE IF EXISTS donasi_online;
CREATE DATABASE donasi_online;
USE donasi_online;

-- =========================
-- TABEL USERS
-- =========================

CREATE TABLE users (
id INT AUTO_INCREMENT PRIMARY KEY,
nama VARCHAR(100) NOT NULL,
email VARCHAR(100) NOT NULL UNIQUE,
PASSWORD VARCHAR(255) NOT NULL,
ROLE ENUM('admin','user') DEFAULT 'user',
foto VARCHAR(255) NULL,
no_hp VARCHAR(20) NULL,
alamat TEXT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- TABEL KATEGORI
-- =========================

CREATE TABLE kategori (
id INT AUTO_INCREMENT PRIMARY KEY,
nama_kategori VARCHAR(100) NOT NULL
);

-- =========================
-- TABEL CAMPAIGN
-- =========================

CREATE TABLE campaign (
id INT AUTO_INCREMENT PRIMARY KEY,
kategori_id INT NOT NULL,
judul VARCHAR(255) NOT NULL,
deskripsi TEXT NOT NULL,
target DECIMAL(15,2) NOT NULL,
terkumpul DECIMAL(15,2) DEFAULT 0,
gambar VARCHAR(255),
deadline DATE,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

CONSTRAINT fk_campaign_kategori
FOREIGN KEY (kategori_id)
REFERENCES kategori(id)
ON DELETE CASCADE
ON UPDATE CASCADE

);

-- =========================
-- TABEL DONASI
-- =========================

CREATE TABLE donasi (
id INT AUTO_INCREMENT PRIMARY KEY,

user_id INT NOT NULL,
campaign_id INT NOT NULL,

nominal DECIMAL(15,2) NOT NULL,

bukti_transfer VARCHAR(255),

STATUS ENUM(
    'pending',
    'diterima',
    'ditolak'
) DEFAULT 'pending',

tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

CONSTRAINT fk_donasi_user
FOREIGN KEY (user_id)
REFERENCES users(id)
ON DELETE CASCADE
ON UPDATE CASCADE,

CONSTRAINT fk_donasi_campaign
FOREIGN KEY (campaign_id)
REFERENCES campaign(id)
ON DELETE CASCADE
ON UPDATE CASCADE

);

-- =========================
-- TABEL NOTIFIKASI
-- =========================

CREATE TABLE notifikasi (
id INT AUTO_INCREMENT PRIMARY KEY,

user_id INT NOT NULL,

pesan TEXT NOT NULL,

STATUS ENUM(
    'belum_dibaca',
    'dibaca'
) DEFAULT 'belum_dibaca',

created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

CONSTRAINT fk_notifikasi_user
FOREIGN KEY (user_id)
REFERENCES users(id)
ON DELETE CASCADE
ON UPDATE CASCADE

);

-- =========================
-- DATA ADMIN
-- email : admin@gmail.com
-- password : password
-- =========================

INSERT INTO users
(nama,email,PASSWORD,ROLE)
VALUES
(
'Administrator',
'admin@gmail.com',
'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/.WHP4jK7A6wG',
'admin'
);

-- =========================
-- USER DUMMY
-- password = password
-- =========================

INSERT INTO users
(nama,email,PASSWORD,ROLE)
VALUES
('Budi','budi@gmail.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/.WHP4jK7A6wG','user'),
('Andi','andi@gmail.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/.WHP4jK7A6wG','user'),
('Siti','siti@gmail.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/.WHP4jK7A6wG','user'),
('Rina','rina@gmail.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/.WHP4jK7A6wG','user'),
('Dewi','dewi@gmail.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/.WHP4jK7A6wG','user');

-- =========================
-- DATA KATEGORI
-- =========================

INSERT INTO kategori (nama_kategori)
VALUES
('Bencana Alam'),
('Pendidikan'),
('Kesehatan'),
('Panti Asuhan'),
('Rumah Ibadah'),
('Lingkungan');

-- =========================
-- DATA CAMPAIGN
-- =========================

INSERT INTO campaign
(kategori_id,judul,deskripsi,target,terkumpul,gambar,deadline)
VALUES
(1,'Bantu Korban Banjir','Penggalangan dana untuk korban banjir.',10000000,2500000,'banjir.jpg','2026-12-31'),
(2,'Beasiswa Anak Yatim','Program pendidikan anak yatim.',20000000,5000000,'beasiswa.jpg','2026-12-31'),
(3,'Pengobatan Kanker','Bantu biaya pengobatan pasien kanker.',50000000,15000000,'kanker.jpg','2026-12-31'),
(4,'Renovasi Panti Asuhan','Perbaikan fasilitas panti asuhan.',30000000,8000000,'panti.jpg','2026-12-31'),
(5,'Pembangunan Masjid','Pembangunan dan renovasi masjid.',40000000,10000000,'masjid.jpg','2026-12-31'),
(1,'Bantu Korban Gempa','Donasi untuk korban gempa bumi.',25000000,6000000,'gempa.jpg','2026-12-31'),
(2,'Buku Untuk Pelajar','Pengadaan buku sekolah.',10000000,2000000,'buku.jpg','2026-12-31'),
(3,'Operasi Jantung','Biaya operasi pasien jantung.',60000000,12000000,'jantung.jpg','2026-12-31'),
(4,'Panti Jompo','Bantuan kebutuhan lansia.',15000000,4000000,'jompo.jpg','2026-12-31'),
(6,'Penanaman Pohon','Program penghijauan lingkungan.',12000000,3000000,'pohon.jpg','2026-12-31');

-- =========================
-- DATA DONASI
-- =========================

INSERT INTO donasi
(user_id,campaign_id,nominal,bukti_transfer,STATUS)
VALUES
(2,1,100000,'bukti1.jpg','diterima'),
(3,1,150000,'bukti2.jpg','diterima'),
(4,2,200000,'bukti3.jpg','pending'),
(5,3,300000,'bukti4.jpg','diterima'),
(6,4,500000,'bukti5.jpg','ditolak'),
(2,5,250000,'bukti6.jpg','diterima'),
(3,6,100000,'bukti7.jpg','pending'),
(4,7,175000,'bukti8.jpg','diterima'),
(5,8,125000,'bukti9.jpg','pending'),
(6,9,225000,'bukti10.jpg','diterima');

-- =========================
-- DATA NOTIFIKASI
-- =========================

INSERT INTO notifikasi
(user_id,pesan)
VALUES
(2,'Terima kasih telah berdonasi'),
(3,'Donasi Anda sedang diverifikasi'),
(4,'Donasi Anda telah diterima'),
(5,'Donasi Anda ditolak admin'),
(6,'Campaign yang Anda dukung telah diperbarui');

UPDATE users
SET PASSWORD='$2y$10$R78TNBXNY0NjsdVjdVQf2eYw.JO6wSNyOFT2CpGW/TwrWbEjr9REe'
WHERE email='admin@gmail.com';

SELECT * FROM users
WHERE email='budi@gmail.com';

UPDATE users
SET PASSWORD='$2y$10$3tGxHi/k.bywGOWxNirdLO1jzCplxheKCeoHdlTy9LZN27vmxvyo6'
WHERE email='budi@gmail.com';

UPDATE users
SET PASSWORD='$2y$10$3tGxHi/k.bywGOWxNirdLO1jzCplxheKCeoHdlTy9LZN27vmxvyo6'
WHERE email='siti@gmail.com';