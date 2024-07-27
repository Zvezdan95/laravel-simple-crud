<?php

namespace App\Enums;

enum UserStatus: string
{
    case  INACTIVE = "inactive";
    case  ACTIVE = "active";
    case  BANNED = "banned";

    public function isInactive(): bool
    {
        return $this === UserStatus::INACTIVE;
    }

    public function isActive(): bool
    {
        return $this === UserStatus::ACTIVE;
    }

    public function isBanned(): bool
    {
        return $this === UserStatus::BANNED;
    }
}
