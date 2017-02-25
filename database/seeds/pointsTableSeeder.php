<?php

use Illuminate\Database\Seeder;
use App\Point;

class pointsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('points')->delete();
        Point::create(['title' => 'Airport Road (Dhaka-Mymensingh Hwy) and Kemal Ataturk Avenue', 'location' => '23.794403, 90.401070']);
        Point::create(['title' => 'Airport Road Roundabout', 'location' => '23.850420, 90.408418']);
        Point::create(['title' => 'Bangla Motor Mor', 'location' => '23.746015, 90.394651']);
        Point::create(['title' => 'Dhanmondi 6', 'location' => '23.743643, 90.382264']);
        Point::create(['title' => 'Gulshan 1 Circle', 'location' => '23.780351, 90.416731']);
        Point::create(['title' => 'Gulshan 2 Circle', 'location' => '23.794847, 90.414213']);
        Point::create(['title' => 'Housebuilding', 'location' => '23.873833, 90.400593']);
        Point::create(['title' => 'Jahangir Gate', 'location' => '23.775280, 90.389939']);
        Point::create(['title' => 'Kakrail Circle', 'location' => '23.737625, 90.405229']);
        Point::create(['title' => 'Kakrail Road', 'location' => '23.737570, 90.409018']);
        Point::create(['title' => 'Kazi Nazrul Islam Avenue & Shahbagh', 'location' => '23.738111, 90.395851']);
        Point::create(['title' => 'Kazi Nazrul Islam Avenue and Bijoy Sharani', 'location' => '23.764426, 90.389003']);
        Point::create(['title' => 'Kazi Nazrul Islam Avenue And Indira Road', 'location' => '23.758477, 90.389871']);
        Point::create(['title' => 'Khamar Bari Gol Chottor', 'location' => '23.758442, 90.383746']);
        Point::create(['title' => 'Khilkhet', 'location' => '23.828733, 90.420070']);
        Point::create(['title' => 'Malibag Mor', 'location' => '23.744144, 90.414286']);
        Point::create(['title' => 'Malibag Rail Gate', 'location' => '23.750099, 90.413043']);
        Point::create(['title' => 'Mirpur Road And Asad Avenue', 'location' => '23.760161, 90.372976']);
        Point::create(['title' => 'Mirpur Road And Elephant Road', 'location' => '23.738768, 90.383448']);
        Point::create(['title' => 'Mirpur Road And Manik Mia Avenue', 'location' => '23.758307, 90.374220']);
        Point::create(['title' => 'Mirpur Road and Old Dhanmondi 27/New 16', 'location' => '23.756349, 90.375102']);
        Point::create(['title' => 'Mohakhali Chourasta', 'location' => '23.778311, 90.397932']);
        Point::create(['title' => 'Mouchak', 'location' => '23.745760, 90.412240']);
        Point::create(['title' => 'PanthaPath and Mirpur Road', 'location' => '23.751346, 90.378314']);
        Point::create(['title' => 'Rampura Bridge - connection between DIT road and Hatirjheel', 'location' => '23.767700, 90.423000']);
        Point::create(['title' => 'SAARC Fountain (Sonargaon, Bashundhara City Shopping Complex)', 'location' => '23.749859, 90.393158']);
        Point::create(['title' => 'Shankar ', 'location' => '23.750766, 90.368247']);
        Point::create(['title' => 'Shantinagor Mor', 'location' => '23.741595, 90.411856']);
        Point::create(['title' => 'Zia Udyan', 'location' => '23.768240, 90.382861']);
        Point::create(['title' => 'Zigatala', 'location' => '23.738348, 90.372999']);
    }
}
