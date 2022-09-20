<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static ONLY_USER_REGISTRATION
 * @method static static DONE
 */
final class AccountRegistrationStatus extends Enum
{
    const ONLY_USER_REGISTRATION = 0; // ユーザー登録後、アカウント登録が未完了
    const DONE = 1; // アカウント登録まで完了
}
