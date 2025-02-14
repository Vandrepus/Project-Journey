<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountriesTableSeeder extends Seeder
{
    public function run()
    {
        $countries = [
            [
                'name' => 'France',
                'capital' => 'Paris',
                'description' => 'France, known for its art, fashion, and gastronomy, is a country of rich cultural heritage. From the romantic streets of Paris to the lavender fields of Provence, every region has its own charm. Explore world-class museums like the Louvre, iconic landmarks like the Eiffel Tower, and indulge in fine wines and exquisite cuisine.',
                'picture' => null,
                'submitted_by' => 1,
                'visible' => true,
            ],
            [
                'name' => 'Italy',
                'capital' => 'Rome',
                'description' => 'Italy, the heart of the Roman Empire, boasts a legacy of art, architecture, and history. Stroll through the ancient ruins of Rome, admire the Renaissance masterpieces of Florence, and experience the vibrant canals of Venice. With its rich culinary traditions, Italy is also a paradise for food lovers, offering everything from handmade pasta to authentic Neapolitan pizza.',
                'picture' => null,
                'submitted_by' => 1,
                'visible' => true,
            ],
            [
                'name' => 'Japan',
                'capital' => 'Tokyo',
                'description' => 'Japan seamlessly blends tradition and modernity, offering everything from ancient shrines to high-tech cities. Explore Kyoto’s historic temples, experience Tokyo’s neon-lit streets, and relax in the tranquil gardens of Nara. Known for sushi, ramen, and cherry blossoms, Japan is a land of cultural treasures and breathtaking landscapes.',
                'picture' => null,
                'submitted_by' => 1,
                'visible' => true,
            ],
            [
                'name' => 'United States',
                'capital' => 'Washington, D.C.',
                'description' => 'The United States is a diverse nation with vibrant cities, stunning national parks, and rich cultural landmarks. Explore the skyscrapers of New York, the sunny beaches of California, and the breathtaking Grand Canyon. With its dynamic mix of cultures and cuisines, the U.S. offers endless travel experiences for all types of explorers.',
                'picture' => null,
                'submitted_by' => 1,
                'visible' => true,
            ],
            [
                'name' => 'Australia',
                'capital' => 'Canberra',
                'description' => 'Australia is known for its stunning natural wonders, unique wildlife, and laid-back culture. Discover the Great Barrier Reef, the red sands of Uluru, and the cosmopolitan vibes of Sydney and Melbourne. Whether it’s surfing on golden beaches or exploring the Outback, Australia is an adventurer’s dream.',
                'picture' => null,
                'submitted_by' => 1,
                'visible' => true,
            ],
            [
                'name' => 'Egypt',
                'capital' => 'Cairo',
                'description' => 'Egypt is a land of ancient wonders, home to the Pyramids of Giza, the Great Sphinx, and the historic temples of Luxor. Cruise along the Nile River and explore the bustling markets of Cairo. With its deep-rooted history and vibrant culture, Egypt remains one of the most fascinating destinations in the world.',
                'picture' => null,
                'submitted_by' => 1,
                'visible' => true,
            ],
            [
                'name' => 'Brazil',
                'capital' => 'Brasília',
                'description' => 'Brazil is a country of vibrant culture, stunning landscapes, and world-famous celebrations like Carnival. From the Amazon Rainforest to the golden beaches of Rio de Janeiro, Brazil offers a mix of adventure, music, and breathtaking natural beauty.',
                'picture' => null,
                'submitted_by' => 1,
                'visible' => true,
            ],
            [
                'name' => 'Greece',
                'capital' => 'Athens',
                'description' => 'Greece is the birthplace of democracy and home to some of the world’s most famous historical sites. Wander through the ruins of Athens, relax on the white-sand beaches of Santorini, and indulge in delicious Mediterranean cuisine. Greece is a perfect blend of history, beauty, and hospitality.',
                'picture' => null,
                'submitted_by' => 1,
                'visible' => true,
            ]
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
