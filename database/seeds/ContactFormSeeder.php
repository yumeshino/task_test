<?php

use Illuminate\Database\Seeder;
use App\Model\ContactForm;


class ContactFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ContactForm::class,200)->create();//200個のダミーデータを生成
    }
}
