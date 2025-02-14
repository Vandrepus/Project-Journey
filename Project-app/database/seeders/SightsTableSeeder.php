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
                'country' => 'France',
                'name' => 'Eiffel Tower',
                'description' => 'An architectural masterpiece and a symbol of France, offering breathtaking panoramic views of Paris from its observation decks.',
                'location' => 'Paris, France',
                'category' => 'Landmark',
                'opening_hours' => '9 AM - 11 PM',
                'average_rating' => 4.7,
                'map_url' => 'https://maps.app.goo.gl/wXQEk6uYHFadzo8Q8',
                'photo' => null,
                'submitted_by' => 1,
                'visible' => true,
            ],
            [
                'country' => 'Italy',
                'name' => 'Colosseum',
                'description' => 'A stunning Roman amphitheater that once hosted gladiatorial contests, showcasing the grandeur of ancient Rome.',
                'location' => 'Rome, Italy',
                'category' => 'Historical Site',
                'opening_hours' => '8 AM - 5 PM',
                'average_rating' => 4.3,
                'map_url' => 'https://maps.app.goo.gl/qvVime4Ynpb3n7p86',
                'photo' => null,
                'submitted_by' => 1,
                'visible' => true,
            ],
            [
                'country' => 'United Kingdom',
                'name' => 'Tower Bridge',
                'description' => 'A historic bascule bridge spanning the River Thames, known for its stunning Victorian Gothic architecture.',
                'location' => 'London, United Kingdom',
                'category' => 'Landmark',
                'opening_hours' => '10 AM - 6 PM',
                'average_rating' => 4.3,
                'map_url' => 'https://maps.app.goo.gl/gx65mHcG34ugwRxs9',
                'photo' => null,
                'submitted_by' => 1,
                'visible' => true,
            ],
            [
                'country' => 'Japan',
                'name' => 'Fushimi Inari Shrine',
                'description' => 'A mesmerizing Shinto shrine known for its thousands of vermillion torii gates leading through the forested hills.',
                'location' => 'Kyoto, Japan',
                'category' => 'Religious Site',
                'opening_hours' => '0AM - 0PM',
                'average_rating' => 0,
                'map_url' => 'https://maps.app.goo.gl/ezNF7SFsimkEeutcA',
                'photo' => null,
                'submitted_by' => 1,
                'visible' => true,
            ],
            [
                'country' => 'Egypt',
                'name' => 'Pyramids of Giza',
                'description' => 'One of the Seven Wonders of the Ancient World, these massive pyramids stand as a testament to the ingenuity of ancient Egypt.',
                'location' => 'Giza, Egypt',
                'category' => 'Historical Site',
                'opening_hours' => '8 AM - 5 PM',
                'average_rating' => 0,
                'map_url' => 'https://maps.app.goo.gl/zVLhRG5TiqgC3FrCA',
                'photo' => null,
                'submitted_by' => 1,
                'visible' => true,
            ],
            [
                'country' => 'Australia',
                'name' => 'Sydney Opera House',
                'description' => 'A world-renowned performing arts center and UNESCO World Heritage site, famous for its sail-like design.',
                'location' => 'Sydney, Australia',
                'category' => 'Cultural Site',
                'opening_hours' => '9 AM - 5 PM',
                'average_rating' => 0,
                'map_url' => 'https://maps.app.goo.gl/ZwohmMricigSmekN7',
                'photo' => null,
                'submitted_by' => 1,
                'visible' => true,
            ],
            [
                'country' => 'Brazil',
                'name' => 'Christ the Redeemer',
                'description' => 'An iconic statue of Jesus Christ towering over Rio de Janeiro, offering a breathtaking panoramic view of the city.',
                'location' => 'Rio de Janeiro, Brazil',
                'category' => 'Religious Site',
                'opening_hours' => '8 AM - 6 PM',
                'average_rating' => 0,
                'map_url' => 'https://maps.app.goo.gl/33VSWH7hrTMKE7sL7',
                'photo' => null,
                'submitted_by' => 1,
                'visible' => true,
            ],
            [
                'country' => 'United States',
                'name' => 'Grand Canyon',
                'description' => 'One of the most breathtaking natural wonders in the world, carved by the Colorado River over millions of years.',
                'location' => 'Arizona, USA',
                'category' => 'Natural Wonder',
                'opening_hours' => '0AM - 0PM',
                'average_rating' => 5,
                'map_url' => 'https://maps.app.goo.gl/xC9QpprAzfWpP3Dq8',
                'photo' => null,
                'submitted_by' => 1,
                'visible' => true,
            ],
        ];

        foreach ($sights as $sight) {
            $country = Country::where('name', $sight['country'])->first();

            if ($country) {
                Sight::create([
                    'country_id' => $country->id,
                    'name' => $sight['name'],
                    'description' => $sight['description'],
                    'location' => $sight['location'],
                    'category' => $sight['category'],
                    'opening_hours' => $sight['opening_hours'],
                    'average_rating' => $sight['average_rating'],
                    'map_url' => $sight['map_url'],
                    'photo' => $sight['photo'],
                    'submitted_by' => $sight['submitted_by'],
                    'visible' => $sight['visible'],
                ]);
            }
        }
    }
}
