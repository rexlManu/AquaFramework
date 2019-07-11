<?php


namespace aqua\framework;


use ClanCats\Hydrahon\Builder;
use ClanCats\Hydrahon\Query\Sql\FetchableInterface;
use PDO;

class AquaDatabase
{

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

}