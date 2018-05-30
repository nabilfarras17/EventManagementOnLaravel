<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    protected $table = 'ticket';
    protected $fillable = ['name', 'type', 'amount', 'price', 'description', 'created_by'];

    public function event()
    {
        return $this->belongsTo('App\Event', 'event_id', 'ticket_id');
    }
}
