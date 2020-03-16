<?php
function isAuthenticated()
{
    //global $session;
    //return $session->get('auth_logged_in', false);
    return decodeAuthCookie();
}

function requireAuth()
{
    if (!isAuthenticated()) {
        global $session;
        $session->getFlashBag()->add('error', 'Not Authorized');
        redirect('/login.php');
    }
}

function isOwner($id_user)
{
    if (!isAuthenticated()) {
        return false;
    }

    //global $session;
    //return $ownerId == $session->get('auth_user_id');
    return $id_user == decodeAuthCookie('auth_user_id');
}

function getAuthenticatedUser()
{
    //global $session;
    //return findUserById($session->get('auth_user_id'));
    return findUserById(decodeAuthCookie('auth_user_id'));
}

function saveUserData($user)
{
    global $session;
    //$session->set('auth_logged_in', true);
    //$session->set('auth_user_id', (int) $user['userid']);
    //$session->set('auth_roles', (int) $user['role_id']);

    $session->getFlashBag()->add('success', 'Successfully Logged In');
    $expTime = time() + 3600;
    $jwt = \Firebase\JWT\JWT::encode([
            'iss' => request()->getBaseUrl(),
            'sub' => (int) $user['id'],
            'exp' => $expTime,
            'iat' => time(),
            'nbf' => time()
            //'auth_roles' =>(int) $user['role_id']
    ],
        getenv("SECRET_KEY"),
        'HS256'
);
 $cookie = setAuthCookie($jwt, $expTime);
 redirect('/', ['cookie' => $cookie]);
}

function setAuthCookie($data, $expTime)
{
  $cookie = new \Symfony\Component\HttpFoundation\Cookie(
    'auth',
    $data,
    $expTime,
    '/',
    'localhost',
    //'.treehouse-app.com',
    false,
    true
  );
  return $cookie;
}

function decodeAuthCookie($prop = null)
{
  try {
    Firebase\JWT\JWT::$leeway= 1;
    $cookie = Firebase\JWT\JWT::decode(
      request()->cookies->get('auth'),
      getenv("SECRET_KEY"),
      ['HS256']
    );
  } catch (Exception $e){
    return false;
  }
  if ($prop === null) {
      return $cookie;
  }
  if ($prop === 'auth_user_id') {
      $prop = 'sub';
  }
  if (!isset($cookie->$prop)){
    return false;
  }
  return $cookie->$prop;
}
