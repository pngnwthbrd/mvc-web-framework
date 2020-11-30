<?php

namespace Services;

class Session
{
    protected $session;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();

        $this->session = & $_SESSION;
    }

    public function set($key, $value)
    {
        if (is_string($key) === true)
            $this->session[$key] = $value;
        else
            trigger_error('Session key must be a string!');
    }

    public function get($key)
    {
        if (array_key_exists($key, $this->session))
            return $this->session[$key];
        else
            return false;
    }

    public function remove($key)
    {
        if (array_key_exists($key, $this->session))
            unset($this->session[$key]);
    }

    public function destroy()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            unset($this->session);
            session_destroy();
        }
    }

    public function __destruct()
    {
        // $this->destroy();
    }
}