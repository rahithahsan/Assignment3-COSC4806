<?php
/**
 * Tiny flash-message helper
 */
class Flash
{
    public static function set(string $msg): void
    {
        $_SESSION['flash'] = $msg;
    }

    public static function get(): string
    {
        $msg = $_SESSION['flash'] ?? '';
        unset($_SESSION['flash']);
        return $msg;
    }
}
