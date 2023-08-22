<?php

namespace App\Http\Businesses\Common\Authentication;

use App\Lib\Business\Authentication\StaffAccount\Models\AuthHelper;
use App\Lib\Business\Authentication\StaffAccount\Models\AuthLoggedInModel;
use App\Lib\Business\Authentication\StaffAccount\Models\AuthUser;
use Illuminate\Support\Facades\App;
use App\Lib\Business\Authentication\StaffAccount\StaffAuthenticationBusiness;
use App\Lib\Business\Base\ExperienceBaseBusiness;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticationBusiness extends ExperienceBaseBusiness
{
    private  const TOKEN_NAME = 'authToken';

    private StaffAuthenticationBusiness $staffAuthenticationBusiness;

    public function __construct()
    {
        parent::__construct();
        $this->staffAuthenticationBusiness = App::make(StaffAuthenticationBusiness::class);
    }

    public function login(string $loginId, string $password): ?AuthLoggedInModel
    {
        $authenticatedAccount = $this->staffAuthenticationBusiness->authenticate($loginId, $password);

        if(is_null($authenticatedAccount)) {
            return null;
        }

        $user = AuthHelper::generateUser($authenticatedAccount);

        $user->deleteMyAccessToken();

        $token = $user->createToken(self::TOKEN_NAME);

        $token->token->save();

        $loggedIn = new AuthLoggedInModel();
        $loggedIn->setToken($token->accessToken);

        return $loggedIn;
    }

    public function logout(): bool
    {
        $auth = auth();

        if($auth) {
            $user = $auth->user();
            $user->token()->revoke();
            return true;
        }

        return false;
    }

    public function authorize(): AuthUser
    {
        $user = AdminAuthenticationBusiness::getLoggedInUser();
        if(isset($user)) {
            if(!$this->staffAuthenticationBusiness->authorize($user->getAuthIdentifier())) {
                $user = null;
            }
        }

        return $user;
    }

    public static function getLoggedInUser()
    {
        $auth = Auth();

        return $auth?->user();
    }
}
