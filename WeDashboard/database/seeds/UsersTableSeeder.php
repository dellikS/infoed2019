<?php

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use jeremykenedy\LaravelRoles\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $profile = new Profile();
        $adminRole = Role::whereName('Admin')->first();
        $userRole = Role::whereName('User')->first();

        // Seed test admin
        $seededAdminEmail = 'admin@admin.com';
        $seededAdminPhone = '0747617570';
        $user = User::where('email', '=', $seededAdminEmail)->first();
        if ($user === null) {
            $user = User::create([
                'name'                           => $faker->userName,
                'first_name'                     => $faker->firstName,
                'last_name'                      => $faker->lastName,
                'email'                          => $seededAdminEmail,
                'phone'                          => $seededAdminPhone,
                'password'                       => Hash::make('password'),
                'token'                          => str_random(64),
                'activated'                      => true,
                'signup_confirmation_ip_address' => $faker->ipv4,
                'admin_ip_address'               => $faker->ipv4,
            ]);

            $user->profile()->save(new Profile());
            $user->attachRole($adminRole);
            $user->save();
        }
        
        // Seed test user
        $seededUserEmail = 'user@user.com';
        $seededUserPhone = '0747617579';
        $user = User::where('email', '=', $seededUserEmail)->first();
        if ($user === null) {
            $user = User::create([
                'name'                           => $faker->userName,
                'first_name'                     => $faker->firstName,
                'last_name'                      => $faker->lastName,
                'email'                          => $seededUserEmail,
                'phone'                          => $seededUserPhone,
                'password'                       => Hash::make('password'),
                'token'                          => str_random(64),
                'activated'                      => true,
                'signup_ip_address'              => $faker->ipv4,
                'signup_confirmation_ip_address' => $faker->ipv4,
            ]);

            $user->profile()->save(new Profile());
            $user->attachRole($userRole);
            $user->save();
        }

        // Seed test users
        Schema::disableForeignKeyConstraints();
         $user = factory(Profile::class, 10)->create();
         $users = User::all();
         foreach ($users as $user) {
             if (!($user->isAdmin()) && !($user->isUnverified())) {
                 $user->attachRole($userRole);
             }
         }
        Schema::enableForeignKeyConstraints();
    }
}
