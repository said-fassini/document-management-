<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'status',
        'created_at',
    ];

    /**
     * Relationship with Workflow model
     * A document has many workflows.
     */
    public function workflows()
    {
        return $this->hasMany(Workflow::class);
    }
}
