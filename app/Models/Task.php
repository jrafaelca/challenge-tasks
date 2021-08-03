<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'maximum_execution_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'maximum_execution_date' => 'datetime',
    ];

    /**
     * Get the user that owns the task.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the responsible that owns the task.
     */
    public function responsible()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the logs for the task.
     */
    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    /*
     *
     */
    public function getExpiredAttribute()
    {
        return now()->gt($this->maximum_execution_date);
    }
}
