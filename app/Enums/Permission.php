<?php

namespace App\Enums;

enum Permission: string
{
    case Create = 'Create';
    case Read = 'Read';
    case Update = 'Update';
    case Delete = 'Delete';
    case Ban = 'Ban';
    case Unban = 'Unban';



    public function label(): string
    {
        return match ($this) {
            static::Create => 'Create',
            static::Read => 'Read',
            static::Update => 'Update',
            static::Delete => 'Delete',
            static::Ban => 'Ban',
            static::Unban => 'Unban',
        };
    }

}

?>
