<?php

namespace App\Http\Controllers;

use App\Contracts\UserContract;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  protected $userRepository;
  public function __construct(UserContract $userRepository)
  {
    $this->userRepository = $userRepository;
  }
  public function store(Request $request) {
      return $this->userRepository->createUser($request->all());
  }
  public function login(Request $request) {
    return $this->userRepository->login($request->all());
  }

  public function logout() {
    return $this->userRepository->logout();
  }


  public function update(Request $request) {



    return $this->userRepository->updateUser($request->all());
  }


  public function refresh(Request $request) {
    return $this->userRepository->refresh($request->all());
  }





        
}
