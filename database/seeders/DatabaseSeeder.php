<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tag;
use App\Models\Type;
use App\Models\User;
use App\Models\Feature;
use App\Models\Seating;
use App\Models\Kategori;
use App\Models\Fasilitas;
use App\Models\Entertaiment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [
            [
                'nama_panjang' => 'Superadmin',
                'email' => 'superadmin@gmail.com',
                'password' => bcrypt(12345678),
                'level' => 'Superadmin',
                'level_admin' => NULL,
            ], [
                'nama_panjang' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt(12345678),
                'level' => 'Admin',
                'level_admin' => 'Admin',
            ], [
                'nama_panjang' => 'Admin Resto & Cafe',
                'email' => 'admin-resto-and-cafe@gmail.com',
                'password' => bcrypt(12345678),
                'level' => 'Admin',
                'level_admin' => 'Food And Beverage',
            ], [
                'nama_panjang' => 'Admin Penginapan',
                'email' => 'admin-penginapan@gmail.com',
                'password' => bcrypt(12345678),
                'level' => 'Admin',
                'level_admin' => 'Lodging',
            ], [
                'nama_panjang' => 'Admin Public Area',
                'email' => 'admin-public-area@gmail.com',
                'password' => bcrypt(12345678),
                'level' => 'Admin',
                'level_admin' => 'Public Area',
            ], [
                'nama_panjang' => 'Admin Community',
                'email' => 'admin-community@gmail.com',
                'password' => bcrypt(12345678),
                'level' => 'Admin',
                'level_admin' => 'Activity Manajemen',
            ],
        ];

        User::insert($users);

        $tags = [
            [
                'tag' => 'Seminar',
                'slug' => 'seminar',
            ], [
                'tag' => 'Konser',
                'slug' => 'konser',
            ], [
                'tag' => 'Workshop',
                'slug' => 'workshop',
            ], [
                'tag' => 'Talkshow',
                'slug' => 'talkshow',
            ],
        ];

        Tag::insert($tags);

        $types = [
            [
                'type' => 'Seminar',
            ], [
                'type' => 'Konser',
            ], [
                'type' => 'Workshop',
            ], [
                'type' => 'Bazaar',
            ], [
                'type' => 'Festival',
            ], [
                'type' => 'Kegiatan Sosial',
            ], [
                'type' => 'Olahraga',
            ],
        ];

        Type::insert($types);
        
        $fasilitasies = [
            [
                'fasilitas' => 'Restoran',
            ], [
                'fasilitas' => 'Pusat Kebugaran',
            ], [
                'fasilitas' => 'AC',
            ], [
                'fasilitas' => 'Kolam Renang',
            ], [
                'fasilitas' => 'Layanan Resepsionis 24 Jam',
            ], [
                'fasilitas' => 'Bathtub',
            ], [
                'fasilitas' => 'WIFI',
            ],
        ];

        Fasilitas::insert($fasilitasies);

        $seatings = [
            [
                'seating' => 'Outdoor',
            ], [
                'seating' => 'Semi Outdoor',
            ], [
                'seating' => 'Indoor Non-Smoking',
            ], [
                'seating' => 'Indoor Smooking',
            ],
        ];

        Seating::insert($seatings);

        $features = [
            [
                'feature' => 'Debit/Kredit/QRIS',
            ], [
                'feature' => 'Cash Only',
            ], [
                'feature' => 'Free Wifi',
            ], [
                'feature' => 'Serves Alcohol',
            ],
        ];

        Feature::insert($features);


        $entertaiments = [
            [
                'entertaiment' => 'Live Music',
            ], [
                'entertaiment' => 'Public Viewing',
            ], [
                'entertaiment' => 'Sport Area',
            ], [
                'entertaiment' => 'Games Area',
            ], [
                'entertaiment' => 'Kids Area',
            ],
        ];

        Entertaiment::insert($entertaiments);

        $kategoris = [
            [
                'kategori' => 'Seminar',
                'slug' => 'seminar',
            ], [
                'kategori' => 'Workshop',
                'slug' => 'workshop',
            ], [
                'kategori' => 'Talkshow',
                'slug' => 'talkshow',
            ],
        ];

        Kategori::insert($kategoris);
    }
}
