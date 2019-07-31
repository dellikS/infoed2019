<?php

use Illuminate\Database\Seeder;
use App\Models\Business;
use App\Models\Project;
use App\Models\BusinessRating;

class BusinessesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $projects = factory(Project::class, 4)->create();
        $business_ratings = factory(BusinessRating::class, 6)->create();
        Schema::enableForeignKeyConstraints();
    }
}
