<?php

use Illuminate\Database\Seeder;
use App\Project as Project;

class ProjectSeeds extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        factory(Project::class, 7)->create();
        }
}