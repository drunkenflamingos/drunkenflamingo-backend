<?php
declare(strict_types=1);

namespace StudentApi\Auth;

use Cake\Auth\BaseAuthenticate;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Network\Request;
use Cake\Network\Response;

/**
 * Custom authenticate object that's used for the API
 */
class ApiAuthenticate extends BaseAuthenticate
{
    /**
     * {@inheritdoc}
     */
    public function authenticate(Request $request, Response $response)
    {
        return $this->getUser($request);
    }

    /**
     * {@inheritdoc}
     */
    public function getUser(Request $request)
    {
        if (!empty($request->header('X-Auth-Token'))) {
            return $this->_findUser($request->getHeader('X-Auth-Token')[0]);
        }

        return false;
    }

    /**
     * {@inheritdoc}
     * @throws \Cake\Network\Exception\UnauthorizedException
     */
    public function unauthenticated(Request $request, Response $response)
    {
        throw new UnauthorizedException(__('Not authenticated - set `X-Auth-Token` HTTP header to API key to authenticate'));
    }
}
