<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 04/03/2017
 * Time: 13:23
 */

namespace Enimiste\LaravelWebApp\Core\Business;


use Enimiste\LaravelWebApp\Core\Exception\BusinessException;

interface BusinessInteractWithDbInterface extends BusinessInterface
{

    /**
     * @return bool
     */
    public function isTransactional();

    /**
     * If false, the service should not begin, commit or rollback transactions,
     * Its to the caller to manage them
     *
     * @param bool $willManageTransactions
     *
     * @return void
     */
    public function setTransactional($willManageTransactions);

    /**
     * Begin the transaction if only isTransactional()==true
     *
     * @throws BusinessException
     */
    function beginTransaction();

    /**
     * Commit the transaction if only isTransactional()==true
     * and there is a transaction
     *
     * @throws BusinessException
     */
    function commit();

    /**
     * Commit the transaction if only isTransactional()==true
     * and there is a transaction
     *
     * @throws BusinessException
     */
    function rollback();
}