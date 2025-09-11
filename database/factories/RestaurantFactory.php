<?php

namespace Database\Factories;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Restaurant::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->company(),
            'type' => fake()->randomElement(['Restaurant', 'Cafe', 'Fast Food', 'Fine Dining']),
            'contact_email' => fake()->safeEmail(),
            'address' => fake()->address(),
            'phone_number' => fake()->phoneNumber(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'country' => fake()->country(),
            'currency' => 'USD',
            'language' => ['en'],
            'theme' => fake()->hexColor(),
            'theme_style' => 'default',
            'layout_type' => 'horizontal',
            'uuid' => (string) Str::uuid(),
            'menu_title_en' => 'MENU',
            'menu_title_ar' => 'القائمة',
        ];
    }

    /**
     * Indicate that the restaurant should have a specific user.
     *
     * @param  \App\Models\User  $user
     * @return static
     */
    public function forUser(User $user)
    {
        return $this->state(function (array $attributes) use ($user) {
            return [
                'user_id' => $user->id,
            ];
        });
    }

    /**
     * Indicate that the restaurant should use the new theme.
     *
     * @return static
     */
    public function newTheme()
    {
        return $this->state(function (array $attributes) {
            return [
                'theme_style' => 'new',
            ];
        });
    }

    /**
     * Indicate that the restaurant should use vertical layout.
     *
     * @return static
     */
    public function vertical()
    {
        return $this->state(function (array $attributes) {
            return [
                'layout_type' => 'vertical',
                'vertical_mode' => 1,
            ];
        });
    }
}
