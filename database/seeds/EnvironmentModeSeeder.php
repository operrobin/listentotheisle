<?php

use Illuminate\Database\Seeder;

use App\Models\EnvironmentMode;

class EnvironmentModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EnvironmentMode::insert([
            [
                "state_name" => "UP",
                "state_description" => "Your system is running",
                "status" => 1,
                "last_trigger" => date('Y-m-d H:i:s', strtotime('now')),
                "created_at" => new \DateTime('now')
            ],
            [
                "state_name" => "DOWN",
                "state_description" => "Your system is shutdown",
                "status" => 0,
                "last_trigger" => null,
                "created_at" => new \DateTime('now')
            ],
            [
                "state_name" => "MAINTENANCE",
                "state_description" => "Your system is currently under maintenance.",
                "status" => 0,
                "last_trigger" => null,
                "created_at" => new \DateTime('now')
            ]
        ]);
    }
}
