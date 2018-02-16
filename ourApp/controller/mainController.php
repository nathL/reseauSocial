<?php

/*
 * Controler 
 */

class mainController {

    public static function helloWorld($request, $context) {
        if (getSessionAttribute('loginUser')) {
            $context->mavariable = "hello world";
            return context::SUCCESS;
        } else {
            echo "You need to login";
        }
    }

    public static function index($request, $context) {

        return context::SUCCESS;
    }

    public static function superTest($request, $context) {

        $context->param1 = $request['param1'];
        $context->param2 = $request['param2'];
        return context::SUCCESS;
    }

    public static function login($request, $context) {

        if (isset($request['login']) && isset($request['pass'])) {
            $context->login = $request['login'];
            $context->pass = $request['pass'];
            $connectionResult = utilisateurTable::getUserByLoginAndPass($context->login, $context->pass);
            if ($connectionResult === false) {
                $context->errorMessage = "Error of database connection";
                return context::ERROR;
            } else {
                if (count($connectionResult) == 0) {
                    $context->errorMessage = "Tu n'existe pas mon ami";
                    return context::ERROR;
                } else {
                    $context->setSessionAttribute("loginUser", $context->login);
                    $context->formDisplay = false;  
                    return context::SUCCESS;
                }
            }
        } else {
            $context->formDisplay = true;  
            return context::SUCCESS;
        }
    }

}
