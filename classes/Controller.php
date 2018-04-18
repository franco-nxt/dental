<?php 

class Controller{

    public function __construct()
    {
      $this->dispatch(func_get_args());  
    }

	private function compile_route( $route ) 
	{
		if ( preg_match_all( '`(/|\.|)\[([^:\]]*+)(?::([^:\]]*+))?\](\?|)`', $route, $matches, PREG_SET_ORDER ) ) {
			$match_types = array(
				'i'  => '[0-9]++',
				'a'  => '[0-9A-Za-z]++',
				'h'  => '[0-9A-Fa-f]++',
				'*'  => '.+?',
				'**' => '.++',
				''   => '[^/]+?'
			);

			foreach ( $matches as $match ) {
				list( $block, $pre, $type, $param, $optional ) = $match;

				if (isset($match_types[$type])) {
					$type = $match_types[$type];
				}

				if ($pre === '.') {
					$pre = '\.';
				}

				$pattern = '(?:' . ( $pre !== '' ? $pre : null ) . '(' . ( $param !== '' ? "?P<$param>" : null ) . $type . '))' . ( $optional !== '' ? '?' : null );

				$route = str_replace($block, $pattern, $route);
			}
		}

		return "`^$route$`";
	}


	/**
	 * Formatea la ruta y el handler que se pasan
	 *
	 * @return Array 
	 */
	private function route( $args ) 
	{

		$callback = array_pop( $args );
		$route = array_pop( $args );
		$method = array_pop( $args );

		if ( null === $route ) {
			$route = '*';
		}
		elseif ($route[0] != '@') { // SI LA RUTA NO ES UNA RGEX
			$route = '/'. ltrim($route, "/"); // QUE SIEMPRE ARRANQUE CON UN /
		}

		$count_match = ( $route !== '*' );

		return array( $method, $route, $callback, $count_match );
	}

	/**
	 * despacha la url correcta, pasandole por parametros
	 * una colleccion de rutas
	 *
	 * @param Array $routes colleccion de rutas formateadas
	 * @return void
	 */
	private function dispatch() 
	{
		$uri = $this->uri();
		$_REQUEST = array_merge( $_GET, $_POST );
		$matched = 0;
		$methods_matched = array();
		$routes = func_get_args();

		ob_start();

		foreach ( $routes[0] as $handler ) {

			list( $method, $_route, $callback, $count_match ) = $this->route($handler);

			if (!method_exists($this, $callback)) {
				continue;
			}

			$possible_match = $this->possible_match($method);

			$i = 0;
			
			if ($_route === '*') {
				$match = true;
			} 
			elseif ($_route === '404' && ! $matched && count($methods_matched) <= 0) {
				call_user_func_array(array($this, $callback));

				++ $matched;
				continue;
			} 
			elseif (isset($_route[$i]) && $_route[$i] === '@' ) {
				// HAY QUE MATCHEAR CONTRA UNA RGEX
				$match = preg_match( '`' . substr($_route, $i + 1) . '`', $uri, $params);
			} 
			else {
				$route = null;
				$regex = false;
				$j = 0;
				$n = isset($_route[$i]) ? $_route[$i] : null;

				while ( true ) {
					if (!isset($_route[$i])) {
						break;
					} 
					elseif (!$regex ) {
						$c = $n;
						$regex = $c === '[' || $c === '(' || $c === '.';

						if (!$regex && isset($_route[$i + 1])) {
							$n = $_route[$i + 1];
							$regex = $n === '?' || $n === '+' || $n === '*' || $n === '{';
						}
						if (!$regex && $c !== '/' && (!isset($uri[$j]) || $c !== $uri[$j])) {
							continue 2;
						}

						$j ++;
					}
					
					$route .= $_route[$i ++];
				}

				$regex = $this->compile_route($route);
				$match = preg_match($regex, $uri, $params);
			}

			if (isset($match) && $match) {

				$methods_matched = array_merge($methods_matched, (array) $method);
				$methods_matched = array_filter($methods_matched);
				$methods_matched = array_unique($methods_matched);

				array_shift($params);

				if ($possible_match) {
					call_user_func_array(array($this, $callback), array_unique($params));
				}
			}
		}

		if (!$matched) {
		}

		ob_end_flush();
	}

	/**
	 * Obtiene la uri de la request
	 *
	 * @return String la uri de la request
	 */
	private function uri()
	{
		 
		$uri = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '/';

		if (strpos($uri, '?')) {
			$uri = str_replace(stristr($uri,"?"),"",$uri);
		}

		return $uri;
	}

	/**
	 * Retorna el metodo de la request
	 *
	 * @return String metodo de la request
	 */
	private function req_method()
	{
		$req_method = isset( $_SERVER['REQUEST_METHOD'] ) ? $_SERVER['REQUEST_METHOD'] : 'GET';

		if ( isset( $_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'] ) ) {
			$req_method = $_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'];
		} 
		else if ( isset( $_REQUEST['_method'] ) ) {
			$req_method = $_REQUEST['_method'];
		}

		return $req_method;
	}

	/**
	 * Analiza un posible match 
	 *
	 * @param String $method El metodo que viene con cada route
	 * @return Boolean retorna true si matchean con el metodo de la request
	 */
	private function possible_match($method)
	{
		$req_method = $this->req_method();
		$method_match = null;

		if (is_array($method)) {
			foreach ($method as $test) {
				if (strcasecmp($req_method, $test) === 0) {
					$method_match = true;
				}
			}

			if (null === $method_match) {
				$method_match = false;
			}
		} 
		elseif ($method && strcasecmp($req_method, $method) !== 0) {
			$method_match = false;
		} 
		elseif ($method && strcasecmp($req_method, $method) === 0) {
			$method_match = true;
		}

		return is_null($method_match) || $method_match;
	}
}