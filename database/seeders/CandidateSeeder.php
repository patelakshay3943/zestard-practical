<?php

namespace Database\Seeders;

use App\Models\Candidate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $candidateListArray = [
            [
                'name' => 'James Anderson',
                'profile_image' => 'images/testimonial/member-01.jpg',
            ],
            [
                'name' => 'Arun Kumar',
                'profile_image' => 'images/testimonial/member-02.jpg',
            ],
            [
                'name' => 'Pream Nath',
                'profile_image' => 'images/testimonial/member-03.jpg',
            ],
            [
                'name' => 'Reena Anath',
                'profile_image' => 'images/testimonial/member-04.jpg',
            ]
        ];
        foreach ($candidateListArray as $item)
        {
            Candidate::updateOrCreate($item,['name'=>$item['name']]);
        }
    }
}
