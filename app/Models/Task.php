<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'duedate', 'isFinished'];
    protected $appends = ['formatedDueDate'];
    protected $connection = 'mysql';
    protected $table = 'tasks';
    protected $primaryKey = 'taskNo';
    public $incrementing = true;
    public $timestamps = true;

    public function getDuedateAttribute($val)
    {
        return date('Y-m-d\TH:i', strtotime($val));
    }

    public function getFormatedDueDateAttribute()
    {
        return date('M d, Y | g:i A', strtotime($this->duedate));
    }
}
