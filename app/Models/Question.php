<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $fillable = ['question', 'answer', 'difficulty', 'type', 'topic_id'];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
