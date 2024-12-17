<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $guarded = [];

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

    /**
     * Relationship with Notes.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    /**
     * Relationship with Journal Entries.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function journals()
    {
        return $this->hasMany(Journal::class);
    }






    /**
     * Relationship with Reviews as a Mentor (being reviewed).
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mentorReviews()
    {
        return $this->hasMany(Review::class, 'mentor_id');
    }

    /**
     * Relationship with Reviews as a Mentee (giving reviews).
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menteeReviews()
    {
        return $this->hasMany(Review::class, 'mentee_id');
    }

    /**
     * Relationship with Goals if user is a mentee.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goals()
    {
        return $this->hasMany(Goal::class, 'mentee_id');
    }

    //     /**
    //  * Relationship: Mentor's clients (mentees).
    //  */
    // public function clients()
    // {
    //     return $this->belongsToMany(User::class, 'mentor_mentee', 'mentor_id', 'mentee_id');
    // }

    /**
     * Relationship: Mentee's mentor.
     */
    public function mentor()
    {
        return $this->belongsToMany(User::class, 'mentor_mentee', 'mentee_id', 'mentor_id');
    }


    /**
 * Get the sessions where the user is a mentor.
 */
public function mentorSessions()
{
    return $this->hasMany(Appt::class, 'mentor_id');
}

/**
 * Get the sessions where the user is a mentee.
 */
public function menteeSessions()
{
    return $this->hasMany(Appt::class, 'mentee_id');
}

public function isAdmin()
{
    return $this->role === 'admin';
}

public function isMentor()
{
    return $this->role === 'mentor';
}

public function isMentee()
{
    return $this->role === 'mentee';
}


public function sessionsAsMentor()
{
    return $this->hasMany(Appt::class, 'mentor_id');
}

public function sessionsAsMentee()
{
    return $this->hasMany(Appt::class, 'mentee_id');
}

public function clients()
{
    return $this->belongsToMany(User::class, 'mentor_mentee', 'mentor_id', 'mentee_id');
}


}


