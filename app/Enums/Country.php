<?php

namespace App\Enums;

enum Country: string
{
    case Kazakhstan = 'Kazakhstan';
    case Russia = 'Russia';
    case Ukraine = 'Ukraine';
    case Belarus = 'Belarus';
    case Kyrgyzstan = 'Kyrgyzstan';
    case Uzbekistan = 'Uzbekistan';
    case Tajikistan = 'Tajikistan';
    case Turkmenistan = 'Turkmenistan';
    case Moldova = 'Moldova';
    case Georgia = 'Georgia';
    case Armenia = 'Armenia';
    case Azerbaijan = 'Azerbaijan';
    case Latvia = 'Latvia';
    case Lithuania = 'Lithuania';
    case Estonia = 'Estonia';


    public static function getCountryList(): array
    {
        return [
            'Kazakhstan' => 'Kazakhstan',
            'Russia' => 'Russia',
            'Ukraine' => 'Ukraine',
            'Belarus' => 'Belarus',
            'Kyrgyzstan' => 'Kyrgyzstan',
            'Uzbekistan' => 'Uzbekistan',
            'Tajikistan' => 'Tajikistan',
            'Turkmenistan' => 'Turkmenistan',
            'Moldova' => 'Moldova',
            'Georgia' => 'Georgia',
            'Armenia' => 'Armenia',
            'Azerbaijan' => 'Azerbaijan',
            'Latvia' => 'Latvia',
            'Lithuania' => 'Lithuania',
            'Estonia' => 'Estonia',
        ];
    }

}

?>
