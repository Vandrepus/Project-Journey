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
                'description' => 'France is celebrated for its art, fashion, and culinary excellence. Wander the romantic boulevards of Paris, explore the lavender fields of Provence, and savor exquisite wines in Bordeaux. Every region tells its own story through architecture, history, and gastronomy.',
                'picture' => null,
                'submitted_by' => 1,
                'visible' => true,
            ],
            [
                'name' => 'Italy',
                'capital' => 'Rome',
                'description' => 'Italy, the cradle of the Renaissance, is a vibrant tapestry of history, art, and mouthwatering cuisine. From the ancient ruins of Rome and the canals of Venice to the rolling vineyards of Tuscany, Italy offers a feast for both the eyes and the palate.',
                'picture' => null,
                'submitted_by' => 1,
                'visible' => true,
            ],
            [
                'name' => 'Japan',
                'capital' => 'Tokyo',
                'description' => 'Japan masterfully blends ancient traditions with futuristic innovation. Explore the serene temples of Kyoto, the bustling neon streets of Tokyo, and the majestic views of Mount Fuji. Its rich cultural festivals, world-class cuisine, and timeless customs make every visit unforgettable.',
                'picture' => null,
                'submitted_by' => 1,
                'visible' => true,
            ],
            [
                'name' => 'United States',
                'capital' => 'Washington, D.C.',
                'description' => 'The United States is a land of endless diversity—from the iconic skylines of New York and Los Angeles to the natural wonders of the Grand Canyon and Yellowstone. With its melting pot of cultures and landscapes, the U.S. offers boundless opportunities for exploration and adventure.',
                'picture' => null,
                'submitted_by' => 1,
                'visible' => true,
            ],
            [
                'name' => 'Australia',
                'capital' => 'Canberra',
                'description' => 'Australia captivates with its diverse natural beauty and dynamic urban centers. Dive into the vibrant Great Barrier Reef, traverse the rugged Outback, and enjoy the cosmopolitan charm of Sydney and Melbourne. Its unique wildlife and endless horizons invite explorers of all kinds.',
                'picture' => null,
                'submitted_by' => 1,
                'visible' => true,
            ],
            [
                'name' => 'Egypt',
                'capital' => 'Cairo',
                'description' => 'Egypt is a timeless land steeped in history and mystery. Home to the monumental Pyramids of Giza, the enigmatic Sphinx, and the ancient temples along the Nile, Egypt invites visitors to step back in time and marvel at the achievements of a bygone civilization.',
                'picture' => null,
                'submitted_by' => 1,
                'visible' => true,
            ],
            [
                'name' => 'Brazil',
                'capital' => 'Brasília',
                'description' => 'Brazil bursts with energy, culture, and natural splendor. From the rhythmic beats of Carnival in Rio de Janeiro to the lush expanses of the Amazon Rainforest, Brazil offers a dynamic blend of vibrant city life, breathtaking landscapes, and rich cultural traditions.',
                'picture' => null,
                'submitted_by' => 1,
                'visible' => true,
            ],
            [
                'name' => 'Greece',
                'capital' => 'Athens',
                'description' => 'Greece is the cradle of Western civilization, where ancient ruins and sun-kissed islands create a landscape of timeless beauty. Stroll through the historic streets of Athens, unwind on the beaches of Santorini, and indulge in delicious Mediterranean flavors.',
                'picture' => null,
                'submitted_by' => 1,
                'visible' => true,
            ],
            [
                'name' => 'Spain',
                'capital' => 'Madrid',
                'description' => 'Spain dazzles with its passionate culture, diverse landscapes, and historic legacy. Experience the artistic treasures of Madrid and Barcelona, the Moorish influences in Andalusia, and the sun-drenched beaches along its extensive coastline, all accompanied by a festive spirit and vibrant cuisine.',
                'picture' => null,
                'submitted_by' => 1,
                'visible' => true,
            ],
            [
                'name' => 'Germany',
                'capital' => 'Berlin',
                'description' => 'Germany is a dynamic blend of modern innovation and storied history. Discover the cutting-edge cultural scene of Berlin, the romantic landscapes of Bavaria, and a country that honors its past while driving boldly into the future. Its festivals, food, and traditions create a truly enriching experience.',
                'picture' => null,
                'submitted_by' => 1,
                'visible' => true,
            ],
            [
                'name' => 'Canada',
                'capital' => 'Ottawa',
                'description' => 'Canada is renowned for its pristine natural beauty and multicultural vibrancy. From the rugged Rocky Mountains and serene lakes to bustling cities like Toronto and Vancouver, Canada offers a peaceful yet diverse landscape perfect for outdoor adventures and urban exploration alike.',
                'picture' => null,
                'submitted_by' => 1,
                'visible' => true,
            ],
            [
                'name' => 'China',
                'capital' => 'Beijing',
                'description' => 'China is a nation of contrasts, where ancient traditions meet rapid modernization. Marvel at the wonders of the Great Wall, explore the historic Forbidden City, and witness the vibrant energy of its sprawling metropolises. Its diverse regions provide a unique journey through millennia of history and innovation.',
                'picture' => null,
                'submitted_by' => 1,
                'visible' => true,
            ],
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
