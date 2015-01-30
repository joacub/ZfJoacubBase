<?php

/*
 * This file is not part of the Pagerfanta package.
 * We hack the Pagerfanta to allow Doctrine nativeQuery pagination.
 */

namespace JoacubBase\Doctrine\Tools\Pagination;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query;
use Doctrine\ORM\NoResultException;
use \Doctrine\ORM\NativeQuery;

/**
 * DoctrineORMNativeQueryAdapter.
 *
 * Ok so this class is a real tweak, here is some advice:
 * - don't use it with INNER JOIN query
 * - don't use it with query already LIMITED
 * - don't use it. Haha.
 *
 * @experimental
 * @todo : Deal with a fetchJoinCollection.
 */
class DoctrineORMNativeQueryAdapter implements \Pagerfanta\Adapter\AdapterInterface
{
    /**
     * @var Query
     */
    private $query;

    private $fetchJoinCollection;

    /**
     * @param \Doctrine\ORM\NativeQuery $query
     * @param bool $fetchJoinCollection
     */
    public function __construct(NativeQuery $query, $fetchJoinCollection = false)
    {
        $this->query = $query;
        $this->fetchJoin = (Boolean) $fetchJoinCollection;
    }

    /**
     * Returns the query
     *
     * @return NativeQuery
     *
     * @api
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Returns whether the query joins a collection.
     *
     * @return Boolean Whether the query joins a collection.
     */
    public function getFetchJoinCollection()
    {
        $this->fetchJoinCollection;
    }

    public function getNbResults()
    {
        $sql = $this->getQuery()->getSQL();

        $sql = preg_replace('@^SELECT .+ FROM@i', 'SELECT COUNT(*) as total FROM', $sql);

        $count = $this->getQuery()->getEntityManager()->getConnection()->fetchColumn($sql, $this->getQuery()->getParameters());
        return $count;
    }

    public function getSlice($offset, $length)
    {
        if ($this->fetchJoinCollection) {
            // @todo
        }

        $query = clone $this->getQuery();
        $query->setParameters( $this->getQuery()->getParameters() );

        $sql   = $query->getSql();
        $sql   .= sprintf(' LIMIT %d, %d', $offset, $length);
        $query->setSql($sql);

        return $query->getResult();
    }
}
