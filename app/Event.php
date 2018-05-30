<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Event extends Model
{
    protected $table = 'event';
    protected $fillable = ['name', 'description', 'category', 'event_date' ,'created_by', 'location_id'];

    public function tickets() {
        return $this->belongsToMany('App\Ticket',
                'event_relations_location', 'event_id', 'ticket_id');
    }

    public function getLocation() {
        return $this->hasOne('App\Location','id','location_id');
    }
}
