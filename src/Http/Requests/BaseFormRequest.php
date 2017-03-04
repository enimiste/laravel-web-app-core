<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 04/03/2017
 * Time: 16:13
 */

namespace Enimiste\LaravelWebApp\Core\Http\Requests;


use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Foundation\Http\FormRequest;

abstract class BaseFormRequest extends FormRequest
{

    /**
     * @return bool
     */
    public static function isAuth()
    {
        return !is_null(app(Authenticatable::class));
    }

    /**
     * @return User
     */
    public static function authUser()
    {
        return app(Authenticatable::class);
    }

    /**
     * @return Filesystem
     */
    protected function getFileSystem()
    {
        return app(Filesystem::class);
    }

    /**
     *
     */
    public function validate()
    {

        $this->beforeValidate();
        parent::validate();
        $this->afterSuccessValidation();
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    abstract public function authorize();

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules();

    /**
     * Executed before parent::validate()
     *
     * @return void
     */
    abstract protected function beforeValidate();

    /**
     * Executed after Executed before parent::validate()
     *
     * @return void
     */
    abstract protected function afterSuccessValidation();
}