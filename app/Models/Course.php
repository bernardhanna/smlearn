<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    protected $fillable = ['course_name', 'description', 'difficulty', 'category'];

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
}
