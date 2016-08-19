<?php

namespace App\Repositories;

use MongoClient;

/**
 * Class CompanyRepository
 *
 * @package App\Repositories
 */
class CompanyRepository
{
    const CONNECTION_STRING =
        'mongodb://mm_recruitment_user_readonly:rebelMutualWhistle@ds037551.mongolab.com:37551/mm-recruitment';

    /**
     * @var \MongoCollection
     */
    private $collection;

    public function __construct()
    {
        $connection       = new MongoClient(self::CONNECTION_STRING);
        $db               = $connection->selectDB('mm-recruitment');
        $this->collection = $connection->selectCollection($db, 'company');
    }

    /**
     * @return array
     */
    public function getAll()
    {
        $cursor = $this->collection->find();
        $companies = [];
        foreach ($cursor as $doc) {
            $companies[] = $doc;
        }

        return $companies;
    }
}


