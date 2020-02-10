<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Administrator()
 * @method static static Editor()
 * @method static static Member()
 * @method static static Visitor()
 */
final class UserType extends Enum
{
    const Administrator = 0;
    const Editor = 1;
    const Member = 2;
    const Visitor = 3;
}
