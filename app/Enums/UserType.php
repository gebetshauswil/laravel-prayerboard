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
    const Administrator = 10;
    const Editor = 20;
    const Member = 30;
    const Visitor = 40;
}
