<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Greeting;
use App\Models\MediaItem;
use App\Models\MenuItem;
use App\Models\NewsPost;
use App\Models\ProfileSection;
use App\Models\StaticPage;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CmsSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::query()->first();

        $mediaItems = collect([
            ['title' => 'Hero Kawasan', 'type' => 'image', 'source_url' => 'https://placehold.co/1200x800/e0f2fe/0f172a?text=IMT-GT+Hero', 'alt_text' => 'Hero kawasan'],
            ['title' => 'Forum Investasi', 'type' => 'image', 'source_url' => 'https://placehold.co/1200x800/dcfce7/0f172a?text=Forum+Investasi', 'alt_text' => 'Forum investasi'],
            ['title' => 'UMKM Showcase', 'type' => 'image', 'source_url' => 'https://placehold.co/1200x800/fef3c7/0f172a?text=UMKM+Showcase', 'alt_text' => 'UMKM showcase'],
        ])->map(fn (array $item) => MediaItem::query()->updateOrCreate(
            ['title' => $item['title']],
            $item + ['caption' => $item['title'], 'is_featured' => true]
        ));

        $categories = collect([
            ['name' => 'Kerja Sama', 'description' => 'Berita kerja sama dan hubungan regional.'],
            ['name' => 'Program', 'description' => 'Program strategis dan kegiatan kelembagaan.'],
            ['name' => 'UMKM', 'description' => 'Promosi produk unggulan dan penguatan UMKM.'],
        ])->map(fn (array $item) => Category::query()->updateOrCreate(
            ['slug' => Str::slug($item['name'])],
            $item + ['slug' => Str::slug($item['name'])]
        ));

        $tags = collect(['investasi', 'perdagangan', 'pariwisata', 'umkm', 'regional'])
            ->map(fn (string $name) => Tag::query()->updateOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => Str::title($name), 'slug' => Str::slug($name)]
            ));

        $newsPosts = [
            [
                'title' => 'IMT-GT BC Riau membuka promosi investasi kawasan semester II 2026',
                'excerpt' => 'Rangkaian promosi investasi kawasan difokuskan pada sektor logistik, pangan, dan ekonomi maritim.',
                'body' => 'Konten dummy berita untuk modul CMS inti. Artikel ini mensimulasikan press release resmi yang dikelola melalui dashboard admin.',
                'featured' => true,
                'category' => 'kerja-sama',
                'tags' => ['investasi', 'regional'],
                'media' => 'Hero Kawasan',
            ],
            [
                'title' => 'Forum perdagangan lintas batas mempertemukan pemerintah dan pelaku usaha',
                'excerpt' => 'Agenda perdagangan regional disiapkan untuk membuka peluang pasar yang lebih luas.',
                'body' => 'Konten dummy forum perdagangan yang dapat disunting dari admin panel.',
                'featured' => true,
                'category' => 'program',
                'tags' => ['perdagangan', 'regional'],
                'media' => 'Forum Investasi',
            ],
            [
                'title' => 'Kurasi produk unggulan ekspor menargetkan sektor pangan dan kriya',
                'excerpt' => 'Program penguatan UMKM menitikberatkan pada kesiapan pasar dan kualitas presentasi produk.',
                'body' => 'Konten dummy untuk pemberitaan kurasi produk unggulan daerah.',
                'featured' => false,
                'category' => 'umkm',
                'tags' => ['umkm', 'pariwisata'],
                'media' => 'UMKM Showcase',
            ],
        ];

        foreach ($newsPosts as $postData) {
            $newsPost = NewsPost::query()->updateOrCreate(
                ['slug' => Str::slug($postData['title'])],
                [
                    'category_id' => $categories->firstWhere('slug', $postData['category'])?->id,
                    'user_id' => $admin?->id,
                    'media_item_id' => $mediaItems->firstWhere('title', $postData['media'])?->id,
                    'title' => $postData['title'],
                    'slug' => Str::slug($postData['title']),
                    'excerpt' => $postData['excerpt'],
                    'body' => $postData['body'],
                    'status' => 'published',
                    'featured' => $postData['featured'],
                    'published_at' => now(),
                ]
            );

            $newsPost->tags()->sync(
                $tags->whereIn('slug', collect($postData['tags'])->map(fn ($tag) => Str::slug($tag))->all())->pluck('id')->all()
            );
        }

        $pages = [
            ['title' => 'Tentang IMT-GT BC Riau', 'excerpt' => 'Gambaran umum kelembagaan.', 'body' => 'Halaman statis dummy untuk company profile.', 'status' => 'published'],
            ['title' => 'Kerja Sama Internasional', 'excerpt' => 'Penjelasan hubungan regional.', 'body' => 'Halaman statis dummy mengenai kerja sama internasional.', 'status' => 'published'],
        ];

        foreach ($pages as $page) {
            StaticPage::query()->updateOrCreate(
                ['slug' => Str::slug($page['title'])],
                $page + [
                    'slug' => Str::slug($page['title']),
                    'user_id' => $admin?->id,
                    'published_at' => now(),
                ]
            );
        }

        $banners = [
            ['title' => 'Gateway Perdagangan Regional', 'subtitle' => 'Mendorong koneksi dagang, investasi, dan promosi kawasan secara terstruktur.', 'media' => 'Hero Kawasan'],
            ['title' => 'Forum Investasi dan Logistik', 'subtitle' => 'Menyatukan agenda prioritas lintas negara dalam satu ruang promosi.', 'media' => 'Forum Investasi'],
            ['title' => 'Showcase UMKM Unggulan', 'subtitle' => 'Mempersiapkan etalase produk unggulan dan peluang business matching.', 'media' => 'UMKM Showcase'],
        ];

        foreach ($banners as $index => $banner) {
            Banner::query()->updateOrCreate(
                ['title' => $banner['title']],
                [
                    'media_item_id' => $mediaItems->firstWhere('title', $banner['media'])?->id,
                    'title' => $banner['title'],
                    'subtitle' => $banner['subtitle'],
                    'cta_label' => 'Pelajari Detail',
                    'cta_url' => '#profil',
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]
            );
        }

        $menuItems = [
            ['title' => 'Beranda', 'url' => '#beranda'],
            ['title' => 'Profil', 'url' => '#profil'],
            ['title' => 'Program', 'url' => '#program'],
            ['title' => 'Publikasi', 'url' => '#publikasi'],
            ['title' => 'Potensi', 'url' => '#potensi'],
            ['title' => 'Kerjasama', 'url' => '#kerjasama'],
            ['title' => 'Layanan', 'url' => '#layanan'],
            ['title' => 'Kontak', 'url' => '#kontak'],
        ];

        foreach ($menuItems as $index => $menu) {
            MenuItem::query()->updateOrCreate(
                ['title' => $menu['title'], 'location' => 'header'],
                $menu + ['location' => 'header', 'sort_order' => $index + 1, 'target' => '_self', 'is_active' => true]
            );
        }

        Greeting::query()->updateOrCreate(
            ['name' => 'Sekretariat IMT-GT BC Riau'],
            [
                'position' => 'Pengelola Portal',
                'headline' => 'Menyajikan wajah IMT-GT BC Riau yang lebih tenang, kredibel, dan mudah dipahami.',
                'message' => 'Halaman publik ini dibuat dengan fokus pada orientasi pengguna: pengunjung langsung melihat konteks, lalu diarahkan ke profil, program, publikasi, potensi daerah, dan layanan tanpa harus menebak alur informasi.',
                'sort_order' => 1,
                'is_active' => true,
            ]
        );

        $profileSections = [
            ['section_key' => 'sejarah', 'title' => 'Sejarah', 'summary' => 'Latar belakang kelembagaan', 'body' => 'IMT-GT Business Centre hadir sebagai simpul informasi dan promosi kerja sama ekonomi kawasan.', 'media' => 'Hero Kawasan'],
            ['section_key' => 'visi', 'title' => 'Visi', 'summary' => 'Arah jangka panjang', 'body' => 'Menjadi pusat informasi, promosi, dan kolaborasi bisnis regional yang kredibel, modern, dan inklusif.', 'media' => 'Forum Investasi'],
            ['section_key' => 'misi', 'title' => 'Misi', 'summary' => 'Fokus penguatan layanan', 'body' => 'Mendorong jejaring perdagangan, investasi, pariwisata, dan penguatan UMKM melalui komunikasi yang terstruktur.', 'media' => 'UMKM Showcase'],
            ['section_key' => 'mitra', 'title' => 'Mitra & Jejaring', 'summary' => 'Kerja sama lintas pemangku kepentingan', 'body' => 'Kolaborasi antara pemerintah, bisnis, akademisi, dan asosiasi menjadi fondasi utama kerja sama kawasan.', 'media' => 'Hero Kawasan'],
        ];

        foreach ($profileSections as $index => $section) {
            ProfileSection::query()->updateOrCreate(
                ['section_key' => $section['section_key']],
                [
                    'media_item_id' => $mediaItems->firstWhere('title', $section['media'])?->id,
                    'section_key' => $section['section_key'],
                    'title' => $section['title'],
                    'summary' => $section['summary'],
                    'body' => $section['body'],
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]
            );
        }
    }
}
