<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use \Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class Car extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'model',
        'number',
    ];

    /**
     * @var string[]
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function driver()
    {
        return $this->hasOne(Driver::class, 'id', 'driver_id');
    }

    /**
     * @param int $car_id
     * @param int $driver_id
     * @return bool
     */
    public static function setDriver(int $car_id, int $driver_id): bool
    {
        DB::beginTransaction();

        try {
            $lastUsedCar = Car::where('driver_id', $driver_id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $lastUsedCar = false;
        }

        try {
            $car = Car::findOrFail($car_id);

            if ($lastUsedCar) {

                $lastUsedCar->update(['driver_id' => null]);
            }

            $car->update(['driver_id' => $driver_id]);

        } catch (Exception $e) {
            DB::rollBack();

            return false;
        }
        DB::commit();

        return true;
    }

    /**
     * @param int $car_id
     * @return bool
     */
    public static function unsetDriver(int $car_id): bool
    {
        try {
            $car = Car::findOrFail($car_id);
            $car->update(['driver_id' => null]);
        } catch (\Exception $e) {

            return false;
        }

        return true;
    }
}

