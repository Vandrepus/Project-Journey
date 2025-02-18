<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Comment;
use App\Models\User;

class NewsTableSeeder extends Seeder
{
    public function run()
    {
        $admin = User::find(1);

        if (!$admin) {
            $admin = User::create([
                'id'       => 1,
                'name'     => 'Admin User',
                'email'    => 'admin@example.com',
                'password' => bcrypt('password'),
                'usertype' => 'admin',
            ]);
        }

        $articles = [
            [
                'admin_id' => $admin->id,
                'title'    => 'Top Travel Destinations for 2024',
                'content'  => 'Explore the best places to visit in 2024, from exotic beaches to cultural landmarks.',
            ],
            [
                'admin_id' => $admin->id,
                'title'    => 'How to Plan a Budget-Friendly Trip',
                'content'  => 'Traveling doesn’t have to be expensive. Here are tips to make your trips more affordable!',
            ],
            [
                'admin_id' => $admin->id,
                'title'    => 'Tips for Traveling with Kids',
                'content'  => 'Make family travel easier with these helpful suggestions for parents on the go.',
            ],
            [
                'admin_id' => $admin->id,
                'title'    => 'Must-Try Local Foods Around the World',
                'content'  => 'Discover iconic dishes that you simply can’t miss when visiting new destinations.',
            ],
            [
                'admin_id' => $admin->id,
                'title'    => 'Adventure Travel: Best Hiking Trails',
                'content'  => 'If you love the great outdoors, these trails offer stunning views and unforgettable journeys.',
            ],
            [
                'admin_id' => $admin->id,
                'title'    => 'Overcoming Jet Lag: Expert Tips',
                'content'  => 'Learn how to minimize jet lag and adjust quickly to new time zones.',
            ],
        ];

        $commentSamples = [
            'This was very informative! Thanks for sharing.',
            'I can’t wait to visit that place someday!',
            'Great advice—I’ll definitely use these tips on my next trip.',
            'I’ve always wanted to explore that region. Great read!',
            'Thanks for the info. Looking forward to more articles like this.',
            'Fantastic article! Keep up the good work.',
            'Loved the details—this really helps with planning.',
            'I never knew about this destination. Thanks for opening my eyes!',
        ];

        foreach ($articles as $articleData) {
            $createdArticle = Article::create($articleData);

            $numberOfComments = rand(2, 4);

            for ($i = 0; $i < $numberOfComments; $i++) {
                Comment::create([
                    'article_id' => $createdArticle->id,
                    'user_id'    => User::inRandomOrder()->first()->id, // Any random user
                    'comment'    => $commentSamples[array_rand($commentSamples)],
                ]);
            }
        }
    }
}
