<?php

namespace App;

class ConvertMsToHuman
{
    public $hours;
    public $minutes;
    public $seconds;
    public $milliseconds;

    public function __construct($microtime)
    {
        $hours = (int)
            ($minutes = (int)
                ($seconds = (int)
                    ($milliseconds = (int)
                    ($microtime * 1000))
                    / 1000)
                / 60)
            / 60;

        $this->hours = $hours;
        $this->minutes = $minutes % 60;
        $this->seconds = $seconds % 60;
        $this->milliseconds = $milliseconds % 1000;
    }

    public function toArray(): array
    {
        $data = [];

        if ($this->hours !== 0) {
            $data['hours'] = $this->hours;
        }

        if ($this->minutes !== 0) {
            $data['minutes'] = $this->minutes;
        }

        if ($this->seconds !== 0) {
            $data['seconds'] = $this->seconds;
        }

        $data['milliseconds'] = $this->milliseconds;

        return $data;
    }

    public function toString(): string
    {
        if ($this->hours !== 0) {
            return "Elapsed Time: {$this->hours} hour(s) {$this->minutes} minute(s) {$this->seconds} second(s) {$this->milliseconds} millisecond(s)";
        }

        if ($this->minutes !== 0) {
            return "Elapsed Time: {$this->minutes} minute(s) {$this->seconds} second(s) {$this->milliseconds} millisecond(s)";
        }

        if ($this->seconds !== 0) {
            return "Elapsed Time: {$this->seconds} second(s) {$this->milliseconds} millisecond(s)";
        }

        return "Elapsed Time: {$this->milliseconds} millisecond(s)";
    }
}
