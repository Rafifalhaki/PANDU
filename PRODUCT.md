# Product

<!-- impeccable:product-schema 1 -->

## Platform

web

## Users

- **Warga RT 04 / RW 17 Perumahan Pondok Tirta Mandala** (Blok P, Q, R, S, dan Al-Hikmah 1): Mayoritas mengakses portal lewat smartphone dari tautan grup WhatsApp untuk memantau saldo kas RT, membaca agenda pengumuman, memeriksa jadwal siskamling, mengecek syarat surat pengantar, dan mengirimkan aspirasi/laporan ke pengurus.
- **Pengurus RT 04 (Ketua RT, Sekretaris, Bendahara, Seksi-Seksi, dan Koordinator Humas Blok)**: Mengelola pencatatan kas secara mandiri dan memperbarui jadwal ronda serta pengumuman secara real-time.

## Product Purpose

Menyediakan portal pelayanan warga dan transparansi keuangan lingkungan tingkat RT yang akuntabel, bebas hambatan teknis, cepat, dan dapat diakses publik 24 jam secara gratis di GitHub Pages tanpa ketergantungan pada backend server rumit atau database pihak ketiga.

## Positioning

Satu-satunya sistem portal lingkungan warga perumahan yang memadukan transparansi pembukuan kas ala Buku Kas Umum (BKU), jadwal siskamling dinamis, dan kanal pengaduan WhatsApp langsung ke pengurus tanpa risiko kebocoran data pribadi (100% Client-Side Architecture).

## Operating Context

- Dioperasikan dalam lingkungan Perumahan Pondok Tirta Mandala, Kelurahan Sukamaju, Kecamatan Cilodong, Kota Depok.
- Mengakomodasi kebutuhan komunikasi warga lintas blok perumahan: Blok P (Hj. Diah), Blok Q (Reni), Blok R (Eva), Blok S (Ami), dan Blok Al-Hikmah 1 (Evi).
- Alur pengelolaan mutasi kas dijalankan secara *real-time* setiap kali transaksi terjadi oleh Bendahara/Pengurus, dengan penyimpanan lokal instan (*LocalStorage*) dan sinkronisasi 1-klik ke repository GitHub.

## Capabilities and Constraints

- **Kapabilitas**:
  - Tampilan publik tanpa login bagi seluruh warga.
  - Mode otentikasi pengurus (admin login) untuk manajemen data CRUD Kas, Pengumuman, dan Jadwal Ronda.
  - Visualisasi grafik arus kas bulanan berbasis Chart.js monokromatik/editorial.
  - Fitur ekspor mutasi kas ke format CSV untuk audit pembukuan fisik.
  - Integrasi pesan terstruktur ke WhatsApp API (`wa.me`) tanpa server backend.
- **Batasan**:
  - Static Site murni di-hosting di GitHub Pages (`https://rafifalhaki.github.io/RT04/`).
  - Seluruh path aset wajib relative (`./assets/...`).
  - Tidak menggunakan server backend dinamis (PHP/Node runtime) untuk produksi.

## Brand Commitments

- **Identitas**: RT 04 / RW 17 Perumahan Pondok Tirta Mandala, Kelurahan Sukamaju, Kecamatan Cilodong, Kota Depok 16415.
- **Slogan**: "Bersih, Nyaman, Religius".
- **Lambang Resmi**: Logo lingkaran Pondok Tirta Mandala dengan warna dominan biru tua dan aksen emas.
- **Tone & Voice**: Bersih, berwibawa, formal kenegaraan/civic, transparan, dan bersahabat bagi warga tetangga.

## Evidence on Hand

- Logo resmi RT 04 / RW 17 (`./assets/images/logo-rt04.jpg`).
- Struktur kepengurusan resmi yang telah disahkan: Dewan Penasehat (H. Hamdan Basar, Sutrisman, Pudji Kartono), Pengurus Inti (Agus Cholif, Ir. Arya Sadewo, Kawanto Wahyu P), serta Seksi Kepemudaan (Rafif), Seksi Lingkungan (Rahadi & Iwan Darmawan), Seksi Sosial (Hj. Maryam), dan Seksi Humas (Pudji Sabdo + 5 Perwakilan Blok).
- Data historis mutasi kas riil Oktober-November 2026.

## Product Principles

1. **Integritas & Keterbukaan Penuh**: Setiap rupiah dana iuran warga dicatat jelas secara real-time dan dapat diaudit warga kapan saja.
2. **Kenyamanan Warga Tanpa Hambatan**: Warga biasa tidak boleh dibebani login atau form berbelit-belit untuk mengakses hak informasi publik.
3. **Desain Civic yang Berwibawa**: Mengutamakan tipografi rapi, keterbacaan tinggi, dan estetika kelembagaan yang sah tanpa elemen visual artifisial / berlebihan.
4. **Mandiri & Nol Biaya Infrastruktur**: Bekerja optimal di GitHub Pages gratis tanpa perlu menyewa VPS atau server database berbayar.
