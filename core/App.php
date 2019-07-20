<?php
    namespace Core;

    class App {
        static private $url, $controller, $action, $params;

        static public function start() : void {
            global $router;

            self::$url = isset($_GET['q']) ? '/' . $_GET['q'] : '/';

            if( !$router->parser(self::$url) )
                self::$url = '';
                
            if( !empty(self::$url) ) {
                self::$url = explode('/', self::$url);
                array_shift(self::$url);
            }


            self::setController();
            self::setAction();
            self::setParams();

            self::callController();
        }

        static private function setController() : void {
            if( empty(self::$url) ) {
                self::$controller = '\\Controllers\\homeController';
                return;
            }

            self::$controller = "\\Controllers\\" . array_shift(self::$url) . 'Controller';
        }

        static private function setAction() : void {
            if( empty(self::$url[0]) ){
                self::$action = 'index';
                return;
            }

            self::$action = array_shift(self::$url);
        }

        static private function setParams() : void {
            if( empty(self::$url[0]) ) {
                self::$params = [];
                return;
            }

            self::$params = self::$url;
        }

        static private function callController() : void {
            if( !class_exists(self::$controller) ) return;

            $controller = new self::$controller;

            if( !method_exists($controller, self::$action) )
                return;

            call_user_func_array([$controller, self::$action], self::$params);
        }
    }