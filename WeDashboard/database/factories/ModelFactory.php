<?php

use jeremykenedy\LaravelRoles\Models\Role;
use App\Models\User;
use App\Models\Profile;
use App\Models\Business;
use App\Models\BusinessRating;
use App\Models\Project;
use App\Models\Employee;

$factory->define(User::class, function (Faker\Generator $faker) {
    static $password;
    $userRole = Role::whereName('User')->first();

    return [
        'name'                           => $faker->unique()->userName,
        'first_name'                     => $faker->firstName,
        'last_name'                      => $faker->lastName,
        'email'                          => $faker->unique()->safeEmail,
        'phone'                          => $faker->unique()->randomNumber($nbDigits = 8),
        'password'                       => $password ?: $password = bcrypt('secret'),
        'token'                          => str_random(64),
        'activated'                      => true,
        'remember_token'                 => str_random(10),
        'signup_ip_address'              => $faker->ipv4,
        'signup_confirmation_ip_address' => $faker->ipv4,
    ];
});

$factory->define(Profile::class, function (Faker\Generator $faker) {


    return [
        'user_id'          => factory(User::class)->create()->id,
        'address'          => $faker->address,
        'birth_date'       => $faker->date($format = 'Y-m-d', $max = '18 years ago'),
        'country_id'       => $faker->numberBetween($min = 1, $max = 110),
        'bio'              => $faker->paragraph(2, true),
        'twitter_username' => $faker->userName,
        'github_username'  => $faker->userName,
    ];
});

$factory->define(Business::class, function (Faker\Generator $faker) {


    return [
        'user_id'          => $faker->unique()->numberBetween($min = 3, $max = User::all()->max('id')),
        'country_id'       => $faker->numberBetween($min = 1, $max = 110),
        'name'             => $faker->company,
        'description'      => $faker->paragraph(2, true),
        'type'             => $faker->randomElement($array = array('Web Design','Video Editing','Android App', 'Translations', 'Music Mixing', 'Painting', 'Logo Creation', 'Game Developing', 'Advertising', 'Game Boosting', 'Typography')),
        'hiring'           => $faker->boolean($chanceOfGettingTrue = 50),
        'vacancies'        => $faker->numberBetween($min = 1, $max = 10),
        'currency'         => $faker->currencyCode,
        'address'          => $faker->address,
        'email'            => $faker->unique()->safeEmail,
        'phone'            => $faker->unique()->randomNumber($nbDigits = 8),
        'fax'              => $faker->unique()->randomNumber($nbDigits = 8),
        'website'          => $faker->domainName,
    ];
});


$factory->define(Project::class, function (Faker\Generator $faker) {


    return [
        'business_id'      => factory(Business::class)->create()->id,
        'title'            => $faker->randomElement($array = array('Hospiweb','From Vacation','Bio-Medical', 'WeBill', 'Eng Translation', 'Medix ', 'Some Creations', 'Schooly Help', 'Christmas Letter')),
        'details'          => $faker->paragraph(2, true),
        'instruction'      => $faker->paragraph(3, true),
        'deadline'         => $faker->dateTimeBetween($startDate = 'now', $endDate = '2 weeks'),
        'currency'         => $faker->currencyCode,
        'budget'           => $faker->randomNumber($nbDigits = 4),
    ];
});


$factory->define(BusinessRating::class, function (Faker\Generator $faker) {


    return [
        'business_id'      => $faker->numberBetween($min = 1, $max = Business::all()->max('id')),
        'user_id'          => $faker->numberBetween($min = 3, $max = User::all()->max('id')),
        'score'            => $faker->randomFloat($nbMaxDecimals = 1, $min = 1, $max = 5),
    ];
});


$factory->define(Employee::class, function (Faker\Generator $faker) {


    return [
        'business_id'      => $faker->numberBetween($min = 1, $max = Business::all()->max('id')),
        'user_id'          => $faker->unique()->numberBetween($min = 3, $max = User::all()->max('id')),
        'job_title'        => $faker->jobTitle,
        'responsability'   => $faker->word,
        'salary'           => $faker->randomNumber($nbDigits = 3),
    ];
});
