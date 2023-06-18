<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorSpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('doctor_specializations')->insert([
            ['specialization' => 'Orthopedics','created_at' => now(),'updated_at' => now()],
            ['specialization' => 'Internal Medicine','created_at' => now(),'updated_at' => now()],
            ['specialization' => 'Obstetrics and Gynecology','created_at' => now(),'updated_at' => now()],
            ['specialization' => 'Dermatology','created_at' => now(),'updated_at' => now()],
            ['specialization' => 'Pediatrics','created_at' => now(),'updated_at' => now()],
            ['specialization' => 'Radiology','created_at' => now(),'updated_at' => now()],
            ['specialization' => 'General Surgery','created_at' => now(),'updated_at' => now()],
            ['specialization' => 'Ophthalmology','created_at' => now(),'updated_at' => now()],
            ['specialization' => 'Anesthesia','created_at' => now(),'updated_at' => now()],
            ['specialization' => 'Pathology','created_at' => now(),'updated_at' => now()],
            ['specialization' => 'ENT','created_at' => now(),'updated_at' => now()],
            ['specialization' => 'Dental Care','created_at' => now(),'updated_at' => now()],
            ['specialization' => 'Dermatologists','created_at' => now(),'updated_at' => now()],
            ['specialization' => 'Endocrinologists','created_at' => now(),'updated_at' => now()],
            ['specialization' => 'Neurologists','created_at' => now(),'updated_at' => now()],
        ]);
    }
}
