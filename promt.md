# PROMPT — Pengembangan Website IMT-GT Business Marketplace

Buat dan kembangkan sebuah **website marketplace/directory bisnis IMT-GT (Indonesia–Malaysia–Thailand Growth Triangle)** yang berfokus pada **memperkenalkan produk dan perusahaan/pelaku usaha serta membuka peluang kerja sama bisnis antara Indonesia, Malaysia, dan Thailand**.

Website bukan hanya marketplace untuk transaksi langsung, tetapi lebih berfungsi sebagai **business directory dan platform business matching**, di mana supplier/pelaku usaha dapat memperkenalkan perusahaan dan produknya, sedangkan buyer dapat mencari supplier, melihat produk, dan mengirim inquiry atau permintaan kerja sama.

## 1. Tujuan Utama Sistem

Sistem harus memiliki tujuan utama:

* Menampilkan katalog produk UMKM/perusahaan.
* Memperkenalkan profil perusahaan/pelaku usaha.
* Memudahkan buyer menemukan produk dan supplier.
* Memudahkan pencarian berdasarkan kategori dan negara.
* Membuka peluang kerja sama bisnis antara Indonesia, Malaysia, dan Thailand.
* Menyediakan fitur inquiry antara buyer dan pelaku usaha/supplier.
* Menyediakan informasi, berita, dan konten terkait IMT-GT.
* Menyediakan dashboard admin untuk mengelola seluruh data dan konten website.

**PENTING:** Jangan mengubah konsep bisnis menjadi sistem e-commerce penuh. Fokus utama adalah **product showcase, company directory, business networking, dan inquiry/kerja sama bisnis**.

---

# 2. Aktor Sistem

Sistem memiliki 4 jenis aktor:

## A. Pengunjung

Pengunjung adalah pengguna umum yang belum login.

Pengunjung dapat:

* Mengakses halaman beranda.
* Melihat katalog produk.
* Melihat detail produk.
* Melihat direktori perusahaan.
* Melihat detail perusahaan.
* Melihat berita IMT-GT.
* Membaca halaman statis/informasi umum.
* Melihat informasi mengenai IMT-GT.
* Melakukan pencarian produk.
* Melakukan filter produk.
* Melakukan pencarian perusahaan.
* Melakukan filter perusahaan.
* Memilih kategori.
* Memilih negara.
* Melihat website dalam beberapa bahasa.
* Melakukan registrasi sebagai pelaku usaha/supplier.
* Melakukan login.

Pengunjung **belum dapat menggunakan fitur khusus member**, seperti mengelola perusahaan, produk pribadi, atau mengirim inquiry sebagai member.

---

## B. Pelaku Usaha / Supplier

Pelaku usaha adalah member yang mendaftarkan perusahaan untuk memperkenalkan bisnis dan produk mereka.

Pelaku usaha dapat:

* Mendaftarkan perusahaan.
* Mengisi dan mengelola profil perusahaan sendiri.
* Mengunggah informasi perusahaan.
* Menambahkan produk.
* Mengedit produk sendiri.
* Menghapus/mengelola produk sendiri.
* Melihat daftar produk milik sendiri.
* Memantau inquiry dari buyer.
* Menerima inquiry atau permintaan kerja sama dari buyer.
* Mengelola informasi bisnis yang diperbolehkan oleh sistem.

Data pelaku usaha/perusahaan dapat memerlukan **verifikasi admin sebelum ditampilkan secara publik**.

Pelaku usaha hanya boleh mengelola data yang menjadi miliknya sendiri dan tidak boleh mengakses atau mengubah data supplier lain.

---

## C. Buyer

Buyer adalah pengguna yang mencari produk atau perusahaan untuk kebutuhan bisnis dan kerja sama.

Buyer dapat:

* Mencari produk.
* Melakukan filter produk.
* Mencari perusahaan/supplier.
* Melakukan filter perusahaan.
* Melihat detail produk.
* Melihat profil perusahaan.
* Melihat informasi supplier.
* Mengirim inquiry kepada supplier.
* Mengirim permintaan kerja sama bisnis.

Fokus buyer adalah **menemukan supplier yang sesuai dan melakukan komunikasi bisnis melalui inquiry**, bukan melakukan checkout atau transaksi e-commerce secara langsung.

---

## D. Admin

Admin merupakan pusat kontrol sistem.

Admin dapat:

### Manajemen Pengguna

* Melihat daftar pengguna.
* Menambah pengguna jika diperlukan.
* Mengedit pengguna.
* Menonaktifkan/mengaktifkan pengguna.
* Mengelola role.
* Mengelola permission.
* Melihat audit log.
* Mengelola status/verifikasi pelaku usaha.

### Manajemen Perusahaan

* Melihat seluruh perusahaan.
* Memeriksa data perusahaan.
* Memverifikasi perusahaan.
* Menyetujui atau menolak pendaftaran perusahaan.
* Mengedit data perusahaan jika diperlukan.
* Mengubah status perusahaan.

### Manajemen Produk

* Melihat seluruh produk.
* Menambah produk.
* Mengedit produk.
* Menghapus produk.
* Mengubah status publikasi produk.
* Mengelola produk berdasarkan kategori.
* Melakukan moderasi/verifikasi produk jika diperlukan.

### Manajemen Kategori

* Mengelola kategori umum.
* Mengelola kategori produk.
* Menambah kategori.
* Mengedit kategori.
* Menghapus/nonaktifkan kategori.
* Mengelola tag.

### Manajemen Berita dan Konten

* Mengelola berita IMT-GT.
* Membuat berita.
* Mengedit berita.
* Menghapus berita.
* Mengatur status publikasi.
* Mengelola halaman statis.
* Mengelola media.
* Mengelola konten website.

### Pengaturan Website

Admin dapat mengelola:

* Banner.
* Menu navigasi.
* Greeting.
* Section website.
* Konten halaman utama.
* Konten informasi umum.
* Pengaturan umum website.

---

# 3. Fitur Utama Website

## A. Homepage / Beranda

Buat halaman beranda yang menjadi pintu utama website.

Minimal memiliki:

* Hero/banner.
* Pengenalan IMT-GT.
* Search produk/perusahaan.
* Featured products.
* Featured companies.
* Kategori produk.
* Informasi negara.
* Berita terbaru.
* Informasi peluang kerja sama.
* Call-to-action untuk supplier melakukan registrasi.
* Call-to-action untuk buyer mencari supplier.

---

# 4. Katalog Produk

Sediakan katalog produk yang dapat digunakan pengunjung maupun buyer.

Fitur:

* Daftar produk.
* Detail produk.
* Foto produk.
* Nama produk.
* Deskripsi.
* Kategori.
* Tag.
* Negara asal.
* Nama perusahaan/supplier.
* Informasi perusahaan.
* Status produk.
* Search.
* Filter.
* Sorting.
* Pagination.

Filter minimal:

* Kategori.
* Negara.
* Perusahaan/supplier.
* Tag jika tersedia.

Pengunjung dapat melihat produk publik tanpa login.

---

# 5. Direktori Perusahaan

Sediakan halaman direktori perusahaan/supplier.

Informasi yang dapat ditampilkan:

* Nama perusahaan.
* Logo.
* Negara.
* Kategori bisnis.
* Deskripsi perusahaan.
* Profil perusahaan.
* Produk yang dimiliki.
* Informasi kontak yang memang diperbolehkan untuk publik.
* Status verifikasi.

Fitur:

* Search perusahaan.
* Filter berdasarkan negara.
* Filter kategori.
* Sorting.
* Pagination.
* Detail perusahaan.

---

# 6. Inquiry / Business Cooperation

Sistem harus memiliki fitur inquiry untuk menghubungkan buyer dengan supplier.

Alur dasar:

Buyer:

1. Menemukan produk/perusahaan.
2. Membuka detail produk atau perusahaan.
3. Memilih opsi inquiry.
4. Mengisi pesan/permintaan kerja sama.
5. Mengirim inquiry.

Supplier:

1. Menerima inquiry.
2. Melihat detail inquiry.
3. Mengetahui buyer yang mengirim inquiry.
4. Membaca pesan.
5. Menindaklanjuti inquiry.

Admin dapat memiliki akses monitoring inquiry jika diperlukan.

**Jangan membuat sistem checkout, cart, payment, shipping, atau transaksi e-commerce kecuali memang sudah terdapat di kode/database existing.**

---

# 7. Registrasi Pelaku Usaha

Sediakan registrasi khusus untuk pelaku usaha/supplier.

Alur:

1. Pengunjung memilih registrasi pelaku usaha.
2. Membuat akun.
3. Mengisi data perusahaan.
4. Mengisi informasi bisnis.
5. Mengirim data.
6. Data masuk ke sistem.
7. Admin melakukan verifikasi.
8. Setelah disetujui, perusahaan dapat ditampilkan pada direktori publik sesuai aturan sistem.

Pastikan status perusahaan dapat dibedakan, misalnya:

* Pending.
* Verified/Approved.
* Rejected.
* Inactive.

Jangan mengubah alur verifikasi jika pada sistem existing sudah terdapat mekanisme yang berbeda.

---

# 8. Berita dan Informasi IMT-GT

Sediakan bagian khusus untuk:

* Berita IMT-GT.
* Artikel.
* Informasi kegiatan.
* Informasi program.
* Informasi kerja sama.
* Informasi terkait Indonesia, Malaysia, dan Thailand.

Fitur publik:

* Daftar berita.
* Detail berita.
* Featured news.
* Search berita jika diperlukan.
* Kategori berita jika tersedia.

Admin dapat melakukan CRUD berita dan mengatur publikasinya.

---

# 9. Multi-Bahasa

Website harus mendukung **multi-bahasa**.

Struktur sistem harus memungkinkan konten website ditampilkan dalam beberapa bahasa.

Minimal desain sistem harus mempertimbangkan:

* Bahasa Indonesia.
* Bahasa Inggris.

Jika sistem existing sudah memiliki bahasa lain, **pertahankan dan jangan menghapusnya**.

Pastikan:

* Menu dapat diterjemahkan.
* Label UI dapat diterjemahkan.
* Konten publik dapat mendukung bahasa.
* Halaman statis dapat mendukung bahasa.
* Berita dapat mendukung bahasa jika struktur database mendukung.

---

# 10. Admin Dashboard

Buat dashboard admin sebagai pusat pengelolaan sistem.

Struktur menu admin minimal:

### Dashboard

* Ringkasan statistik.
* Total user.
* Total supplier/perusahaan.
* Total produk.
* Total berita.
* Data pending verification.
* Aktivitas terbaru.

### User Management

* Users.
* Roles.
* Permissions.
* Audit Logs.

### Company Management

* Companies.
* Verification.
* Company status.

### Product Management

* Products.
* Categories.
* Tags.

### Content Management

* News.
* Pages.
* Media.

### Website Settings

* Banner.
* Menu.
* Greeting.
* Website sections.
* General settings.

Jika sistem existing memiliki struktur menu atau modul yang berbeda, **ikuti struktur existing dan jangan mengganti alur bisnisnya tanpa alasan yang jelas.**

---

# 11. Role dan Permission

Gunakan sistem role dan permission yang jelas.

Minimal:

* Admin.
* Supplier/Pelaku Usaha.
* Buyer.
* Guest/Pengunjung.

Pastikan authorization diterapkan pada backend.

Contoh:

* Supplier hanya dapat mengelola perusahaan dan produk miliknya sendiri.
* Buyer tidak dapat mengubah data supplier.
* Guest tidak dapat mengakses dashboard member.
* Admin dapat mengelola seluruh data sesuai permission.

Jangan hanya menyembunyikan menu di frontend. Validasi authorization juga harus dilakukan di backend/API.

---

# 12. Keamanan dan Validasi

Implementasikan keamanan tanpa mengubah business flow.

Minimal:

* Authentication.
* Authorization.
* Role-based access control.
* Validasi input.
* Validasi upload file.
* Proteksi endpoint/API.
* Proteksi terhadap SQL Injection.
* Proteksi XSS.
* Proteksi CSRF jika relevan.
* Password hashing.
* Rate limiting jika tersedia.
* Audit log untuk aktivitas penting.
* Validasi ownership data.
* Error handling yang aman.
* Jangan menampilkan informasi sensitif pada response API.
* Jangan menyimpan password dalam bentuk plaintext.

---

# 13. Prinsip Penting Saat Mengembangkan Sistem

**INI SANGAT PENTING.**

Jika project/code/database existing diberikan, **jangan mengubah alur bisnis yang sudah berjalan**.

Sebelum melakukan perubahan:

1. Analisis struktur project.
2. Analisis database.
3. Analisis API/backend.
4. Analisis frontend.
5. Analisis authentication.
6. Analisis role dan permission.
7. Analisis relationship antar tabel.
8. Identifikasi fitur yang sudah tersedia.
9. Pertahankan fitur yang sudah berjalan.
10. Hanya lakukan perubahan yang diperlukan untuk memenuhi requirement.

Jangan:

* Menghapus tabel tanpa alasan.
* Menghapus endpoint existing.
* Mengubah nama field database sembarangan.
* Mengubah struktur API yang sudah digunakan frontend.
* Mengubah role tanpa kebutuhan.
* Mengubah business logic existing.
* Mengganti framework.
* Mengganti teknologi utama.
* Membuat ulang sistem dari nol jika sistem existing sudah tersedia.

Jika terdapat kebutuhan baru yang bertentangan dengan kode existing, **jelaskan konflik tersebut terlebih dahulu dan pilih solusi yang paling minim perubahan terhadap business logic.**

---

# 14. Prinsip UI/UX

Buat interface yang:

* Modern.
* Profesional.
* Bersih.
* Responsive.
* Mudah digunakan.
* Cocok untuk platform bisnis internasional.
* Memiliki navigasi yang jelas.
* Memisahkan area publik, member, dan admin.
* Mendukung desktop, tablet, dan mobile.

Fokus UI:

**Public Website**
→ Produk
→ Perusahaan
→ Berita
→ Informasi IMT-GT
→ Search
→ Filter
→ Business opportunity

**Supplier Area**
→ Company Profile
→ My Products
→ Add Product
→ Edit Product
→ Inquiry

**Buyer Area**
→ Search Product
→ Search Company
→ Product Detail
→ Company Detail
→ Inquiry

**Admin Area**
→ Dashboard
→ Users
→ Roles & Permissions
→ Companies
→ Products
→ Categories
→ Tags
→ News
→ Pages
→ Media
→ Website Settings
→ Audit Logs

---

# 15. Target Business Flow

Business flow utama harus seperti berikut:

### Pengunjung → Supplier

Pengunjung membuka website → melihat produk/perusahaan → tertarik menjadi supplier → registrasi → mengisi data perusahaan → menunggu verifikasi admin → disetujui → perusahaan dan produk dapat ditampilkan.

### Buyer → Supplier

Buyer login → mencari produk/perusahaan → melihat detail → memilih supplier → mengirim inquiry → supplier menerima inquiry → supplier melakukan follow-up.

### Admin → Semua Data

Admin login → dashboard → mengelola user → melakukan verifikasi supplier → mengelola perusahaan → mengelola produk → mengelola kategori/tag → mengelola berita → mengelola halaman/media → mengelola konfigurasi website → melihat audit log.

---

# 16. Hasil Akhir yang Diharapkan

Hasil akhir adalah sebuah platform **IMT-GT Business Directory / Business Matching** yang memungkinkan:

**Indonesia ↔ Malaysia ↔ Thailand**

untuk:

* Memperkenalkan perusahaan.
* Memperkenalkan produk.
* Menemukan supplier.
* Menemukan buyer.
* Mencari berdasarkan kategori.
* Mencari berdasarkan negara.
* Membaca informasi dan berita IMT-GT.
* Melakukan inquiry.
* Membuka peluang kerja sama bisnis.

Prioritas utama sistem:

**Company Discovery → Product Discovery → Supplier Discovery → Business Inquiry → Business Cooperation**

Bukan:

**Cart → Checkout → Payment → Shipping**

Seluruh implementasi harus tetap mempertahankan **alur bisnis, struktur data, dan fungsi existing** apabila project yang diberikan sudah memiliki implementasi sebelumnya.
