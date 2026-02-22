<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TeamMemberFactory extends Factory
{
    public function definition(): array
    {
        $gender = $this->faker->randomElement(['Male', 'Female']);

        $roles = [
            'Project Manager',
            'Architect',
            'Civil Engineer',
            'Safety Officer',
            'Foreman',
            'Electrician',
            'Plumbing Specialist',
            'Construction Worker',
            'Quantity Surveyor',
            'Site Engineer',
        ];

        $salaryOptions = [
            '₱20,000', '₱24,000', '₱30,000', '₱38,000', '₱45,000',
            '₱55,000', '₱60,000', '₱70,000', '₱75,000', '₱85,000',
        ];

        return [
            'name' => $this->faker->name($gender === 'Male' ? 'male' : 'female'),
            'role' => $this->faker->randomElement($roles),
            'location' => $this->faker->randomElement(['Onsite', 'Remote']),
            'salary' => $this->faker->randomElement($salaryOptions),

            // important: email must be unique
            'email' => $this->faker->unique()->safeEmail(),

            'phone' => $this->faker->numerify('09#########'),
            'avatar' => null,
            'gender' => $gender,
            'date_of_birth' => $this->faker->dateTimeBetween('-50 years', '-18 years')->format('Y-m-d'),
            'nationality' => 'Filipino',

            'address_line' => $this->faker->streetName(),
            'address_city' => $this->faker->randomElement(['Davao City', 'Tagum City', 'Cabadbaran City', 'Panabo City']),
            'address_state' => $this->faker->randomElement(['Davao del Sur', 'Davao del Norte', 'Agusan del Norte']),
            'workload' => $this->faker->numberBetween(0, 6),
        ];
    }
}
