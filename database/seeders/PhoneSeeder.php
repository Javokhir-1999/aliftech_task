<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use App\Models\Phone;
use App\Models\Contact;

class PhoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Phone::factory()->count(8)->state(new Sequence(
            fn ($sequence) => ['contact_id' => Contact::all('id')->random()],
        ))->create();
    }
}
