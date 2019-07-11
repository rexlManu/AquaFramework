<?php


namespace aqua\framework;


use ClanCats\Hydrahon\Builder;
use ClanCats\Hydrahon\Query\Sql\FetchableInterface;
use PDO;

class AquaDatabase
{

    protected static $_instance = null;

    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    private $connection;
    private $builder;

    public function __construct()
    {
        $connection = new PDO('mysql:host=localhost;dbname=my_database', 'username', 'password');

        $this->builder = new Builder('mysql', function ($query, $queryString, $queryParameters) use ($connection) {
            $statement = $connection->prepare($queryString);
            $statement->execute($queryParameters);
            if ($query instanceof FetchableInterface) {
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            }
        });
    }

    /**
     * @return Builder
     */
    public function getBuilder(): Builder
    {
        return $this->builder;
    }

}