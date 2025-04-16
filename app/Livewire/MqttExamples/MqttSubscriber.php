<?php

namespace App\Livewire\MqttExamples;

use App\Jobs\MqttSubscriberJob;
use Livewire\Component;

class MqttSubscriber extends Component
{
    public function mount(): void{
        MqttSubscriberJob::dispatch();
    }
    
    public function render()
    {
        return view('livewire.mqtt-examples.mqtt-subscriber');
    }
}
