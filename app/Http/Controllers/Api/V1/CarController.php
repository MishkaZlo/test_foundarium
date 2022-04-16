<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarSetDriverRequest;
use App\Http\Requests\CarStoreRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;
use Illuminate\Foundation\Http\FormRequest;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CarResource::collection(Car::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarStoreRequest $request)
    {
        $newCar = Car::create($request->validated());

        return new CarResource($newCar);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        return new CarResource($car);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CarStoreRequest $request, Car $car)
    {
        $validate = $request->validated();
        $car->update($validate);

        return new CarResource($car);
    }

    /**
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function setDriver(CarSetDriverRequest $request, $car_id)
    {
        $validate = $request->validated();

        return Car::setDriver($car_id, $validate['driver_id']);
    }

    /**
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function unsetDriver($car_id)
    {
        return Car::unsetDriver($car_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $car->delete();
    }
}
