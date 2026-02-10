<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('buku')->insert([

            /* =======================
               KATEGORI: FIKSI (id = 1)
               ======================= */

            [
                'kode_buku' => 'FK001',
                'judul_buku' => 'Funiculi Funicula',
                'penulis' => 'Toshikazu Kawaguchi',
                'penerbit' => 'Poplar Publishing',
                'tanggal_terbit' => '2015-01-01',
                'kategori_id' => 1,
                'stok' => 10,
                'sampul' => 'funiculi.jpg',
                'deskripsi' => 'Novel ini bercerita tentang sebuah kafe kecil di Tokyo yang memiliki kemampuan unik untuk membawa pengunjungnya ke masa lalu.
                                Setiap perjalanan waktu memiliki aturan ketat yang tidak boleh dilanggar oleh siapa pun.
                                Melalui kisah-kisah para pengunjung, pembaca diajak merenungkan penyesalan, cinta, dan kesempatan kedua.
                                Cerita disampaikan dengan sederhana namun penuh emosi yang menyentuh hati.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'FK002',
                'judul_buku' => 'Laut Bercerita',
                'penulis' => 'Leila S. Chudori',
                'penerbit' => 'Kepustakaan Populer Gramedia',
                'tanggal_terbit' => '2017-10-01',
                'kategori_id' => 1,
                'stok' => 8,
                'sampul' => 'laut_bercerita.jpg',
                'deskripsi' => 'Buku ini mengisahkan perjuangan para aktivis mahasiswa pada masa Orde Baru.
                                Cerita disampaikan melalui sudut pandang korban penculikan dan keluarganya yang ditinggalkan.
                                Novel ini memperlihatkan sisi kemanusiaan, ketakutan, dan harapan di tengah represi politik.
                                Pembaca diajak memahami sejarah melalui cerita yang emosional dan mendalam.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'FK003',
                'judul_buku' => 'Cantik Itu Luka',
                'penulis' => 'Eka Kurniawan',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tanggal_terbit' => '2002-01-01',
                'kategori_id' => 1,
                'stok' => 6,
                'sampul' => 'cantik_itu_luka.jpg',
                'deskripsi' => 'Novel ini menggabungkan realisme magis dengan sejarah Indonesia.
                                Mengisahkan kehidupan Dewi Ayu dan keturunannya yang penuh tragedi dan ironi.
                                Cerita dipenuhi kritik sosial, politik, serta budaya patriarki.
                                Gaya bahasanya khas dan kuat, menjadikan novel ini sangat berkesan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /* =========================
               KATEGORI: NON-FIKSI (id = 2)
               ========================= */

            [
                'kode_buku' => 'NF001',
                'judul_buku' => 'Atomic Habits',
                'penulis' => 'James Clear',
                'penerbit' => 'Penguin Random House',
                'tanggal_terbit' => '2018-10-16',
                'kategori_id' => 2,
                'stok' => 12,
                'sampul' => 'atomic_habits.jpg',
                'deskripsi' => 'Buku ini membahas bagaimana kebiasaan kecil dapat membawa perubahan besar dalam hidup.
                                Penulis menjelaskan konsep perubahan perilaku dengan pendekatan ilmiah dan praktis.
                                Disertai contoh nyata yang mudah dipahami dan diterapkan.
                                Cocok bagi siapa pun yang ingin memperbaiki kualitas hidup secara bertahap.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'NF002',
                'judul_buku' => 'Filosofi Teras',
                'penulis' => 'Henry Manampiring',
                'penerbit' => 'Kompas',
                'tanggal_terbit' => '2018-11-26',
                'kategori_id' => 2,
                'stok' => 9,
                'sampul' => 'filosofi_teras.jpg',
                'deskripsi' => 'Buku ini memperkenalkan filsafat Stoikisme dengan bahasa yang ringan.
                                Pembaca diajak memahami cara mengelola emosi dan pikiran secara rasional.
                                Konsep-konsep filsafat dijelaskan dengan contoh kehidupan sehari-hari.
                                Sangat relevan untuk menghadapi tekanan hidup modern.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'NF003',
                'judul_buku' => 'Sapiens',
                'penulis' => 'Yuval Noah Harari',
                'penerbit' => 'Harvill Secker',
                'tanggal_terbit' => '2011-01-01',
                'kategori_id' => 2,
                'stok' => 7,
                'sampul' => 'sapiens.jpg',
                'deskripsi' => 'Buku ini membahas sejarah umat manusia dari masa purba hingga modern.
                                Penulis mengaitkan biologi, sejarah, dan budaya secara komprehensif.
                                Banyak gagasan kritis yang memancing pembaca untuk berpikir ulang.
                                Cocok bagi pembaca yang menyukai wawasan mendalam tentang peradaban manusia.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /* =====================
               KATEGORI: NOVEL (id = 3)
               ===================== */

            [
                'kode_buku' => 'NV001',
                'judul_buku' => 'Hujan',
                'penulis' => 'Tere Liye',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tanggal_terbit' => '2016-01-01',
                'kategori_id' => 3,
                'stok' => 10,
                'sampul' => 'hujan.jpg',
                'deskripsi' => 'Novel ini berlatar dunia masa depan dengan teknologi canggih.
                                Mengisahkan tentang kehilangan, persahabatan, dan kenangan.
                                Cerita disampaikan dengan emosi yang kuat dan menyentuh.
                                Sangat cocok bagi pembaca yang menyukai drama romantis.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'NV002',
                'judul_buku' => 'Bumi',
                'penulis' => 'Tere Liye',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tanggal_terbit' => '2014-01-01',
                'kategori_id' => 3,
                'stok' => 11,
                'sampul' => 'bumi.jpg',
                'deskripsi' => 'Novel ini mengisahkan petualangan remaja dengan kekuatan istimewa.
                                Dunia paralel menjadi latar utama dalam cerita ini.
                                Dipenuhi aksi, misteri, dan persahabatan.
                                Menjadi awal dari serial petualangan yang sangat populer.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'NV003',
                'judul_buku' => 'Perahu Kertas',
                'penulis' => 'Dewi Lestari',
                'penerbit' => 'Bentang Pustaka',
                'tanggal_terbit' => '2009-01-01',
                'kategori_id' => 3,
                'stok' => 8,
                'sampul' => 'perahu_kertas.jpg',
                'deskripsi' => 'Novel ini mengisahkan perjalanan cinta dan pencarian jati diri.
                                Tokoh utama berjuang antara idealisme dan realitas hidup.
                                Cerita dikemas dengan bahasa yang puitis dan hangat.
                                Sangat cocok untuk pembaca yang menyukai kisah romantis inspiratif.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /* =====================
   KATEGORI: CERPEN (id = 4)
   ===================== */

            [
                'kode_buku' => 'CP001',
                'judul_buku' => 'Robohnya Surau Kami',
                'penulis' => '',
                'penerbit' => 'Balai Pustaka',
                'tanggal_terbit' => '1956-01-01',
                'kategori_id' => 4,
                'stok' => 7,
                'sampul' => 'robohnya_surau.jpg',
                'deskripsi' => 'Kumpulan cerpen ini menyindir kehidupan sosial dan religius masyarakat.
Cerita disampaikan dengan gaya satir yang tajam dan kritis.
Pembaca diajak berpikir ulang tentang makna ibadah dan kemanusiaan.
Karya ini menjadi salah satu cerpen klasik sastra Indonesia.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'CP002',
                'judul_buku' => 'Senja di Jakarta',
                'penulis' => 'Mochtar Lubis',
                'penerbit' => 'Yayasan Obor',
                'tanggal_terbit' => '1963-01-01',
                'kategori_id' => 4,
                'stok' => 6,
                'sampul' => 'senja_jakarta.jpg',
                'deskripsi' => 'Buku ini menggambarkan kehidupan masyarakat Jakarta pasca kemerdekaan.
Cerita-cerita pendeknya penuh realitas sosial dan konflik batin.
Penulis menampilkan sisi gelap kehidupan perkotaan.
Cocok untuk pembaca yang menyukai cerpen bernuansa serius.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'CP003',
                'judul_buku' => 'Sepotong Senja untuk Pacarku',
                'penulis' => 'Seno Gumira Ajidarma',
                'penerbit' => 'Gramedia',
                'tanggal_terbit' => '1991-01-01',
                'kategori_id' => 4,
                'stok' => 8,
                'sampul' => 'sepotong_senja.jpg',
                'deskripsi' => 'Cerpen-cerpen dalam buku ini sarat dengan simbol dan makna.
Bahasanya puitis namun tetap membumi.
Cerita menggambarkan cinta, kehilangan, dan kegelisahan manusia.
Menjadi salah satu karya cerpen modern yang berpengaruh.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /* =====================
   KATEGORI: KOMIK (id = 5)
   ===================== */

            [
                'kode_buku' => 'KM001',
                'judul_buku' => 'One Piece Vol. 1',
                'penulis' => 'Eiichiro Oda',
                'penerbit' => 'Shueisha',
                'tanggal_terbit' => '1997-07-22',
                'kategori_id' => 5,
                'stok' => 15,
                'sampul' => 'one_piece_1.jpg',
                'deskripsi' => 'Komik ini mengisahkan petualangan Monkey D. Luffy.
Ia bercita-cita menjadi Raja Bajak Laut.
Dunia One Piece penuh aksi, humor, dan persahabatan.
Sangat populer di kalangan remaja hingga dewasa.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'KM002',
                'judul_buku' => 'Naruto Vol. 1',
                'penulis' => 'Masashi Kishimoto',
                'penerbit' => 'Shueisha',
                'tanggal_terbit' => '1999-09-21',
                'kategori_id' => 5,
                'stok' => 14,
                'sampul' => 'naruto_1.jpg',
                'deskripsi' => 'Naruto adalah ninja muda yang bercita-cita menjadi Hokage.
Cerita dipenuhi aksi dan perjuangan hidup.
Nilai persahabatan dan pantang menyerah sangat kuat.
Komik ini menjadi salah satu manga terlaris sepanjang masa.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'KM003',
                'judul_buku' => 'Doraemon Vol. 1',
                'penulis' => 'Fujiko F. Fujio',
                'penerbit' => 'Shogakukan',
                'tanggal_terbit' => '1974-01-01',
                'kategori_id' => 5,
                'stok' => 12,
                'sampul' => 'doraemon_1.jpg',
                'deskripsi' => 'Doraemon adalah robot kucing dari masa depan.
Ia membantu Nobita dengan alat-alat ajaib.
Cerita ringan dan penuh pesan moral.
Sangat cocok untuk anak-anak dan keluarga.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /* =====================
   KATEGORI: BIOGRAFI (id = 6)
   ===================== */

            [
                'kode_buku' => 'BG001',
                'judul_buku' => 'Habibie & Ainun',
                'penulis' => 'B.J. Habibie',
                'penerbit' => 'THC Mandiri',
                'tanggal_terbit' => '2010-01-01',
                'kategori_id' => 6,
                'stok' => 9,
                'sampul' => 'habibie_ainun.jpg',
                'deskripsi' => 'Buku ini menceritakan kisah cinta Habibie dan Ainun.
Ditulis langsung oleh B.J. Habibie.
Penuh ketulusan, kesetiaan, dan perjuangan hidup.
Menjadi salah satu biografi paling menyentuh di Indonesia.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'BG002',
                'judul_buku' => 'Soekarno: Penyambung Lidah Rakyat',
                'penulis' => 'Cindy Adams',
                'penerbit' => 'Gunung Agung',
                'tanggal_terbit' => '1965-01-01',
                'kategori_id' => 6,
                'stok' => 6,
                'sampul' => 'soekarno.jpg',
                'deskripsi' => 'Biografi ini mengisahkan perjalanan hidup Ir. Soekarno.
Ditulis berdasarkan cerita langsung dari sang tokoh.
Membahas perjuangan kemerdekaan Indonesia.
Buku ini sarat nilai sejarah dan nasionalisme.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'BG003',
                'judul_buku' => 'Steve Jobs',
                'penulis' => 'Walter Isaacson',
                'penerbit' => 'Simon & Schuster',
                'tanggal_terbit' => '2011-10-24',
                'kategori_id' => 6,
                'stok' => 7,
                'sampul' => 'steve_jobs.jpg',
                'deskripsi' => 'Buku ini mengisahkan pendiri Apple, Steve Jobs.
Mengupas sisi jenius dan kontroversialnya.
Memberikan gambaran dunia teknologi modern.
Sangat inspiratif bagi pembaca muda.',
                'created_at' => now(),
                'updated_at' => now(),
            ],


            /* =====================
   KATEGORI: SAINS (id = 8)
   ===================== */

            [
                'kode_buku' => 'SN001',
                'judul_buku' => 'A Brief History of Time',
                'penulis' => 'Stephen Hawking',
                'penerbit' => 'Bantam Books',
                'tanggal_terbit' => '1988-04-01',
                'kategori_id' => 8,
                'stok' => 6,
                'sampul' => 'brief_history_time.jpg',
                'deskripsi' => 'Buku ini membahas asal-usul alam semesta secara ilmiah.
Konsep fisika kompleks dijelaskan dengan bahasa sederhana.
Membahas ruang, waktu, dan lubang hitam.
Menjadi bacaan wajib bagi pecinta sains.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'SN002',
                'judul_buku' => 'Cosmos',
                'penulis' => 'Carl Sagan',
                'penerbit' => 'Random House',
                'tanggal_terbit' => '1980-01-01',
                'kategori_id' => 8,
                'stok' => 5,
                'sampul' => 'cosmos.jpg',
                'deskripsi' => 'Cosmos mengajak pembaca menjelajahi alam semesta.
Buku ini menghubungkan sains dengan peradaban manusia.
Bahasanya puitis dan penuh kekaguman.
Sangat cocok bagi pembaca yang mencintai astronomi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'SN003',
                'judul_buku' => 'The Selfish Gene',
                'penulis' => 'Richard Dawkins',
                'penerbit' => 'Oxford University Press',
                'tanggal_terbit' => '1976-01-01',
                'kategori_id' => 8,
                'stok' => 4,
                'sampul' => 'selfish_gene.jpg',
                'deskripsi' => 'Buku ini membahas teori evolusi dari sudut pandang gen.
Menjelaskan perilaku makhluk hidup secara ilmiah.
Gagasannya kontroversial namun berpengaruh besar.
Cocok untuk pembaca yang ingin memahami biologi evolusioner.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /* =====================
   KATEGORI: TEKNOLOGI (id = 9)
   ===================== */

            [
                'kode_buku' => 'TK001',
                'judul_buku' => 'Clean Code',
                'penulis' => 'Robert C. Martin',
                'penerbit' => 'Prentice Hall',
                'tanggal_terbit' => '2008-08-01',
                'kategori_id' => 9,
                'stok' => 10,
                'sampul' => 'clean_code.jpg',
                'deskripsi' => 'Buku ini membahas cara menulis kode yang bersih dan rapi.
Dilengkapi contoh praktik pemrograman yang baik.
Sangat direkomendasikan bagi programmer pemula maupun profesional.
Membantu meningkatkan kualitas software secara keseluruhan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'TK002',
                'judul_buku' => 'The Pragmatic Programmer',
                'penulis' => 'Andrew Hunt & David Thomas',
                'penerbit' => 'Addison-Wesley',
                'tanggal_terbit' => '1999-10-20',
                'kategori_id' => 9,
                'stok' => 8,
                'sampul' => 'pragmatic_programmer.jpg',
                'deskripsi' => 'Buku ini membahas pola pikir programmer profesional.
Memberikan tips praktis dalam pengembangan software.
Bahasanya ringan dan penuh analogi.
Sangat cocok untuk pengembang aplikasi modern.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'TK003',
                'judul_buku' => 'Artificial Intelligence Basics',
                'penulis' => 'Tom Taulli',
                'penerbit' => 'Apress',
                'tanggal_terbit' => '2019-01-01',
                'kategori_id' => 9,
                'stok' => 7,
                'sampul' => 'ai_basics.jpg',
                'deskripsi' => 'Buku ini mengenalkan konsep dasar kecerdasan buatan.
Membahas machine learning dan deep learning.
Cocok untuk pemula yang ingin memahami AI.
Disertai contoh penggunaan di dunia nyata.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /* =====================
   KATEGORI: PENDIDIKAN (id = 10)
   ===================== */

            [
                'kode_buku' => 'PD001',
                'judul_buku' => 'Pendidikan Karakter',
                'penulis' => 'Thomas Lickona',
                'penerbit' => 'Bumi Aksara',
                'tanggal_terbit' => '2012-01-01',
                'kategori_id' => 10,
                'stok' => 9,
                'sampul' => 'pendidikan_karakter.jpg',
                'deskripsi' => 'Buku ini membahas pentingnya pendidikan karakter.
Menekankan nilai moral dalam proses pembelajaran.
Cocok untuk guru dan pendidik.
Mendukung pembentukan generasi berintegritas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'PD002',
                'judul_buku' => 'Strategi Pembelajaran',
                'penulis' => 'Wina Sanjaya',
                'penerbit' => 'Kencana',
                'tanggal_terbit' => '2010-01-01',
                'kategori_id' => 10,
                'stok' => 8,
                'sampul' => 'strategi_pembelajaran.jpg',
                'deskripsi' => 'Buku ini membahas metode dan strategi mengajar.
Membantu guru menciptakan pembelajaran efektif.
Disertai teori dan praktik pendidikan.
Sangat berguna dalam dunia akademik.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'PD003',
                'judul_buku' => 'Psikologi Pendidikan',
                'penulis' => 'Slavin',
                'penerbit' => 'Pearson',
                'tanggal_terbit' => '2011-01-01',
                'kategori_id' => 10,
                'stok' => 6,
                'sampul' => 'psikologi_pendidikan.jpg',
                'deskripsi' => 'Buku ini membahas perilaku belajar peserta didik.
Mengaitkan psikologi dengan proses pendidikan.
Memberikan wawasan tentang motivasi belajar.
Cocok bagi mahasiswa dan pendidik.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /* =====================
   KATEGORI: AGAMA (id = 11)
   ===================== */

            [
                'kode_buku' => 'AG001',
                'judul_buku' => 'Tafsir Ibnu Katsir',
                'penulis' => 'Ibnu Katsir',
                'penerbit' => 'Darul Fikr',
                'tanggal_terbit' => '2000-01-01',
                'kategori_id' => 11,
                'stok' => 5,
                'sampul' => 'tafsir_ibnu_katsir.jpg',
                'deskripsi' => 'Kitab tafsir ini menjelaskan ayat-ayat Al-Qur’an.
Menggunakan hadits dan pendapat ulama salaf.
Menjadi rujukan utama dalam kajian Islam.
Sangat cocok untuk studi keagamaan mendalam.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'AG002',
                'judul_buku' => 'La Tahzan',
                'penulis' => 'Aidh al-Qarni',
                'penerbit' => 'Qisthi Press',
                'tanggal_terbit' => '2004-01-01',
                'kategori_id' => 11,
                'stok' => 10,
                'sampul' => 'la_tahzan.jpg',
                'deskripsi' => 'Buku ini memberikan motivasi berbasis nilai Islam.
Mengajak pembaca untuk bersabar dan bersyukur.
Bahasanya ringan dan menyentuh.
Sangat cocok untuk penguatan mental dan spiritual.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'AG003',
                'judul_buku' => 'Fiqih Islam Lengkap',
                'penulis' => 'Sulaiman Rasyid',
                'penerbit' => 'Sinar Baru Algensindo',
                'tanggal_terbit' => '2001-01-01',
                'kategori_id' => 11,
                'stok' => 7,
                'sampul' => 'fiqih_islam.jpg',
                'deskripsi' => 'Buku ini membahas hukum-hukum Islam secara lengkap.
Disusun sistematis dan mudah dipahami.
Cocok untuk pelajar dan masyarakat umum.
Menjadi referensi fiqih sehari-hari.',
                'created_at' => now(),
                'updated_at' => now(),
            ],


            /* =====================
   KATEGORI: FILSAFAT (id = 12)
   ===================== */

            [
                'kode_buku' => 'FL001',
                'judul_buku' => 'Dunia Sophie',
                'penulis' => 'Jostein Gaarder',
                'penerbit' => 'Mizan',
                'tanggal_terbit' => '1991-01-01',
                'kategori_id' => 12,
                'stok' => 8,
                'sampul' => 'dunia_sophie.jpg',
                'deskripsi' => 'Novel ini menjadi pengantar filsafat yang sangat populer.
Mengisahkan seorang gadis yang belajar sejarah filsafat Barat.
Konsep berat disampaikan melalui cerita yang menarik.
Sangat cocok bagi pemula yang ingin memahami filsafat.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'FL002',
                'judul_buku' => 'Meditations',
                'penulis' => 'Marcus Aurelius',
                'penerbit' => 'Penguin Classics',
                'tanggal_terbit' => '0180-01-01',
                'kategori_id' => 12,
                'stok' => 6,
                'sampul' => 'meditations.jpg',
                'deskripsi' => 'Buku ini berisi pemikiran filsafat Stoikisme.
Ditulis sebagai refleksi pribadi seorang kaisar Romawi.
Membahas ketenangan, kebajikan, dan pengendalian diri.
Masih relevan untuk kehidupan modern saat ini.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'FL003',
                'judul_buku' => 'Being and Nothingness',
                'penulis' => 'Jean-Paul Sartre',
                'penerbit' => 'Gallimard',
                'tanggal_terbit' => '1943-01-01',
                'kategori_id' => 12,
                'stok' => 4,
                'sampul' => 'being_nothingness.jpg',
                'deskripsi' => 'Buku ini membahas filsafat eksistensialisme secara mendalam.
Menjelaskan kebebasan dan tanggung jawab manusia.
Bahasanya kompleks dan filosofis.
Cocok untuk pembaca tingkat lanjut.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /* =====================
   KATEGORI: PSIKOLOGI (id = 13)
   ===================== */

            [
                'kode_buku' => 'PS001',
                'judul_buku' => 'Man’s Search for Meaning',
                'penulis' => 'Viktor E. Frankl',
                'penerbit' => 'Beacon Press',
                'tanggal_terbit' => '1946-01-01',
                'kategori_id' => 13,
                'stok' => 7,
                'sampul' => 'mans_search_meaning.jpg',
                'deskripsi' => 'Buku ini mengisahkan pengalaman penulis di kamp konsentrasi.
Menghubungkan penderitaan dengan makna hidup.
Menjadi dasar pendekatan logoterapi.
Sangat inspiratif dan menyentuh.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'PS002',
                'judul_buku' => 'Thinking, Fast and Slow',
                'penulis' => 'Daniel Kahneman',
                'penerbit' => 'Farrar, Straus and Giroux',
                'tanggal_terbit' => '2011-01-01',
                'kategori_id' => 13,
                'stok' => 6,
                'sampul' => 'thinking_fast_slow.jpg',
                'deskripsi' => 'Buku ini membahas dua sistem berpikir manusia.
Mengulas bias kognitif dan pengambilan keputusan.
Ditulis oleh peraih Nobel Ekonomi.
Cocok untuk memahami cara kerja pikiran.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'PS003',
                'judul_buku' => 'Psikologi Kepribadian',
                'penulis' => 'Alwisol',
                'penerbit' => 'UMM Press',
                'tanggal_terbit' => '2014-01-01',
                'kategori_id' => 13,
                'stok' => 8,
                'sampul' => 'psikologi_kepribadian.jpg',
                'deskripsi' => 'Buku ini membahas teori-teori kepribadian utama.
Mulai dari psikoanalisis hingga humanistik.
Disusun sistematis untuk mahasiswa psikologi.
Sangat cocok sebagai buku referensi akademik.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /* =====================
   KATEGORI: SASTRA (id = 14)
   ===================== */

            [
                'kode_buku' => 'SS001',
                'judul_buku' => 'Laskar Pelangi',
                'penulis' => 'Andrea Hirata',
                'penerbit' => 'Bentang Pustaka',
                'tanggal_terbit' => '2005-01-01',
                'kategori_id' => 14,
                'stok' => 12,
                'sampul' => 'laskar_pelangi.jpg',
                'deskripsi' => 'Novel ini mengisahkan perjuangan anak-anak Belitung.
Mengangkat tema pendidikan dan persahabatan.
Bahasanya sederhana namun penuh makna.
Menjadi salah satu karya sastra Indonesia paling populer.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'SS002',
                'judul_buku' => 'Ronggeng Dukuh Paruk',
                'penulis' => 'Ahmad Tohari',
                'penerbit' => 'Gramedia',
                'tanggal_terbit' => '1982-01-01',
                'kategori_id' => 14,
                'stok' => 6,
                'sampul' => 'ronggeng_dukuh_paruk.jpg',
                'deskripsi' => 'Novel ini menggambarkan kehidupan desa tradisional.
Mengangkat budaya dan konflik sosial masyarakat.
Bahasanya kuat dan sarat makna.
Merupakan karya sastra klasik Indonesia.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'SS003',
                'judul_buku' => 'Tenggelamnya Kapal Van der Wijck',
                'penulis' => 'Buya Hamka',
                'penerbit' => 'Balai Pustaka',
                'tanggal_terbit' => '1938-01-01',
                'kategori_id' => 14,
                'stok' => 5,
                'sampul' => 'van_der_wijck.jpg',
                'deskripsi' => 'Novel ini mengisahkan cinta terhalang adat.
Latar budaya Minangkabau sangat kuat.
Cerita penuh tragedi dan nilai moral.
Menjadi karya sastra legendaris Indonesia.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /* =====================
   KATEGORI: BAHASA (id = 15)
   ===================== */

            [
                'kode_buku' => 'BH001',
                'judul_buku' => 'Kamus Besar Bahasa Indonesia',
                'penulis' => 'Tim Penyusun',
                'penerbit' => 'Balai Pustaka',
                'tanggal_terbit' => '2016-01-01',
                'kategori_id' => 15,
                'stok' => 10,
                'sampul' => 'kbbi.jpg',
                'deskripsi' => 'KBBI merupakan rujukan resmi Bahasa Indonesia.
Memuat ribuan kosakata baku.
Digunakan dalam dunia pendidikan dan akademik.
Sangat penting bagi pelajar dan penulis.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'BH002',
                'judul_buku' => 'English Grammar in Use',
                'penulis' => 'Raymond Murphy',
                'penerbit' => 'Cambridge University Press',
                'tanggal_terbit' => '2004-01-01',
                'kategori_id' => 15,
                'stok' => 9,
                'sampul' => 'grammar_in_use.jpg',
                'deskripsi' => 'Buku ini menjadi panduan tata bahasa Inggris.
Disertai contoh dan latihan praktis.
Digunakan secara internasional.
Cocok untuk pemula hingga menengah.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'BH003',
                'judul_buku' => 'Linguistik Umum',
                'penulis' => 'Ferdinand de Saussure',
                'penerbit' => 'Gadjah Mada University Press',
                'tanggal_terbit' => '1916-01-01',
                'kategori_id' => 15,
                'stok' => 4,
                'sampul' => 'linguistik_umum.jpg',
                'deskripsi' => 'Buku ini membahas dasar-dasar ilmu linguistik.
Menjadi fondasi studi bahasa modern.
Bahasannya teoritis dan akademik.
Cocok untuk mahasiswa bahasa dan sastra.',
                'created_at' => now(),
                'updated_at' => now(),
            ],


            /* =====================
   KATEGORI: EKONOMI (id = 16)
   ===================== */

            [
                'kode_buku' => 'EK001',
                'judul_buku' => 'Pengantar Ilmu Ekonomi',
                'penulis' => 'N. Gregory Mankiw',
                'penerbit' => 'Salemba Empat',
                'tanggal_terbit' => '2014-01-01',
                'kategori_id' => 16,
                'stok' => 8,
                'sampul' => 'pengantar_ekonomi.jpg',
                'deskripsi' => 'Buku ini membahas konsep dasar ilmu ekonomi.
Mulai dari penawaran, permintaan, hingga pasar.
Disusun dengan bahasa yang mudah dipahami.
Cocok untuk mahasiswa dan pelajar ekonomi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'EK002',
                'judul_buku' => 'Ekonomi Mikro',
                'penulis' => 'Sadono Sukirno',
                'penerbit' => 'Rajawali Pers',
                'tanggal_terbit' => '2013-01-01',
                'kategori_id' => 16,
                'stok' => 6,
                'sampul' => 'ekonomi_mikro.jpg',
                'deskripsi' => 'Buku ini membahas perilaku konsumen dan produsen.
Menjelaskan teori pasar secara rinci.
Digunakan sebagai buku teks perguruan tinggi.
Sangat penting untuk memahami ekonomi modern.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'EK003',
                'judul_buku' => 'Ekonomi Makro',
                'penulis' => 'Boediono',
                'penerbit' => 'BPFE',
                'tanggal_terbit' => '2012-01-01',
                'kategori_id' => 16,
                'stok' => 5,
                'sampul' => 'ekonomi_makro.jpg',
                'deskripsi' => 'Buku ini membahas ekonomi dalam skala nasional.
Topik inflasi, pengangguran, dan pertumbuhan ekonomi.
Bahasannya sistematis dan terstruktur.
Cocok untuk pembelajaran ekonomi tingkat lanjut.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /* =====================
   KATEGORI: BISNIS (id = 17)
   ===================== */

            [
                'kode_buku' => 'BS001',
                'judul_buku' => 'Rich Dad Poor Dad',
                'penulis' => 'Robert T. Kiyosaki',
                'penerbit' => 'Warner Books',
                'tanggal_terbit' => '1997-01-01',
                'kategori_id' => 17,
                'stok' => 12,
                'sampul' => 'rich_dad.jpg',
                'deskripsi' => 'Buku ini membahas pola pikir dalam mengelola uang.
Perbandingan dua sudut pandang tentang kekayaan.
Memberikan inspirasi kemandirian finansial.
Sangat populer di kalangan pebisnis pemula.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'BS002',
                'judul_buku' => 'The Lean Startup',
                'penulis' => 'Eric Ries',
                'penerbit' => 'Crown Business',
                'tanggal_terbit' => '2011-01-01',
                'kategori_id' => 17,
                'stok' => 8,
                'sampul' => 'lean_startup.jpg',
                'deskripsi' => 'Buku ini membahas metode membangun startup.
Mengutamakan eksperimen dan validasi pasar.
Cocok untuk wirausahawan modern.
Membantu mengurangi risiko kegagalan bisnis.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'BS003',
                'judul_buku' => 'Good to Great',
                'penulis' => 'Jim Collins',
                'penerbit' => 'HarperBusiness',
                'tanggal_terbit' => '2001-01-01',
                'kategori_id' => 17,
                'stok' => 6,
                'sampul' => 'good_to_great.jpg',
                'deskripsi' => 'Buku ini meneliti perusahaan sukses jangka panjang.
Menjelaskan faktor kepemimpinan dan budaya kerja.
Berdasarkan riset mendalam.
Cocok untuk manajer dan eksekutif.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /* =====================
   KATEGORI: HUKUM (id = 18)
   ===================== */

            [
                'kode_buku' => 'HK001',
                'judul_buku' => 'Pengantar Ilmu Hukum',
                'penulis' => 'Sudikno Mertokusumo',
                'penerbit' => 'Liberty',
                'tanggal_terbit' => '2009-01-01',
                'kategori_id' => 18,
                'stok' => 7,
                'sampul' => 'pengantar_hukum.jpg',
                'deskripsi' => 'Buku ini membahas dasar-dasar ilmu hukum.
Menjelaskan sistem hukum dan peraturan.
Digunakan sebagai buku wajib mahasiswa hukum.
Bahasannya runtut dan mudah dipahami.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'HK002',
                'judul_buku' => 'Hukum Perdata',
                'penulis' => 'R. Subekti',
                'penerbit' => 'Intermasa',
                'tanggal_terbit' => '2008-01-01',
                'kategori_id' => 18,
                'stok' => 6,
                'sampul' => 'hukum_perdata.jpg',
                'deskripsi' => 'Buku ini membahas hubungan hukum antar individu.
Menjelaskan perjanjian dan tanggung jawab hukum.
Disusun berdasarkan KUH Perdata.
Sangat penting dalam praktik hukum perdata.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'HK003',
                'judul_buku' => 'Hukum Pidana',
                'penulis' => 'Moeljatno',
                'penerbit' => 'Bumi Aksara',
                'tanggal_terbit' => '2010-01-01',
                'kategori_id' => 18,
                'stok' => 5,
                'sampul' => 'hukum_pidana.jpg',
                'deskripsi' => 'Buku ini membahas tindak pidana dan sanksi hukum.
Mengulas asas-asas hukum pidana.
Digunakan dalam pendidikan hukum.
Cocok untuk pemahaman hukum dasar.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /* =====================
   KATEGORI: KESEHATAN (id = 19)
   ===================== */

            [
                'kode_buku' => 'KS001',
                'judul_buku' => 'Gizi Seimbang',
                'penulis' => 'Almatsier',
                'penerbit' => 'Gramedia',
                'tanggal_terbit' => '2015-01-01',
                'kategori_id' => 19,
                'stok' => 9,
                'sampul' => 'gizi_seimbang.jpg',
                'deskripsi' => 'Buku ini membahas pentingnya pola makan sehat.
Menjelaskan kebutuhan gizi harian.
Cocok untuk masyarakat umum.
Mendukung gaya hidup sehat.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'KS002',
                'judul_buku' => 'Hidup Sehat ala Rasulullah',
                'penulis' => 'Muhammad Al-Farisi',
                'penerbit' => 'Qisthi Press',
                'tanggal_terbit' => '2014-01-01',
                'kategori_id' => 19,
                'stok' => 8,
                'sampul' => 'hidup_sehat_rasulullah.jpg',
                'deskripsi' => 'Buku ini membahas pola hidup sehat Islami.
Mengacu pada sunnah Rasulullah SAW.
Menjelaskan kebiasaan makan dan olahraga.
Menggabungkan kesehatan fisik dan spiritual.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'KS003',
                'judul_buku' => 'Medical Physiology',
                'penulis' => 'Guyton & Hall',
                'penerbit' => 'Elsevier',
                'tanggal_terbit' => '2011-01-01',
                'kategori_id' => 19,
                'stok' => 4,
                'sampul' => 'medical_physiology.jpg',
                'deskripsi' => 'Buku ini membahas sistem tubuh manusia.
Digunakan dalam pendidikan kedokteran.
Bahasannya ilmiah dan mendalam.
Menjadi referensi utama mahasiswa kesehatan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /* =====================
   KATEGORI: UMUM / REFERENSI (id = 20)
   ===================== */

            [
                'kode_buku' => 'UM001',
                'judul_buku' => 'Ensiklopedia Nasional Indonesia',
                'penulis' => 'Tim Penyusun',
                'penerbit' => 'Cipta Adi Pustaka',
                'tanggal_terbit' => '2004-01-01',
                'kategori_id' => 20,
                'stok' => 6,
                'sampul' => 'ensiklopedia.jpg',
                'deskripsi' => 'Ensiklopedia ini memuat berbagai pengetahuan umum.
Mencakup sains, budaya, dan sejarah.
Digunakan sebagai sumber referensi.
Sangat berguna untuk pelajar dan umum.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'UM002',
                'judul_buku' => 'Atlas Dunia',
                'penulis' => 'National Geographic',
                'penerbit' => 'National Geographic Society',
                'tanggal_terbit' => '2013-01-01',
                'kategori_id' => 20,
                'stok' => 7,
                'sampul' => 'atlas_dunia.jpg',
                'deskripsi' => 'Atlas ini memuat peta dunia lengkap.
Disertai informasi geografis dan budaya.
Visualnya jelas dan informatif.
Cocok untuk pendidikan dan referensi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_buku' => 'UM003',
                'judul_buku' => 'Buku Pintar Pengetahuan Umum',
                'penulis' => 'Tim Redaksi',
                'penerbit' => 'Erlangga',
                'tanggal_terbit' => '2016-01-01',
                'kategori_id' => 20,
                'stok' => 10,
                'sampul' => 'pengetahuan_umum.jpg',
                'deskripsi' => 'Buku ini memuat berbagai fakta menarik.
Disusun dengan bahasa yang mudah dipahami.
Cocok untuk semua kalangan.
Menambah wawasan pengetahuan umum.',
                'created_at' => now(),
                'updated_at' => now(),
            ],


        ]);
    }
}
