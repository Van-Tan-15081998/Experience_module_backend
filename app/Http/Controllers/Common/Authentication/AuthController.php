<?php

namespace App\Http\Controllers\Common\Authentication;

use App\Http\Businesses\Common\Authentication\AdminAuthenticationBusiness;
use App\Http\Controllers\Controller;
use App\Lib\Business\Authentication\StaffAccount\Models\AuthLoggedInModel;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginFormRequest $request, AdminAuthenticationBusiness $adminAuthenticationBusiness) {
        $error = null;
        $errMessage = null;

        try {
            $loggedIn = $adminAuthenticationBusiness->login($request->loginId, $request->password);

            if ($loggedIn) {
                return $this->responseOnAuthorized($loggedIn);
            } else {

            }
        } catch (\Exception $e) {

        }
    }

    public function logout() {

    }

    public function authorizeUser() {

    }

    private function responseOnAuthorized(AuthLoggedInModel $loggedIn)
    {
        return response()->json([
            'token' => $loggedIn->getToken(),
        ]);
    }

    public function responseOnUnAuthorized($user) {

    }

    private function responOnAuthorizedUser($user)
    {
        $response = array(
            'id' => $user->getAccountId(),
            'name' => $user->getStaffName()
        );

        return response()->json([$response]);
    }
}
