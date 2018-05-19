<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create([
            'name'     => 'Taras Omelianchuk',
            'email'    => 'test@test.com',
            'password' => bcrypt('1111'),
        ]);
    }
}
