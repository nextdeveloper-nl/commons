<?php

namespace NextDeveloper\Commons\Common\Timer;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class Timer
{
    private $initialTime;

    private $lastTime;

    private $lastStage = 'Start';

    private $marker =   '';

    public function __construct()
    {
        $this->lastTime = now();
        $this->initialTime = now();

        $adjectives = array(
            "Awesome",
            "Energetic",
            "Vibrant",
            "Creative",
            "Spectacular",
            "Innovative",
            "Joyful",
            "Dynamic",
            "Radiant",
            "Exquisite"
        );

        $this->marker = $adjectives[array_rand($adjectives)];
        $this->marker.= rand(0, 20);

//        Log::debug('[Timer|' . $this->marker . '] Now I am in starting stage and its: '
//            . Carbon::now()->toDateTimeString());
    }

    public function showDiff($stage = null)
    {
        $tempLastTime = $this->lastTime;

        $start = Carbon::parse($this->lastTime);
        $end = Carbon::parse(now());

        $diff = $end->diffInSeconds($start);

        Log::debug('[Timer|' . $this->marker . '] The last stage [' . $this->lastStage . '] you asked for this was: '
            . $start->toDateTimeString() . '. And now this is: ' . $end->toDateTimeString() . '. It took '
            . $diff . ' seconds to reach to this stage [' . $stage . '].');

        $this->lastStage = $stage;

        $this->lastTime = now();
    }

    public function diff($stage = null)
    {
        $tempLastTime = $this->lastTime;

        $start = Carbon::parse($this->lastTime);
        $end = Carbon::parse(now());

        $diff = $end->diffInSeconds($start);

        $this->lastStage = $stage;

        $this->lastTime = now();

        return $diff;
    }

    public function totalDiff()
    {
        $start = Carbon::parse($this->initialTime);
        $end = Carbon::parse(now());

        return $end->diffInSeconds($start);
    }
}
