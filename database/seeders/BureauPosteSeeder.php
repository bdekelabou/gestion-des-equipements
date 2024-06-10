<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BureauPosteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $BureauPoste = [
            "LOME TELESSOU",
            "LOME EMONNAIE",
            "LOME SEGBE",
            "CRA",
            "POSTE CENTRAL 1",
            "POSTE CENTRAL 2",
            "LOME RP",
            "LOME",
            "AGBODRAFO",
            "AGOU",
            "AMLAME",
            "AGBELOUVE",
            "ANIE",
            "BADOU",
            "BOMBOUAKA",
            "KABOLI",
            "KPELE-ELE",
            "LOME CAVEAU",
            "LOME EMS",
            "LOME TOKOIN",
            "MANGO",
            "NIAMTOUGOU",
            "NOTSE",
            "PAGOUDA",
            "TABLIGBO",
            "TOHOUN",
            "BLITTA",
            "P A C E",
            "LOME BE",
            "BASSAR",
            "CINKASSE",
            "GUERIN-KOUKA",
            "KANTE",
            "KEVE",
            "KPELE-ADETA",
            "LOME PHILATELIE",
            "LOME CITE",
            "LOME GBONVIE",
            "SOTOUBOUA",
            "TCHAMBA",
            "LOME CPT",
            "LOME NYEKONAKPOE",
            "LOME WUITI",
            "LOME CHEQUES 2",
            "LOME PORT",
            "ANCIEN LOME PHILATELIE",
            "ANEHO",
            "WESTERN   UNION",
            "ATAKPAME",
            "ELAVAGNON",
            "SOKODE",
            "PAGALA",
            "BAFILO",
            "KETAO",
            "PYA",
            "DAPAONG",
            "DANYI APEYEME",
            "LOME CNT",
            "VOGAN",
            "KARA",
            "LOME AVIATION",
            "TSEVIE",
            "ANFOIN",
            "KPALIME",
            "BUREAUX EXTERIEURS",
            "ADJENGRÉ",
            "KABOU",
            "GLEI",
            "ADIDOGOME",
            "LOME AGBALEPEDOGAN",
            "LOME DJIFA-KPOTA",
            "LOME BAGUIDA",
            "LOME AGOENYIVE",
            "CCE",
            "HAHOTOE",
            "MANDOURI",
            "AFAGNAN",
            "AHEPE",
            "AGBONOU",
            "KOUGNOUHOU",
            "BARKOISSI",
            "LOME KEGUE",
            "EMS LOME CENTRE",
            "EMS LOME BE",

        ];
            
        foreach ($BureauPoste as $bureau) {
            \App\Models\BureauPoste::create([
                'nom' => $bureau,
            ]);
        }


    }
}
