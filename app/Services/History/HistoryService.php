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

    /**
     * @param $machineBalls
     * @param $userBalls
     * @return mixed
     */
    public function saveHistory($machineBalls, $userBalls): mixed
    {
        return $this->historyRepository->saveHistory($machineBalls, $userBalls);
    }

    /**
     * @return mixed
     */
    public function getLastTenPlays(): mixed
    {
        return $this->historyRepository->getLastTenPlays();
    }
}
