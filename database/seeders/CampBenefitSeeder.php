<?php

namespace Database\Seeders;

use App\Models\CampBenefit;
use Illuminate\Database\Seeder;

class CampBenefitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $campBenefits = [
            [
                'camp_id' => 1,
                'name' => 'Pro TechStack Kit'
            ],
            [
                'camp_id' => 1,
                'name' => 'iMac Pro 2024 $ Display'
            ],
            [
                'camp_id' => 1,
                'name' => '1-1 Mentoring Program'
            ],
            [
                'camp_id' => 1,
                'name' => 'Final Project Certificate'
            ],
            [
                'camp_id' => 1,
                'name' => 'Offline Course Video'
            ],
            [
                'camp_id' => 1,
                'name' => 'Future Job Oportunity'
            ],
            [
                'camp_id' => 1,
                'name' => 'Premium Design Kit'
            ],
            [
                'camp_id' => 1,
                'name' => 'Website Builder'
            ],
            [
                'camp_id' => 2,
                'name' => '1-1 Mentoring'
            ],
            [
                'camp_id' => 2,
                'name' => 'Final Project Certificate'
            ],
            [
                'camp_id' => 2,
                'name' => 'Offline Course Video'
            ]
        ];

        CampBenefit::insert($campBenefits);
    }
}
