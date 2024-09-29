<?php

class User {
    private $validUsername = "hola";
    private $validPassword = "44";

    public function authenticate($username, $password) {
        return $username === $this->validUsername && $password === $this->validPassword;
    }
}
