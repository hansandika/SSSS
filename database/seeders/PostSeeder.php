<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Exploring the Heart of Academics',
                'content' => 'The academic world is full of fascinating disciplines, each with its unique challenges and rewards. Research, critical thinking, and innovation form the bedrock of scholarly pursuit.',
                'slug' => 'exploring-the-heart-of-academics',
            ],
            [
                'user_id' => 2,
                'category_id' => 2,
                'title' => 'A Journey Through Italy',
                'content' => 'Italy, with its rich history, stunning landscapes, and delectable cuisine, offers countless opportunities for exploration and discovery.',
                'slug' => 'a-journey-through-italy',
            ],
            [
                'user_id' => 3,
                'category_id' => 3,
                'title' => 'The Culinary Delights of Japanese Cuisine',
                'content' => 'Japanese cuisine is admired worldwide for its balance of flavor, presentation, and nutrition. From sushi to ramen, the variety is endless.',
                'slug' => 'the-culinary-delights-of-japanese-cuisine',
            ],
            [
                'user_id' => 1,
                'category_id' => 4,
                'title' => 'The Enriching Experiences of Book Club Participation',
                'content' => 'Book clubs offer an enriching experience, providing opportunities for intellectual stimulation, lively discussion, and social interaction.',
                'slug' => 'the-enriching-experiences-of-book-club-participation',
            ],
            [
                'user_id' => 2,
                'category_id' => 5,
                'title' => 'Navigating the Intricacies of Apartment Rental',
                'content' => 'Renting an apartment involves numerous considerations. Understanding the lease terms, property conditions, and rental laws are key to a positive rental experience.',
                'slug' => 'navigating-the-intricacies-of-apartment-rental',
            ],
            [
                'user_id' => 3,
                'category_id' => 6,
                'title' => 'An Insight into Cardiovascular Research',
                'content' => 'Cardiovascular research continually evolves, offering insights into the prevention, diagnosis, and treatment of heart disease. The path to discovery is an ongoing journey.',
                'slug' => 'an-insight-into-cardiovascular-research',
            ],
            [
                'user_id' => 1,
                'category_id' => 7,
                'title' => 'Diversifying Your Fitness Routine',
                'content' => 'Diversifying your fitness routine can provide a range of health benefits while keeping your workouts exciting and challenging.',
                'slug' => 'diversifying-your-fitness-routine',
            ],
            [
                'user_id' => 2,
                'category_id' => 1,
                'title' => 'Understanding Quantum Mechanics',
                'content' => 'Quantum mechanics is a fundamental theory in physics that provides a description of the physical properties of nature at the scale of atoms and subatomic particles.',
                'slug' => 'understanding-quantum-mechanics',
            ],
            [
                'user_id' => 3,
                'category_id' => 2,
                'title' => 'The Hidden Gems of South America',
                'content' => 'South America is home to stunning landscapes, vibrant cultures, and remarkable historical sites.',
                'slug' => 'the-hidden-gems-of-south-america',
            ]
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
