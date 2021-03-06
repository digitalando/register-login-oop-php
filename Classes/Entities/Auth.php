<?php 

namespace AFS\Entities;

use AFS\Repositories\UserRepository;

/**
 * Clase de autenticación.
 *
 * Provee todos los métodos relacionados a la sesión del usuario.
 */
class Auth
{
	/**
	 * @var boolean Define si la sessión es recorda por defecto.
	 */
	private $rememberLogin = false;

	/**
	 * @var int Duración de la sessión en minutos.
	 */
	private $sessionLength = 30;

	/**
	 * Nombre para guardar la sessión y la cookie.
	 * @var string
	 */
	private $sessionName = 'asf_session';

	/**
	 * Ubicación por defecto para usuarios logeados.
	 * @var string
	 */
	private $defaultLoginLocation = 'index.php';

	/**
	 * Ubicación por defecto para usuario deslogeados.
	 * @var string
	 */
	private $defaultLogoutLocation = 'profile.php';


	/**
	 * Método constructor, inicializa una sesión de PHP.
	 */
	public function __construct()
	{
		session_start();
		$this->autoLogin();
	}

	/**
	 * Logea al usuario y lo recuerda si es necesario.
	 *
	 * Este método retorna esta misma clase, lo cual permite encadendar métodos, ej:
	 * $auth->login()->redirect();
	 * 
	 * @param  User   $user     
	 * @param  bool   $remember
	 * @return Auth           
	 */
	public function login(User $user, bool $remember = false)
	{
		$this->createSession($user);
		if ($remember || $this->rememberLogin)
		{
			$this->createCookie();
		}

		return $this;
	}

	/**
	 * Logea automáticamente al usuario si existe la cookie.
	 */
	public function autoLogin()
	{
		if ($this->isLoggedIn() == false && $this->hasCookie())
		{
			$userRepo = new UserRepository();
			$user = $userRepo->fetchByField($this->getCookie());

			if ($user) {
				$this->login($user);
			}
		}		
	}

	/**
	 * Comprueba si el usuario está logeado
	 * 
	 * @return boolean Verdadero si está logeado, falso de lo contrario.
	 */
	public function isLoggedIn()
	{
		return isset($_SESSION[$this->sessionName]);
	}

	/**
	 * Deslogea al usuario.
	 *
	 * Este método retorna esta misma clase, lo cual permite encadendar métodos, ej:
	 * $auth->logout()->redirect();
	 * 
	 * @return Auth           
	 */
	public function logout()
	{
		session_destroy();
		$this->deleteCookie();

		return $this;
	}

	/**
	 * Redirige al usuario a la ubición por defecto según su estado.
	 * 
	 * @return void
	 */
	public function redirect() {
		if ($this->isLoggedIn())
		{
			header('location: ' . $this->defaultLoginLocation);
		}
		else
		{
			header('location: ' . $this->defaultLogoutLocation);
		}
		exit;
	}

	/**
	 * Retorna un objeto de tipo usuario si el usuario está logeado.
	 * 
	 * @return User|false Objeto de tipo usuario o false.
	 */
	public function getUser()
	{
		if ($this->isLoggedIn())
		{
			return $_SESSION[$this->sessionName];
		}
		else
		{
			return false;
		}
	}

	/**
	 * Crea la session del usuario.
	 * 
	 * @param  User   $user
	 */
	private function createSession(User $user)
	{
		$user->setPassword('');
		$_SESSION[$this->sessionName] = $user;
	}

	/**
	 * Crea la cookie del usuario.
	 * 
	 * @param  User   $user
	 */
	private function createCookie(User $user)
	{
		setcookie($this->sessionName, $user->getId(), time() + $sessionLength * 60 );
	}

	/**
	 * Comprueba si la cookie del usuario está creada
	 * 
	 * @return boolean Verdadero si está creada, falso de lo contrario.
	 */
	private function hasCookie() {
		return isset($_COOKIE[$this->sessionName]);
	}

	/**
	 * Devuelve la cookie del usuario si existe.
	 * 
	 * @return bool 	Retorna los contenidos de la cookie si existe, falso de lo contrario.
	 */
	private function getCookie() {
		if (isset($_COOKIE[$this->sessionName])) 
		{
			return $_COOKIE[$this->sessionName];
		}
		else
		{
			return false;
		}
	}

	/**
	 * Elimina la cookie del usuario.
	 */
	private function deleteCookie()
	{
		setcookie($this->sessionName, '', time() * -1 );
	}
}