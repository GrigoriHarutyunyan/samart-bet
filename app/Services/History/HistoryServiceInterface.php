<?php

namespace App\Services\History;

interface HistoryServiceInterface
{
    public function saveHistory($machineBalls, $userBalls);

    public function getLastTenPlays();
}
