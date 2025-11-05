<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Limesurvey\Models\Extra;

/**
 * @extends Factory<Extra>
 */
class ExtraFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Extra::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
            'model_type' => $this->faker->word(),
            'model_id' => $this->faker->randomNumber(),
            'extra_attributes' => [
                'key1' => $this->faker->word(),
                'key2' => $this->faker->boolean(),
                'key3' => $this->faker->numberBetween(1, 100),
            ],
            'created_by' => $this->faker->uuid(),
            'updated_by' => $this->faker->uuid(),
        ];
    }
}
