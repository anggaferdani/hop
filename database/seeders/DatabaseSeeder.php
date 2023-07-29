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
                'level' => 'superadmin',
            ], [
                'nama_panjang' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt(12345678),
                'level' => 'admin',
            ],
        ];

        User::insert($users);

        $tags = [
            [
                'tag' => 'Seminar',
            ], [
                'tag' => 'Konser',
            ], [
                'tag' => 'Workshop',
            ], [
                'tag' => 'Talkshow',
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
                'feature' => 'QRIS',
            ], [
                'feature' => 'Stop Kontak',
            ], [
                'feature' => 'AC',
            ], [
                'feature' => 'WIFI',
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
            ], [
                'kategori' => 'Workshop',
            ], [
                'kategori' => 'Talkshow',
            ],
        ];

        Kategori::insert($kategoris);
    }
}
