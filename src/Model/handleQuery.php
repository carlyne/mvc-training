<?php 

namespace App\Model;

abstract class HandleQuery
{
    /** var string */
    protected $_tableName;
    /** var array */
    protected $_tableFields = ['*'];
    /** var array */
    protected $_condition = [];
    /** var array */
    protected $_inserts = [];
    
    public function __construct(string $tableName, array $tableFields = ['*'])
    {
        $this->_tableName = $tableName;
        $this->_tableFields = $tableFields;
    }

    public function where(string $condition, string $value) : self
    {
        $this->_condition = [
            'condition' => $condition,
            'value' => $value
        ];

        return $this;
    }

    public function insertValues(array $columns, array $values) : self
    {
        $this->_inserts = [
            'columns' => $columns,
            'values' => $values
        ];

        return $this;
    }

    public function createGetQuery() : string
    {
        $query = 'SELECT ' . implode(', ', $this->_tableFields) . ' FROM ' . $this->_tableName . ' ';

        if(!empty($this->_condition)) {
            $query .= 'WHERE ' . $this->_condition['condition'] . ' = ' . $this->_condition['value'];
        };
        
        return $query;
    }

    public function createPostQuery() : string
    {   
        $query = 'INSERT INTO ' . $this->_tableName . ' ';

        $insertColumns = implode(', ', $this->_inserts['columns']);
        $insertValues = implode(', ', $this->_inserts['values']);

        $query .= '(' . $insertColumns . ') VALUES (' . $insertValues . ') ';

        return $query;
    }

    public function getTableName() : string
    {
        return $this->_tableName;
    }

    public function getTableFields() : array
    {
        return $this->_tableFields;
    }
    
    public function getCondition() : array
    {
        return $this->_condition;
    }
}

?>