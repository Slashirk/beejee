<?php


namespace kernel\interfaces;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

interface DbModelInterface
{
    public function getConnection(): Connection;
    public function getQuery(): QueryBuilder;
    public function tableName(): string;
}