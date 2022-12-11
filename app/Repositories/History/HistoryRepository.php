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

    public function saveHistory($machineBalls, $userBalls)
    {
      $lotto =  $this->model->create([
            'machine_balls' => $machineBalls,
            'user_balls' => $userBalls,
        ]);
      return $lotto;
    }

    public function getLastTenPlays() {
        return $this->model->latest()->take(10)->get();
    }
}
