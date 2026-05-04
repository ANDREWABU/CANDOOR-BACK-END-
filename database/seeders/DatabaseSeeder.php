<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(DegreesTableSeeder::class);
        $this->call(FieldOfStudiesTableSeeder::class);
        $this->call(HighestDegreeCompletedsTableSeeder::class);
        $this->call(IndustriesTableSeeder::class);
        $this->call(MeetingTypesTableSeeder::class);
        $this->call(QuizTableSeeder::class);
        $this->call(RaceEthnicitiesTableSeeder::class);
        $this->call(ReferralCodesTableSeeder::class);
        $this->call(SchoolsTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(TimeZonesTableSeeder::class);
        $this->call(WorkRolesTableSeeder::class);
        $this->call(GenderIdentitySeeder::class);
        $this->call(SocioEconomicStatusSeeder::class);
    }
}
