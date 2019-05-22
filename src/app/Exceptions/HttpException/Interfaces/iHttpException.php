<?php
namespace App\Exceptions\HttpException\Interfaces;

/**
 * Interface iHttpException
 * @package app\communication\Exceptions\HttpException\Interfaces
 */
interface iHttpException
{
    /**
     * @return int
     */
    function getCode();

    /**
     * @return int
     */
    function getLogRef();


    /**
     * @return string
     */
    function getMessage();


    /**
     * @return string
     */
    function getErrorCode();
}