<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//         \App\Models\User::factory(5)->create();

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'john@gmai.com',
        ]);

        Listing::factory(6)->create([
            'user_id' => $user->id
        ]);

//         Listing::create([
//             'title' => 'Lavarel Senior Developer',
//             'tags' => 'Laravel, PHP, Senior',
//             'company' => 'Laravel Company',
//             'location' => 'London',
//             'email' => 'email@gmail',
//             'website' => 'https://nacme.com',
//             'description' => 'Lorem ipsum dolor sit amet, consectetur
//             adipiscing elit. Sed euismod, nisl nec ultricies aliquam,
//             nunc nisl aliquet nisl, eget aliquet nisl nisl sit amet nisl. N',
//
//         ]);
//
//        Listing::create([
//            'title' => 'Lavarel Junior Developer',
//            'tags' => 'Laravel, PHP',
//            'company' => 'LoL Company',
//            'location' => 'London',
//            'email' => 'email2@gmail',
//            'website' => 'https://acme.com',
//            'description' => 'Lorem ipsum dolor sit amet, consectetur
//             adipiscing elit. Sed euismod, nisl nec ultricies aliquam,
//             nunc nisl aliquet nisl, eget aliquet nisl nisl sit amet nisl. N',
//
//        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
