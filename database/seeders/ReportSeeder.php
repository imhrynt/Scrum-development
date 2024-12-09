<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the latitude and longitude boundaries for Indonesia.
        $minLatitude = -11.00;
        $maxLatitude = 6.00;
        $minLongitude = 94.00;
        $maxLongitude = 141.00;
        // Seed 10 factories with random coordinates.
        for ($i = 1; $i <= 100; $i++) {
            $factory = new Report();
            $factory->user_id = 1;
            // Generate random latitude and longitude within a specific range.
            // $latitude = rand(-90, 90); // Latitude ranges from -90 to 90 degrees.
            // $longitude = rand(-180, 180); // Longitude ranges from -180 to 180 degrees.
              // Generate random latitude and longitude within the defined boundaries.
            $latitude = rand($minLatitude * 100, $maxLatitude * 100) / 100;
            $longitude = rand($minLongitude * 100, $maxLongitude * 100) / 100;
            $factory->information = "Report $i";
            $factory->latitude = $latitude;
            $factory->longitude = $longitude;
            // $factory->location = new Point($latitude, $longitude);
            $factory->save();
        }
        // $report = Report::create([
        //     'user_id' => '1',
        //     'latitude'  => '-6.209542703031363',
        //     'longitude' => '106.8076586721145',
        //     'information'  => 'Test123'
        // ]);

        // $users = Report::factory()->count(30)->create();

    }
}
