<?php 
namespace App\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profile;

class ProfileRepository extends BaseRepository
{
    public function getModel(): Model
    {
        return new Profile();
    }
}