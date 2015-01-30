<?php

namespace JoacubBase\Paginator\Adapter;

use Zend\Paginator\Adapter\AdapterInterface;
use Pagerfanta\Adapter\DoctrineCollectionAdapter as EXTDoctrineCollectionAdapte;

/**
 * Paginator adapter for the Zend\Paginator component
 *
 * @license MIT
 * @link    http://www.doctrine-project.org/
 * @since   0.1.0
 * @author  Tõnis Tobre <tobre@bitweb.ee>
 */
class DoctrineCollectionAdapter implements AdapterInterface
{

    /**
     * Constructor
     *
     * @param DoctrineCollectionAdapter $paginator
     */
    public function __construct(EXTDoctrineCollectionAdapte $paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * @param  DoctrineCollectionAdapter $paginator
     * @return self
     */
    public function setPaginator(EXTDoctrineCollectionAdapte $paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * @return DoctrineCollectionAdapter
     */
    public function getPaginator()
    {
        return $this->paginator;
    }

    /**
     * {@inheritDoc}
     */
    public function getItems($offset, $itemCountPerPage)
    {
        return $this->paginator->getSlice($offset, $itemCountPerPage);
    }

    /**
     * {@inheritDoc}
     */
    public function count()
    {
        return $this->paginator->getNbResults();
    }
}
