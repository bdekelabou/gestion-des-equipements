<?php

namespace App\Enums;

use \Spatie\Enum\Enum;

/**
 * @method static self Equipement_envoye()
 * @method static self Equipement_receptionne()
 * @method static self Equipement_traite()
 * @method static self Equipement_renvoye()
 * @method static self Cloture()
 */

class EtapesEnums extends Enum
{
    
    protected static function values()
    {
        return [
            'Equipement_envoye' => 'Equipement envoyé',
            'Equipement_receptionne' => 'Réceptionné à la CI',
            'Equipement_traite' => 'Réparé',
            'Equipement_renvoye' => 'Equipement renvoyé',
            'Cloture' => 'Cloturée',
        ];
    }
}