<?php 
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\RecoveryPassword;
use Illuminate\Database\Eloquent\Model;

class RecoveryPasswordRepository extends BaseRepository
{

    public function getModel(): Model
    {
        return new RecoveryPassword();
    }
}