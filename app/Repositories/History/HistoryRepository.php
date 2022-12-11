<?php

namespace App\Repositories\History;

use App\Models\LottoDrawn;
use NamTran\LaravelMakeRepositoryService\Repository\BaseRepository;
use App\Repositories\History\HistoryRepositoryInterface;

class HistoryRepository extends BaseRepository implements HistoryRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return  LottoDrawn::class;
    }

    /**
     * @param $machineBalls
     * @param $userBalls
     * @return mixed
     */
    public function saveHistory($machineBalls, $userBalls): mixed
    {
       return $this->model->create([
            'machine_balls' => $machineBalls,
            'user_balls' => $userBalls,
        ]);

    }

    /**
     * @return mixed
     */
    public function getLastTenPlays(): mixed
    {
        return $this->model->latest()->take(10)->get();
    }
}
