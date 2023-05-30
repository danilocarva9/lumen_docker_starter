<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserRepository extends BaseRepository
{
    public function getModel(): Model
    {
        return new User();
    }
}
