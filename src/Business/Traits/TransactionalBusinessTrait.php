<?php

namespace Enimiste\LaravelWebApp\Core\Business\Traits;


use Enimiste\LaravelWebApp\Core\Exception\BusinessException;
use Illuminate\Database\Connection;

/**
 * Class TransactionalBusinessTrait
 * @package Enimiste\LaravelWebApp\Core\Business\Traits
 *
 * To use with service classes implementing BusinessInteractWithDbInterface
 */
trait TransactionalBusinessTrait
{

    /**
     * @var bool
     */
    protected $willManageTransactions = true;

    /** @var Connection */
    protected $db;

    /** @var bool true if a transaction was opened and not yet committed or rollbacked */
    protected $tx = false;

    /**
     * If false, the service should not begin, commit or rollback transactions,
     * Its to the caller to manage them
     *
     * @param bool $willManageTransactions
     *
     * @return void
     */
    public function setTransactional($willManageTransactions)
    {
        $this->willManageTransactions = $willManageTransactions;
    }

    /**
     * Begin the transaction if only isTransactional()==true
     *
     * @throws BusinessException
     */
    function beginTransaction()
    {
        $this->checkDbObject();

        if ($this->isTransactional()) {
            $this->db->beginTransaction();
            $this->tx = true;
        }
    }

    /**
     * If not set, the default value is true
     *
     * @return bool
     */
    public function isTransactional()
    {
        return $this->willManageTransactions;
    }

    /**
     * Commit the transaction if only isTransactional()==true
     * and there is a transaction
     *
     * @throws BusinessException
     */
    function commit()
    {
        $this->checkDbObject();

        if ($this->tx && $this->isTransactional()) {
            $this->db->commit();
            $this->tx = false;
        }
    }

    /**
     * Commit the transaction if only isTransactional()==true
     * and there is a transaction
     *
     * @throws BusinessException
     */
    function rollback()
    {
        $this->checkDbObject();

        if ($this->tx && $this->isTransactional()) {
            $this->db->rollBack();
            $this->tx = false;
        }
    }

    /**
     * @param Connection $db
     */
    public function setDb(Connection $db)
    {
        $this->db = $db;
    }

    /**
     * @throws BusinessException
     */
    protected function checkDbObject()
    {
        if ($this->db == null) {
            throw new BusinessException('db object is null, you should inject it');
        }
    }


}