<?php

namespace App\Services\Settings;

use Illuminate\Support\Facades\Session;

class SettingsService implements SettingsServiceInterface
{
    /**
     * Generate random numbers in a range for specified users
     * @param int $lottoNumbersCount
     * @param int $checkedNumbersCount
     * @return array
     */
    public function generateMachineBalls(int $lottoNumbersCount, int $checkedNumbersCount): array
    {
        $numbers = range(1, $lottoNumbersCount);
        shuffle($numbers);
        return array_slice($numbers, 0, $checkedNumbersCount);
    }

    /**
     * Check if generated numbers match the numbers selected by the user
     * @param $userBalls
     * @param array $machineBalls
     * @return array
     */
    public function checkMatches($userBalls, array $machineBalls): array
    {
        $userBalls = array_map('intval', explode(',', $userBalls));
        $matchedBalls = array_intersect($userBalls, $machineBalls);
        return ['matchedBalls' => $matchedBalls, 'userBalls' => $userBalls];
    }

    /**
     * Decide if the user wins or loses,
     * if lost we save this in the session to change the number of balls for prediction
     * @param array $matchedBalls
     * @return int
     */
    public function decideWinner(array $matchedBalls): int
    {
        Session::has('lose') ? $matchBallsForWin = 2 : $matchBallsForWin = 3;
        $result = count($matchedBalls) < $matchBallsForWin ? 0 : 1;
        $result == 0 ? Session::put('lose', 'lose') : Session::forget('lose');
        return $result;
    }

    /**
     * Keep last result in session
     * @param $emptyBoard
     * @param $machineBalls
     * @param $userBalls
     * @param $matchedBalls
     * @param $result
     * @param $lastTenPlays
     */
    public function setSession($emptyBoard, $machineBalls, $userBalls, $matchedBalls, $result, $lastTenPlays)
    {
        Session::put('emptyBoard', $emptyBoard);
        Session::put('machineBalls',$machineBalls);
        Session::put('userBalls', $userBalls);
        Session::put('matchedBalls', $matchedBalls);
        Session::put('result', $result);
        Session::put('lastTenPlays', $lastTenPlays);
    }
}
