<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Topic;
use App\Models\Reply;
use App\Models\User;

class ForumTableSeeder extends Seeder
{
    public function run()
    {
        $users = User::pluck('id');

        $topics = [
            [
                'title'   => 'Best Travel Destinations for 2024',
                'content' => 'Let’s discuss the top travel spots for this year!',
            ],
            [
                'title'   => 'What’s your favorite travel memory?',
                'content' => 'Share the most unforgettable experiences from your trips.',
            ],
            [
                'title'   => 'Tips for Budget Travel',
                'content' => 'How do you save money when traveling? Share your best tips.',
            ],
            [
                'title'   => 'Overcoming Language Barriers',
                'content' => 'Have you ever traveled somewhere without speaking the language?',
            ],
        ];

        $sampleReplies = [
            'I absolutely loved visiting local markets. The food and crafts were incredible!',
            'One tip: always learn a few basic phrases in the local language—it goes a long way.',
            'Budget airlines can be a hit or miss, but sometimes you find real gems!',
            'Bali was breathtaking. The beaches, temples, and friendly locals made it special.',
            'I recommend traveling off-season to avoid the crowds and save on accommodation.',
            'Definitely try the local cuisine—food tours can be the highlight of a trip.',
            'Make sure you have a good travel insurance plan. It saved me big time once!',
            'If you’re into history, local museums are a must-see!',
            'Meeting new people was my favorite part. You learn so much about the culture.',
            'I found a hidden waterfall hike that was the highlight of my entire trip!',
        ];

        foreach ($topics as $topicData) {
            $createdTopic = Topic::create([
                'user_id' => $users->random(),
                'title'   => $topicData['title'],
                'content' => $topicData['content'],
            ]);

            $replyCount = rand(2, 5);

            for ($i = 0; $i < $replyCount; $i++) {
                Reply::create([
                    'topic_id' => $createdTopic->id,
                    'user_id'  => $users->random(),
                    'content'  => $sampleReplies[array_rand($sampleReplies)],
                ]);
            }
        }
    }
}
