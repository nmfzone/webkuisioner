<?php

use App\Enums\Role;
use App\Models\Site;
use App\Models\User;
use Illuminate\Database\Seeder;

class PreliminaryDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'site' => [
                    'title' => 'Riset Eksperimen Akuntansi Keperilakuan',
                    'sub_domain' => 'kiki',
                ],
                'user' => [
                    'name' => 'Fuadhillah Kirana P.',
                    'email' => 'fuadhillah.kirana.p@mail.ugm.ac.id',
                    'password' => bcrypt('12345678'),
                ],
            ],
            [
                'site' => [
                    'title' => 'Riset Eksperimen Akuntansi Keperilakuan',
                    'sub_domain' => 'azizah',
                ],
                'user' => [
                    'name' => 'Azizah',
                    'email' => 'azizah@mail.ugm.ac.id',
                    'password' => bcrypt('12345678'),
                ],
            ]
        ];

        foreach ($data as $item) {
            $user = User::create(array_merge($item['user'], [
                'email_verified_at' => now(),
                'role' => Role::OWNER
            ]));

            $user->site()->save(new Site([
                'title' => $item['site']['title'],
                'domain' => $item['site']['sub_domain'] . '.' . env('APP_DOMAIN'),
            ]));
        }
    }
}
