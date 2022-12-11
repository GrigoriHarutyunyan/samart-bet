<?php

namespace App\Services\Settings;

interface SettingsServiceInterface
{
    public function generateMachineBalls(int $lottoNumbersCount, int $checkedNumbersCount);

    public function checkMatches($userBalls, array $machineBalls);

    public function decideWinner(array $matchedBalls);

    public function setSession($emptyBoard, $machineBalls, $userBalls, $matchedBalls, $result, $lastTenPlays);

}
