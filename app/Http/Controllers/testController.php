<?php


namespace App\Http\Controllers;


use App\Point;
use App\Report;
use Illuminate\Http\Request;
use App\Utility;

class testController extends Controller
{
    public function generateSeedMarkup (Request $request)
    {
        $data = <<<EOF
23.794403, 90.401070, "Airport Road (Dhaka-Mymensingh Hwy) and Kemal Ataturk Avenue"
23.850420, 90.408418, "Airport Road Roundabout"
23.746015, 90.394651, "Bangla Motor Mor"
23.743643, 90.382264, "Dhanmondi 6"
23.780351, 90.416731, "Gulshan Circle 1"
23.873833, 90.400593, "Uttara Housebuilding"
23.775280, 90.389939, "Jahangir Gate"
23.737625, 90.405229, "Kakrail Circle"
23.737570, 90.409018, "Kakrail Road"
23.738111, 90.395851, "Kazi Nazrul Islam Avenue & Shahbagh"
23.764426, 90.389003, "Kazi Nazrul Islam Avenue & Bijoy Sharani"
23.758477, 90.389871, "Kazi Nazrul Islam Avenue & Indira Road"
23.758442, 90.383746, "Khamar Bari Gol Chottor"
23.828733, 90.420070, "Khilkhet"
23.744144, 90.414286, "Malibag Mor"
23.750099, 90.413043, "Malibag Rail Gate"
23.760161, 90.372976, "Mirpur Road & Asad Avenue"
23.738768, 90.383448, "Mirpur Road & Elephant Road"
23.758307, 90.374220, "Mirpur Road & Manik Mia Avenue"
23.756349, 90.375102, "Mirpur Road & Old Dhanmondi 27/New 16"
23.778311, 90.397932, "Mohakhali Chourasta"
23.745760, 90.412240, "Mouchak"
23.751346, 90.378314, "Panthapath & Mirpur Road"
23.767700, 90.423000, "Rampura Bridge - DIT road <-> Hatirjheel"
23.749859, 90.393158, "SAARC Fountain (Sonargaon - Bashundhara City Shopping Complex)"
23.741595, 90.411856, "Shantinagar Mor"
23.768240, 90.382861, "Zia Udyan"
23.738348, 90.372999, "Zigatala"
23.794847, 90.414213, "Gulshan Circle 2"
23.797715, 90.423513, "Notun Bazar"
23.809595, 90.421341, "Nadda"
23.811952, 90.421267, "Bashundhara Gate"
23.818811, 90.414887, "Shewra"
23.796625, 90.407494, "Banani Rd 27"
23.799114, 90.401882, "Banani Graveyard Road"
23.793589, 90.408569, "Banani Rd 27 - Kemal Ataturk"
23.791370, 90.400473, "Banani 11 - Kakoli"
23.790369, 90.407899, "Banani 11 - A"
23.789921, 90.411179, "Banani 11 - B"
23.780717, 90.425624, "Link Road - Pragati Sharani"
23.771430, 90.425226, "Merul Badda"
23.768240, 90.423319, "Rampura Bridge"
23.765491, 90.421816, "Rampura"
23.754172, 90.415417, "Khilgaon Abul Hotel"
23.790051, 90.416157, "Azad Masjid"
23.774244, 90.416132, "Gulshan Shooting Complex"
23.780535, 90.405433, "WireLess Mor"
23.787986, 90.399832, "Chariman Bari"
23.790517, 90.400307, "Shainik Club Bus Stop"
23.750426, 90.390355, "Bashundhara City Complex"
23.751050, 90.387090, "Panthapath - Green Road "
23.741434, 90.396089, "Shahbagh / Mintu Road Intersection"
23.822576, 90.419733, "Nikunja"
23.756918, 90.398946, "Satrastar Mor"
23.770088, 90.401091, "Nabiscor Mor"
23.763684, 90.400059, "Bijoy Sarani - Tejgaon Link Rd"
23.744175, 90.405121, "Minto Rd"
23.745162, 90.404196, "Old Elephant Road"
23.753424, 90.400733, "Sonargaon Road (Entrance to Karwan Bazar)"
EOF;
        $line = strtok($data, PHP_EOL);
        while ($line)
        {
            $line = strtok(PHP_EOL);
            $raw = explode(",", $line);
            $raw = array_map('trim', $raw);
            list($lat, $long, $title) = $raw;
            printf("Point::create(['title' => %s, 'location' => '%s, %s']);", $title, $lat, $long);
            echo "<br />";
        }

    }
    public function test (Request $request)
    {
        $reports = Report::where('id',1)->get();
        $points = Point::all();

        foreach ($reports as $report)
        {
            foreach ($points as $point)
            {
                list($pointLat, $pointLong) = explode(",", $point['location']);
                $polypoints = $report['polypoints'];

                foreach ($polypoints as $polypoint)
                {
                    $distance = Utility::greaterCircleDistance($pointLat, $pointLong, $polypoint->latitude, $polypoint->longitude);

                    if ($distance <= 100)
                    {
                        printf("Point (%s, %s) intersects %s with a distance of %s", $polypoint->latitude, $polypoint->longitude,
                            $point['title'], $distance);
                        echo "<br />";
                    }
                }
            }
        }
    }

}