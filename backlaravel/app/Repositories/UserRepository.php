<?php
namespace App\Repositories;

use App\Contracts\UserContract;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserRepository extends BaseRepository implements UserContract {
  public function __construct(User $user)
  {
    parent::__construct($user);
  }
  public function listUsers($columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc') {
            return $this->all($columns, $orderBy,$sortBy);
  } 
  public function findUserById(int $id) {
              return $this->findOneOrFail($id);
  }
  public function createUser(array $params) {
          $collection = collect($params);
          return $this->create([
            'first_name' => $collection->get('first_name'),
            'last_name' => $collection->get('last_name'),
            'username' => $collection->get('username'),
            'email' => $collection->get('email'),
            'password' => bcrypt($collection->get('password'))
          ]);
  }


  public function login(array $attributes) {
    $collection = collect($attributes);
    $emailOrPassword = filter_var($collection->get('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    $credentials = [$emailOrPassword => $collection->get('email'), 'password' => $collection->get('password')];
    $user = Auth::attempt($credentials);
        if(!$user) {
          return response()->json([
            'message' => 'Unauthorized'
        ], 401);
        }
        $tokenResult = request()->user()->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $user = request()->user();
        $token->save();
        return response()->json([
              'user' => $user->load('role'),
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
  }
  
  public function updateUser(array $params) {
  
       
        $collection = collect($params);
        $id = $collection->get('id');
        if($collection->has('avatar')) {
          $avatarPath = $collection->get('avatar');
          $avatarName = explode('/',$avatarPath)[1];
          $avatarNewPath = 'avatarPhotos/' . $avatarName;
          Storage::move($avatarPath,  $avatarNewPath);
          $collection->put('avatar', $avatarNewPath);

        } else {
          $collection = $collection->except(['avatar']);
        }
        $this->update(
          $collection->toArray(), $id);
          return response()->json([
           'user' => $collection->toArray()
        ],200);
  }


  

  public function deleteUser($id) {

  }


  public function logout() {
    $podatak = request()->user()->token()->revoke();
    return response()->json([
        'message' => 'Successfully logged out'
    ]);
  }

  public function refresh(array $attributes) {

    return response()->json([
      'user' => request()->user()->load('role')
]);


  }






}