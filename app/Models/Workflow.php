<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workflow extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'document_id',
        'status',
        'created_at',
    ];

    /**
     * Relationship with User model
     * Each workflow belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship with Document model
     * Each workflow belongs to a document.
     */
    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
