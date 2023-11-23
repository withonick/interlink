<?php

namespace App\Enums;

enum Country: string
{
    case KZ = 'Kazakhstan';
    case RU = 'Russia';
    case UA = 'Ukraine';
    case BY = 'Belarus';
    case KG = 'Kyrgyzstan';
    case UZ = 'Uzbekistan';
    case TJ = 'Tajikistan';
    case TM = 'Turkmenistan';
    case MD = 'Moldova';
    case GE = 'Georgia';
    case AM = 'Armenia';
    case AZ = 'Azerbaijan';
    case LV = 'Latvia';
    case LT = 'Lithuania';
    case EE = 'Estonia';


    public static function getCountryList(): array
    {
        return [
            self::KZ,
            self::RU,
            self::UA,
            self::BY,
            self::KG,
            self::UZ,
            self::TJ,
            self::TM,
            self::MD,
            self::GE,
            self::AM,
            self::AZ,
            self::LV,
            self::LT,
            self::EE,
        ];
    }

}

?>
