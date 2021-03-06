<?php

namespace App\Repositories;

use App\Exceptions\CompanyNotFoundException;
use Exception;
use MongoClient;

/**
 * Class CompanyRepository
 *
 * @package App\Repositories
 */
class CompanyRepository
{
    // @todo: inject this from env
    const CONNECTION_STRING =
        'mongodb://mm_recruitment_user_readonly:rebelMutualWhistle@ds037551.mongolab.com:37551/mm-recruitment';

    /**
     * @var \MongoCollection
     */
    private $collection;

    public function __construct()
    {
        try {
            $connection       = new MongoClient(self::CONNECTION_STRING);
            $db               = $connection->selectDB('mm-recruitment');
            $this->collection = $connection->selectCollection($db, 'company');
        } catch (Exception $e) {
            // @todo - Log here
            throw $e;
        }

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

    public function getCompanyInformation($tickerCode)
    {
        $cursor = $this->collection->find(['tickerCode' => $tickerCode]);
        if ($cursor->count() == 0) {
            throw new CompanyNotFoundException();
        }
        foreach ($cursor as $doc) {
            // return first result (assuming uniqueness)
            return $doc;
        }
    }
}


