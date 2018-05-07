<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\LogService;
use App\Http\Requests\Log\PostCreateInRequest;
use App\Http\Requests\Log\PostCreateOutRequest;
use App\Http\Controllers\Controller;

class LogController extends Controller {

    /**
     * @var LogService 
     */
    protected $logService;

    /**
     * LogController Constructor.
     * 
     * @param LogService $logService
     */
    public function __construct(LogService $logService)
    {
        $this->logService = $logService;
        $this->logService->setIsAPI(true);
    }

    /**
     * create new log in record.
     * 
     * @param PostCreateInRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postCreateIn(PostCreateInRequest $request)
    {
        $log = $this->logService->createIn($request->item_id, $request->quantity, $request->expiry_date, $request->unit_price, auth()->user());
        
        return response()->json(compact('log'));
    }

    /**
     * create new log out record.
     * 
     * @param PostCreateOutRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateOut(PostCreateOutRequest $request)
    {
        $log = $this->logService->createOut($request->item_id, $request->quantity, $request->item_batch_id, auth()->user());

        if (!$log) {
            \Session::flash('flash_message_error', $this->logService->getErrorMessage());
            return redirect()->back();
        }

        \Session::flash('flash_message_success', 'Log Created.');
        return redirect()->to('/log');
    }

}
