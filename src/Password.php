<?php
/**
 * Datetime: 22.11.2017 10:37
 * @author Timur Kasumov aka XAKEPEHOK
 */

namespace XAKEPEHOK\Password;


class Password
{

    private $password;
    private $hash;

    /**
     * Password constructor.
     * @param string $password
     * @throws PasswordException
     */
    public function __construct(string $password)
    {
        $this->guardShort($password);
        $this->password = $password;
        $this->hash = password_hash($password, PASSWORD_BCRYPT);
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getPasswordHash()
    {
        return $this->hash;
    }

    public function verify(string $hash)
    {
        return password_verify($this->password, $hash);
    }

    /**
     * @return Password
     * @throws \Exception
     */
    public static function random(): self
    {
        return new self(bin2hex(random_bytes(16)));
    }

    /**
     * @param $password
     * @throws PasswordException
     */
    private function guardShort($password)
    {
        if (strlen($password) < 6) {
            throw new PasswordException('Password length should be great than 6 chars');
        }
    }

}