<?php

namespace App\Enums;

enum USER_ROLES: int
{
    case SUPER_ADMIN = 0;
    case ADMIN = 1;
    case USER = 2;
    case OWNER = 3;
    case CASHIER = 4;

    public function label():string
    {
        return match($this) {
            self::SUPER_ADMIN => 'Super Admin',
            self::ADMIN => 'Admin',
            self::USER => 'User',
            self::OWNER => 'Owner',
            self::CASHIER => 'Cashier',
        };
    }

    public static function labels():array
    {
        $labels = [];

        foreach(self::cases() as $role) {
            $labels[$role->value] = $role->label();
        }

        return $labels;
    }
}
