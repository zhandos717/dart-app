<?php

declare(strict_types=1);
namespace App\Support;
use \RedBeanPHP\R as R;
use Tuupola\Middleware\HttpBasicAuthentication\AuthenticatorInterface;

final class Authenticator implements AuthenticatorInterface{
    /**
     * Stores all the options passed to the authenticator.
     * @var mixed[]
     */
    private $options;

    /**
     * @param mixed[] $options
     */
    public function __construct(array $options = [])
    {
        /* Default options. */
        $this->options = [
            "table" => "diruser",
            "user" => "login",
            "hash" => "password"
        ];
        if ($options) {
            $this->options = array_merge($this->options, $options);
        }
    }
    /**
     * @param string[] $arguments
     */
    public function __invoke(array $arguments): bool
    {
        $user = $arguments["login"];
        $password = $arguments["password"];

        if ($user = R::getRow($this->sql(),[':user' => $user])) {
            return password_verify($password, $user[$this->options["hash"]]);
        }
        return false;
    }
    
    public function sql(): string
    {
    $sql = "SELECT * FROM {$this->options['table']} WHERE {$this->options['user']} = :user
            LIMIT 1";
        return (string) preg_replace("!\s+!", " ", $sql);
    }
}