<?php

class Application
{
    private ?string $url_controller = null;
    private ?object $controller = null;
    private string $url_action = '';

    private array $url_params = array();

    public function __construct()
    {
        $this->splitUrl();


        if (!is_null($this->url_controller) && file_exists(APP . 'controller/' . $this->url_controller . '.php')) {
            // load controller file if the url has a controller param and if such controller file exists
            // example: if controller would be "car", then this line would translate into: $this->car = new car();
            require APP . 'controller/' . $this->url_controller . '.php';
            $this->controller = new $this->url_controller();
            // check for method: does such a method exist in the controller ?
            if (method_exists($this->controller, $this->url_action)) {

                if (!empty($this->url_params)) {
                    // Call the method and pass arguments to it
                    call_user_func_array(array($this->controller, $this->url_action), $this->url_params);
                } else {
                    // If no parameters are given, just call the method without parameters, like $this->home->method();
                    $this->controller->{$this->url_action}();
                }

            } else {
                if (strlen($this->url_action) == 0) {
                    // no action defined: call the default index() method of a selected controller
                    $this->controller->index();
                }
                else {
                   $this->redirect_error();
                }
            }
        } else {
            $this->redirect_error();
        }
    }

    private function redirect_error(): void
    {
        if (error_reporting()) {
            file_put_contents(ROOT.URL_PUBLIC_FOLDER."/logs.txt", date(DATE_FORMAT).print_r($this, true), FILE_APPEND);
        }
        //Redirect to error page
        header('location: ' . URL . 'problem');
    }

    private function splitUrl(): void
    {
        if (isset($_SERVER['REQUEST_URI'])) {

            // split URL
            $url = trim($_SERVER['REQUEST_URI'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            $this->url_controller = $url[0] ?? null;
            $this->url_action = $url[1] ?? '';

            // Remove controller and action from the split URL
            unset($url[0], $url[1]);

            // Rebase array keys and store the URL params
            $this->url_params = array_values($url);
        }
    }
}
