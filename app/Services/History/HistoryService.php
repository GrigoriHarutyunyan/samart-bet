<?php

namespace App\Services\History;

use App\Repositories\History\HistoryRepositoryInterface;
use App\Services\History\HistoryServiceInterface;

class HistoryService implements HistoryServiceInterface
{

    private HistoryRepositoryInterface $historyRepository;

    public function __construct(HistoryRepositoryInterface $historyRepository)
    {
        $this->historyRepository = $historyRepository;
    }

    public function saveHistory($machineBalls, $userBalls)
    {
        return $this->historyRepository->saveHistory($machineBalls, $userBalls);
    }

    public function getLastTenPlays()
    {
        return $this->historyRepository->getLastTenPlays();
    }
}
