<?php

use App\User;
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
        Point::create(['title' => "Airport Road Roundabout", 'location' => '23.850420, 90.408418']);
        Point::create(['title' => "Bangla Motor Mor", 'location' => '23.746015, 90.394651']);
        Point::create(['title' => "Dhanmondi 6", 'location' => '23.743643, 90.382264']);
        Point::create(['title' => "Gulshan Circle 1", 'location' => '23.780351, 90.416731']);
        Point::create(['title' => "Uttara Housebuilding", 'location' => '23.873833, 90.400593']);
        Point::create(['title' => "Jahangir Gate", 'location' => '23.775280, 90.389939']);
        Point::create(['title' => "Kakrail Circle", 'location' => '23.737625, 90.405229']);
        Point::create(['title' => "Kakrail Road", 'location' => '23.737570, 90.409018']);
        Point::create(['title' => "Kazi Nazrul Islam Avenue & Shahbagh", 'location' => '23.738111, 90.395851']);
        Point::create(['title' => "Kazi Nazrul Islam Avenue & Bijoy Sharani", 'location' => '23.764426, 90.389003']);
        Point::create(['title' => "Kazi Nazrul Islam Avenue & Indira Road", 'location' => '23.758477, 90.389871']);
        Point::create(['title' => "Khamar Bari Gol Chottor", 'location' => '23.758442, 90.383746']);
        Point::create(['title' => "Khilkhet", 'location' => '23.828733, 90.420070']);
        Point::create(['title' => "Malibag Mor", 'location' => '23.744144, 90.414286']);
        Point::create(['title' => "Malibag Rail Gate", 'location' => '23.750099, 90.413043']);
        Point::create(['title' => "Mirpur Road & Asad Avenue", 'location' => '23.760161, 90.372976']);
        Point::create(['title' => "Mirpur Road & Elephant Road", 'location' => '23.738768, 90.383448']);
        Point::create(['title' => "Mirpur Road & Manik Mia Avenue", 'location' => '23.758307, 90.374220']);
        Point::create(['title' => "Mirpur Road & Old Dhanmondi 27/New 16", 'location' => '23.756349, 90.375102']);
        Point::create(['title' => "Mohakhali Chourasta", 'location' => '23.778311, 90.397932']);
        Point::create(['title' => "Mouchak", 'location' => '23.745760, 90.412240']);
        Point::create(['title' => "Panthapath & Mirpur Road", 'location' => '23.751346, 90.378314']);
        Point::create(['title' => "Rampura Bridge - DIT road <-> Hatirjheel", 'location' => '23.767700, 90.423000']);
        Point::create(['title' => "SAARC Fountain (Sonargaon - Bashundhara City Shopping Complex)", 'location' => '23.749859, 90.393158']);
        Point::create(['title' => "Shantinagar Mor", 'location' => '23.741595, 90.411856']);
        Point::create(['title' => "Zia Udyan", 'location' => '23.768240, 90.382861']);
        Point::create(['title' => "Zigatala", 'location' => '23.738348, 90.372999']);
        Point::create(['title' => "Gulshan Circle 2", 'location' => '23.794847, 90.414213']);
        Point::create(['title' => "Notun Bazar", 'location' => '23.797715, 90.423513']);
        Point::create(['title' => "Nadda", 'location' => '23.809595, 90.421341']);
        Point::create(['title' => "Bashundhara Gate", 'location' => '23.811952, 90.421267']);
        Point::create(['title' => "Shewra", 'location' => '23.818811, 90.414887']);
        Point::create(['title' => "Banani Rd 27", 'location' => '23.796625, 90.407494']);
        Point::create(['title' => "Banani Graveyard Road", 'location' => '23.799114, 90.401882']);
        Point::create(['title' => "Banani Rd 27 - Kemal Ataturk", 'location' => '23.793589, 90.408569']);
        Point::create(['title' => "Banani 11 - Kakoli", 'location' => '23.791370, 90.400473']);
        Point::create(['title' => "Banani 11 - A", 'location' => '23.790369, 90.407899']);
        Point::create(['title' => "Banani 11 - B", 'location' => '23.789921, 90.411179']);
        Point::create(['title' => "Link Road - Pragati Sharani", 'location' => '23.780717, 90.425624']);
        Point::create(['title' => "Merul Badda", 'location' => '23.771430, 90.425226']);
        Point::create(['title' => "Rampura Bridge", 'location' => '23.768240, 90.423319']);
        Point::create(['title' => "Rampura", 'location' => '23.765491, 90.421816']);
        Point::create(['title' => "Khilgaon Abul Hotel", 'location' => '23.754172, 90.415417']);
        Point::create(['title' => "Azad Masjid", 'location' => '23.790051, 90.416157']);
        Point::create(['title' => "Gulshan Shooting Complex", 'location' => '23.774244, 90.416132']);
        Point::create(['title' => "WireLess Mor", 'location' => '23.780535, 90.405433']);
        Point::create(['title' => "Chariman Bari", 'location' => '23.787986, 90.399832']);
        Point::create(['title' => "Shainik Club Bus Stop", 'location' => '23.790517, 90.400307']);
        Point::create(['title' => "Bashundhara City Complex", 'location' => '23.750426, 90.390355']);
        Point::create(['title' => "Panthapath - Green Road ", 'location' => '23.751050, 90.387090']);
        Point::create(['title' => "Shahbagh / Mintu Road Intersection", 'location' => '23.741434, 90.396089']);
        Point::create(['title' => "Nikunja", 'location' => '23.822576, 90.419733']);
        Point::create(['title' => "Satrastar Mor", 'location' => '23.756918, 90.398946']);
        Point::create(['title' => "Nabiscor Mor", 'location' => '23.770088, 90.401091']);
        Point::create(['title' => "Bijoy Sarani - Tejgaon Link Rd", 'location' => '23.763684, 90.400059']);
        Point::create(['title' => "Minto Rd", 'location' => '23.744175, 90.405121']);
        Point::create(['title' => "Old Elephant Road", 'location' => '23.745162, 90.404196']);
        Point::create(['title' => "Sonargaon Road (Entrance to Karwan Bazar)", 'location' => '23.753424, 90.400733']);
    }
}
