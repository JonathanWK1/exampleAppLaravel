<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\Relations\HasOne;
use illuminate\Database\Eloquent\Relations\HasMany;
use illuminate\Database\Eloquent\Relations\belongsToMany;

use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        "image"
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
     * Get the user associated with the User
     *
     */
    public function profil(): HasOne
    {
        #dd($this->hasOne(Profil::class, 'user_id', 'id'));
        return $this->hasOne(Profil::class, 'user_id', 'id');
    }
    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'user_id', 'id')->latest();
    }
    public function imagePath(): string{
        return "/storage/".$this->image;
    }

    public function isFollowing (User $user):bool{
       return $this->following->contains($user->id);
    }

    public function followers(): belongsToMany
    {
        return $this->belongsToMany(User::class, 'follow_relation_table', 
        'followed_user_id', 'followers_user_id')->withTimestamps();
    }

    public function isLiked(Post $post): bool
    {

        return $this->likedPost->contains($post->id);
    }

    public function likedPost(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'like_relation_table', 'user_id', 'post_id');
    }

    public function following(): belongsToMany
    {
        return $this->belongsToMany(User::class, 'follow_relation_table', 
         'followers_user_id','followed_user_id')->withTimestamps();
    }

    protected static function boot(){
        parent::boot();

        static::created(function ($user){

            $user->profil()->create([
                "title" => $user->name
            ]);
        });
    }
}
