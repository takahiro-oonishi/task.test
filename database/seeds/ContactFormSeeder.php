<?php

use Illuminate\Database\Seeder;
use App\Models\ContactForm;//インポート

class ContactFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(ContactForm::class,200)->create();//２００個のダミーデータを作成
    }
}
