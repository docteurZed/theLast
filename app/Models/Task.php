<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'due_date',
        'priority',
        'statut',
        'image',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($task) {

            $task->user_id = Auth::user()->id;

        });
    }

    public function getRelativeCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->translatedFormat('d F Y');
    }

    public function getDeadlineAttribute()
    {
        return Carbon::parse($this->attributes['due_date'])->translatedFormat('d F Y');
    }

    public function task_details()
    {
        return $this->hasMany(TaskDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'task_users');
    }
}
