<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Mail\SendCodeMail;
use App\Trait\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRolesAndPermissions;

    public const RECORDS_PER_PAGE = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'enable_2fa',
        'handle'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Creates a 2FA code for the user
     * @return void
     */
    public function generateCode()
    {
        $code = rand(100000, 999999);

        UserCode::updateOrCreate(
            ['user_id' => auth()->id()],
            ['code' => $code]
        );

        try {

            $details = [
                'title' => __('Login code'),
                'code' => $code
            ];

            // Send the code in email
            Mail::to(auth()->user()->email)->send(new SendCodeMail($details));


        } catch (\Exception $e) {
            info("Error: ".$e->getMessage());
            exit;
        }
    }


    /**
     * User has many galleries
     *
     * @return HasMany
     */
    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }


    public function getPaginatedGalleriesAttribute()
    {
        return $this->galleries()->paginate(10);
    }

    public function getUserHandleAttribute(): string
    {
        return '@'.$this->handle;
    }


    /**
     * User has many photos
     *
     * @return HasMany
     */
    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class);
    }


    /**
     * User has many tags
     *
     * @return HasMany
     */
    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }


    /**
     * User has many photos
     *
     * @return HasMany
     */
    public function goals(): HasMany
    {
        return $this->hasMany(Goal::class);
    }

    /**
     * @return HasOne
     */
    public function user_detail(): HasOne
    {
        return $this->hasOne(UserDetail::class);
    }

}
