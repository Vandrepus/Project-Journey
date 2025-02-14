<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\Sight;
use App\Models\User;

class ReviewsTableSeeder extends Seeder
{
    public function run()
    {
        $reviews = [
            [
                'sight' => 'Eiffel Tower',
                'content' => [
                    "Breathtaking view from the top! A must-visit when in Paris.",
                    "Beautiful at night when the lights sparkle! Great experience.",
                    "The queues are long, but the view is absolutely worth it!",
                ],
                'ratings' => [5, 4, 5],
            ],
            [
                'sight' => 'Colosseum',
                'content' => [
                    "Stepping into history! The architecture is stunning.",
                    "An incredible place, but be prepared for crowds.",
                    "If you love history, this is a must-see in Rome.",
                ],
                'ratings' => [5, 4, 4],
            ],
            [
                'sight' => 'Tower Bridge',
                'content' => [
                    "A fantastic structure! The glass floor is thrilling!",
                    "The bridge looks amazing, especially when it opens for ships.",
                    "Great views of London from the top walkways.",
                ],
                'ratings' => [5, 4, 4],
            ],
            [
                'sight' => 'Grand Canyon',
                'content' => [
                    "Nature’s masterpiece! The sheer size is awe-inspiring.",
                    "Unreal views at sunrise! Bring lots of water.",
                    "Hiking here was the best experience of my trip!",
                ],
                'ratings' => [5, 5, 5],
            ],
        ];

        foreach ($reviews as $reviewData) {
            $sight = Sight::where('name', $reviewData['sight'])->first();

            if ($sight) {
                foreach ($reviewData['content'] as $index => $content) {
                    Review::create([
                        'sight_id' => $sight->id,
                        'user_id' => User::inRandomOrder()->first()->id,
                        'content' => $content,
                        'rating' => $reviewData['ratings'][$index],
                    ]);
                }
            }
        }
    }
}
