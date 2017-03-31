<?php

namespace App\Console\Commands;

use App\Point;
use App\PointOfInterest;
use App\Report;
use App\Task;
use App\User;
use App\Utility;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\Support\Facades\Log;
use paragraph1\phpFCM\Client;
use paragraph1\phpFCM\Message;
use paragraph1\phpFCM\Recipient\Device;
use paragraph1\phpFCM\Notification;

class SendNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parses unparsed reports and generates user notifications';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $points = Point::all();
        $tasks = Task::all();

        $client = new Client();
        $client->setApiKey(env('FIREBASE_SERVER_KEY'));
        $client->injectHttpClient(new \GuzzleHttp\Client());

        foreach ($tasks as $task)
        {
            try
            {
                $report = Report::findOrFail($task->resource_id);
            }
            catch (ModelNotFoundException $exception)
            {
                $task->delete();
            }

            $matches = [];

            foreach ($points as $point)
            {
                list($pointLat, $pointLong) = explode(",", $point->location);
                $polypoints = $report->polypoints;

                foreach ($polypoints as $polypoint)
                {
                    $distance = Utility::greaterCircleDistance($pointLat, $pointLong, $polypoint->latitude, $polypoint->longitude);

                    if ($distance <= env("LATLNG_MATCH_THRESHOLD", 100))
                    {
                        if (! in_array($point, $matches))
                            $matches[] = $point;
                    }
                }
            }

            foreach ($matches as $match)
            {
                $interestedParties = PointOfInterest::point($match->id)->get();
                foreach ($interestedParties as $interestedParty)
                {
                    try
                    {
                        $user = User::findOrFail($interestedParty->user_id);
                    }
                    catch (ModelNotFoundException $exception)
                    {
                        continue;
                    }

                    //Don't send notification to the person who contributed the data!
                    if ($user->id == $report->user_id)
                        continue;

                    $person = $report->anonymous == true ? 'Anonymous' : $user->name;

                    $messageTemplate = "%s has reported %s as %s";
                    $messageBody = sprintf($messageTemplate, $person, $match->title, Utility::resolveSeverity($report->severity));

                    $note = new Notification('Traffic alert!', $messageBody);

                    $note->setColor(env('FCM_NOTIFICATION_COLOR', '#ffffff'))
                        ->setBadge(env('FCM_NOTIFICATION_BADGE', 1))
                        ->setIcon(env('FCM_NOTIFICATION_ICON', 'ic_explore_black_24dp'));

                    $message = new Message();
                    $message->addRecipient(new Device($user->firebase_id));
                    $message->setNotification($note);

                    $response = $client->send($message);

                    if ($response->getStatusCode() != 200)
                        Log::error("Sending FCM notification failed.");

                    //printf("Notified %s about %s\n", $user->name, $match->title);
                }
            }
            $task->delete();
        }
    }

}
