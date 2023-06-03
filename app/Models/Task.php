<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['creator', 'assignee'];

    public function creator(){
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function assignee(){
        return $this->belongsTo(User::class, 'assignee_id');
    }
}
