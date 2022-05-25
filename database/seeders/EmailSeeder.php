<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use App\Models\Email;
use App\Models\Contact;

class EmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Email::factory()->count(18)->state(new Sequence(
            fn ($sequence) => ['contact_id' => Contact::all('id')->random()],
        ))->create();
    }
}
