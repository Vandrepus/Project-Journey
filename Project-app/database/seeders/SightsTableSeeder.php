<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sight;
use App\Models\Country;

class SightsTableSeeder extends Seeder
{
    public function run()
    {
        $sights = [
            [
                'country'        => 'France',
                'name'           => 'Eiffel Tower',
                'description'    => 'An architectural masterpiece and a symbol of France, the Eiffel Tower offers breathtaking panoramic views of Paris from its multiple observation decks. Its intricate iron lattice structure and dazzling nightly illuminations make it a must-see landmark.',
                'location'       => 'Paris, France',
                'category'       => 'Landmark',
                'opening_hours'  => '9 AM - 11 PM',
                'average_rating' => 4.7,
                'map_url'        => 'https://maps.app.goo.gl/wXQEk6uYHFadzo8Q8',
                'photo'          => null,
                'submitted_by'   => 1,
                'visible'        => true,
            ],
            [
                'country'        => 'Italy',
                'name'           => 'Colosseum',
                'description'    => 'A stunning Roman amphitheater that once hosted gladiatorial contests and public spectacles, the Colosseum stands as a testament to ancient engineering. Its monumental arches, underground chambers, and storied past transport visitors back in time.',
                'location'       => 'Rome, Italy',
                'category'       => 'Historical Site',
                'opening_hours'  => '8 AM - 5 PM',
                'average_rating' => 4.3,
                'map_url'        => 'https://maps.app.goo.gl/qvVime4Ynpb3n7p86',
                'photo'          => null,
                'submitted_by'   => 1,
                'visible'        => true,
            ],
            [
                'country'        => 'United Kingdom',
                'name'           => 'Tower Bridge',
                'description'    => 'A historic bascule and suspension bridge spanning the River Thames, Tower Bridge is famed for its Victorian Gothic architecture and stunning panoramic views of London. The bridge’s walkways offer unique vistas of the city’s skyline and river traffic below.',
                'location'       => 'London, United Kingdom',
                'category'       => 'Landmark',
                'opening_hours'  => '10 AM - 6 PM',
                'average_rating' => 4.3,
                'map_url'        => 'https://maps.app.goo.gl/gx65mHcG34ugwRxs9',
                'photo'          => null,
                'submitted_by'   => 1,
                'visible'        => true,
            ],
            [
                'country'        => 'Japan',
                'name'           => 'Fushimi Inari Shrine',
                'description'    => 'A mesmerizing Shinto shrine in Kyoto, Fushimi Inari is renowned for its thousands of vibrant vermillion torii gates. These gates create a winding path up Mount Inari, offering visitors a spiritual and scenic journey through lush forested slopes.',
                'location'       => 'Kyoto, Japan',
                'category'       => 'Religious Site',
                'opening_hours'  => 'Open 24 hours',
                'average_rating' => 0,
                'map_url'        => 'https://maps.app.goo.gl/ezNF7SFsimkEeutcA',
                'photo'          => null,
                'submitted_by'   => 1,
                'visible'        => true,
            ],
            [
                'country'        => 'Egypt',
                'name'           => 'Pyramids of Giza',
                'description'    => 'One of the Seven Wonders of the Ancient World, the Pyramids of Giza stand as monumental tombs of the pharaohs. Their immense scale, precise construction, and the mysteries surrounding their creation continue to captivate visitors and historians alike.',
                'location'       => 'Giza, Egypt',
                'category'       => 'Historical Site',
                'opening_hours'  => '8 AM - 5 PM',
                'average_rating' => 0,
                'map_url'        => 'https://maps.app.goo.gl/zVLhRG5TiqgC3FrCA',
                'photo'          => null,
                'submitted_by'   => 1,
                'visible'        => true,
            ],
            [
                'country'        => 'Australia',
                'name'           => 'Sydney Opera House',
                'description'    => 'A world-renowned performing arts center and UNESCO World Heritage site, the Sydney Opera House is celebrated for its distinctive sail-like design. It hosts a wide array of cultural events and offers guided tours that reveal the building’s unique architectural features.',
                'location'       => 'Sydney, Australia',
                'category'       => 'Cultural Site',
                'opening_hours'  => '9 AM - 5 PM',
                'average_rating' => 0,
                'map_url'        => 'https://maps.app.goo.gl/ZwohmMricigSmekN7',
                'photo'          => null,
                'submitted_by'   => 1,
                'visible'        => true,
            ],
            [
                'country'        => 'Brazil',
                'name'           => 'Christ the Redeemer',
                'description'    => 'An iconic statue of Jesus Christ overlooking Rio de Janeiro, Christ the Redeemer is a symbol of Brazilian culture and spirituality. With its outstretched arms and panoramic city views, it remains one of the world’s most recognizable landmarks.',
                'location'       => 'Rio de Janeiro, Brazil',
                'category'       => 'Religious Site',
                'opening_hours'  => '8 AM - 6 PM',
                'average_rating' => 0,
                'map_url'        => 'https://maps.app.goo.gl/33VSWH7hrTMKE7sL7',
                'photo'          => null,
                'submitted_by'   => 1,
                'visible'        => true,
            ],
            [
                'country'        => 'United States',
                'name'           => 'Grand Canyon',
                'description'    => 'Carved by the Colorado River over millions of years, the Grand Canyon is one of the most breathtaking natural wonders on Earth. Its vast, layered landscape offers dramatic vistas, challenging hiking trails, and unforgettable sunset views.',
                'location'       => 'Arizona, USA',
                'category'       => 'Natural Wonder',
                'opening_hours'  => 'Open 24 hours',
                'average_rating' => 5,
                'map_url'        => 'https://maps.app.goo.gl/xC9QpprAzfWpP3Dq8',
                'photo'          => null,
                'submitted_by'   => 1,
                'visible'        => true,
            ],
            [
                'country'        => 'United States',
                'name'           => 'Statue of Liberty',
                'description'    => 'A universal symbol of freedom and democracy, the Statue of Liberty stands proudly on Liberty Island in New York Harbor. Visitors can explore its museum, ascend to the pedestal, and enjoy panoramic views of Manhattan and the surrounding waterways.',
                'location'       => 'New York, USA',
                'category'       => 'Landmark',
                'opening_hours'  => '8:30 AM - 4 PM',
                'average_rating' => 0,
                'map_url'        => 'https://maps.app.goo.gl/EXAMPLE',
                'photo'          => null,
                'submitted_by'   => 1,
                'visible'        => true,
            ],
            [
                'country'        => 'China',
                'name'           => 'Great Wall of China',
                'description'    => 'An ancient fortification spanning thousands of miles, the Great Wall of China was built to protect the Chinese empire. Its watchtowers, rugged pathways, and stunning vistas showcase the ingenuity and resilience of an era long past.',
                'location'       => 'Northern China',
                'category'       => 'Historical Site',
                'opening_hours'  => '7 AM - 5 PM',
                'average_rating' => 0,
                'map_url'        => 'https://maps.app.goo.gl/EXAMPLE',
                'photo'          => null,
                'submitted_by'   => 1,
                'visible'        => true,
            ],
            [
                'country'        => 'Canada',
                'name'           => 'Niagara Falls',
                'description'    => 'A natural spectacle straddling the border of Canada and the USA, Niagara Falls is famed for its powerful cascades and misty atmosphere. Visitors can take boat tours for an up-close view or admire the falls from panoramic observation decks.',
                'location'       => 'Ontario, Canada / New York, USA',
                'category'       => 'Natural Wonder',
                'opening_hours'  => '24/7',
                'average_rating' => 0,
                'map_url'        => 'https://maps.app.goo.gl/EXAMPLE',
                'photo'          => null,
                'submitted_by'   => 1,
                'visible'        => true,
            ],
            [
                'country'        => 'Spain',
                'name'           => 'Sagrada Familia',
                'description'    => 'An iconic basilica in Barcelona designed by Antoni Gaudí, the Sagrada Familia is celebrated for its intricate facades, towering spires, and a stunning interior that resembles a forest of stone columns. Despite being under construction for over a century, its unique blend of Gothic and Art Nouveau styles continues to inspire awe.',
                'location'       => 'Barcelona, Spain',
                'category'       => 'Religious Site',
                'opening_hours'  => '9 AM - 8 PM',
                'average_rating' => 0,
                'map_url'        => 'https://maps.app.goo.gl/EXAMPLE',
                'photo'          => null,
                'submitted_by'   => 1,
                'visible'        => true,
            ],
            [
                'country'        => 'France',
                'name'           => 'Palace of Versailles',
                'description'    => 'The opulent Palace of Versailles, with its magnificent gardens and Hall of Mirrors, offers a glimpse into the extravagance of the French monarchy.',
                'location'       => 'Versailles, France',
                'category'       => 'Historical Site',
                'opening_hours'  => '9 AM - 6 PM',
                'average_rating' => 0,
                'map_url'        => 'https://maps.app.goo.gl/EXAMPLE',
                'photo'          => null,
                'submitted_by'   => 1,
                'visible'        => true,
            ],
            [
                'country'        => 'Italy',
                'name'           => 'Leaning Tower of Pisa',
                'description'    => 'The Leaning Tower of Pisa is renowned for its unintended tilt and Romanesque architecture. It has become an iconic symbol of Italy’s rich history.',
                'location'       => 'Pisa, Italy',
                'category'       => 'Historical Site',
                'opening_hours'  => '8 AM - 7 PM',
                'average_rating' => 0,
                'map_url'        => 'https://maps.app.goo.gl/EXAMPLE',
                'photo'          => null,
                'submitted_by'   => 1,
                'visible'        => true,
            ],
            [
                'country'        => 'Japan',
                'name'           => 'Tokyo Tower',
                'description'    => 'Tokyo Tower is a communications and observation tower in the heart of Tokyo, offering breathtaking views of the sprawling city below.',
                'location'       => 'Tokyo, Japan',
                'category'       => 'Landmark',
                'opening_hours'  => '9 AM - 11 PM',
                'average_rating' => 0,
                'map_url'        => 'https://maps.app.goo.gl/EXAMPLE',
                'photo'          => null,
                'submitted_by'   => 1,
                'visible'        => true,
            ],
            [
                'country'        => 'United States',
                'name'           => 'Golden Gate Bridge',
                'description'    => 'An iconic suspension bridge in San Francisco, the Golden Gate Bridge is celebrated for its striking red color and majestic views over the bay.',
                'location'       => 'San Francisco, USA',
                'category'       => 'Landmark',
                'opening_hours'  => 'Open 24 hours',
                'average_rating' => 0,
                'map_url'        => 'https://maps.app.goo.gl/EXAMPLE',
                'photo'          => null,
                'submitted_by'   => 1,
                'visible'        => true,
            ],
            [
                'country'        => 'Australia',
                'name'           => 'Bondi Beach',
                'description'    => 'Bondi Beach is one of Australia’s most famous beaches, renowned for its golden sands, excellent surf, and vibrant coastal atmosphere.',
                'location'       => 'Sydney, Australia',
                'category'       => 'Natural Wonder',
                'opening_hours'  => 'Open 24 hours',
                'average_rating' => 0,
                'map_url'        => 'https://maps.app.goo.gl/EXAMPLE',
                'photo'          => null,
                'submitted_by'   => 1,
                'visible'        => true,
            ],
            [
                'country'        => 'Egypt',
                'name'           => 'Valley of the Kings',
                'description'    => 'The Valley of the Kings is the burial site of Egyptian pharaohs, where elaborate tombs carved into rock offer insights into ancient funerary customs.',
                'location'       => 'Luxor, Egypt',
                'category'       => 'Historical Site',
                'opening_hours'  => '8 AM - 5 PM',
                'average_rating' => 0,
                'map_url'        => 'https://maps.app.goo.gl/EXAMPLE',
                'photo'          => null,
                'submitted_by'   => 1,
                'visible'        => true,
            ],
            [
                'country'        => 'Brazil',
                'name'           => 'Iguazu Falls',
                'description'    => 'Iguazu Falls is a breathtaking collection of waterfalls located on the border between Brazil and Argentina, renowned for its raw natural beauty.',
                'location'       => 'Foz do Iguaçu, Brazil',
                'category'       => 'Natural Wonder',
                'opening_hours'  => '8 AM - 6 PM',
                'average_rating' => 0,
                'map_url'        => 'https://maps.app.goo.gl/EXAMPLE',
                'photo'          => null,
                'submitted_by'   => 1,
                'visible'        => true,
            ],
            [
                'country'        => 'Greece',
                'name'           => 'Delphi',
                'description'    => 'Delphi, once considered the center of the world by the ancient Greeks, is famed for its archaeological ruins and the legendary Oracle of Delphi.',
                'location'       => 'Delphi, Greece',
                'category'       => 'Historical Site',
                'opening_hours'  => '8 AM - 7 PM',
                'average_rating' => 0,
                'map_url'        => 'https://maps.app.goo.gl/EXAMPLE',
                'photo'          => null,
                'submitted_by'   => 1,
                'visible'        => true,
            ],
            [
                'country'        => 'Spain',
                'name'           => 'Alhambra',
                'description'    => 'The Alhambra in Granada is a palace and fortress complex known for its stunning Islamic art and architecture, lush gardens, and intricate design details.',
                'location'       => 'Granada, Spain',
                'category'       => 'Historical Site',
                'opening_hours'  => '8 AM - 8 PM',
                'average_rating' => 0,
                'map_url'        => 'https://maps.app.goo.gl/EXAMPLE',
                'photo'          => null,
                'submitted_by'   => 1,
                'visible'        => true,
            ],
            [
                'country'        => 'Germany',
                'name'           => 'Neuschwanstein Castle',
                'description'    => 'Neuschwanstein Castle, built by King Ludwig II of Bavaria, is a fairy-tale fortress known for its romantic architecture and stunning mountain surroundings.',
                'location'       => 'Bavaria, Germany',
                'category'       => 'Historical Site',
                'opening_hours'  => '9 AM - 6 PM',
                'average_rating' => 0,
                'map_url'        => 'https://maps.app.goo.gl/EXAMPLE',
                'photo'          => null,
                'submitted_by'   => 1,
                'visible'        => true,
            ],
            [
                'country'        => 'Canada',
                'name'           => 'CN Tower',
                'description'    => 'The CN Tower is a signature landmark in Toronto, Canada, offering panoramic views of the city from its observation deck.',
                'location'       => 'Toronto, Canada',
                'category'       => 'Landmark',
                'opening_hours'  => '9 AM - 10 PM',
                'average_rating' => 0,
                'map_url'        => 'https://maps.app.goo.gl/EXAMPLE',
                'photo'          => null,
                'submitted_by'   => 1,
                'visible'        => true,
            ],
            [
                'country'        => 'China',
                'name'           => 'Terracotta Army',
                'description'    => 'The Terracotta Army, depicting the armies of China’s first emperor, is an archaeological wonder that offers a glimpse into ancient military history.',
                'location'       => 'Xi\'an, China',
                'category'       => 'Historical Site',
                'opening_hours'  => '8 AM - 5 PM',
                'average_rating' => 0,
                'map_url'        => 'https://maps.app.goo.gl/EXAMPLE',
                'photo'          => null,
                'submitted_by'   => 1,
                'visible'        => true,
            ],
            [
                'country'        => 'France',
                'name'           => 'Mont Saint-Michel',
                'description'    => 'Mont Saint-Michel is a medieval abbey perched atop a rocky island in Normandy, renowned for its dramatic tides and historic charm.',
                'location'       => 'Normandy, France',
                'category'       => 'Historical Site',
                'opening_hours'  => '9 AM - 6 PM',
                'average_rating' => 0,
                'map_url'        => 'https://maps.app.goo.gl/EXAMPLE',
                'photo'          => null,
                'submitted_by'   => 1,
                'visible'        => true,
            ],
            [
                'country'        => 'Italy',
                'name'           => 'Pompeii Ruins',
                'description'    => 'The ancient ruins of Pompeii offer a captivating glimpse into Roman life, preserved in time after the eruption of Mount Vesuvius.',
                'location'       => 'Pompeii, Italy',
                'category'       => 'Historical Site',
                'opening_hours'  => '8 AM - 6 PM',
                'average_rating' => 0,
                'map_url'        => 'https://maps.app.goo.gl/EXAMPLE',
                'photo'          => null,
                'submitted_by'   => 1,
                'visible'        => true,
            ],
            [
                'country'        => 'Japan',
                'name'           => 'Tokyo Skytree',
                'description'    => 'Tokyo Skytree is a broadcasting and observation tower that offers breathtaking panoramic views of the bustling city of Tokyo.',
                'location'       => 'Tokyo, Japan',
                'category'       => 'Landmark',
                'opening_hours'  => '9 AM - 10 PM',
                'average_rating' => 0,
                'map_url'        => 'https://maps.app.goo.gl/EXAMPLE',
                'photo'          => null,
                'submitted_by'   => 1,
                'visible'        => true,
            ],
            [
                'country'        => 'United States',
                'name'           => 'Yellowstone National Park',
                'description'    => 'America\'s first national park, Yellowstone is famed for its geothermal features, abundant wildlife, and expansive natural landscapes.',
                'location'       => 'Wyoming, USA',
                'category'       => 'Natural Wonder',
                'opening_hours'  => 'Open 24 hours',
                'average_rating' => 0,
                'map_url'        => 'https://maps.app.goo.gl/EXAMPLE',
                'photo'          => null,
                'submitted_by'   => 1,
                'visible'        => true,
            ],
            [
                'country'        => 'Australia',
                'name'           => 'Great Barrier Reef',
                'description'    => 'The Great Barrier Reef is the world\'s largest coral reef system, celebrated for its vibrant marine life and stunning underwater scenery.',
                'location'       => 'Queensland, Australia',
                'category'       => 'Natural Wonder',
                'opening_hours'  => '9 AM - 5 PM',
                'average_rating' => 0,
                'map_url'        => 'https://maps.app.goo.gl/EXAMPLE',
                'photo'          => null,
                'submitted_by'   => 1,
                'visible'        => true,
            ],
            [
                'country'        => 'Brazil',
                'name'           => 'Itaipu Dam',
                'description'    => 'Itaipu Dam is one of the world\'s largest hydroelectric power plants, an engineering marvel located on the border between Brazil and Paraguay.',
                'location'       => 'Paraná, Brazil',
                'category'       => 'Landmark',
                'opening_hours'  => '9 AM - 5 PM',
                'average_rating' => 0,
                'map_url'        => 'https://maps.app.goo.gl/EXAMPLE',
                'photo'          => null,
                'submitted_by'   => 1,
                'visible'        => true,
            ],
            [
                'country'        => 'Greece',
                'name'           => 'Mykonos Windmills',
                'description'    => 'The iconic windmills of Mykonos overlook the Aegean Sea and stand as symbols of the island’s rich history and charm.',
                'location'       => 'Mykonos, Greece',
                'category'       => 'Scenic View',
                'opening_hours'  => 'Open 24 hours',
                'average_rating' => 0,
                'map_url'        => 'https://maps.app.goo.gl/EXAMPLE',
                'photo'          => null,
                'submitted_by'   => 1,
                'visible'        => true,
            ],
            [
                'country'        => 'Spain',
                'name'           => 'Alhambra',
                'description'    => 'The Alhambra is a stunning palace and fortress complex in Granada, famed for its exquisite Islamic art, lush gardens, and intricate architectural details.',
                'location'       => 'Granada, Spain',
                'category'       => 'Historical Site',
                'opening_hours'  => '8 AM - 8 PM',
                'average_rating' => 0,
                'map_url'        => 'https://maps.app.goo.gl/EXAMPLE',
                'photo'          => null,
                'submitted_by'   => 1,
                'visible'        => true,
            ],
            [
                'country'        => 'Germany',
                'name'           => 'Neuschwanstein Castle',
                'description'    => 'Neuschwanstein Castle is a fairy-tale fortress built by King Ludwig II of Bavaria, celebrated for its romantic design and breathtaking alpine surroundings.',
                'location'       => 'Bavaria, Germany',
                'category'       => 'Historical Site',
                'opening_hours'  => '9 AM - 6 PM',
                'average_rating' => 0,
                'map_url'        => 'https://maps.app.goo.gl/EXAMPLE',
                'photo'          => null,
                'submitted_by'   => 1,
                'visible'        => true,
            ],
            
        ];

        foreach ($sights as $sight) {
            $country = Country::where('name', $sight['country'])->first();

            if ($country) {
                if (strtolower(trim($sight['opening_hours'])) === 'open 24 hours') {
                    $sight['opening_hours'] = '24/7';
                }

                Sight::create([
                    'country_id'     => $country->id,
                    'name'           => $sight['name'],
                    'description'    => $sight['description'],
                    'location'       => $sight['location'],
                    'category'       => $sight['category'],
                    'opening_hours'  => $sight['opening_hours'],
                    'average_rating' => $sight['average_rating'] ?? 0,
                    'map_url'        => $sight['map_url'],
                    'photo'          => $sight['photo'],
                    'submitted_by'   => $sight['submitted_by'],
                    'visible'        => $sight['visible'],
                ]);
            }
        }
    }
}
