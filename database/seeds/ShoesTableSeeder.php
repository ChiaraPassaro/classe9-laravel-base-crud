<?php

use Illuminate\Database\Seeder;
use App\Shoe;
use Faker\Generator as Faker;
 

class ShoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10; $i++) { 
            $newShoe = new Shoe;
            $newShoe->brand = $faker->name;
            $newShoe->size = $faker->randomFloat($nbMaxDecimals = 1, $min = 30, $max = 50);
            $newShoe->color = $faker->colorName;
            $newShoe->type = $faker->word;
            $newShoe->material = $faker->word;
            $newShoe->description = $faker->paragraph($nbSentences = 3, $variableNbSentences = true);
            $newShoe->price =
            $faker->randomFloat($nbMaxDecimals = 2, $min = 30, $max = 9999);
            $newShoe->date_production = '2010-01-01';
            $newShoe->save();
        }
    }
}
