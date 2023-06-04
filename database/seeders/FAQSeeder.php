<?php

namespace Database\Seeders;

use App\Models\FAQ;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqList = [
            [
                'question' => 'What is the purpose of this website?',
                'answer' => 'This website is a platform for international students to share their experiences and knowledge about living in Japan. 
                We hope that this website will be a useful resource for international students who are planning to study in Japan, as well as those who are already living in Japan.',
            ],
            [
                'question' => 'How can I get to Omiya Station from Narita Airport?',
                'answer' => "There are several options to reach Omiya Station from Narita Airport:
                1. By Train:
                Take the Narita Skyliner from Narita Airport to Nippori Station. From Nippori Station, take the JR Yamanote Line to Ueno Station. Then take the Shonan-Shinjuku Line or the Utsunomiya Line (also known as the Tohoku Main Line) from Ueno Station to Omiya Station.
                
                2. By Airport Limousine Bus and Train:
                An alternative is to take the Airport Limousine Bus from Narita Airport to Tokyo Station (Yaesu North Exit). From Tokyo Station, take the Shonan-Shinjuku Line or the Utsunomiya Line to Omiya Station.
                
                Please note that travel times can vary based on the time of day and traffic conditions. Be sure to check the latest train and bus schedules.
                
                It's also worth noting that the Japan Rail Pass covers the Narita Express and the JR lines, so if you plan on traveling around Japan, this might be a cost-effective option.
                
                Make sure to follow the guidelines regarding luggage and conduct on Japanese public transportation. Travel can be a bit complicated, so if you have further questions, feel free to ask!
                
                Please note that the routes may change, so always check the most up-to-date information on transportation websites or applications like Google Maps.",
            ],
            [
                'question' => 'What is GLC ?',
                'answer' => 'GLC is a student organization at the University of Shibaura that aims to support international students in Japan. GLC is a community place for SIT students, faculties and staffs.
                As a global university, University are committed to provide opportunities for both international and domestic students with diverse backgrounds to become open-minded by learning languages, sharing different cultures, communicating with each other, and so much more.
                '
            ],
            [
                'question' => 'Who is GLC Staff',
                'answer' => 'At GLC, student staff called "GLC staff" are here and ready to support any visitors. If you wish to practice different languages, ask questions about studying abroad, or simply enjoy meeting new people, the GLC staff will be happy to assist you!'
            ],
            [
                'question' => 'What is Available at GLC?',
                'answer' => '1. Learn about Studying Abroad
                If you wish to study abroad someday or hear experiences from students who studied abroad, GLC student staffs will be happy to talk to you and share their experiences.

                2. Practice Languages and Learn about Different Cultures
                If you wish to practice other languages, or learn about other cultures, our students from various countries will be happy to talk to you and share their stories.

                3. Support for Living in Japan (Mainly for International Students)
                If you need help in everyday life, such as purchasing a train pass, opening a bank account, and so on, we will support you. Also, if you have any questions before starting to live and study in Japan, please feel free to access the Facebook page called "SIT Student Support Community", which is mainly organized by GLC staff. Along with international students, this community group is dedicated to share information, and based on their experiences, they will be happy to respond to your questions before coming to Japan.

                4. Books and Materials
                There are many books, magazines and materials available in GLC room. These are available for you to read in the room only, not for check-out. However, a variety of books are available especially for language studies (including TOEIC and TOEFL) and cultural information (including Japanese cuisine and Manga).

                5. Events
                A variety of events and activities are planned and held on regular basis. It is a great opportunity for you to get involved and learn about different cultures while having fun!'
            ]
        ];

        foreach ($faqList as $faq) {
            FAQ::create([
                'question' => $faq['question'],
                'answer' => $faq['answer'],
            ]);
        }
    }
}
