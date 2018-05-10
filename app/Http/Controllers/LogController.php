<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LogService;
use App\Http\Requests\Log\PostCreateInRequest;
use App\Http\Requests\Log\PostCreateOutRequest;

class LogController extends Controller {

    /**
     * @var LogService 
     */
    protected $logService;

    /**
     * ItemsController Constructor.
     * 
     * @param LogService $logService
     */
    public function __construct(LogService $logService)
    {
        $this->logService = $logService;
    }

    /**
     * Retrieve all log records.
     * 
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $itemID = $request->get('item_id');
        $fromDate = $request->get('from_date');
        $toDate = $request->get('to_date');

        $filtersData = $this->logService->getFiltersData();
        
        $log = $this->logService->getAll('id', 'DESC', $itemID, $fromDate, $toDate);
        return view('log.index', compact('log', 'filtersData'));
    }

    /**
     * Retrieve create page for log in.
     * 
     * @return \Illuminate\View\View
     */
    public function getCreateIn()
    {
        $dependencies = $this->logService->getCreateIn();
        return view('log.createIn', $dependencies);
    }

    /**
     * create new log in record.
     * 
     * @param PostCreateInRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateIn(PostCreateInRequest $request)
    {
        $log = $this->logService->createIn($request->item_id, $request->quantity, $request->expiry_date, $request->unit_price, auth()->user());

        \Session::flash('flash_message_success', 'Log Created.');
        return redirect()->to('/log');
    }

    /**
     * Retrieve create page for log out.
     * 
     * @return \Illuminate\View\View
     */
    public function getCreateOut()
    {
        $dependencies = $this->logService->getCreateOut();
        return view('log.createOut', $dependencies);
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
