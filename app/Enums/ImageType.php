<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static IMAGE
 * @method static static MOVIE
 */
final class ImageType extends Enum
{
    const IMAGE = 1; // 画像
    const MOVIE = 2; // 動画
}
