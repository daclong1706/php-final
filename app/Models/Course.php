<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'grade',
        'price',
        'is_deleted'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_deleted' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withTimestamps();
    }

    public function coursedetails()
    {
        return $this->hasMany(CourseDetail::class);
    }

    public function courseuser()
    {
        return $this->hasMany(CourseUser::class);
    }

    public function scopeNotDeleted($query)
    {
        return $query->where('is_deleted', false);
    }
}
