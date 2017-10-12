<?php

class ClockTower
{
    public function countBells($startTime, $endTime)
    {
        $startTimeHour = explode(':', $startTime)[0];
        $startTimeMin = explode(':', $startTime)[1];
        $endTimeHour = explode(':', $endTime)[0];

        return $this->totalChimes($startTimeHour, $endTimeHour, $startTimeMin);
    }

    private function totalChimes($startTimeHour, $endTimeHour, $startTimeMin)
    {
        $chimes = 0;

        if ($endTimeHour <= $startTimeHour) {
            $endTimeHour += 24;
        }

        for($h = $startTimeHour; $h <= $endTimeHour; $h++) {
            if ($h == $startTimeHour && $startTimeMin != '00') {
                // Only record the first itration if Minutes is 00.
                continue;
            }

            if ($h < 13) {
                $bellRingCount = $h;
            } elseif ($h < 25) {
                $bellRingCount = ($h - 12);
            } elseif ($h < 37) {
                $bellRingCount = ($h - 24);
            } else {
                $bellRingCount = ($h - 36);
            }

            $chimes += $bellRingCount;
        }

        return $chimes;
    }
}

function isValidMilitaryTime($time)
{
    return preg_match('/^([0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/', $time);
}


// MAIN

$binaryPathParts = explode('/', $_SERVER['_']);
$cliBinary = end($binaryPathParts);

if ($cliBinary == 'php') { // Prevent execution when called from Test Suite.
    echo "\nStart Time: ";
    $startTime = trim(fgets(STDIN));

    echo 'End Time: ';
    $endTime = trim(fgets(STDIN));

    echo "\n";

    if (isValidMilitaryTime($startTime) && isValidMilitaryTime($endTime)) {
        $clockTower = new ClockTower();
        $rings = $clockTower->countBells($startTime, $endTime);

        echo "Number of bell rings between $startTime and $endTime is $rings.\n";
    } else {
        echo "Invalid time. Times must be in Military Time, eg 14:30, and less than 24:00 hours.\n";
    }

    echo "\n";
}
?>
