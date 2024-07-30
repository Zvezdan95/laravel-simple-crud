<?php

namespace App\Models;

use App\Enums\UserStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["name", "email", "password", "phone_number", "profile_picture", "status", "username"];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ["password", "remember_token"];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            "email_verified_at" => "datetime",
            "password" => "hashed",
            "status" => UserStatus::class,
        ];
    }

    public function setProfilePicture(UploadedFile $uploadedFile): self
    {
        $currentProfilePicture = $this->profile_picture;

        if ($currentProfilePicture) {
            Storage::delete($currentProfilePicture);
        }

        $path = Storage::putFile('/public/profile_images', $uploadedFile);
        $this->profile_picture = $path;

        return $this;
    }

    public function getProfilePicture(): ?string
    {
        return Storage::url($this->profile_picture);
    }

    public function addresses():HasMany
    {
        return $this->hasMany(Address::class);
    }
}
