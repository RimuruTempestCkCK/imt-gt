# MASTER PROMPT PENGEMBANGAN WEBSITE IMT-GT BUSINESS CENTRE Indonesia

Anda bertindak sebagai Senior Fullstack Laravel Engineer, UI/UX Designer, Software Architect, Database Designer, dan Security Engineer.

Tugas Anda adalah mengembangkan aplikasi website resmi:

**IMT-GT Business Centre Provinsi Indonesia**

Aplikasi terdiri dari:

1. Website publik untuk guest.
2. Content Management System untuk administrator.
3. Sistem verifikasi dan persetujuan konten.
4. Sistem layanan publik dan pendaftaran kegiatan.
5. Sistem pengelolaan dokumen, galeri, potensi daerah, dan investasi.
6. UMKM Mendaftarkan produk yang di jual dan dapat mempromosikan produknya di dalam website. informasi produk yang di tampilkan dan umkm dapat membuat company profile untuk mempromosikan produk ke investor luar negri. bisa menggunakan bahasa inggris, thailand, melayu/indonesia

Gunakan pendekatan pengembangan yang modular, rapi, aman, mudah dipelihara, dan siap dikembangkan lebih lanjut.

---

# A. KONTEKS APLIKASI

Website IMT-GT Business Centre merupakan portal resmi yang menyediakan informasi tentang kegiatan, program, peluang kerja sama, investasi, perdagangan, UMKM, pariwisata, dan potensi ekonomi dalam kawasan Indonesia–Malaysia–Thailand Growth Triangle.

Website harus berfungsi sebagai:

1. Portal informasi resmi.
2. Media promosi potensi ekonomi dan investasi.
3. Pusat publikasi berita dan kegiatan.
4. Sarana komunikasi dengan stakeholder.
5. Layanan pendaftaran kegiatan dan pengajuan kemitraan.
6. Pusat pengelolaan dokumen publik.
7. Media kolaborasi pemerintah, bisnis, akademisi, asosiasi, dan masyarakat.

---

# B. VARIABEL PROYEK

Gunakan konfigurasi berikut dan sesuaikan dengan project yang sudah tersedia:

* Nama aplikasi: `IMT-GT`
* Database: `imtgt`
* Bahasa utama: Indonesia
* Bahasa tambahan: Inggris
* Bahasa opsional: Melayu dan Thai
* Zona waktu: Asia/Jakarta
* Format tanggal: `dd MMMM yyyy`
* Format waktu: `HH:mm WIB`

Jangan melakukan upgrade major Laravel, PHP, Node.js, Tailwind CSS, atau dependency lain tanpa instruksi.

Periksa terlebih dahulu versi dan struktur project yang sudah ada sebelum menulis kode.

---

# C. TEKNOLOGI UTAMA

Gunakan teknologi berikut:

* Laravel sesuai versi yang sudah terpasang.
* PHP sesuai requirement project.
* Blade Template Engine.
* Tailwind CSS.
* Alpine.js untuk interaksi ringan.
* Vite untuk asset bundling.
* MySQL atau PostgreSQL.
* Laravel authentication.
* Laravel Form Request untuk validasi.
* Laravel Policy dan Gate untuk authorization.
* Laravel Storage untuk media dan dokumen.
* Laravel Notification untuk notifikasi.
* Laravel Queue untuk proses email atau pekerjaan berat.
* Laravel Scheduler untuk publish terjadwal dan maintenance otomatis.
* Pest atau PHPUnit untuk automated testing.

Gunakan library tambahan hanya jika benar-benar dibutuhkan dan kompatibel dengan versi project.

Untuk role dan permission:

* Gunakan package role-permission yang kompatibel apabila dependency eksternal diizinkan.
* Jika dependency eksternal tidak diizinkan, gunakan implementasi native Laravel menggunakan tabel roles, permissions, role_user, dan permission_role.

---

# D. PRINSIP PENGEMBANGAN

Terapkan prinsip berikut:

1. Clean architecture yang realistis untuk Laravel.
2. Thin controller.
3. Validasi menggunakan Form Request.
4. Logika bisnis kompleks ditempatkan di Service atau Action Class.
5. Query kompleks ditempatkan di Query Builder, Scope, atau Repository jika diperlukan.
6. Authorization menggunakan Policy dan Gate.
7. Gunakan database transaction untuk proses kritis.
8. Hindari duplikasi kode.
9. Gunakan reusable Blade component.
10. Gunakan naming convention yang konsisten.
11. Gunakan eager loading untuk mencegah N+1 query.
12. Semua form memiliki server-side validation.
13. Semua data dari pengguna harus dianggap tidak tepercaya.
14. Setiap fitur harus responsif dan accessible.
15. Jangan menulis kode dummy jika implementasi sebenarnya memungkinkan.
16. Jangan menghapus kode lama sebelum memahami keterkaitannya.
17. Jangan mengubah fitur di luar scope tanpa alasan yang jelas.

---

# E. ROLE DAN HAK AKSES

Implementasikan role berikut.

## 1. Super Administrator

Hak akses:

* Mengelola seluruh sistem.
* Mengelola user.
* Mengelola role dan permission.
* Mengelola konfigurasi website.
* Melihat seluruh audit log.
* Mengakses seluruh modul.
* Melakukan publish, unpublish, archive, dan restore.
* Mengelola menu dan halaman statis.
* Mengelola integrasi sistem.

## 2. Administrator

Hak akses:

* Mengelola sebagian besar konten.
* Mengelola berita, agenda, galeri, dokumen, dan halaman.
* Mengelola formulir masuk.
* Melihat statistik website.
* Tidak dapat menghapus Super Administrator.
* Tidak dapat mengubah konfigurasi keamanan kritis.

## 3. Operator

Hak akses:

* Membuat konten baru.
* Mengedit konten miliknya.
* Menyimpan sebagai draft.
* Mengirim konten untuk diverifikasi.
* Mengunggah gambar dan dokumen.
* Melihat catatan revisi.
* Tidak dapat memverifikasi atau menyetujui konten sendiri.

## 4. Verifikator

Hak akses:

* Melihat konten yang sudah diajukan.
* Memeriksa fakta, format, bahasa, gambar, dan dokumen.
* Memberikan catatan.
* Mengembalikan konten untuk revisi.
* Menandai konten sebagai terverifikasi.
* Tidak dapat menyetujui konten apabila sekaligus menjadi pembuat konten tersebut.

## 5. Approver atau Pimpinan

Hak akses:

* Melihat konten yang sudah diverifikasi.
* Menyetujui konten.
* Menolak konten.
* Mengembalikan konten untuk revisi.
* Menentukan waktu publikasi.
* Membatalkan publikasi jika diperlukan.

## 6. Member atau Mitra

Role opsional untuk pengembangan selanjutnya.

Hak akses:

* Login ke member area.
* Melihat dokumen khusus mitra.
* Mengirim proposal atau dokumen kerja sama.
* Mengikuti forum diskusi.
* Melihat riwayat pengajuan.

## 7. Guest

Hak akses:

* Mengakses konten publik.
* Menggunakan pencarian.
* Mengunduh dokumen publik.
* Mengisi formulir.
* Mendaftar kegiatan.
* Berlangganan newsletter.

---

# F. WORKFLOW KONTEN

Gunakan workflow berikut:

```text
Draft
→ Submitted
→ Under Verification
→ Revision Required
→ Verified
→ Waiting Approval
→ Approved
→ Scheduled
→ Published
→ Unpublished
→ Archived
```

Status alternatif:

```text
Rejected
```

Ketentuan:

1. Operator membuat konten sebagai Draft.
2. Operator mengirim konten menjadi Submitted.
3. Verifikator memeriksa konten.
4. Verifikator dapat memilih:

   * Revision Required
   * Verified
5. Konten yang Verified masuk ke Waiting Approval.
6. Approver dapat memilih:

   * Approved
   * Revision Required
   * Rejected
7. Konten Approved dapat:

   * Langsung dipublikasikan.
   * Dijadwalkan.
8. Sistem mengubah status Scheduled menjadi Published secara otomatis.
9. Semua perubahan status harus dicatat.
10. Setiap catatan revisi harus tersimpan.
11. Pengguna terkait menerima notifikasi.
12. User tidak boleh memverifikasi atau menyetujui konten yang dibuatnya sendiri jika prinsip separation of duties diaktifkan.
13. Konten Published hanya dapat diedit melalui proses revisi baru atau dibuatkan version history.

---

# G. MODUL WEBSITE PUBLIK

## 1. Beranda

Beranda minimal memiliki:

* Top information bar.
* Header dan logo.
* Navigasi utama.
* Pilihan bahasa.
* Search button.
* Hero banner atau slider.
* Informasi singkat IMT-GT Business Centre.
* Sambutan pimpinan.
* Berita utama.
* Berita terbaru.
* Agenda mendatang.
* Program unggulan.
* Potensi investasi.
* Produk unggulan.
* Statistik singkat.
* Galeri terbaru.
* Mitra kerja.
* Call-to-action kerja sama.
* Newsletter subscription.
* Footer lengkap.

Hero section harus:

* Modern dan profesional.
* Menonjolkan kerja sama Indonesia, Malaysia, dan Thailand.
* Memiliki headline yang jelas.
* Memiliki maksimal dua call-to-action utama.
* Memiliki overlay yang menjaga keterbacaan.
* Tidak menggunakan animasi berlebihan.
* Tetap ringan pada perangkat mobile.

## 2. Profil

Subhalaman:

* Tentang IMT-GT.
* Sejarah.
* Latar belakang.
* Visi dan misi.
* Tujuan.
* Struktur organisasi.
* Profil pimpinan.
* Mitra dan jejaring.
* Tugas dan fungsi.
* Dasar hukum.

## 3. Program dan Kegiatan

Fitur:

* Daftar program.
* Detail program.
* Agenda kegiatan.
* Kalender kegiatan.
* Filter berdasarkan tanggal dan kategori.
* Detail kegiatan.
* Lokasi kegiatan.
* Peta lokasi.
* Informasi penyelenggara.
* Tombol pendaftaran.
* Status pendaftaran.
* Laporan kegiatan.
* Dokumentasi kegiatan.
* Proyek unggulan.

## 4. Berita

Fitur:

* Daftar berita.
* Berita utama.
* Berita terbaru.
* Filter kategori.
* Filter tahun.
* Pencarian.
* Pagination.
* Detail berita.
* Cover image.
* Galeri di dalam berita.
* Dokumen lampiran.
* Berita terkait.
* Tombol berbagi.
* Jumlah tayangan.
* Informasi penulis dan tanggal publikasi.

## 5. Publikasi dan Dokumen

Kategori antara lain:

* Laporan tahunan.
* Laporan kegiatan.
* MoU.
* Regulasi.
* Kajian.
* Materi presentasi.
* Newsletter.
* E-magazine.
* Dokumen investasi.

Fitur:

* Filter kategori.
* Filter tahun.
* Search.
* Preview metadata.
* Ukuran file.
* Jenis file.
* Jumlah unduhan.
* Tombol download.
* Dokumen terkait.

## 6. Galeri

Jenis galeri:

* Galeri foto.
* Galeri video.

Fitur:

* Album.
* Cover album.
* Tanggal.
* Lokasi.
* Deskripsi.
* Lightbox.
* Embed video yang aman.
* Lazy loading.
* Filter berdasarkan kegiatan dan tahun.

## 7. Potensi Daerah

Submodul:

* Potensi investasi.
* Produk unggulan.
* UMKM.
* Pariwisata.
* Perkebunan.
* Perikanan.
* Energi.
* Industri.
* Perdagangan.
* Infrastruktur.
* Ekonomi kreatif.

Setiap potensi dapat memiliki:

* Judul.
* Slug.
* Ringkasan.
* Deskripsi.
* Kategori.
* Kabupaten atau kota.
* Lokasi.
* Koordinat.
* Nilai atau estimasi investasi.
* Status peluang.
* Gambar.
* Dokumen pendukung.
* Informasi kontak.
* Data indikator.
* Call-to-action pengajuan minat.

## 8. Peta Peluang Bisnis

Siapkan arsitektur untuk interactive map.

Fitur:

* Marker lokasi.
* Filter sektor.
* Filter kabupaten atau kota.
* Detail peluang.
* Link ke halaman detail.
* Cluster marker jika data banyak.
* Fallback daftar apabila peta gagal dimuat.

Gunakan provider peta yang disetujui project.

Jangan menaruh API key secara langsung di source code.

## 9. Kerja Sama Internasional

Subhalaman:

* Tentang IMT-GT.
* Negara anggota.
* Area kerja sama.
* Joint program.
* Mitra internasional.
* Proyek bersama.
* Success stories.
* Dokumen kerja sama.

## 10. Layanan

Fitur:

* Pendaftaran event atau seminar.
* Formulir kemitraan.
* Formulir minat investasi.
* Formulir pengajuan produk UMKM.
* Formulir kontak.
* Formulir pengaduan.
* FAQ.
* WhatsApp quick contact.

Setiap formulir harus memiliki:

* Validasi.
* Anti-spam.
* Rate limiting.
* Persetujuan privasi.
* Nomor tiket atau registrasi.
* Email konfirmasi.
* Status pengajuan.
* Riwayat perubahan status di admin.

## 11. Kontak

Informasi:

* Alamat.
* Email.
* Nomor telepon.
* Jam layanan.
* Google Maps atau peta lainnya.
* Formulir kontak.
* Link media sosial.

## 12. Pencarian Global

Pencarian mencakup:

* Berita.
* Program.
* Agenda.
* Dokumen.
* Potensi investasi.
* Produk unggulan.
* Halaman statis.
* Galeri.

Fitur:

* Keyword highlighting.
* Filter tipe konten.
* Pagination.
* Empty state.
* Search suggestion opsional.

---

# H. MODUL CMS ADMIN

Gunakan layout admin terpisah dari website publik.

## 1. Dashboard

Tampilkan:

* Jumlah berita.
* Jumlah agenda.
* Jumlah dokumen.
* Jumlah potensi investasi.
* Jumlah formulir masuk.
* Jumlah subscriber.
* Konten menunggu verifikasi.
* Konten menunggu approval.
* Konten terjadwal.
* Grafik publikasi.
* Grafik pengunjung jika integrasi tersedia.
* Agenda terdekat.
* Aktivitas terbaru.
* Quick action.

Isi dashboard harus menyesuaikan role.

## 2. Manajemen Konten

CMS harus menyediakan CRUD untuk:

* Berita.
* Kategori berita.
* Tag.
* Halaman statis.
* Program.
* Agenda.
* Laporan kegiatan.
* Proyek unggulan.
* Publikasi.
* Kategori dokumen.
* Galeri foto.
* Galeri video.
* Album.
* Potensi investasi.
* Produk unggulan.
* UMKM.
* Sektor.
* Wilayah.
* Mitra.
* Success story.
* FAQ.
* Banner.
* Sambutan.
* Struktur organisasi.
* Profil pimpinan.
* Menu.
* Footer.
* Media sosial.

Setiap listing admin minimal memiliki:

* Search.
* Filter.
* Sort.
* Pagination.
* Bulk action.
* Status badge.
* Tanggal dibuat.
* Pembuat.
* Tanggal diperbarui.
* Action menu.
* Empty state.
* Confirmation dialog.

## 3. Editor Konten

Editor harus menyediakan:

* Judul.
* Slug otomatis yang dapat diedit.
* Ringkasan.
* Isi.
* Cover image.
* Alt text.
* Caption.
* Kategori.
* Tag.
* Author.
* SEO title.
* Meta description.
* Open Graph image.
* Canonical URL opsional.
* Jadwal publikasi.
* Status.
* Featured content.
* Lampiran.
* Preview.
* Save draft.
* Submit verification.

Gunakan rich text editor yang aman apabila dependency diizinkan.

Lakukan sanitasi HTML di sisi server.

## 4. Media Library

Fitur:

* Upload gambar.
* Upload dokumen.
* Folder atau kategori.
* Search.
* Filter jenis media.
* Preview.
* Metadata.
* Alt text.
* Caption.
* Credit.
* Ukuran file.
* Dimensi gambar.
* Digunakan pada konten mana.
* Hapus file yang tidak terpakai.
* Soft delete.
* Validasi MIME type.
* Batas ukuran file.
* Generate thumbnail.

Gunakan struktur penyimpanan yang jelas.

Contoh:

```text
storage/app/public/
├── news/
├── events/
├── galleries/
├── documents/
├── investments/
├── products/
├── partners/
└── settings/
```

## 5. Workflow Verification dan Approval

Halaman khusus:

* Konten menunggu verifikasi.
* Konten perlu revisi.
* Konten terverifikasi.
* Konten menunggu approval.
* Konten disetujui.
* Konten ditolak.
* Riwayat workflow.

Fitur:

* Preview konten.
* Perbandingan perubahan.
* Catatan revisi.
* Timeline status.
* Tombol verify.
* Tombol request revision.
* Tombol approve.
* Tombol reject.
* Tombol schedule.
* Notifikasi.

## 6. Manajemen Formulir Masuk

Kelola:

* Pendaftaran event.
* Pengajuan kemitraan.
* Minat investasi.
* Pengajuan produk UMKM.
* Pesan kontak.
* Pengaduan.
* Newsletter subscriber.

Fitur:

* Status.
* Assignment petugas.
* Catatan internal.
* Riwayat tindak lanjut.
* Export CSV atau Excel.
* Filter tanggal.
* Filter status.
* Pencarian.
* Print.
* Detail data.
* Lampiran.
* Notifikasi.

## 7. Manajemen User

Fitur:

* Daftar user.
* Tambah user.
* Edit user.
* Aktifkan atau nonaktifkan user.
* Reset password.
* Assign role.
* Assign permission.
* Riwayat login.
* Last activity.
* Force logout opsional.

Password tidak boleh ditampilkan.

## 8. Audit Log

Catat minimal:

* Login.
* Logout.
* Gagal login.
* Membuat data.
* Mengubah data.
* Menghapus data.
* Restore data.
* Perubahan status.
* Verifikasi.
* Approval.
* Reject.
* Publish.
* Unpublish.
* Download data sensitif.
* Perubahan konfigurasi.

Audit log menyimpan:

* User.
* Aktivitas.
* Modul.
* Record ID.
* Nilai sebelum.
* Nilai sesudah.
* IP address.
* User agent.
* Timestamp.

## 9. Pengaturan Website

Pengaturan meliputi:

* Nama website.
* Logo.
* Favicon.
* Deskripsi.
* Alamat.
* Kontak.
* Email.
* Nomor telepon.
* WhatsApp.
* Media sosial.
* Sambutan.
* SEO default.
* Bahasa.
* Maintenance mode.
* Google Analytics atau Matomo.
* Peta.
* SMTP.
* Newsletter.
* Footer.
* Kebijakan privasi.
* Syarat dan ketentuan.

Data sensitif harus disimpan di environment variable, bukan database biasa atau source code.

---

# I. STRUKTUR DATABASE

Rancang migration, model, relationship, factory, seeder, dan index yang sesuai.

Tabel inti yang disarankan:

```text
users
roles
permissions
role_user
permission_role

pages
page_translations

posts
post_translations
post_categories
post_category_relations
tags
post_tag

programs
program_translations

events
event_translations
event_registrations

activity_reports

document_categories
documents
document_translations
document_downloads

albums
album_translations
media
media_relations

investment_categories
investment_opportunities
investment_opportunity_translations

product_categories
featured_products
featured_product_translations

businesses
business_translations

regions
sectors

partners
partner_translations

success_stories
success_story_translations

faqs
faq_translations

banners
banner_translations

organization_members
organization_member_translations

contact_messages
partnership_submissions
investment_inquiries
complaints

newsletter_subscribers

content_workflows
content_revisions
content_approvals

notifications
audit_logs
settings
menus
menu_items
redirects
```

Gunakan polymorphic relation jika efektif, misalnya untuk:

* Media.
* Workflow.
* Revisions.
* Approvals.
* Tags.
* Attachments.

Setiap tabel konten minimal mempertimbangkan:

* UUID atau big integer sesuai standar project.
* created_by.
* updated_by.
* deleted_by.
* status.
* published_at.
* scheduled_at.
* created_at.
* updated_at.
* deleted_at.

Tambahkan database index pada:

* slug.
* status.
* published_at.
* category_id.
* user_id.
* foreign key.
* kolom pencarian.
* kombinasi filter yang sering dipakai.

Pastikan foreign key memiliki aturan delete dan update yang aman.

---

# J. MULTI-LANGUAGE

Gunakan arsitektur yang memungkinkan konten tersedia dalam beberapa bahasa.

Bahasa minimum:

* Indonesia.
* Inggris.

Gunakan salah satu pendekatan:

1. Translation table.
2. JSON translation field jika struktur konten sederhana.

Untuk aplikasi ini, prioritaskan translation table agar:

* Mudah difilter.
* Mudah divalidasi.
* Mudah dikembangkan.
* SEO tiap bahasa dapat dikelola.
* Slug dapat berbeda per bahasa.

Gunakan URL seperti:

```text
/id/berita
/en/news
```

Ketentuan:

* Bahasa default Indonesia.
* Fallback ke bahasa Indonesia.
* Language switcher mempertahankan halaman yang sama jika terjemahan tersedia.
* Jika terjemahan tidak tersedia, arahkan ke halaman bahasa default dengan pemberitahuan yang wajar.
* Metadata SEO berbeda untuk setiap bahasa.

---

# K. UI/UX WEBSITE PUBLIK

Gunakan gaya visual:

* Modern.
* Profesional.
* Pemerintahan dan bisnis internasional.
* Bersih.
* Elegan.
* Kredibel.
* Tidak terlalu ramai.
* Memiliki identitas Indonesia secara halus.
* Menampilkan semangat kerja sama tiga negara.

## Design System

Buat:

* Color tokens.
* Typography scale.
* Spacing scale.
* Border radius.
* Shadow.
* Container width.
* Button variants.
* Form styles.
* Badge variants.
* Alert variants.
* Card variants.

Gunakan warna utama berdasarkan identitas resmi yang diberikan.

Jika warna belum tersedia, gunakan placeholder CSS variable:

```text
--color-primary
--color-primary-dark
--color-secondary
--color-accent
--color-surface
--color-muted
--color-border
--color-danger
--color-success
--color-warning
```

Jangan menyebarkan hardcoded color secara berlebihan.

## Aturan Tampilan

1. Mobile-first.
2. Responsif pada mobile, tablet, laptop, dan desktop.
3. Navigasi mudah dipahami.
4. Maksimal dua CTA utama pada satu section.
5. Hirarki visual jelas.
6. White space cukup.
7. Kontras warna memenuhi accessibility.
8. Semua gambar memiliki alt text.
9. Fokus keyboard terlihat.
10. Form memiliki label.
11. Error message mudah dipahami.
12. Hindari carousel berlebihan.
13. Animasi ringan dan tidak mengganggu.
14. Hormati `prefers-reduced-motion`.
15. Gunakan skeleton atau loading state jika dibutuhkan.
16. Sediakan empty state.
17. Sediakan error state.

## Komponen Blade Publik

Buat reusable component seperti:

```text
<x-public.header />
<x-public.navigation />
<x-public.mobile-menu />
<x-public.hero />
<x-public.section-heading />
<x-public.news-card />
<x-public.event-card />
<x-public.document-card />
<x-public.investment-card />
<x-public.partner-logo />
<x-public.gallery-card />
<x-public.breadcrumb />
<x-public.pagination />
<x-public.search-modal />
<x-public.language-switcher />
<x-public.newsletter />
<x-public.footer />
```

---

# L. UI/UX ADMIN DASHBOARD

Gunakan tampilan dashboard profesional dengan:

* Sidebar.
* Topbar.
* Breadcrumb.
* Page title.
* Search.
* Notification dropdown.
* User menu.
* Responsive mobile navigation.
* Dashboard cards.
* Tables.
* Filters.
* Form sections.
* Tabs.
* Status badge.
* Modal confirmation.
* Toast notification.

Admin harus nyaman digunakan untuk data besar.

## Komponen Blade Admin

Buat reusable component:

```text
<x-admin.layout />
<x-admin.sidebar />
<x-admin.topbar />
<x-admin.breadcrumb />
<x-admin.page-header />
<x-admin.stat-card />
<x-admin.card />
<x-admin.table />
<x-admin.status-badge />
<x-admin.filter-panel />
<x-admin.input />
<x-admin.select />
<x-admin.textarea />
<x-admin.file-upload />
<x-admin.image-upload />
<x-admin.rich-editor />
<x-admin.modal />
<x-admin.confirmation-dialog />
<x-admin.empty-state />
<x-admin.alert />
<x-admin.toast />
<x-admin.pagination />
```

Hindari file Blade yang terlalu besar.

Pisahkan component berdasarkan tanggung jawab.

---

# M. SEO

Implementasikan:

* SEO title.
* Meta description.
* Canonical URL.
* Open Graph.
* Twitter Card.
* Structured data.
* XML sitemap.
* Robots.txt.
* Breadcrumb schema.
* Article schema.
* Event schema.
* Organization schema.
* Hreflang untuk multi-language.
* Slug yang bersih.
* Redirect jika slug berubah.

Halaman draft, admin, preview, dan internal tidak boleh terindeks.

---

# N. KEAMANAN

Implementasikan minimum:

1. CSRF protection.
2. XSS prevention.
3. SQL injection prevention.
4. Mass assignment protection.
5. Form Request validation.
6. Authorization Policy.
7. Rate limiting.
8. Secure file upload.
9. MIME type validation.
10. File size validation.
11. Randomized storage filename.
12. Anti-spam.
13. CAPTCHA jika disetujui.
14. Secure session configuration.
15. Password hashing.
16. Login throttling.
17. Email verification bila diperlukan.
18. Two-factor authentication opsional untuk administrator.
19. Audit log.
20. Soft delete.
21. Backup strategy.
22. Security headers.
23. Sanitasi rich text.
24. Jangan expose stack trace pada production.
25. Jangan menyimpan secret di repository.

Pastikan file upload tidak dapat dieksekusi sebagai script.

Batasi file yang diperbolehkan berdasarkan modul.

---

# O. PERFORMANCE

Lakukan:

* Eager loading.
* Pagination.
* Database indexing.
* Cache untuk setting dan menu.
* Cache untuk halaman yang jarang berubah.
* Image optimization.
* Responsive image.
* Lazy loading.
* WebP jika memungkinkan.
* Queue untuk email.
* Queue untuk image processing jika diperlukan.
* Query monitoring pada development.
* Hindari N+1 query.
* Vite asset optimization.
* Gunakan CDN jika dikonfigurasi.

---

# P. ACCESSIBILITY

Target minimal WCAG 2.1 AA secara praktis.

Periksa:

* Semantic HTML.
* Heading hierarchy.
* Alt text.
* Keyboard navigation.
* Focus state.
* Color contrast.
* Form label.
* Error announcement.
* ARIA hanya jika diperlukan.
* Skip to content.
* Reduced motion.
* Tombol dan link memiliki nama yang jelas.

---

# Q. NOTIFIKASI

Notifikasi minimum:

* Konten diajukan ke verifikator.
* Konten dikembalikan untuk revisi.
* Konten berhasil diverifikasi.
* Konten menunggu approval.
* Konten disetujui.
* Konten ditolak.
* Konten berhasil dipublikasikan.
* Pendaftaran event berhasil.
* Form kemitraan diterima.
* Minat investasi diterima.
* Pesan kontak diterima.

Channel:

* Database notification.
* Email notification.
* Channel lain hanya jika disetujui.

---

# R. TESTING

Buat automated test untuk:

## Authentication

* Login berhasil.
* Login gagal.
* Logout.
* User nonaktif tidak dapat login.
* Rate limiting login.

## Authorization

* Operator tidak dapat approve.
* Verifikator tidak dapat mengubah permission.
* Approver dapat menyetujui konten terverifikasi.
* Guest tidak dapat mengakses admin.
* User tidak dapat mengakses resource di luar permission.

## Workflow

* Draft dapat dikirim.
* Submitted dapat diverifikasi.
* Konten dapat dikembalikan untuk revisi.
* Verified dapat disetujui.
* Approved dapat dipublikasikan.
* Scheduled dipublikasikan pada waktunya.
* Rejected tidak tampil di publik.
* Audit log tercatat.

## Public Website

* Berita published tampil.
* Berita draft tidak tampil.
* Scheduled content belum tampil sebelum waktunya.
* Search bekerja.
* Filter bekerja.
* Download document tercatat.
* Form dapat dikirim.
* Spam dibatasi.

## Validation

* File tidak valid ditolak.
* Ukuran file terlalu besar ditolak.
* Field wajib divalidasi.
* Slug unik.
* Email valid.
* URL valid.

Gunakan factory dan seeder agar test tidak tergantung data manual.

---

# S. SEEDER DAN DEMO DATA

Buat seeder untuk:

* Role.
* Permission.
* Super Administrator.
* Kategori berita.
* Kategori dokumen.
* Sektor investasi.
* Wilayah Indonesia.
* FAQ.
* Menu.
* Setting dasar.
* Data demo secukupnya.

Gunakan data demo profesional dan relevan.

Jangan menggunakan lorem ipsum pada tampilan akhir jika konten contoh yang relevan dapat dibuat.

Credential development harus berasal dari environment variable atau dijelaskan dengan aman di dokumentasi.

---

# T. ROUTE STRUCTURE

Gunakan struktur route yang konsisten.

Contoh public route:

```text
/
locale.switch
profile.*
news.*
programs.*
events.*
publications.*
galleries.*
investments.*
products.*
cooperations.*
services.*
contact.*
search
newsletter.subscribe
```

Contoh admin route:

```text
admin.dashboard
admin.posts.*
admin.events.*
admin.documents.*
admin.galleries.*
admin.investments.*
admin.products.*
admin.partners.*
admin.forms.*
admin.users.*
admin.roles.*
admin.permissions.*
admin.workflows.*
admin.audit-logs.*
admin.settings.*
```

Gunakan:

* Route name.
* Route group.
* Prefix.
* Middleware.
* Route model binding.

Jangan membuat URL admin tanpa authorization.

---

# U. STRUKTUR FOLDER

Gunakan struktur yang mengikuti konvensi Laravel.

Contoh tambahan:

```text
app/
├── Actions/
├── Enums/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   └── Public/
│   ├── Requests/
│   │   ├── Admin/
│   │   └── Public/
│   └── Resources/
├── Models/
├── Notifications/
├── Policies/
├── Services/
├── Support/
└── View/
    └── Components/

resources/views/
├── admin/
├── public/
├── components/
│   ├── admin/
│   └── public/
├── emails/
└── errors/
```

Jangan membuat folder atau abstraction yang tidak memiliki manfaat nyata.

---

# V. TAHAP IMPLEMENTASI

Kerjakan secara bertahap.

## Fase 1 — Audit Project

Sebelum menulis kode:

1. Baca struktur repository.
2. Periksa versi Laravel.
3. Periksa PHP.
4. Periksa package.
5. Periksa authentication yang tersedia.
6. Periksa struktur database.
7. Periksa Tailwind dan Vite.
8. Periksa coding style.
9. Identifikasi kode yang dapat digunakan ulang.
10. Laporkan risiko sebelum perubahan besar.

Output fase ini:

* Ringkasan kondisi project.
* Struktur penting.
* Dependency penting.
* Risiko.
* Rencana implementasi.
* Daftar file yang akan dibuat atau diubah.

## Fase 2 — Fondasi Sistem

Kerjakan:

* Authentication.
* Role.
* Permission.
* Policy.
* Base layout.
* Admin layout.
* Public layout.
* Design system.
* Setting.
* Audit log.

## Fase 3 — Workflow Konten

Kerjakan:

* Status enum.
* Workflow model.
* Revision.
* Verification.
* Approval.
* Notification.
* Timeline.
* Policy.
* Test.

## Fase 4 — CMS Inti

Kerjakan:

* Berita.
* Kategori.
* Tag.
* Halaman statis.
* Media library.
* Banner.
* Menu.
* Sambutan.
* Profil.

## Fase 5 — Program, Agenda, dan Publikasi

Kerjakan:

* Program.
* Agenda.
* Registrasi event.
* Laporan kegiatan.
* Dokumen.
* Galeri.

## Fase 6 — Potensi Daerah dan Investasi

Kerjakan:

* Potensi investasi.
* Produk unggulan.
* UMKM.
* Sektor.
* Wilayah.
* Peta peluang bisnis.

## Fase 7 — Layanan Publik

Kerjakan:

* Kemitraan.
* Minat investasi.
* Kontak.
* Pengaduan.
* FAQ.
* Newsletter.

## Fase 8 — Penyempurnaan

Kerjakan:

* Multi-language.
* SEO.
* Sitemap.
* Analytics.
* Performance.
* Accessibility.
* Security review.
* Automated test.
* Documentation.

Jangan mengerjakan seluruh fase sekaligus jika berisiko menghasilkan kode yang tidak terkontrol.

---

# W. FORMAT RESPONS CODEX

Pada setiap tahap, berikan respons dalam format berikut:

## 1. Analisis

Jelaskan kondisi dan masalah yang ditemukan.

## 2. Rencana Perubahan

Sebutkan fitur yang akan dibuat.

## 3. File yang Diubah

Tuliskan:

```text
CREATE: path/file
UPDATE: path/file
DELETE: path/file
```

Jangan menghapus file tanpa alasan kuat.

## 4. Implementasi

Tulis kode lengkap, bukan hanya potongan yang tidak dapat digunakan.

## 5. Perintah Terminal

Berikan perintah yang perlu dijalankan.

Contoh:

```bash
php artisan migrate
php artisan db:seed
npm run build
php artisan test
```

Jangan menjalankan perintah destruktif tanpa izin.

## 6. Verifikasi

Jelaskan:

* Route yang diuji.
* Role yang diuji.
* Form yang diuji.
* Test yang dijalankan.
* Hasil test.
* Risiko yang masih tersisa.

## 7. Langkah Berikutnya

Tuliskan satu fase paling logis untuk dikerjakan setelah implementasi saat ini.

---

# X. LARANGAN

Jangan melakukan hal berikut:

1. Jangan menggunakan `php artisan migrate:fresh` tanpa izin.
2. Jangan menghapus data produksi.
3. Jangan mengubah `.env` secara sembarangan.
4. Jangan menaruh API key di source code.
5. Jangan menonaktifkan CSRF.
6. Jangan menggunakan `{!! $content !!}` tanpa sanitasi.
7. Jangan memberikan akses admin berdasarkan pengecekan role di tampilan saja.
8. Jangan menaruh business logic kompleks di Blade.
9. Jangan menaruh seluruh logic di controller.
10. Jangan membuat satu file Blade berukuran sangat besar.
11. Jangan menggunakan query di dalam loop.
12. Jangan membuat migration yang merusak data lama.
13. Jangan mengganti dependency inti tanpa pemeriksaan kompatibilitas.
14. Jangan menggunakan CDN untuk dependency utama tanpa alasan.
15. Jangan menganggap fitur selesai tanpa validasi dan authorization.
16. Jangan menampilkan konten draft kepada guest.
17. Jangan memperbolehkan operator menyetujui kontennya sendiri.
18. Jangan membuat antarmuka yang hanya baik pada desktop.
19. Jangan menggunakan animasi berlebihan.
20. Jangan menambahkan fitur di luar scope sebelum fitur inti stabil.

---

# Y. ACCEPTANCE CRITERIA UTAMA

Aplikasi dianggap memenuhi requirement minimum apabila:

1. Guest dapat mengakses website publik secara responsif.
2. Guest dapat membaca berita, agenda, program, publikasi, dan potensi investasi.
3. Guest dapat mencari konten.
4. Guest dapat mengunduh dokumen publik.
5. Guest dapat mendaftar kegiatan.
6. Guest dapat mengirim formulir kemitraan dan kontak.
7. Operator dapat membuat dan mengajukan konten.
8. Verifikator dapat memverifikasi atau meminta revisi.
9. Approver dapat menyetujui, menolak, dan menjadwalkan publikasi.
10. Konten yang belum disetujui tidak tampil di publik.
11. Sistem menyimpan audit trail.
12. Permission diterapkan di backend.
13. Media upload tervalidasi.
14. Semua form memiliki validasi.
15. Website berfungsi pada mobile dan desktop.
16. Halaman memiliki SEO metadata.
17. Multi-language dapat dikembangkan atau telah tersedia.
18. Automated test untuk fitur kritis berhasil.
19. Tidak terdapat error console utama.
20. Tidak terdapat N+1 query pada listing utama.
21. Dokumentasi instalasi dan penggunaan admin tersedia.

---

# Z. INSTRUKSI PERTAMA

Mulai dengan **Fase 1 — Audit Project**.

Jangan langsung membuat seluruh aplikasi.

Lakukan pemeriksaan repository, lalu berikan:

1. Ringkasan arsitektur saat ini.
2. Versi teknologi yang digunakan.
3. Daftar fitur yang sudah ada.
4. Daftar fitur yang belum ada.
5. Masalah teknis yang ditemukan.
6. Risiko perubahan.
7. Rekomendasi struktur aplikasi.
8. Rencana pengerjaan per fase.
9. Daftar file yang akan dibuat atau diubah pada fase berikutnya.

Setelah audit selesai, kerjakan fase berikutnya secara bertahap dan pastikan setiap fase dapat dijalankan serta diuji sebelum melanjutkan.

# MODUL TAMBAHAN — PORTAL UMKM DAN PROMOSI PRODUK INTERNASIONAL

Kembangkan modul khusus bernama:

**IMT-GT UMKM International Business Showcase**

Modul ini menjadi media bagi UMKM untuk:

1. Mendaftarkan usahanya.
2. Membuat company profile.
3. Mendaftarkan produk yang dijual.
4. Mempromosikan produk kepada pembeli dan investor luar negeri.
5. Menampilkan kapasitas produksi dan kesiapan ekspor.
6. Menerima permintaan informasi, kerja sama, investasi, dan pembelian.
7. Menampilkan profil serta produk dalam beberapa bahasa.
8. Mengikuti proses verifikasi sebelum profil dan produknya ditampilkan kepada publik.

Modul tidak harus menjadi e-commerce dengan transaksi pembayaran pada fase awal.

Prioritaskan fungsi:

* Business directory.
* Product catalogue.
* Investment showcase.
* Export readiness profile.
* Business matching.
* Request for quotation.
* Partnership inquiry.
* Investor inquiry.
* Virtual exhibition.

---

# A. ROLE TAMBAHAN: PELAKU UMKM

Tambahkan role:

## UMKM Owner

UMKM Owner merupakan pemilik atau perwakilan resmi UMKM yang telah mendaftar.

Hak akses:

* Membuat dan memperbarui profil UMKM.
* Mengunggah logo, foto usaha, legalitas, sertifikasi, dan company profile.
* Mendaftarkan produk.
* Mengedit produk miliknya.
* Mengunggah foto, video, katalog, dan dokumen produk.
* Menambahkan informasi kesiapan ekspor.
* Mengelola informasi kontak bisnis.
* Melihat status verifikasi profil dan produk.
* Menindaklanjuti catatan revisi.
* Melihat pesan atau inquiry yang masuk.
* Membalas inquiry melalui sistem jika fitur komunikasi internal tersedia.
* Melihat statistik kunjungan profil dan produk.
* Menandai produk aktif atau tidak tersedia.
* Mengajukan profil atau produk untuk dipublikasikan.
* Mengelola terjemahan konten usahanya.

Batasan:

* UMKM hanya boleh mengelola data usaha miliknya.
* UMKM tidak boleh mempublikasikan profil dan produk secara langsung.
* UMKM tidak dapat mengubah hasil verifikasi.
* UMKM tidak dapat melihat inquiry milik UMKM lain.
* UMKM tidak dapat mengakses modul administrasi utama.
* Dokumen legal tertentu hanya dapat dilihat oleh administrator dan verifikator.

---

# B. PROSES PENDAFTARAN UMKM

Sediakan alur:

```text
Registrasi Akun
→ Verifikasi Email
→ Melengkapi Identitas Pemilik
→ Melengkapi Profil UMKM
→ Mengunggah Dokumen Pendukung
→ Mengirim Pengajuan
→ Verifikasi Admin
→ Revisi jika Diperlukan
→ Disetujui
→ Profil UMKM Aktif
```

Form registrasi minimal memuat:

## Informasi Pemilik atau Penanggung Jawab

* Nama lengkap.
* Nomor identitas opsional sesuai kebijakan.
* Jabatan.
* Email.
* Nomor telepon.
* WhatsApp.
* Alamat korespondensi.
* Password.
* Persetujuan syarat dan kebijakan privasi.

## Informasi Awal UMKM

* Nama usaha.
* Nama merek.
* Bentuk badan usaha.
* Tahun berdiri.
* Sektor usaha.
* Kabupaten atau kota.
* Alamat usaha.
* Nomor telepon usaha.
* Email bisnis.
* Website.
* Media sosial.
* Deskripsi singkat.

Keamanan registrasi:

* Email verification.
* CAPTCHA atau anti-bot.
* Rate limiting.
* Password policy.
* Persetujuan pemrosesan data.
* Pencegahan duplikasi berdasarkan email, nomor legalitas, atau identifier yang disepakati.
* Audit log registrasi dan perubahan data.

---

# C. COMPANY PROFILE UMKM

Setiap UMKM dapat membuat halaman company profile profesional.

URL contoh:

```text
/id/umkm/nama-usaha
/en/smes/business-name
/ms/pks/nama-perniagaan
/th/sme/business-name
```

## Informasi Identitas Usaha

Tampilkan:

* Nama resmi usaha.
* Nama merek.
* Logo.
* Cover image.
* Tagline.
* Slug.
* Tahun berdiri.
* Bentuk usaha.
* Skala usaha.
* Jumlah tenaga kerja opsional.
* Nama pemilik atau pimpinan jika diizinkan.
* Sektor industri.
* Kategori usaha.
* Lokasi usaha.
* Wilayah pemasaran.
* Status verifikasi.
* Status featured atau unggulan.

## Deskripsi Perusahaan

Sediakan field:

* Ringkasan usaha.
* Sejarah usaha.
* Visi.
* Misi.
* Nilai utama.
* Keunggulan usaha.
* Proses produksi.
* Teknologi yang digunakan.
* Dampak sosial.
* Dampak lingkungan.
* Cerita perkembangan usaha.
* Unique selling proposition.
* Business model ringkas.
* Target pasar.
* Potensi pengembangan.

## Informasi Legalitas

Data yang dapat dikelola:

* Nomor Induk Berusaha.
* Bentuk badan usaha.
* NPWP usaha jika diperlukan.
* Nomor izin usaha.
* Nomor PIRT.
* Sertifikasi halal.
* Sertifikasi BPOM.
* Hak kekayaan intelektual atau merek.
* Sertifikasi SNI.
* Sertifikasi ISO.
* Sertifikasi lingkungan.
* Sertifikasi ekspor.
* Sertifikasi lain.

Ketentuan privasi:

* Administrator menentukan data legalitas mana yang tampil di publik.
* Nomor dokumen sensitif dapat disamarkan.
* File legalitas tidak boleh tersedia sebagai public URL tanpa authorization.
* Dokumen legal harus melalui validasi tipe file.
* Setiap perubahan dokumen legal tercatat dalam audit log.

## Informasi Ekspor dan Investasi

Sediakan data:

* Status kesiapan ekspor.
* Pernah ekspor atau belum.
* Negara tujuan ekspor.
* Negara target.
* Kode HS produk jika tersedia.
* Kapasitas produksi.
* Kapasitas produksi tambahan.
* Minimum order quantity.
* Lead time produksi.
* Kemampuan private label.
* Kemampuan OEM atau ODM.
* Standar kualitas.
* Metode pengemasan.
* Pelabuhan atau titik pengiriman.
* Incoterms yang didukung.
* Mata uang transaksi.
* Kebutuhan investasi.
* Nilai kebutuhan investasi.
* Tujuan penggunaan investasi.
* Bentuk kerja sama yang dicari.
* Distributor yang dicari.
* Mitra teknologi yang dicari.
* Mitra ekspor yang dicari.
* Kebutuhan peningkatan kapasitas.
* Estimasi peluang pertumbuhan.

Pilihan status kesiapan ekspor:

```text
Belum Siap Ekspor
Dalam Persiapan
Siap Ekspor
Sudah Melakukan Ekspor
```

Pilihan bentuk kerja sama:

```text
Buyer
Distributor
Reseller
Importer
Export Partner
Investor
Technology Partner
Manufacturing Partner
Private Label
OEM
ODM
Joint Venture
Mentoring
Financing
```

## Media Company Profile

UMKM dapat mengunggah:

* Logo.
* Cover.
* Foto pemilik atau tim.
* Foto tempat usaha.
* Foto proses produksi.
* Foto fasilitas.
* Video profil.
* Company profile PDF.
* Katalog produk.
* Sertifikat.
* Achievement.
* Press coverage.

Semua media harus:

* Memiliki caption.
* Memiliki alt text.
* Memiliki credit jika diperlukan.
* Dikompresi.
* Memiliki thumbnail.
* Memenuhi validasi ukuran dan MIME type.
* Dapat ditinjau admin sebelum dipublikasikan.

---

# D. PENDAFTARAN DAN PENGELOLAAN PRODUK

UMKM dapat menambahkan lebih dari satu produk.

Setiap produk memiliki status:

```text
Draft
→ Submitted
→ Under Verification
→ Revision Required
→ Verified
→ Waiting Approval
→ Approved
→ Published
→ Unpublished
→ Archived
```

## Informasi Utama Produk

Field minimal:

* Nama produk.
* Slug.
* Nama merek.
* SKU opsional.
* Kategori produk.
* Subkategori.
* Ringkasan produk.
* Deskripsi lengkap.
* Keunggulan produk.
* Unique selling proposition.
* Bahan utama.
* Komposisi.
* Variasi.
* Ukuran.
* Berat.
* Dimensi.
* Warna.
* Rasa.
* Kemasan.
* Masa simpan.
* Cara penyimpanan.
* Cara penggunaan.
* Negara asal.
* Daerah asal.
* Status ketersediaan.
* Produk unggulan.
* Produk siap ekspor.

## Informasi Komersial

Sediakan:

* Harga retail opsional.
* Harga grosir opsional.
* Rentang harga.
* Mata uang.
* Harga berdasarkan permintaan.
* Minimum order quantity.
* Unit minimum order.
* Kapasitas produksi per bulan.
* Lead time.
* Sampel tersedia atau tidak.
* Private label tersedia atau tidak.
* OEM tersedia atau tidak.
* ODM tersedia atau tidak.
* Wilayah pengiriman.
* Metode pengiriman.
* Incoterms.
* Port of loading.
* Payment terms dalam bentuk informasi, bukan pembayaran langsung.

Untuk pasar internasional, harga tidak wajib ditampilkan.

Sediakan pilihan:

```text
Tampilkan Harga
Tampilkan Rentang Harga
Hubungi untuk Harga
Request for Quotation
```

## Sertifikasi Produk

Produk dapat memiliki:

* Halal.
* BPOM.
* PIRT.
* SNI.
* HACCP.
* GMP.
* ISO.
* Organic certification.
* Fair trade.
* Merek atau HKI.
* Sertifikasi negara tujuan.
* Sertifikasi lainnya.

Setiap sertifikasi memiliki:

* Nama.
* Nomor opsional.
* Lembaga penerbit.
* Tanggal terbit.
* Masa berlaku.
* File bukti.
* Status verifikasi.
* Visibilitas publik.

## Media Produk

UMKM dapat mengunggah:

* Foto utama.
* Multiple product images.
* Foto kemasan.
* Foto penggunaan produk.
* Foto proses produksi.
* Video produk.
* Brosur.
* Product specification sheet.
* Katalog PDF.
* Sertifikat.

Aturan foto:

* Gambar utama wajib.
* Minimal resolusi ditentukan.
* Rasio gambar konsisten.
* Format JPG, PNG, atau WebP.
* Kompresi otomatis.
* Alt text wajib.
* Watermark opsional.
* Maksimal jumlah gambar dapat dikonfigurasi.

---

# E. HALAMAN PUBLIK DIREKTORI UMKM

Tambahkan menu utama:

```text
UMKM dan Produk
```

Submenu:

```text
Direktori UMKM
Katalog Produk
UMKM Siap Ekspor
Produk Unggulan
Peluang Investasi UMKM
Virtual Expo
```

## Direktori UMKM

Halaman menyediakan:

* Search.
* Filter sektor.
* Filter kategori.
* Filter kabupaten atau kota.
* Filter status kesiapan ekspor.
* Filter sertifikasi.
* Filter bentuk kerja sama.
* Filter negara tujuan ekspor.
* Filter UMKM terverifikasi.
* Filter UMKM unggulan.
* Sort terbaru.
* Sort paling banyak dilihat.
* Sort alfabet.
* Pagination atau load more.

Card UMKM menampilkan:

* Logo.
* Nama usaha.
* Nama merek.
* Lokasi.
* Sektor.
* Ringkasan.
* Status verifikasi.
* Status siap ekspor.
* Produk unggulan.
* Bentuk kerja sama yang dicari.
* Tombol lihat profil.

## Detail Company Profile

Halaman detail menampilkan:

1. Cover dan logo.
2. Nama usaha.
3. Verified badge.
4. Ringkasan perusahaan.
5. Informasi lokasi.
6. Tahun berdiri.
7. Sektor usaha.
8. Visi dan misi.
9. Keunggulan.
10. Kapasitas produksi.
11. Kesiapan ekspor.
12. Negara target.
13. Sertifikasi.
14. Galeri usaha.
15. Video profil.
16. Produk yang ditawarkan.
17. Kebutuhan investasi.
18. Bentuk kerja sama.
19. Company profile PDF.
20. Tombol business inquiry.
21. Tombol investment inquiry.
22. Tombol request for quotation.
23. Tombol bagikan profil.
24. Produk terkait.
25. UMKM serupa.

Informasi kontak pribadi tidak ditampilkan secara langsung jika kebijakan platform mewajibkan penggunaan inquiry form.

---

# F. HALAMAN PUBLIK KATALOG PRODUK

## Product Listing

Sediakan:

* Search produk.
* Filter kategori.
* Filter wilayah.
* Filter sertifikasi.
* Filter kesiapan ekspor.
* Filter private label.
* Filter OEM atau ODM.
* Filter harga jika tersedia.
* Filter minimum order.
* Filter produk unggulan.
* Filter UMKM terverifikasi.
* Filter status stok.
* Sorting.

Card produk menampilkan:

* Foto utama.
* Nama produk.
* Nama UMKM.
* Lokasi.
* Kategori.
* Ringkasan.
* Harga atau label “Contact for Price”.
* Minimum order.
* Status siap ekspor.
* Sertifikasi utama.
* Verified badge.
* Tombol lihat produk.
* Tombol inquiry.

## Detail Produk

Halaman detail menampilkan:

1. Product image gallery.
2. Video produk.
3. Nama produk.
4. Nama merek.
5. Nama UMKM.
6. Verified badge.
7. Deskripsi.
8. Keunggulan.
9. Spesifikasi.
10. Bahan atau komposisi.
11. Variasi.
12. Ukuran dan berat.
13. Informasi kemasan.
14. Masa simpan.
15. Harga atau request price.
16. Minimum order quantity.
17. Kapasitas produksi.
18. Lead time.
19. Private label.
20. OEM atau ODM.
21. Wilayah pengiriman.
22. Kesiapan ekspor.
23. Sertifikasi.
24. Dokumen produk.
25. Request for quotation.
26. Business inquiry.
27. Investment inquiry.
28. Tombol bagikan.
29. Produk lain dari UMKM yang sama.
30. Produk serupa.

Tambahkan structured data `Product` dan `Organization` untuk SEO.

---

# G. BUSINESS INQUIRY DAN INVESTMENT INQUIRY

Sediakan beberapa tipe inquiry.

## 1. Product Inquiry

Untuk calon pembeli yang ingin meminta informasi produk.

Field:

* Nama.
* Nama perusahaan.
* Negara.
* Email bisnis.
* Nomor telepon.
* Produk.
* Jumlah kebutuhan.
* Satuan.
* Waktu kebutuhan.
* Negara tujuan.
* Pesan.
* Lampiran opsional.

## 2. Request for Quotation

Field:

* Produk.
* Varian.
* Kuantitas.
* Unit.
* Target price opsional.
* Mata uang.
* Negara tujuan.
* Incoterm.
* Waktu pengiriman.
* Packaging requirement.
* Private label requirement.
* Pesan.

## 3. Partnership Inquiry

Field:

* Nama perusahaan.
* Negara.
* Jenis kerja sama.
* Ringkasan proposal.
* Target kerja sama.
* Periode.
* Pesan.
* Lampiran.

## 4. Investment Inquiry

Field:

* Nama investor atau institusi.
* Negara.
* Jenis investor.
* Kisaran investasi.
* Mata uang.
* Sektor yang diminati.
* UMKM yang diminati.
* Bentuk investasi.
* Rencana kerja sama.
* Pesan.
* Lampiran.

## Ketentuan Inquiry

Setiap inquiry harus:

* Memiliki nomor tiket.
* Dikirim kepada UMKM terkait.
* Tercatat di dashboard UMKM.
* Dapat dipantau administrator.
* Memiliki status.
* Memiliki catatan tindak lanjut.
* Memiliki proteksi anti-spam.
* Memiliki rate limiting.
* Memerlukan persetujuan kebijakan privasi.
* Tidak mengekspos email UMKM secara langsung jika tidak diperlukan.
* Mengirim notifikasi email dan database.

Status inquiry:

```text
New
Opened
In Review
Contacted
Negotiation
Completed
Closed
Spam
Rejected
```

Administrator dapat menandai inquiry mencurigakan atau spam.

---

# H. DASHBOARD KHUSUS UMKM

Buat layout dashboard UMKM yang lebih sederhana daripada dashboard administrator.

Menu:

```text
Dashboard
Profil Usaha
Produk Saya
Company Profile
Legalitas dan Sertifikasi
Kesiapan Ekspor
Kebutuhan Investasi
Galeri
Pesan dan Inquiry
Statistik
Notifikasi
Pengaturan Akun
```

## Dashboard Summary

Tampilkan:

* Status verifikasi akun.
* Kelengkapan profil dalam persentase.
* Jumlah produk.
* Produk published.
* Produk perlu revisi.
* Inquiry baru.
* Total kunjungan profil.
* Total kunjungan produk.
* Jumlah download katalog.
* Negara asal pengunjung jika analytics tersedia.
* Checklist peningkatan profil.
* Notifikasi terbaru.

## Profile Completion

Buat progress indicator berdasarkan:

* Identitas usaha.
* Deskripsi.
* Logo.
* Cover.
* Legalitas.
* Sertifikasi.
* Informasi kontak.
* Informasi ekspor.
* Produk.
* Galeri.
* Terjemahan.
* Company profile PDF.

Berikan rekomendasi seperti:

```text
Tambahkan deskripsi bahasa Inggris.
Lengkapi informasi kapasitas produksi.
Tambahkan minimum order quantity.
Unggah sertifikasi produk.
Tambahkan foto fasilitas produksi.
```

---

# I. WORKFLOW VERIFIKASI UMKM DAN PRODUK

Workflow profil UMKM:

```text
Draft
→ Submitted
→ Administrative Review
→ Revision Required
→ Verified
→ Waiting Approval
→ Approved
→ Published
→ Suspended
→ Archived
```

Workflow produk:

```text
Draft
→ Submitted
→ Content Review
→ Product Verification
→ Revision Required
→ Verified
→ Approved
→ Published
→ Unpublished
→ Archived
```

Aspek yang diverifikasi:

## Profil UMKM

* Identitas usaha.
* Kepemilikan akun.
* Alamat.
* Legalitas.
* Informasi kontak.
* Kesesuaian kategori.
* Kebenaran informasi.
* Foto dan media.
* Bahasa.
* Potensi kerja sama.
* Kesiapan ekspor.

## Produk

* Nama produk.
* Kategori.
* Kepemilikan produk.
* Deskripsi.
* Foto.
* Harga jika ditampilkan.
* Kapasitas produksi.
* Sertifikasi.
* Klaim produk.
* Informasi ekspor.
* Informasi kemasan.
* Terjemahan.

Ketentuan:

* Klaim kesehatan atau kualitas harus dapat diverifikasi.
* Produk yang dilarang oleh hukum tidak boleh dipublikasikan.
* Produk palsu, melanggar merek, atau tidak jelas kepemilikannya ditolak.
* Administrator dapat menonaktifkan profil atau produk.
* Alasan penolakan dan revisi harus tercatat.
* Setiap perubahan material setelah published dapat memerlukan verifikasi ulang.

---

# J. MULTI-LANGUAGE UMKM DAN PRODUK

Sediakan empat bahasa:

```text
id = Bahasa Indonesia
en = English
ms = Bahasa Melayu
th = ภาษาไทย
```

Bahasa Indonesia atau Melayu dapat menggunakan konten dasar yang sama, tetapi tetap sediakan translation record terpisah agar terminologi dapat disesuaikan.

Setiap profil dan produk memiliki terjemahan untuk:

* Nama tampilan jika diperlukan.
* Tagline.
* Ringkasan.
* Deskripsi.
* Sejarah usaha.
* Visi.
* Misi.
* Keunggulan.
* Informasi investasi.
* Bentuk kerja sama.
* Nama produk.
* Deskripsi produk.
* Spesifikasi.
* Bahan.
* Cara penggunaan.
* Informasi kemasan.
* SEO title.
* Meta description.
* Alt text.
* Caption.

Gunakan tabel terjemahan.

Contoh:

```text
businesses
business_translations

products
product_translations

business_investment_profiles
business_investment_profile_translations
```

Struktur translation minimal:

```text
id
translatable_id
locale
name
slug
summary
description
seo_title
meta_description
created_at
updated_at
```

Ketentuan:

1. Bahasa default adalah Indonesia.
2. Bahasa Inggris sangat direkomendasikan untuk profil yang menyasar investor luar negeri.
3. Bahasa Melayu dan Thailand dapat ditambahkan oleh UMKM atau penerjemah.
4. Jika terjemahan belum tersedia, gunakan fallback Indonesia.
5. Tampilkan indikator kelengkapan setiap bahasa.
6. Terjemahan dapat diverifikasi secara terpisah.
7. Pengguna dapat menyimpan terjemahan sebagai draft.
8. Terjemahan mesin tidak langsung dipublikasikan tanpa review.
9. Nama merek dan nama legal tidak diterjemahkan kecuali diperlukan.
10. Satuan, mata uang, dan format angka mengikuti locale.

Contoh URL:

```text
/id/umkm/nama-usaha
/en/smes/business-name
/ms/pks/nama-perniagaan
/th/sme/business-name

/id/produk/nama-produk
/en/products/product-name
/ms/produk/nama-produk
/th/products/product-name
```

## Translation Assistance

Sistem dapat menyediakan fitur:

* Copy from Indonesian.
* Translation draft.
* Translation status.
* Reviewer notes.
* Machine translation integration opsional.
* Glossary istilah perdagangan.
* Glossary nama sektor.
* Glossary sertifikasi.
* Translation completeness percentage.

Status translation:

```text
Not Started
Draft
Submitted
Needs Revision
Verified
Published
```

---

# K. FITUR INVESTOR DAN PEMBELI INTERNASIONAL

Tambahkan landing page:

```text
Discover Indonesia SMEs
Investment-Ready SMEs
Export-Ready Products
Business Opportunities
Partner with Indonesia SMEs
```

Halaman ditujukan kepada:

* Investor.
* Importer.
* Distributor.
* Retail buyer.
* Hotel dan restoran.
* E-commerce.
* Manufacturer.
* Export aggregator.
* Government agency.
* Trade association.
* International business chamber.

Sediakan filter:

* Investment range.
* Business sector.
* Export readiness.
* Production capacity.
* Country target.
* Partnership type.
* Certification.
* Location.
* Business age.
* Featured business.

Sediakan CTA:

```text
Contact Business
Request Product Catalogue
Request Quotation
Discuss Partnership
Express Investment Interest
Schedule Business Meeting
```

Opsional:

* Investor dapat membuat shortlist UMKM.
* Investor dapat menyimpan produk favorit.
* Investor dapat mengirim satu inquiry ke beberapa UMKM.
* Administrator dapat memfasilitasi business matching.
* Administrator dapat membuat daftar UMKM untuk virtual pitching.

---

# L. VIRTUAL EXPO

Sediakan arsitektur untuk fitur Virtual Expo.

Struktur:

* Expo.
* Tema expo.
* Periode.
* Daftar exhibitor.
* Booth UMKM.
* Produk yang dipamerkan.
* Video profil.
* Download katalog.
* Jadwal pitching.
* Jadwal business matching.
* Live event link.
* Inquiry.
* Statistik kunjungan.

Setiap booth menampilkan:

* Logo.
* Cover booth.
* Company profile.
* Produk unggulan.
* Video.
* Katalog.
* Sertifikasi.
* Contact atau inquiry.
* Bahasa yang tersedia.

Virtual Expo dapat diaktifkan berdasarkan event tertentu.

---

# M. FITUR PROMOSI DAN FEATURED CONTENT

Administrator dapat menandai:

* Featured UMKM.
* Featured product.
* Export-ready UMKM.
* Investment-ready UMKM.
* Success story.
* Product of the month.
* New product.
* Sustainable product.
* Innovative product.

Ketentuan:

* Featured status memiliki periode mulai dan berakhir.
* Alasan penetapan dapat dicatat.
* Konten featured harus sudah verified.
* Penempatan featured dicatat pada audit log.
* Jangan membuat sistem featured berbayar pada fase awal kecuali diminta.

Homepage dapat menampilkan section:

```text
Featured Indonesia SMEs
Export-Ready Products
Investment Opportunities
Success Stories
Sustainable Products
Newly Registered Products
```

---

# N. STATISTIK UMKM

UMKM dapat melihat statistik yang aman dan ringkas:

* Kunjungan company profile.
* Kunjungan produk.
* Produk paling banyak dilihat.
* Download katalog.
* Jumlah inquiry.
* Jenis inquiry.
* Negara asal inquiry.
* Negara asal pengunjung jika data tersedia.
* Conversion dari kunjungan ke inquiry.
* Periode statistik.
* Status tindak lanjut inquiry.

Administrator dapat melihat:

* Jumlah UMKM terdaftar.
* UMKM verified.
* UMKM aktif.
* UMKM per wilayah.
* UMKM per sektor.
* UMKM siap ekspor.
* Jumlah produk.
* Produk verified.
* Inquiry per negara.
* Inquiry per sektor.
* UMKM paling banyak dilihat.
* Produk paling banyak diminati.
* Nilai indikatif kebutuhan investasi jika tersedia.

Pastikan statistik tidak mengekspos data pribadi pengunjung.

---

# O. STRUKTUR DATABASE TAMBAHAN

Tambahkan tabel:

```text
businesses
business_translations
business_owners
business_categories
business_category_relations
business_legal_documents
business_certifications
business_export_profiles
business_export_countries
business_investment_profiles
business_investment_profile_translations
business_partnership_types

products
product_translations
product_categories
product_category_relations
product_variants
product_images
product_documents
product_certifications
product_prices
product_shipping_profiles

business_inquiries
business_inquiry_messages
business_inquiry_attachments

business_views
product_views
catalogue_downloads
business_favorites
product_favorites

virtual_expos
virtual_expo_translations
virtual_expo_booths
virtual_expo_products
virtual_expo_schedules

translation_reviews
verification_documents
```

## Tabel `businesses`

Minimal memuat:

```text
id
owner_user_id
name
brand_name
slug
business_type
established_year
sector_id
region_id
address
latitude
longitude
phone
whatsapp
email
website
employee_range
export_readiness_status
verification_status
is_verified
is_featured
featured_until
published_at
created_by
updated_by
deleted_by
created_at
updated_at
deleted_at
```

## Tabel `business_translations`

```text
id
business_id
locale
tagline
summary
description
history
vision
mission
advantages
production_process
social_impact
environmental_impact
seo_title
meta_description
translation_status
verified_by
verified_at
created_at
updated_at
```

## Tabel `products`

```text
id
business_id
category_id
sku
brand_name
slug
origin_region_id
currency
price_type
retail_price
wholesale_price
minimum_price
maximum_price
minimum_order_quantity
minimum_order_unit
production_capacity
production_capacity_unit
production_period
lead_time_days
shelf_life
stock_status
is_export_ready
is_private_label_available
is_oem_available
is_odm_available
is_verified
is_featured
verification_status
published_at
created_by
updated_by
deleted_by
created_at
updated_at
deleted_at
```

## Tabel `product_translations`

```text
id
product_id
locale
name
summary
description
advantages
materials
composition
specifications
packaging_information
storage_information
usage_information
seo_title
meta_description
translation_status
verified_by
verified_at
created_at
updated_at
```

## Tabel `business_inquiries`

```text
id
ticket_number
business_id
product_id
inquiry_type
sender_name
company_name
country_code
email
phone
quantity
quantity_unit
investment_range_min
investment_range_max
currency
partnership_type
subject
message
status
assigned_to
opened_at
responded_at
closed_at
created_at
updated_at
```

Gunakan encrypted cast untuk data tertentu jika diperlukan.

Tambahkan index pada:

* business_id.
* product_id.
* slug.
* locale.
* verification_status.
* export_readiness_status.
* is_verified.
* is_featured.
* published_at.
* sector_id.
* region_id.
* country_code.
* inquiry_type.
* status.

---

# P. POLICY DAN AUTHORIZATION UMKM

Buat Policy untuk:

```text
BusinessPolicy
ProductPolicy
BusinessLegalDocumentPolicy
BusinessCertificationPolicy
BusinessInquiryPolicy
VirtualExpoBoothPolicy
```

Aturan minimum:

* UMKM hanya mengubah profil miliknya.
* UMKM hanya mengubah produk miliknya.
* Produk milik UMKM lain tidak dapat diakses melalui admin action.
* UMKM tidak dapat mengubah `is_verified`.
* UMKM tidak dapat mengubah `published_at`.
* UMKM tidak dapat mengubah status approval.
* UMKM tidak dapat melihat dokumen legal UMKM lain.
* Verifikator dapat melihat dokumen sesuai permission.
* Guest hanya melihat profil dan produk published.
* Data suspended tidak tampil kepada publik.
* Inquiry hanya dapat dilihat pengirim, UMKM penerima, dan administrator jika akun investor tersedia.

Jangan hanya menyembunyikan tombol di UI.

Semua aturan harus diterapkan pada backend.

---

# Q. VALIDASI PRODUK DAN PROFIL

## Validasi Profil

* Nama usaha wajib.
* Nama merek opsional.
* Sektor wajib.
* Wilayah wajib.
* Alamat wajib.
* Email bisnis valid.
* Nomor telepon divalidasi.
* Website harus URL valid.
* Tahun berdiri tidak boleh melebihi tahun berjalan.
* Logo harus berupa gambar valid.
* Company profile harus PDF.
* Dokumen legal dibatasi berdasarkan MIME type.

## Validasi Produk

* Nama produk wajib.
* Kategori wajib.
* Deskripsi wajib.
* Gambar utama wajib.
* Harga tidak boleh negatif.
* Minimum order harus lebih dari nol jika diisi.
* Kapasitas produksi tidak boleh negatif.
* Currency harus berasal dari daftar yang valid.
* Kode negara harus valid.
* Klaim sertifikasi harus memiliki dokumen pendukung jika diwajibkan.
* Produk tidak boleh dipublikasikan tanpa UMKM terverifikasi.
* Produk harus memiliki minimal satu terjemahan published.
* Produk siap ekspor harus memiliki data kapasitas dan minimum order.

---

# R. NOTIFIKASI TAMBAHAN

Buat notifikasi:

* Registrasi UMKM diterima.
* Email berhasil diverifikasi.
* Profil UMKM diajukan.
* Profil membutuhkan revisi.
* Profil berhasil diverifikasi.
* Profil disetujui.
* Profil dipublikasikan.
* Profil ditangguhkan.
* Produk diajukan.
* Produk membutuhkan revisi.
* Produk berhasil diverifikasi.
* Produk dipublikasikan.
* Inquiry baru diterima.
* Inquiry belum ditindaklanjuti.
* Terjemahan membutuhkan revisi.
* Sertifikasi akan kedaluwarsa.
* Featured period akan berakhir.
* Virtual Expo akan dimulai.

Channel:

* Database.
* Email.
* WhatsApp hanya jika integrasi resmi tersedia dan disetujui.

---

# S. TESTING TAMBAHAN

Buat automated test untuk:

## Registrasi UMKM

* Guest dapat mendaftar sebagai UMKM.
* Email verification wajib.
* Akun duplikat ditolak.
* User biasa tidak otomatis menjadi UMKM terverifikasi.
* Profil belum approved tidak tampil di publik.

## Authorization

* UMKM hanya dapat mengedit profil sendiri.
* UMKM tidak dapat mengedit produk UMKM lain.
* UMKM tidak dapat mengubah status verified.
* Guest tidak dapat mengakses dashboard UMKM.
* Produk draft tidak tampil di publik.

## Workflow

* Profil dapat diajukan.
* Profil dapat diminta revisi.
* Profil dapat diverifikasi.
* Produk tidak dapat published jika profil belum verified.
* Produk dapat dijadwalkan.
* Profil suspended tidak tampil di direktori.

## Multi-language

* Profil dapat memiliki empat bahasa.
* Fallback locale bekerja.
* Translation draft tidak tampil.
* Slug unik per locale.
* Metadata SEO sesuai locale.

## Inquiry

* Guest dapat mengirim inquiry.
* Inquiry tercatat pada UMKM yang benar.
* Email tujuan tidak terekspos.
* Spam dan request berulang dibatasi.
* UMKM lain tidak dapat melihat inquiry.
* Attachment tidak valid ditolak.

---

# T. ACCEPTANCE CRITERIA MODUL UMKM

Modul UMKM dianggap selesai apabila:

1. Pelaku UMKM dapat melakukan registrasi.
2. Pelaku UMKM dapat membuat company profile.
3. Pelaku UMKM dapat mengunggah legalitas dan sertifikasi.
4. Pelaku UMKM dapat menambahkan beberapa produk.
5. Produk memiliki informasi komersial dan kesiapan ekspor.
6. UMKM dapat menyediakan profil dalam bahasa Indonesia, Inggris, Melayu, dan Thailand.
7. Produk dapat diterjemahkan ke empat bahasa.
8. Admin dapat memverifikasi profil UMKM.
9. Admin dapat memverifikasi produk.
10. Profil dan produk yang belum approved tidak tampil kepada publik.
11. Investor dapat mencari UMKM berdasarkan sektor dan kesiapan investasi.
12. Pembeli dapat mencari produk berdasarkan kategori dan kesiapan ekspor.
13. Pengunjung dapat mengirim product inquiry.
14. Pengunjung dapat mengirim request for quotation.
15. Investor dapat mengirim investment inquiry.
16. UMKM dapat melihat inquiry yang diterimanya.
17. Administrator dapat memantau tindak lanjut inquiry.
18. Data legal sensitif tidak dapat diakses secara publik.
19. Profil dan produk memiliki SEO metadata.
20. Statistik dasar dapat dilihat UMKM.
21. Seluruh akses dilindungi menggunakan Policy.
22. Fitur kritis memiliki automated test.
23. Tampilan responsif pada mobile, tablet, dan desktop.
24. Dashboard UMKM mudah digunakan oleh pengguna nonteknis.
25. Website berfungsi sebagai media promosi internasional, bukan sekadar daftar produk.

---

# U. URUTAN IMPLEMENTASI MODUL UMKM

Kerjakan modul ini dalam fase berikut:

## Fase UMKM 1 — Fondasi

* Role UMKM Owner.
* Registrasi.
* Email verification.
* Dashboard UMKM.
* Business ownership.
* Policy.

## Fase UMKM 2 — Company Profile

* Profil usaha.
* Legalitas.
* Sertifikasi.
* Media usaha.
* Company profile PDF.
* Profile completeness.

## Fase UMKM 3 — Produk

* CRUD produk.
* Kategori.
* Varian.
* Harga.
* Foto.
* Dokumen.
* Sertifikasi produk.

## Fase UMKM 4 — Verifikasi

* Submission.
* Review.
* Revision.
* Verification.
* Approval.
* Publication.
* Audit log.
* Notification.

## Fase UMKM 5 — Public Directory

* Direktori UMKM.
* Katalog produk.
* Detail UMKM.
* Detail produk.
* Filter.
* Search.
* SEO.

## Fase UMKM 6 — Multi-language

* Indonesia.
* Inggris.
* Melayu.
* Thailand.
* Translation dashboard.
* Translation review.
* Localized SEO.

## Fase UMKM 7 — Business Matching

* Product inquiry.
* Request for quotation.
* Partnership inquiry.
* Investment inquiry.
* Dashboard tindak lanjut.

## Fase UMKM 8 — Pengembangan Lanjutan

* Virtual Expo.
* Investor shortlist.
* Business meeting.
* Analytics.
* Featured campaign.
* Export readiness assessment.

Kerjakan setiap fase secara terpisah.

Jangan langsung membangun seluruh modul UMKM dalam satu perubahan besar.

