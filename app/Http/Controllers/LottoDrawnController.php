<?php

namespace App\Http\Controllers;

use App\Rules\UserBall;
use App\Services\History\HistoryServiceInterface;
use App\Services\Settings\SettingsServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LottoDrawnController extends Controller
{
    private SettingsServiceInterface $settingsService;
    private HistoryServiceInterface $historyService;

    public function __construct(SettingsServiceInterface $settingsService, HistoryServiceInterface $historyService)
    {
        $this->settingsService = $settingsService;
        $this->historyService = $historyService;
    }

    public function index() {
        $lastTenPlays = $this->historyService->getLastTenPlays();
        return view('lotto', ['lastTenPlays' => $lastTenPlays]);

    }

    public function draw(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'machine-balls' => 'required',
            'lotto-config' => 'required|in:5,7',
            'user-balls' => ['required', new UserBall(+$data['machine-balls'], +$data['lotto-config'])],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        $machineGeneratedBalls = $this->settingsService->generateMachineBalls(+$data['machine-balls'], +$data['lotto-config']);
        $balls = $this->settingsService->checkMatches($data['user-balls'], $machineGeneratedBalls);
        $result = $this->settingsService->decideWinner($balls['matchedBalls']);
        $this->historyService->saveHistory($machineGeneratedBalls, $balls['userBalls']);
        $lastTenPlays = $this->historyService->getLastTenPlays();
        $this->settingsService->setSession(+$data['machine-balls'], $machineGeneratedBalls, $balls['userBalls'], $balls['matchedBalls'], $result, $lastTenPlays);

        return redirect()->back();
    }
}
