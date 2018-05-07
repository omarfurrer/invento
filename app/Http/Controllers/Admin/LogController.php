<?php

namespace App\Http\Controllers\Admin;

use App\Services\LogService;
use App\Models\Log;
use App\Http\Controllers\Controller;

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
     * Destroy a record.
     * 
     * @param Log $log
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Log $log)
    {
        $this->logService->delete($log);

        \Session::flash('flash_message_success', 'Log Deleted.');
        return redirect()->to('/log');
    }

}
