<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventRelationsWithTicket extends Model
{
    //
    protected $table = 'event_relations_location';
    protected $fillable = ['event_id', 'ticket_id'];
}
