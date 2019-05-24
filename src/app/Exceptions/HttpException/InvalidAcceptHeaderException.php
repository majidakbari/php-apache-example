<?php

namespace App\Exceptions\HttpException;

/**
 * Class InvalidAcceptHeaderException
 * This class is a child of HttpException exception which will be thrown in case of
 * requests contain invalid `accept` header
 *
 * @package App\Exceptions\HttpException
 */
class InvalidAcceptHeaderException extends HttpException
{
    /**
     * InvalidAcceptHeaderException constructor.
     */
    public function __construct()
    {
        parent::__construct(
            1000,
            get_class_name($this),
            trans('app.InvalidAcceptHeaderException'),
            406
        );
    }
}
