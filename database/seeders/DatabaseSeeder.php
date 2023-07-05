<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tag;
use App\Models\User;
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
                'tag' => 'Konser/Pertunjukan',
            ], [
                'tag' => 'Workshop',
            ], [
                'tag' => 'Talkshow',
            ], [
                'tag' => 'Bazaar',
            ],
        ];

        Tag::insert($tags);

        $types = [
            [
                'type' => 'Seminar',
            ], [
                'type' => 'Konferensi',
            ], [
                'type' => 'Simposium',
            ], [
                'type' => 'Konser/Pertunjukan',
            ], [
                'type' => 'Workshop',
            ], [
                'type' => 'Talkshow',
            ], [
                'type' => 'Pameran',
            ], [
                'type' => 'Bazaar',
            ], [
                'type' => 'Festival',
            ], [
                'type' => 'Kompetisi/Lomba',
            ], [
                'type' => 'Kegiatan Sosial',
            ], [
                'type' => 'Olahraga',
            ],
        ];

        Type::insert($types);
        
        $fasilitasies = [
            [
                'fasilitas' => 'Kasur',
            ], [
                'fasilitas' => 'Meja',
            ], [
                'fasilitas' => 'Lemari',
            ], [
                'fasilitas' => 'Kursi',
            ], [
                'fasilitas' => 'AC',
            ],
        ];

        Fasilitas::insert($fasilitasies);
    }
}
