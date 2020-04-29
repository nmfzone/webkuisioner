<?php

use App\Enums\Role;
use App\Models\Site;
use App\Models\User;
use Illuminate\Database\Seeder;

class SitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subDomains = [
            'johnwebkuisioner.ngrok.io',
            'doewebkuisioner.ngrok.io',
        ];

        foreach ($subDomains as $subDomain) {
            $user = factory(User::class)->create([
                'role' => Role::OWNER,
            ]);

            $user->site()->save(factory(Site::class)->make([
                'domain' => $subDomain,
            ]));
        }
    }
}
