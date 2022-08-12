<?php

namespace App\Models;

use App\Events\event\SendEmailEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['name' , 'slug'];

    public static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            SendEmailEvent::dispatch($model, config('event_created.emailTo'));
        });
    }
}
