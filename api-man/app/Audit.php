<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    /**
     * Get the user that owns the audit log.
     */
    public function user() {
        return $this -> belongsTo(User::class);
    }
}
