<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 04/03/2017
 * Time: 15:59
 */

namespace Enimiste\LaravelWebApp\Core\Console\Support\Auth;


use Illuminate\Contracts\Auth\Authenticatable;

class AuthSystemSimulatedUser implements Authenticatable
{

    /** @var  string */
    protected $email;
    /** @var  string */
    protected $id;

    /**
     * JobGuard constructor.
     *
     * @param string $email
     * @param string $id
     */
    public function __construct($email, $id = null)
    {
        $this->email = $email;
        $this->id = $id;
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'email';
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->email;
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        throw new \RuntimeException('Not implemented');
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        throw new \RuntimeException('Not implemented');
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string $value
     *
     * @return void
     */
    public function setRememberToken($value)
    {
        throw new \RuntimeException('Not implemented');
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        throw new \RuntimeException('Not implemented');
    }

    /**
     * @param $name
     *
     * @return string
     */
    function __get($name)
    {
        if ($name == 'email') {
            return $this->email;
        }

        throw new \RuntimeException(sprintf('Undefined property %s', $name));
    }
}