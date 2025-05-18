<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'phone',
        'role',
        'is_active',
        'is_welcomed_message_sent',
        'profile_photo',
        'bio',
        'payment_status',
        'total_amount',
        'email',
        'password',
        'personal_code'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->personal_code = self::generateUniquePersonalCode($user->name);
        });
    }

    public static function generateUniquePersonalCode(string $name): string
    {
        $initial = strtoupper(Str::substr($name, 0, 1));

        do {
            $code = $initial . '-' . random_int(1000, 9999);
        } while (self::where('personal_code', $code)->exists());

        return $code;
    }

    public function payments ()
    {
        return $this->hasMany(Payment::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_users');
    }

    public function invitations ()
    {
        return $this->hasMany(Invitation::class);
    }

    public function sentMessages()
    {
        return $this->hasMany(ParticipantMessage::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(ParticipantMessage::class, 'receiver_id');
    }

    // Utilisateur qui envoie le like
    public function likesGiven()
    {
        return $this->hasMany(Like::class, 'liker_id');
    }

    // Utilisateur qui reçoit le like
    public function likesReceived()
    {
        return $this->hasMany(Like::class, 'liked_id');
    }

    public function hasLiked(User $user)
    {
        return $this->likesGiven()->where('liked_id', $user->id)->exists();
    }

    public function votesCast()
    {
        return $this->hasMany(Vote::class, 'voter_id');
    }

    public function votesReceived()
    {
        return $this->hasMany(Vote::class, 'candidat_id');
    }

    public function hasVotedInCategory($categoryId)
    {
        return $this->votesCast()->where('vote_category_id', $categoryId)->exists();
    }

    public function publications()
    {
        return $this->hasMany(Publication::class);
    }

    public function publication_likes()
    {
        return $this->hasMany(Publication::class);
    }

    public function publication_comments() {
        return $this->hasMany(PublicationComment::class);
    }
}
