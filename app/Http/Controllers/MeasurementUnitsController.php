<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\MeasurementUnitsRepositoryInterface;
use App\Models\MeasurementUnit;
use App\Http\Requests\MeasurementUnits\StoreMeasurementUnitRequest;
use App\Http\Requests\MeasurementUnits\UpdateMeasurementUnitRequest;

class MeasurementUnitsController extends Controller {

    /**
     * @var MeasurementUnitsRepositoryInterface 
     */
    protected $measurementUnitsReposiotry;

    /**
     * MeasurementUnitsController Constructor.
     * 
     * @param MeasurementUnitsRepositoryInterface $measurementUnitsReposiotry
     */
    public function __construct(MeasurementUnitsRepositoryInterface $measurementUnitsReposiotry)
    {
        $this->measurementUnitsReposiotry = $measurementUnitsReposiotry;
    }

    /**
     * Retrieve a list of all users on the system.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $measurementUnits = $this->measurementUnitsReposiotry->all();
        return view('admin.units.index', compact("measurementUnits"));
    }

    /**
     * Retrieve view to create a new user.
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.measurementUnits.create');
    }

    /**
     * Store a new user.
     * 
     * @param StoreMeasurementUnitRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreMeasurementUnitRequest $request)
    {
        $measurementUnit = $this->measurementUnitsReposiotry->create($request->all());

        \Session::flash('flash_message_success', 'Measurement Unit Created.');
        return redirect()->to('/measurement_units');
    }

    /**
     * Retrieve view to edit a user.
     * 
     * @param MeasurementUnit $measurementUnit
     * @return \Illuminate\View\View
     */
    public function edit(MeasurementUnit $measurementUnit)
    {
        return view('admin.measurementUnits.edit', compact('measurementUnit'));
    }

    /**
     * Update user.
     * 
     * @param UpdateMeasurementUnitRequest $request
     * @param MeasurementUnit $measurementUnit
     */
    public function update(UpdateMeasurementUnitRequest $request, MeasurementUnit $measurementUnit)
    {
        $measurementUnit = $this->measurementUnitsReposiotry->update($measurementUnit->id, $request->all());

        \Session::flash('flash_message_success', 'Measurement Unit updated.');
        return redirect()->to('/measurement_units');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  MeasurementUnit $measurementUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(MeasurementUnit $measurementUnit)
    {

        $this->measurementUnitsReposiotry->delete($measurementUnit);

        \Session::flash('flash_message_success', 'Measurement Unit Deleted.');

        return redirect()->to('/measurement_units');
    }

}
