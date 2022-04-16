<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarSetDriverRequest;
use App\Http\Requests\CarStoreRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Info(
 *    title="Your super  ApplicationAPI",
 *    version="1.0.0",
 * )
 */
class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return Response()->json(CarResource::collection(Car::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CarStoreRequest $request)
    {
        $newCar = Car::create($request->validated());

        return Response()->json(new CarResource($newCar));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Car $car)
    {
        return Response()->json(new CarResource($car));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CarStoreRequest $request, Car $car)
    {
        $validate = $request->validated();
        $car->update($validate);

        return Response()->json(new CarResource($car));
    }

    /**
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @OA\Post(
     *     path="/api/v1/cars/{car_id}/set_driver",
     *     summary="Назначить водителя для автомобиля",
     *     description="set driver for car",
     *     operationId="setDriver",
     *     tags={"Управление автомобилем"},
     *     @OA\Parameter(
     *         name="car_id",
     *         in="path",
     *         description="car id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *         style="form"
     *     ),
     *     @OA\Parameter(
     *         name="driver_id",
     *         in="query",
     *         description="driver id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *         style="form"
     *     ),
     *     @OA\RequestBody(
     *        required=true,
     *        description="choose driver for set",
     *        @OA\JsonContent(
     *           required={"car_id","driver_id"},
     *        ),
     *     ),
     *     @OA\Response(
     *        response=200,
     *        description="successful",
     *        @OA\MediaType(
     *            mediaType="application/json",
     *            @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                property="success",
     *                type="boolean",
     *              ),
     *           )
     *       )
     *     )
     * )
     */
    public function setDriver(CarSetDriverRequest $request, int $car_id): JsonResponse
    {
        $validate = $request->validated();

        return Response()->json(Car::setDriver($car_id, $validate['driver_id']));
    }

    /**
     *
     * @param $car_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function unsetDriver(int $car_id): JsonResponse
    {
        return Response()->json(Car::unsetDriver($car_id));
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
