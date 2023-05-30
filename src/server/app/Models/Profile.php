<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $table = 'profiles';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
       'role', 'description', 'picture', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
