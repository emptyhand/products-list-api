<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\Post;

/**
 * Class SecurityController
 * @package AppBundle\Controller
 */
class SecurityController extends Controller
{
    /**
     * @Post("/register")
     * @param Request $request
     * @return array
     */
    public function registerAction(Request $request)
    {
        $userManager = $this->get('fos_user.user_manager');
        $data = $request->request->all();

        $user = $userManager->createUser();
        $user->setUsername($data['username']);
        $user->setEmail($data['username']);

        $user->setPlainPassword($data['password']);
        $user->setEnabled(true);
        $userManager->updateUser($user);

        $token = $this->get('lexik_jwt_authentication.jwt_manager')
            ->create($user);

        return $response = [
            'token' => $token,
            'username'  => $user->getUsername()
        ];
    }
}