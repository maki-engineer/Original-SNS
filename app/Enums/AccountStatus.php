<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static LOGIN     
 * @method static static LOGOUT    
 * @method static static DELETED   
 * @method static static FROZEN    
 */
final class AccountStatus extends Enum
{
    const LOGIN = 1; // ログイン済み
    const LOGOUT = 2; // ログアウト中
    const DELETED = 0; // 削除済み
    const FROZEN = -1; // 凍結

    /**
     * Get the description for an enum value
     *
     * @param $value
     * @return string
     */
    public static function getDescription($value): string
    {
        if ($value === self::LOGIN) {
            return 'ログイン中';
        }
        if ($value === self::LOGOUT) {
            return 'ログアウト中';
        }
        if ($value === self::DELETED) {
            return '削除済み';
        }
        if ($value === self::FROZEN) {
            return '凍結';
        }

        return parent::getDescription($value);
    }
}
