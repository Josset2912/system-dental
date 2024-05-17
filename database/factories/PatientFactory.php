<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombres' => fake()->name(),
            'apellidos' => fake()->lastName(),
            'direccion' => fake()->address(),
            'correo' => fake()->unique()->safeEmail(),
            'telefono' => fake()->phoneNumber(),
            'especialidad' => fake()->text(10),
            'cita' => now()->addDays(7),
            'alergias' => fake()->text(10),
            'observaciones' => fake()->text(20),
        ];
    }
}
