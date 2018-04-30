<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LogService;

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
    public function index()
    {
        $log = $this->logService->getAll();
        return view('log.index', compact('log'));
    }

    /**
     * Retrieve create page for log in.
     * 
     * @return \Illuminate\View\View
     */
    public function getCreateIn()
    {
        $dependencies = $this->logService->getCreateIn();
        return view('items.createIn', $dependencies);
    }

    /**
     * create new log in record.
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateIn(Request $request)
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
        return view('items.createOut', $dependencies);
    }

    /**
     * create new log out record.
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateOut(Request $request)
    {
        $log = $this->logService->createOut($request->item_id, $request->quantity, $request->item_batch_id, auth()->user());

        \Session::flash('flash_message_success', 'Log Created.');
        return redirect()->to('/log');
    }

}
