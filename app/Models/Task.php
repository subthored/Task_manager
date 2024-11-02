<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property-read mixed $author_name
 * @property-read mixed $executor_name
 * @property-read mixed $labels_name
 * @property-read mixed $status_name
 */
class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'status_id', 'created_by_id', 'assigned_to_id'
    ];

    protected $appends = ['author_name', 'status_name', 'executor_name', 'labels_name'];

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function getAuthorNameAttribute()
    {
        return $this->author->name;
    }

    public function status()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function getStatusNameAttribute()
    {
        return $this->status->name;
    }

    public function executor()
    {
        return $this->belongsTo(User::class, 'assigned_to_id')->withDefault();
    }

    public function getExecutorNameAttribute()
    {
        return $this->executor->name;
    }

    public static function booted()
    {
        static::addGlobalScope('withRelations', function ($query) {
            $query->with(['author', 'status', 'executor', 'labels']);
        });
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class);
    }

    public function getLabelsNameAttribute()
    {
        return $this->labels()->pluck('name')->toArray();
    }

    public function scopeFilterByStatus(Builder $query, string | null $statusId)
    {
        if ($statusId !== null && $statusId !== '0') {
            return $query->where('status_id', $statusId);
        }
        return $query;
    }

    public function scopeFilterByCreatedBy(Builder $query, string | null $createdById)
    {
        if ($createdById !== null && $createdById !== '0') {
            return $query->where('created_by_id', $createdById);
        }
        return $query;
    }

    public function scopeFilterByAssignedTo(Builder $query, string | null $assignedToId)
    {
        if ($assignedToId !== null && $assignedToId !== '0') {
            return $query->where('assigned_to_id', $assignedToId);
        }
        return $query;
    }
}
