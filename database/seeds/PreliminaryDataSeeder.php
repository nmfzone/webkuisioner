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
        $subDomains = [
            'kiki' => [
                'name' => 'Fuadhillah Kirana P.',
                'email' => 'fuadhillah.kirana.p@mail.ugm.ac.id',
                'password' => bcrypt('12345678'),
            ],
            'azizah' => [
                'name' => 'Azizah',
                'email' => 'azizah@mail.ugm.ac.id',
                'password' => bcrypt('12345678'),
            ]
        ];

        foreach ($subDomains as $subDomain => $userDetail) {
            $user = User::create(array_merge($userDetail, [
                'email_verified_at' => now(),
               'role' => Role::OWNER
            ]));

            $user->site()->save(new Site([
                'domain' => $subDomain . '.' . env('APP_DOMAIN'),
            ]));
        }
    }
}
