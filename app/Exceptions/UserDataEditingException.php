<?php

namespace App\Exceptions;

/**
 * Class ProductIsNotInFavoritesListException
 *
 * @package App\Modules\Favorites\Exceptions\Favorites
 */
class UserDataEditingException extends BaseException
{
    /**
     * Default exception message
     */
    protected $message = 'Error editing user data';

    /**
     * Default exception code
     */
    protected $code = 500;
}