<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unitate extends Model
{
    // set custom table name
    protected $table = 'unitati';

    /**
     * Get the user that owns the unit.
     */
    public function user() {
        return $this -> belongsTo(User::class);
    }

    /**
     * Get the parent unit that owns the unit.
     */
    public function parent()
    {
        return $this->belongsTo(Unitate::class, 'parent_id');
    }

    /**
     * Get the children units that owned by the unit.
     */
    public function children()
    {
        return $this->hasMany(Unitate::class, 'parent_id');
    }
}
