<?php

namespace App\Enums;

enum Role: string
{
    case Admin = 'admin';
    case User = 'user';
    case Moderator = 'moderator';

    public function label(): string
    {
        return match ($this) {
            static::Admin => 'admin',
            static::User => 'user',
            static::Moderator => 'moderator',
        };
    }

}

?>
