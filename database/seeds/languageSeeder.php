<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class languageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $languages = [
            ["code"=>"AF", "name"=>"Afrikaans", "description"=>' '],
            ["code"=>"SQ", "name"=>"Albanian", "description"=>' '],
            ["code"=>"AR", "name"=>"Arabic", "description"=>' '],
            ["code"=>"HY", "name"=>"Armenian", "description"=>' '],
            ["code"=>"EU", "name"=>"Basque", "description"=>' '],
            ["code"=>"BN", "name"=>"Bengali", "description"=>' '],
            ["code"=>"BG", "name"=>"Bulgarian", "description"=>' '],
            ["code"=>"CA", "name"=>"Catalan", "description"=>' '],
            ["code"=>"KM", "name"=>"Cambodian", "description"=>' '],
            ["code"=>"ZH", "name"=>"Chinese (Mandarin)", "description"=>' '],
            ["code"=>"HR", "name"=>"Croatian", "description"=>' '],
            ["code"=>"CS", "name"=>"Czech", "description"=>' '],
            ["code"=>"DA", "name"=>"Danish", "description"=>' '],
            ["code"=>"NL", "name"=>"Dutch", "description"=>' '],
            ["code"=>"EN", "name"=>"English", "description"=>' '],
            ["code"=>"ET", "name"=>"Estonian", "description"=>' '],
            ["code"=>"FJ", "name"=>"Fiji", "description"=>' '],
            ["code"=>"FI", "name"=>"Finnish", "description"=>' '],
            ["code"=>"FR", "name"=>"French", "description"=>' '],
            ["code"=>"KA", "name"=>"Georgian", "description"=>' '],
            ["code"=>"DE", "name"=>"German", "description"=>' '],
            ["code"=>"EL", "name"=>"Greek", "description"=>' '],
            ["code"=>"GU", "name"=>"Gujarati", "description"=>' '],
            ["code"=>"HE", "name"=>"Hebrew", "description"=>' '],
            ["code"=>"HI", "name"=>"Hindi", "description"=>' '],
            ["code"=>"HU", "name"=>"Hungarian", "description"=>' '],
            ["code"=>"IS", "name"=>"Icelandic", "description"=>' '],
            ["code"=>"ID", "name"=>"Indonesian", "description"=>' '],
            ["code"=>"GA", "name"=>"Irish", "description"=>' '],
            ["code"=>"IT", "name"=>"Italian", "description"=>' '],
            ["code"=>"JA", "name"=>"Japanese", "description"=>' '],
            ["code"=>"JW", "name"=>"Javanese", "description"=>' '],
            ["code"=>"KO", "name"=>"Korean", "description"=>' '],
            ["code"=>"LA", "name"=>"Latin", "description"=>' '],
            ["code"=>"LV", "name"=>"Latvian", "description"=>' '],
            ["code"=>"LT", "name"=>"Lithuanian", "description"=>' '],
            ["code"=>"MK", "name"=>"Macedonian", "description"=>' '],
            ["code"=>"MS", "name"=>"Malay", "description"=>' '],
            ["code"=>"ML", "name"=>"Malayalam", "description"=>' '],
            ["code"=>"MT", "name"=>"Maltese", "description"=>' '],
            ["code"=>"MI", "name"=>"Maori", "description"=>' '],
            ["code"=>"MR", "name"=>"Marathi", "description"=>' '],
            ["code"=>"MN", "name"=>"Mongolian", "description"=>' '],
            ["code"=>"NE", "name"=>"Nepali", "description"=>' '],
            ["code"=>"NO", "name"=>"Norwegian", "description"=>' '],
            ["code"=>"FA", "name"=>"Persian", "description"=>' '],
            ["code"=>"PL", "name"=>"Polish", "description"=>' '],
            ["code"=>"PT", "name"=>"Portuguese", "description"=>' '],
            ["code"=>"PA", "name"=>"Punjabi", "description"=>' '],
            ["code"=>"QU", "name"=>"Quechua", "description"=>' '],
            ["code"=>"RO", "name"=>"Romanian", "description"=>' '],
            ["code"=>"RU", "name"=>"Russian", "description"=>' '],
            ["code"=>"SM", "name"=>"Samoan", "description"=>' '],
            ["code"=>"SR", "name"=>"Serbian", "description"=>' '],
            ["code"=>"SK", "name"=>"Slovak", "description"=>' '],
            ["code"=>"SL", "name"=>"Slovenian", "description"=>' '],
            ["code"=>"ES", "name"=>"Spanish", "description"=>' '],
            ["code"=>"SW", "name"=>"Swahili", "description"=>' '],
            ["code"=>"SV", "name"=>"Swedish ", "description"=>' '],
            ["code"=>"TA", "name"=>"Tamil", "description"=>' '],
            ["code"=>"TT", "name"=>"Tatar", "description"=>' '],
            ["code"=>"TE", "name"=>"Telugu", "description"=>' '],
            ["code"=>"TH", "name"=>"Thai", "description"=>' '],
            ["code"=>"BO", "name"=>"Tibetan", "description"=>' '],
            ["code"=>"TO", "name"=>"Tonga", "description"=>' '],
            ["code"=>"TR", "name"=>"Turkish", "description"=>' '],
            ["code"=>"UK", "name"=>"Ukrainian", "description"=>' '],
            ["code"=>"UR", "name"=>"Urdu", "description"=>' '],
            ["code"=>"UZ", "name"=>"Uzbek", "description"=>' '],
            ["code"=>"VI", "name"=>"Vietnamese", "description"=>' '],
            ["code"=>"CY", "name"=>"Welsh", "description"=>' '],
            ["code"=>"XH", "name"=>"Xhosa", "description"=>' '],
        ];
      //  foreach ($languages as $index => $language) {
            // $language->id = $index+1;
    //        DB::table('languages')->insert($language);
        //}

    }
}
