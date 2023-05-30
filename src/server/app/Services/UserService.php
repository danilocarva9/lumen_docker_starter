<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Http\Response;
use App\Repositories\UserRepository;
use App\Repositories\ProfileRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected UserRepository $userRepository;
    protected ProfileRepository $profileRepository;
    protected UploadService $uploadService;

    public function __construct(
        UserRepository $userRepository,
        ProfileRepository $profileRepository,
        UploadService $uploadService
    )
    {
        $this->userRepository = $userRepository;
        $this->profileRepository = $profileRepository;
        $this->uploadService = $uploadService;
    }

    public function find(int $id): array
    {
        $user = $this->userRepository->findBy([['id', $id]]);
        if(!is_null($user)){
            return ['httpCode' => Response::HTTP_OK, 'data'=> $user, $user->profile];
        }
        return ["httpCode"=> Response::HTTP_NOT_FOUND, "message" => "User not found."];
    }


   public function create(array $request): User
   {
        $request = [
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ];
        return $this->userRepository->create($request);
   }

   public function updateUserProfile($request): array
   {
        $user = $this->userRepository->findBy([['id', $request['user_id'], '=']]);
        $user->name = $request['name'];
        $user->save();

        if(!$user->save()){
           return ['httpCode' => Response::HTTP_INTERNAL_SERVER_ERROR, 'data'=> $user];
        }

        $profile = [
            'role' => $request['role'],
            'description' => $request['description']
        ];
        if(isset($request['picture'])){
            $profile['picture'] = $this->uploadService->uploadPicture($request['picture']);
        }
        $user->profile->fill($profile);

        if(!$user->profile->save()){
            return ['httpCode' => Response::HTTP_INTERNAL_SERVER_ERROR, 'data'=> $user];
        }

        return ['httpCode' => Response::HTTP_OK, 'data'=> $user];
   }

}
