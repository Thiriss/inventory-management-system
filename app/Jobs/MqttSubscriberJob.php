<?php

namespace App\Jobs;

use App\Events\MessageReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use PhpMqtt\Client\Facades\MQTT;
use Illuminate\Support\Facades\Log;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\Exceptions\MqttClientException;


class MqttSubscriberJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {   
        try{
        $mqtt= MQTT::connection();
        $topic = env('MQTT_TOPIC', 'rfid/location');
        $mqtt->subscribe($topic, function(string $topic, string $message) use ($mqtt){
            Log::info("Received message on topic '{$topic}': {$message}");
        
        try{
            broadcast(new MessageReceived($message));
        }catch(\Exception $e){
            Log::error('Failed to broadcast event: '.$e->getMessage());
        }

        $mqtt->interrupt();
    },MqttClient::QOS_AT_MOST_ONCE);
         // Connect and listen for 30 seconds (adjust as needed)
    // Connect and listen for 30 seconds (adjust as needed)
    $mqtt->loop(true); // non-blocking
    $mqtt->disconnect();
    }catch(MqttClientException $e){
        Log::error('An error occurred while subscribing to topic:'.$e->getMessage());
    }
} 

}
