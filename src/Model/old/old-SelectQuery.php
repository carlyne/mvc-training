<?php 


namespace App\Model;

class OldSelectQuery {
    // all needed to create a custom request
    private  $table;
    private  $selects;
    private  $whereCondition = []; 
    private  $andConditions = []; 

    // initiate request with table name and default SELECT * 
    public function __construct(string $tableName, array $selects = ['*']) {
        $this->table = $tableName;
        $this->selects = $selects;
    }

    public function where(string $condition, string $value) : self {
        $this->whereCondition = [
            'condition' => $condition,
            'value' => $value
        ];

        // allowing chaining
        return $this;
    }

    public function and(string $condition, string $value) : self {
        $this->andConditions[] = [
            'condition' => $condition,
            'value' => $value
        ];

        // allowing chaining
        return $this;
    }

    public function createStringQuery() : string {
        $select = 'SELECT ' . implode(',', $this->selects) . ' ';
        $from = 'FROM ' . $this->table;
        $where = '';
        $and = '';

        if (count($this->andConditions)) {
            foreach($this->andConditions as $condition) {
                $and .= 'AND ' . $condition['condition'] . ' = ' . $condition['value'];
            }
        }

        if (count($this->whereConditions)) {
            $where = 'WHERE ' . $this->whereCondition['condition'] . ' = ' .   $this->whereCondition['value'];
        }

        if (empty($and) && empty($where)) {
            return $select . $from;
        } else if (empty($and)) {
            return $select . $from . $where;
        } else {
            return $select . $from . $where . $and;
        }
    }
    
};

?>

