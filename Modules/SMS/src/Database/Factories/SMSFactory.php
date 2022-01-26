<?php

namespace MODULES\SMS\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use MODULES\SMS\Models\SMS;

class SMSFactory extends Factory
{
    protected $model=SMS::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "number"=>$this->faker->phoneNumber(),
            "body"=>$this->faker->realText(500),
            "status"=>$this->faker->shuffleArray(["failed","sent","sending"])[0],
            "provider"=>$this->faker->shuffleArray(["kavenegar","ghasedak"])[0]
        ];
    }
}
