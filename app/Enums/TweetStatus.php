<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static PUBLIC
 * @method static static PRIVATE
 * @method static static DELETED
 * @method static static DELETED_BY_ADMIN
 */
final class TweetStatus extends Enum
{
    const PUBLIC = 1; // 公開
    const PRIVATE = 2; // 非公開
    const DELETED = 0; // 削除
    const DELETED_BY_ADMIN = -1; // 管理者による削除(通報等があった場合)
}
