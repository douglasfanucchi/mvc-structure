<?php
    namespace Core;

    class App {
        static private $url, $controller, $action, $params;

        static public function start() : void {
            self::$url = !empty($_GET['q']) ? explode('/', $_GET['q']) : '';

            self::setController();
            self::setAction();
            self::setParams();

            self::callController();
        }

        static private function setController() : void {
            self::$controller = "\Controllers\\" . array_shift(self::$url);
        }

        static private function setAction() : void {
            if( empty(self::$url[0]) ){
                self::$action = 'index';
                return;
            }

            self::$currentAction = array_shift(self::$url);
        }

        static private function setParams() : void {
            if( empty(self::$url[0]) ) {
                self::$params = [];
                return;
            }

            self::$params = array_shift(self::$url);
        }

        static private function callController() : void {
            if( !class_exists(self::$controller) ) return;

            $controller = new self::$controller;

            if( !method_exists($controller, self::$action) )
                return;

            call_user_func_array([$controller, self::$action], self::$params);
        }
    }