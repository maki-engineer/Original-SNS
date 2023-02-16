<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static ACTIVE
 * @method static static DEACTIVE
 * @method static static DELETED
 * @method static static FROZEN
 */
final class AccountStatus extends Enum
{
    const ACTIVE = 1; // アカウント利用中
    const DEACTIVE = 2; // 違うアカウント利用中
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
        if ($value === self::ACTIVE) {
            return 'ログイン中';
        }
        if ($value === self::DEACTIVE) {
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
