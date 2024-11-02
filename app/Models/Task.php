<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $status_id
 * @property int $created_by_id
 * @property int|null $assigned_to_id
 * @property-read \App\Models\User $author
 * @property-read \App\Models\User|null $executor
 * @property-read mixed $author_name
 * @property-read mixed $executor_name
 * @property-read mixed $labels_name
 * @property-read mixed $status_name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Label> $labels
 * @property-read int|null $labels_count
 * @property-read \App\Models\TaskStatus $status
 * @method static \Database\Factories\TaskFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Task filterByAssignedTo($assignedToId)
 * @method static \Illuminate\Database\Eloquent\Builder|Task filterByCreatedBy($createdById)
 * @method static \Illuminate\Database\Eloquent\Builder|Task filterByStatus($statusId)
 * @method static \Illuminate\Database\Eloquent\Builder|Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task query()
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereAssignedToId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereCreatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereUpdatedAt($value)
 * @mixin \Eloquent
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
