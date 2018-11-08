<?php

namespace App\Db;

use PDO;
use App\Config\Config;

class MysqlDbConnection implements DbConnectionInterface
{
    /**
     * Types o binding variables
     *
     * @var array
     */
    protected $types = [
        'string' => \PDO::PARAM_STR,
        'int' => \PDO::PARAM_INT,
        'boolean' => \PDO::PARAM_BOOL,
        'null' => \PDO::PARAM_NULL,
        'fixed' => \PDO::PARAM_STR,
    ];

    /**
     * @var PDO
     */
    private $pdoConnection = null;

    /**
     * @return PDO
     */
    private function getConnection()
    {
        if ($this->pdoConnection) {
            return $this->pdoConnection;
        }

        $dsn = 'mysql:dbname=' . Config::DB_NAME . ';host=' . Config::DB_HOST . ';charset=' . Config::DB_CHARSET;

        $pdoConnection = new PDO($dsn, Config::DB_USERNAME, Config::DB_PASSWORD);
        $pdoConnection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        $pdoConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $this->pdoConnection = $pdoConnection;

        return $this->pdoConnection;
    }

    /**
     * @param string $query
     * @param null $data
     * @return int
     */
    public function query(string $query, $data = []): int {
        $sth = $this->getConnection()->prepare($query);
        $sth->execute($data);

        return $sth->rowCount();
    }

    /**
     * @param $query - sql statement
     * @param array $data
     * @return string
     * @throws MysqlDbException
     * @see FunctionsTrait::update() example
     */
    public function insert(string $query, $data = []): string {
        $sth = $this->getConnection()->prepare($query);
        $sth = $this->bindValues($sth, $data);
        $sth->execute();

        $insertId = $this->getConnection()->lastInsertId();
        return $insertId;
    }

    /**
     * Bind values to statement with bindValue() method
     *
     * @param \PDOStatement $statement
     * @param array $data
     * @return \PDOStatement
     * @throws MysqlDbException
     */
    protected function bindValues(\PDOStatement $statement, $data = []) {
        $data = $this->normalizeData($data);
        if (!empty($data)) {
            foreach ($data as $field => $params) {
                $statement->bindValue($field, $params['value'], $params['type']);
            }
        }
        return $statement;
    }

    /**
     * Normalize inout data array in functions for binding
     *
     * @param array $data
     * @return array
     * @throws MysqlDbException
     */
    protected function normalizeData(array $data) {
        foreach ($data as $field => &$params) {
            if (!is_array($params)) {
                $params = [
                    'value' => (string)$params,
                    'type' => 'string',
                ];
            }

            if (!isset($params['value'])) {
                throw new MysqlDbException("Value in query is not set");
            }

            if (!isset($params['type']) || !isset($this->types[$params['type']])) {
                $params['type'] = 'string';
            }

            if ($params['type'] == 'fixed') {
                if (!isset($params['values']) || !is_array($params['values']) || !in_array($params['value'],
                        $params['values'])
                ) {
                    throw new MysqlDbException('Value is not in fixed values array');
                }
            }

            $params['type'] = $this->types[$params['type']];
        }

        return $data;
    }
}