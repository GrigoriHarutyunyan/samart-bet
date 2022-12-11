<?php

namespace App\Repositories\History;

use NamTran\LaravelMakeRepositoryService\Repository\RepositoryContract;

interface HistoryRepositoryInterface extends RepositoryContract
{
    public function saveHistory($machineBalls, $userBalls);

    public function getLastTenPlays();
}
