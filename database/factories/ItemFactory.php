<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $names = ['牛肉','魚','キャベツ','鶏肉','豚肉','シャーペン','塩','砂糖','ボールペン','唐揚げ'];
        return [
            'user_id' => function () {
                return factory(App\Models\User::class)->create()->id;
            },
            'name'=>$this->faker->randomElement($names),
            'status'=>'active',
            'type'=>$this->faker->numberBetween(1,10),
            'detail'=>$this->faker->sentence(),
            'stock'=>$this->faker->numberBetween(1,1000),
        ];
    }
}
