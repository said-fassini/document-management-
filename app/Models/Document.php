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
        'description',
        'file_path',    // Store file data in the database
        'sender_id',
        'receiver_id',
        'status',       // Stores the document's status
        'archived',     // To mark if a document is archived
        'created_at',
    ];

    /**
     * Constants for document statuses.
     */
    const STATUS_PENDING = 'pending';
    const STATUS_ARCHIVED = 'archived';
    const STATUS_REJECTED = 'rejected';
    const STATUS_READ = 'read';

    /**
     * Relationship with the User model.
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');    

    }
    

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id'); 

    }

    /**
     * Relationship with Workflow model.
     * A document has many workflows.
     */
    public function workflows()
    {
        return $this->hasMany(Workflow::class);
    }

    /**
     * Scope for unread documents (status is 'pending').
     */
    public function scopeUnread($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Mark document as read.
     */
    public function markAsRead()
    {
        $this->status = self::STATUS_READ;
        $this->save();
    }
    // In Document.php (Document model)
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Archive the document.
     */
    public function archive()
    {
        $this->archived = true;
        $this->status = self::STATUS_ARCHIVED;
        $this->save();
    }

}
