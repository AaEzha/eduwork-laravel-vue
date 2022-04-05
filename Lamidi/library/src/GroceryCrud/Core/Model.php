<?php
namespace GroceryCrud\Core;

use GroceryCrud\Core\Profiler\FileProfiler;

use Laminas\Db\Adapter\Adapter;
use Laminas\Db\Sql\Predicate;
use Laminas\Db\Sql\Sql;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Expression;
use Laminas\Db\Sql\Predicate\PredicateSet;
use Laminas\Db\Sql\TableIdentifier;
use Laminas\Db\Sql\Where;
use Laminas\Db\Adapter\Profiler\ProfilerInterface;

use GroceryCrud\Core\Model\ModelInterface;
use GroceryCrud\Core\Helpers\ArrayHelper;
use GroceryCrud\Core\Model\ModelFieldType;

class Model implements ModelInterface
{
    protected $tableName = '';
    protected $primaryKeys = [];

    /**
     * @var Adapter
     */
    protected $adapter;

    protected $orderBy;
    protected $sorting;
    protected $_profiler;
    protected $limit = 10;
    protected $page  = 1;
    protected $_filters;
    protected $_filters_or;
    protected $_relation_1_n = [];
    protected $_relation_n_n = [];
    protected $_depended_relation = [];
    protected $_columns = [];
    protected $_relation_n_n_columns = [];
    protected $_fieldTypes = [];
    protected $_columnNames = [];
    protected $_shortNames = [];
    protected $_dbSchema = null;
    protected $_sequenceName = null;

    protected $_optimizeSqlQueries = true;

    /**
     * @var string|array|null
     */
    protected $_where;

    function __construct($databaseConfig) {
        $this->setDatabaseConnection($databaseConfig);
    }

    /**
     * @param string|array $where
     * @return $this
     */
    public function setWhere($where)
    {
        $this->_where = $where;

        return $this;
    }

    public function setDefaultProfiler()
    {
        $this->setProfiler(new FileProfiler());

        return $this;
    }

    public function setOptimizeSqlQueries($optimizeSqlQueries) {
        $this->_optimizeSqlQueries = $optimizeSqlQueries;

        return $this;
    }

    public function setProfiler(ProfilerInterface $profiler)
    {
        $this->_profiler = $profiler;
        $this->adapter->setProfiler($this->_profiler);

        return $this;
    }

    public function getAdapter()
    {
        return $this->adapter;
    }

    public function getProfiler()
    {
        return $this->_profiler;
    }


    public function setDatabaseConnection($databaseConfig) {
        $this->adapter = new Adapter($databaseConfig['adapter']);
    }

    public function getDatabaseName() {
        return $this->adapter->getDriver()->getConnection()->getCurrentSchema();
    }

    public function getDriverName() {
        return $this->adapter->getDriver()->getDatabasePlatformName();
    }

    public function getDbUniqueId() {
        $dbName = $this->getDatabaseName();
        $dbDriver = $this->getDriverName();

        return $dbDriver . '+' . $dbName;
    }

    /**
     * @param string $dbSchema
     */
    public function setDatabaseSchema($dbSchema) {
        $this->_dbSchema = $dbSchema;
    }

    /**
     * @param string $sequenceName
     */
    public function setSequenceName($sequenceName) {
        $this->_sequenceName = $sequenceName;
    }

    /**
     * @return string|null
     */
    public function getDatabaseSchema() {
        return $this->_dbSchema;
    }

    public function setTableName($tableName) {
        $this->tableName = $tableName;

        return $this;
    }

    public function setAndFilters($filters) {
        $this->_filters = $filters;
    }

    public function setOrFilters($filters) {
        $this->_filters_or = $filters;
    }

    /**
     * @param string $orderBy
     * @param string $sortingBy
     * @return $this
     */
    public function setDefaultOrderBy($orderBy, $sortingBy = 'asc')
    {
        $this->setOrderBy($orderBy);
        $this->setSorting($sortingBy);

        return $this;
    }

    public function setOrderBy($orderBy) {
        $this->orderBy = $orderBy;
        return $this;
    }

    public function setSorting($sorting) {
        $this->sorting = $sorting;
        return $this;
    }

    /**
     * @param integer $limit
     * @return $this
     */
    public function setLimit($limit) {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @param integer $page
     * @return $this
     */
    public function setPage($page) {
        $this->page = $page;
        return $this;
    }

    public function getColumnNames ($tableName = null) {
        if ($tableName === null) {
            $tableName = $this->tableName;
        }

        if (isset($this->_columnNames[$tableName])) {
            return $this->_columnNames[$tableName];
        }

        $fieldTypes = $this->getFieldTypes($tableName);

        $columnNames = [];
        foreach ($fieldTypes as $fieldName => $fieldType) {
            $columnNames[] = $fieldName;
        }

        $this->_columnNames[$tableName] = $columnNames;

        return $columnNames;
    }

    public function getRelationData($tableName, $titleField, $where = null, $orderBy = null, $relationFieldName = null) {
        $primaryKeyField = $this->getPrimaryKeyField($tableName);

        $titleFieldIsArray = is_array($titleField);

        $sql = new Sql($this->adapter);
        $select = $sql->select();

        if ($orderBy !== null) {
            $select->order($orderBy);
        } else {
            if ($titleFieldIsArray) {
                $select->order($titleField[0]);
            } else {
                $select->order($titleField);
            }
        }

        $shortTableName = $this->getShortName($tableName, $relationFieldName);

        $select->from([$shortTableName => $this->getTableNameWithSchema($tableName)]);

        if ($where !== null) {

            if (is_array($where) && array_key_exists('IN_ARRAY', $where)) {
                $predicate = new Predicate\In();
                $fieldName = key($where['IN_ARRAY']);
                if (!empty($where['IN_ARRAY'][$fieldName])) {
                    $select->where(
                        $predicate
                            ->setValueSet($where['IN_ARRAY'][$fieldName])
                            ->setIdentifier($fieldName)
                    );
                } else {
                    // Always return an empty array
                    $select->where("(1 = 0)");
                }
            } else {
                $select->where($where);
            }
        }

        $select = $this->extraJoinRelationalData($tableName, $select);
        $select = $this->extraWhereRelationalData($tableName, $select);

        $selectString = $sql->buildSqlString($select);
        $result = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);

        $relationData = [];
        foreach ($result as $row) {
            if ($titleFieldIsArray) {
                $title = [];
                foreach ($titleField as $subtitle) {
                    $title[$subtitle] = $row[$subtitle];
                }
            } else {
                $title = $row[$titleField];
            }

            $relationData[] = (object)array(
                'id' => $row[$primaryKeyField],
                'title' => $title
            );
        }

        return $relationData;
    }

    public function getPrimaryKeyField ($tableName = null) {
        if ($tableName === null) {
            $tableName = $this->tableName;
        }

        // Is the key already set?
        if (!empty($this->primaryKeys[$tableName])) {
            return $this->primaryKeys[$tableName];
        }

        return $this->_getPrimaryKey($tableName);
    }

    public function setPrimaryKey($primaryKey, $tableName = null)
    {
        if ($tableName === null) {
            $tableName = $this->tableName;
        }

        $this->primaryKeys[$tableName] = $primaryKey;

        return $this;
    }

    private function _getPrimaryKey($tableName) {
        $driverName = $this->getDriverName();

        // There is a much faster way for Mysql to retreive the primary key
        if ($driverName === 'Mysql') {
            $statement = $this->adapter->createStatement('SHOW KEYS FROM `' . $tableName . '` WHERE Key_name = \'PRIMARY\'');

            $result = $statement->execute();

            $primaryKeyData = $result->current();

            $this->primaryKeys[$tableName] = $primaryKeyData['Column_name'];

            return $this->primaryKeys[$tableName];
        }

        if ($driverName === 'Sqlite') {

            $statement = $this->adapter->createStatement('pragma table_info(\'' . $tableName . '\')');

            $results = iterator_to_array($statement->execute());

            $primaryKeyFieldName = null;
            foreach ($results as $column) {

                if ($column['pk'] == '1') {
                    $primaryKeyFieldName = $column['name'];
                }
            }

            if ($primaryKeyFieldName === null) {
                throw new \Exception('Couldn\'t find a primary key for the table with name \'' . $tableName . '\'');
            }

            $this->primaryKeys[$tableName] = $primaryKeyFieldName;

            return $this->primaryKeys[$tableName];
        }

        if ($driverName === 'SqlServer') {
            $statement = $this->adapter->createStatement(
                "SELECT KU.table_name as TABLENAME,column_name as PRIMARYKEYCOLUMN
FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS AS TC
INNER JOIN
    INFORMATION_SCHEMA.KEY_COLUMN_USAGE AS KU
          ON TC.CONSTRAINT_TYPE = 'PRIMARY KEY' AND
             TC.CONSTRAINT_NAME = KU.CONSTRAINT_NAME AND
             KU.table_name='" . $tableName . "'
ORDER BY KU.TABLE_NAME, KU.ORDINAL_POSITION;");

            $result = $statement->execute();

            $primaryKeyData = $result->current();

            $this->primaryKeys[$tableName] = $primaryKeyData['PRIMARYKEYCOLUMN'];

            return $this->primaryKeys[$tableName];
        }

        if ($driverName === 'Postgresql') {

            $tableNameWithSchema = $this->_dbSchema !== null ? $this->_dbSchema . '.' . $tableName : $tableName;

            $statement = $this->adapter->createStatement(
                'SELECT a.attname
                    FROM   pg_index i
                    JOIN   pg_attribute a ON a.attrelid = i.indrelid AND a.attnum = ANY(i.indkey)
                    WHERE  i.indrelid = \'' . $tableNameWithSchema . '\'::regclass AND i.indisprimary');

            $result = $statement->execute();

            $primaryKeyData = $result->current();

            $this->primaryKeys[$tableName] = $primaryKeyData['attname'];

            return $this->primaryKeys[$tableName];

        }

        throw new \Exception("Database not supported");
    }

    public function splitFilterValue($filterValue) {
        if (preg_match('/^<=/', $filterValue)) {
            $comparison = '<=';
            $value = preg_replace('/^<=/', '', $filterValue);
        } else if (preg_match('/^</', $filterValue)) {
            $comparison = '<';
            $value = preg_replace('/^</', '', $filterValue);
        } else if (preg_match('/^>=/', $filterValue)) {
            $comparison = '>=';
            $value = preg_replace('/^>=/', '', $filterValue);
        } else if (preg_match('/^>/', $filterValue)) {
            $comparison = '>';
            $value = preg_replace('/^>/', '', $filterValue);
        } else if (preg_match('/^=/', $filterValue)) {
            $comparison = '=';
            $value = preg_replace('/^=/', '', $filterValue);
        } else if (preg_match('/^!=/', $filterValue)) {
            $comparison = '!=';
            $value = preg_replace('/^!=/', '', $filterValue);
        } else if (preg_match('/^~/', $filterValue)) {
            $comparison = 'LIKE';
            $value = preg_replace('/^~/', '', $filterValue) . '%';
        } else if (preg_match('/~$/', $filterValue)) {
            $comparison = 'LIKE';
            $value = '%' . preg_replace('/~$/', '', $filterValue);
        } else {
            $comparison = 'LIKE';
            $value = '%' . $filterValue . '%';
        }

        return [
            'comparison' => $comparison,
            'value' => $value
        ];
    }

    protected function _setWhereArray($filterName, $filterValue, $whereArray) {
        $whereComparison = $this->splitFilterValue($filterValue);

        // When there is an empty string also check for NULL values as well
        if ($whereComparison['value'] === '') {
            $whereArray[] = ["( $filterName {$whereComparison['comparison']} ? OR $filterName IS NULL)", $whereComparison['value']];
        } else {
            $whereArray[] = [$filterName . ' ' . $whereComparison['comparison'] . ' ?', $whereComparison['value']];
        }


        return $whereArray;
    }

    /**
     * @param Select $select
     * @param string $filterType
     * @return Select
     */
    public function filtering(Select $select, $filterType = PredicateSet::OP_AND)
    {
        $where = new Where();
        $whereArray = [];

        $filters = $filterType === PredicateSet::OP_AND ? $this->_filters : $this->_filters_or;

        foreach ($filters as $filterName => $filterValue) {

            if ($this->isFieldWithRelationNtoN($filterName)) {
                // If the filter is relationNtoN we will filter than within a second query later
                continue;
            } else {
                $filterName =  $this->tableName. '.' . $filterName;
            }

            if (is_array($filterValue)) {
                foreach ($filterValue as $value) {
                    $whereArray = $this->_setWhereArray($filterName, $value, $whereArray);
                }
            } else {
                $whereArray = $this->_setWhereArray($filterName, $filterValue, $whereArray);
            }
        }

        if ($filterType === PredicateSet::OP_AND) {
            foreach ($whereArray as $whereQuery) {
                $where->literal($whereQuery[0], $whereQuery[1]);
            }

            $select->where($where);
        } else {
            $predictateSetArray = [];

            foreach ($whereArray as $whereQuery) {
                $predictateSetArray[] = new Predicate\Expression($whereQuery[0], $whereQuery[1]);
            }

            if (!empty($predictateSetArray)) {
                $select->where(new Predicate\PredicateSet($predictateSetArray, $filterType));
            }
        }


        return $select;
    }

    public function insert($data, $tableName = null) {

        if ($tableName === null) {
            $tableName = $this->tableName;
        }

        $driverName = $this->getDriverName();

        $sql = new Sql($this->adapter);
        $insert = $sql->insert($this->getTableNameWithSchemaForOperations($tableName));
        $insert->values($data);

        $statement = $sql->prepareStatementForSqlObject($insert);

        $result = $statement->execute();

        if ($driverName === 'Postgresql') {
            $sequenceName = $this->_sequenceName === null
                ? $tableName . '_' . $this->getPrimaryKeyField($tableName) . '_seq'
                : $this->_sequenceName;

            $insertId = $this->_sequenceName !== false
                ? $this->adapter->getDriver()->getLastGeneratedValue($sequenceName)
                : false;
        } else {
            $insertId = $result->getGeneratedValue();
        }

        return (object) [
            'insertId' => $insertId
        ];
    }

    public function update($primaryKeyValue, $data) {
        if (empty($primaryKeyValue)) {
            throw new \Exception("The primaryKeyValue can't be empty or 0");
        }

        $primaryKeyField = $this->getPrimaryKeyField();

        // First a validation check that we can
        $sql = new Sql($this->adapter);
        $select = $sql->select()
            ->columns([$primaryKeyField])
            ->from($this->getTableNameWithSchema($this->tableName));

        $select = $this->joinStatements($select);

        $select->where([
            $this->tableName . '.' . $primaryKeyField . ' = ?' => $primaryKeyValue
        ]);
        if ($this->_where !== null) {
            $select->where($this->_where);
        }

        $row = $this->getRowFromSelect($select, $sql);

        if ($row === null) {
            return false;
        }

        $sql = new Sql($this->adapter);
        $update = $sql->update($this->getTableNameWithSchemaForOperations($this->tableName));
        $update->where([
            $primaryKeyField . ' = ?' => $primaryKeyValue
        ]);

        $update->set($data);

        $statement = $sql->prepareStatementForSqlObject($update);
        return $statement->execute();
    }

    public function removeOne($id) {
        if (empty($id)) {
            throw new \Exception("The remove id can't be empty or 0");
        }

        $sql = new Sql($this->adapter);
        $remove = $sql->delete($this->getTableNameWithSchemaForOperations($this->tableName));
        $remove->where([
            $this->getPrimaryKeyField() . ' = ?' => $id
        ]);
        if ($this->_where !== null) {
            $remove->where($this->_where);
        }

        $statement = $sql->prepareStatementForSqlObject($remove);
        return $statement->execute();
    }

    public function removeMultiple($ids)
    {
        if (empty($ids)) {
            throw new \Exception("The remove ids can't be empty");
        }

        $sql = new Sql($this->adapter);
        $remove = $sql->delete($this->getTableNameWithSchemaForOperations($this->tableName));
        $where = new Where();
        $where->in($this->getPrimaryKeyField(), $ids);
        $remove->where($where);

        if ($this->_where !== null) {
            $remove->where($this->_where);
        }

        $statement = $sql->prepareStatementForSqlObject($remove);
        return $statement->execute();
    }

    public function getTotalItems()
    {
        $sql = new Sql($this->adapter);
        $select = $sql->select()
            ->columns(array('num' => new Expression('COUNT(*)')))
            ->from($this->getTableNameWithSchema($this->tableName));

        if (!empty($this->_filters)) {
            $select = $this->filtering($select, PredicateSet::OP_AND);
        }

        if (!empty($this->_filters_or)) {
            $select = $this->filtering($select, PredicateSet::OP_OR);
        }

        if (!empty($this->_filters) || !empty($this->_filters_or)) {
            $select = $this->joinStatements($select);
        }
        $select = $this->extraJoinStatements($select);

        $select = $this->whereStatements($select);
        $select = $this->extraWhereStatements($select);

        $selectString = $sql->buildSqlString($select);

        $result = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);

        foreach ($result as $row) {
            return (int)$row['num'];
        }

        return 0;
    }

    public function validateOne($id) {
        $sql = new Sql($this->adapter);
        $select = $sql->select();

        $primaryKeyField = $this->getPrimaryKeyField();

        $select->columns([
            $primaryKeyField
        ]);
        $select->from($this->getTableNameWithSchema($this->tableName));
        $select->where([
            $this->tableName . '.' . $primaryKeyField => $id
        ]);

        if ($this->_where !== null) {
            $select->where($this->_where);
        }

        $this->joinStatements($select);

        $selectString = $sql->buildSqlString($select);

        $result = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);

        $resultsArray = [];
        foreach ($result as $row) {
            $resultsArray[]  = $row;
        }

        return (count($resultsArray) === 1);
    }

    public function validateMultiple($ids) {
        $sql = new Sql($this->adapter);
        $select = $sql->select();

        $select->from($this->getTableNameWithSchema($this->tableName));

        $primaryKeyField = $this->getPrimaryKeyField();
        $where = new Where();
        $where->in($primaryKeyField, $ids);
        $select->where($where);

        if ($this->_where !== null) {
            $select->where($this->_where);
        }

        $this->joinStatements($select);

        $selectString = $sql->buildSqlString($select);
        $result = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);

        $resultsArray = [];
        foreach ($result as $row) {
            $resultsArray[]  = $row;
        }

        return (count($resultsArray) === count($ids));
    }

    public function getOne($id)
    {
        $sql = new Sql($this->adapter);
        $select = $sql->select();

        // TODO: throw exception when there is no tableName
        $select->from($this->getTableNameWithSchema($this->tableName));

        $primaryKeyField = $this->getPrimaryKeyField();

        $select->where([$primaryKeyField => $id]);

        if ($this->_where !== null) {
            $select->where($this->_where);
        }

        $selectString = $sql->buildSqlString($select);
        $result = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);

        foreach ($result as $row) {
            return $row;
        }

        return null;
    }

    public function getFieldTypes($tableName)
    {
        if (isset($this->_fieldTypes[$tableName])) {
            return $this->_fieldTypes[$tableName];
        }

        $driverName = $this->adapter->getDriver()->getDatabasePlatformName();

        // There is a much faster way for Mysql to retreive the field types
        if ($driverName === 'Mysql') {
            $statement = $this->adapter->createStatement('SHOW FIELDS FROM `' . $tableName . '`');

            $results = iterator_to_array($statement->execute());

            $fieldTypes = [];
            foreach ($results as $column) {

                $tmpColumn = new ModelFieldType();
                $tmpColumn->isNullable = $column['Null'] == 'YES';
                list($tmpColumn->dataType) = explode('(', $column['Type']);
                $tmpColumn->defaultValue = $column['Default'];
                $tmpColumn->permittedValues = null;

                if ($tmpColumn->dataType === 'enum') {

                    $tmpColumn->permittedValues = explode("','", str_replace(['enum(\'', '\')'], '', $column['Type']));
                } else if ($tmpColumn->dataType === 'varchar' || $tmpColumn->dataType === 'char') {
                    $tmpColumn->options = (object)[
                        'maxLength' => str_replace(['varchar(', 'char(', ')'], '', $column['Type'])
                    ];
                }

                $fieldTypes[$column['Field']] = $tmpColumn;
            }

            $this->_fieldTypes[$tableName] = $fieldTypes;

            return $fieldTypes;
        }

        if ($driverName === 'Sqlite') {

            $statement = $this->adapter->createStatement('pragma table_info(\'' . $tableName . '\')');

            $results = iterator_to_array($statement->execute());

            $fieldTypes = [];
            foreach ($results as $column) {

                $tmpColumn = new ModelFieldType();
                $tmpColumn->isNullable = $column['notnull'] != '1';
                $tmpColumn->dataType = $column['type'];
                $tmpColumn->defaultValue = $column['dflt_value'];
                $tmpColumn->permittedValues = null;

                $fieldTypes[$column['name']] = $tmpColumn;
            }

            $this->_fieldTypes[$tableName] = $fieldTypes;

            return $fieldTypes;
        }

        if ($driverName === 'SqlServer') {
            $statement = $this->adapter->createStatement(
                'SELECT * FROM INFORMATION_SCHEMA.COLUMNS
                    WHERE TABLE_NAME = \'' . $tableName . '\'');

            $results = iterator_to_array($statement->execute());

            $fieldTypes = [];
            foreach ($results as $column) {
                $tmpColumn = new ModelFieldType();
                $tmpColumn->isNullable = $column['IS_NULLABLE'] == 'YES';
                $tmpColumn->dataType = $column['DATA_TYPE'];
                $tmpColumn->defaultValue = $column['COLUMN_DEFAULT'];
                $tmpColumn->permittedValues = null;

                $fieldTypes[$column['COLUMN_NAME']] = $tmpColumn;
            }

            $this->_fieldTypes[$tableName] = $fieldTypes;

            return $fieldTypes;
        }

        if ($driverName === 'Postgresql') {
            $statement = $this->adapter->createStatement(
                'SELECT column_name, data_type, is_nullable, column_default
                FROM information_schema.columns
                where table_name = \'' . $tableName . '\'');

            $results = iterator_to_array($statement->execute());

            $fieldTypes = [];
            foreach ($results as $column) {
                $tmpColumn = new ModelFieldType();
                $tmpColumn->isNullable = $column['is_nullable'] == 'YES';
                $tmpColumn->dataType = $column['data_type'];
                $tmpColumn->defaultValue = $column['column_default'];
                $tmpColumn->permittedValues = null;

                $fieldTypes[$column['column_name']] = $tmpColumn;
            }

            $this->_fieldTypes[$tableName] = $fieldTypes;

            return $fieldTypes;
        }

        throw new \Exception("Database not supported");
    }


    public function setDependedRelation($dbRelations)
    {
        $this->_depended_relation = $dbRelations;
    }

    public function setRelations1ToN($dbRelations)
    {
        $this->_relation_1_n = $dbRelations;
    }

    public function setRelationNToN($dbRelations)
    {
        $this->_relation_n_n = $dbRelations;
    }

    public function isFieldWithRelation($fieldName)
    {
        foreach ($this->_relation_1_n as $relation) {
            if ($relation->fieldName === $fieldName) {
                return true;
            }
        }

        return false;
    }

    public function isFieldWithRelationNtoN($fieldName)
    {
        foreach ($this->_relation_n_n_columns as $column) {
            if ($column === $fieldName) {
                return true;
            }
        }

        return false;
    }

    public function defaultOrdering($select)
    {
        return $select;
    }

    public function setRelationalColumns($columns)
    {
        $this->_relation_n_n_columns = $columns;
    }

    public function getShortName($tableName, $fieldName) {
        $shortName = substr($tableName, 0, 1);

        if ($fieldName === null) {
            return $shortName;
        }

        $fieldNameUniqueKey = $shortName . '__' . $fieldName;

        if (!in_array($shortName, $this->_shortNames)) {
            $this->_shortNames[$fieldNameUniqueKey] = $shortName;
            return $shortName;
        }

        if (array_key_exists($fieldNameUniqueKey, $this->_shortNames)) {
            return $this->_shortNames[$fieldNameUniqueKey];
        }

        // We are preventing having duplicate short names for the same unique key
        $this->_shortNames[$fieldNameUniqueKey] = $fieldNameUniqueKey;

        return $this->_shortNames[$fieldNameUniqueKey];
    }

    /**
     * @param \Laminas\Db\Sql\Select $select
     * @return mixed
     */
    public function joinStatements($select)
    {
        foreach ($this->_relation_1_n as $relation) {
            // When we have the configuration value optimizeSqlQueries to true we are trying to avoid as much as
            // possible to join the tables if it is not required.
            // We are joining the tables for the following 4 scenarios:
            // 1. When optimize SQL queries is set to off
            // 2. When we have an order by field
            // 3. The relation has a where statement
            // 4. When we have a depended relation
            if ($this->_optimizeSqlQueries === false || array_key_exists($relation->fieldName, $this->_depended_relation) || $this->orderBy === $relation->fieldName || $relation->where !== null) {
                $shortNameForRelationTable = $this->getShortName($relation->tableName, $relation->fieldName);

                $select->join(
                    [$shortNameForRelationTable => $this->getTableNameWithSchemaForOperations($relation->tableName)],
                    $this->tableName . '.' . $relation->fieldName . ' = ' . $shortNameForRelationTable . '.' . $relation->relationPrimaryKey,
                    [],
                    Select::JOIN_LEFT
                );

                if ($relation->where !== null) {
                    $tmpRelationWhere = $relation->where;
                    $finalRelationWhere = [];
                    if (is_array($tmpRelationWhere)) {
                        foreach ($tmpRelationWhere as $fieldName => $fieldValue) {
                            $finalRelationWhere[$shortNameForRelationTable . '.' . $fieldName] = $fieldValue;
                        }
                    } else {
                        $finalRelationWhere = $tmpRelationWhere;
                    }
                    $select->where($finalRelationWhere);
                }
            }
        }

        return $select;
    }

    /**
     * @param \Laminas\Db\Sql\Select $select
     * @return \Laminas\Db\Sql\Select
     */
    public function extraJoinStatements($select)
    {
        return $select;
    }

    /**
     * @param \Laminas\Db\Sql\Select $select
     * @return \Laminas\Db\Sql\Select
     */
    public function extraWhereStatements($select)
    {
        return $select;
    }

    /**
     * @param string $tableName
     * @param \Laminas\Db\Sql\Select $select
     * @return \Laminas\Db\Sql\Select
     */
    protected function extraJoinRelationalData($tableName, $select) {
        return $select;
    }

    /**
     * @param string $tableName
     * @param \Laminas\Db\Sql\Select $select
     * @return \Laminas\Db\Sql\Select
     */
    protected function extraWhereRelationalData($tableName, $select) {
        return $select;
    }

    /**
     * @param \Laminas\Db\Sql\Select $select
     * @return \Laminas\Db\Sql\Select
     */
    public function whereStatements($select)
    {
        if ($this->_filters) {
            foreach ($this->_filters as $filterName => $filter) {
                if ($this->isFieldWithRelationNtoN($filterName)) {
                    $rel = $this->_relation_n_n[$filterName];

                    $select->join($this->getTableNameWithSchema($rel->junctionTable),
                        $rel->junctionTable . '.' . $rel->primaryKeyJunctionToCurrent . '=' .
                        $this->tableName . '.' . $this->getPrimaryKeyField($this->tableName). '',
                        []
                    );

                    if (is_array($filter)) {
                        $predictateSetArray = [];
                        foreach ($filter as $primaryKeyId) {
                            $predictateSetArray[] = new Predicate\Operator(
                                $rel->junctionTable . '.' . $rel->primaryKeyToReferrerTable, '=' , $primaryKeyId
                            );
                        }

                        if (!empty($predictateSetArray)) {
                            $select->where(new Predicate\PredicateSet($predictateSetArray, PredicateSet::OP_OR));
                        }
                    } else {
                        $select->where([
                            $rel->junctionTable . '.' . $rel->primaryKeyToReferrerTable => $filter
                        ]);
                    }

                }
            }

            // @todo: Remove duplicate code with the above filters
        } else if ($this->_filters_or) {
            foreach ($this->_filters_or as $filterName => $filter) {
                if ($this->isFieldWithRelationNtoN($filterName)) {
                    $rel = $this->_relation_n_n[$filterName];

                    $select->join($rel->junctionTable,
                        $rel->junctionTable . '.' . $rel->primaryKeyJunctionToCurrent . '=' .
                        $this->tableName . '.' . $this->getPrimaryKeyField($this->tableName). '',
                        []
                    );

                    if (is_array($filter)) {
                        $predictateSetArray = [];
                        foreach ($filter as $primaryKeyId) {
                            $predictateSetArray[] = new Predicate\Operator(
                                $rel->junctionTable . '.' . $rel->primaryKeyToReferrerTable, '=' , $primaryKeyId
                            );
                        }

                        if (!empty($predictateSetArray)) {
                            $select->where(new Predicate\PredicateSet($predictateSetArray, PredicateSet::OP_OR));
                        }
                    } else {
                        $select->where([
                            $rel->junctionTable . '.' . $rel->primaryKeyToReferrerTable => $filter
                        ]);
                    }

                }
            }
        }

        if ($this->_where !== null) {
            $select->where($this->_where);
        }

        return $select;
    }

    public function setColumns($columns) {
        $this->_columns = $columns;
    }

    public function getRowFromSelect($select, $sql) {
        $selectString = $sql->buildSqlString($select);

        $result = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);

        $resultsArray = [];
        foreach ($result as $row) {
            $resultsArray[]  = $row;
        }

        if (count($resultsArray) === 0) {
            return null;
        }

        return $resultsArray;
    }

    /**
     * @param \Laminas\Db\Sql\Select $select
     * @param $sql
     * @return array
     */
    public function getResultsFromSelect($select, $sql) {
        $selectString = $sql->buildSqlString($select);

        $result = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);

        $resultsArray = [];
        foreach ($result as $row) {
            $resultsArray[]  = $row;
        }

        return $resultsArray;
    }

    public function isUnique($fieldName, $fieldValue, $primaryKeyValue)
    {
        $sql = new Sql($this->adapter);
        $select = $sql->select();

        $select->columns(array('num' => new Expression('COUNT(*)')));

        if ($primaryKeyValue !== null) {
            $primaryKeyName = $this->getPrimaryKeyField();
            $where = new Where();
            $where->literal($fieldName . ' = ?', $fieldValue);
            $where->literal($primaryKeyName . ' != ?', $primaryKeyValue);
            $select->where($where);
        } else {
            $select->where([$fieldName => $fieldValue]);
        }

        $select->from($this->getTableNameWithSchema($this->tableName));

        $row = $this->getRowFromSelect($select, $sql);

        return ((int)$row[0]['num'] === 0);
    }

    function insertRelationManytoMany($fieldInfo, $data , $primaryKey)
    {
        foreach($data as $dataPrimaryKey) {
            $this->insert(array(
                $fieldInfo->primaryKeyJunctionToCurrent => $primaryKey,
                $fieldInfo->primaryKeyToReferrerTable => $dataPrimaryKey,
            ), $fieldInfo->junctionTable);
        }

        return true;
    }

    function updateRelationManytoMany($fieldInfo, $data , $primaryKey)
    {
        $sql = new Sql($this->adapter);

        // Step 1. Remove all the ids that are not on $data
        $remove = $sql->delete($this->getTableNameWithSchemaForOperations($fieldInfo->junctionTable));
        $whereDelete = new Where();

        $whereDelete->equalTo($fieldInfo->primaryKeyJunctionToCurrent, $primaryKey);

        if (!empty($data)) {
            $whereDelete->notIn($fieldInfo->primaryKeyToReferrerTable, $data);
        }
        $remove->where($whereDelete);
        $statement = $sql->prepareStatementForSqlObject($remove);

        $statement->execute();

        // Step 2. Create the final data that we would like to insert into junctionTable
        // by checking what data we already have into the junctionTable
        $dataToInsert = $data;

        $select = $sql->select();
        $select->columns([$fieldInfo->primaryKeyToReferrerTable]);

        $where = new Where();

        $where->equalTo($fieldInfo->primaryKeyJunctionToCurrent, $primaryKey);

        if (!empty($data)) {
            $where->in($fieldInfo->primaryKeyToReferrerTable, $data);
        }

        $select->where($where);
        $select->from($this->getTableNameWithSchema($fieldInfo->junctionTable));

        $results = $this->getResultsFromSelect($select, $sql);

        foreach ($results as $field) {
            $fieldValue = (string) $field->{$fieldInfo->primaryKeyToReferrerTable};
            if (in_array($fieldValue, $data)) {
                $dataToInsert = ArrayHelper::array_reject_value($dataToInsert, $fieldValue);
            }
        }

        // Step 3. Insert all the data on the junctionTable
        foreach($dataToInsert as $dataPrimaryKey) {
            $this->insert(array(
                $fieldInfo->primaryKeyJunctionToCurrent => $primaryKey,
                $fieldInfo->primaryKeyToReferrerTable => $dataPrimaryKey,
            ), $fieldInfo->junctionTable);
        }

        return true;
    }

    public function getRelationNtoNData($fieldInfo, $primaryKeyValue)
    {
        $sql = new Sql($this->adapter);
        $select = $sql->select();
        $select->columns([$fieldInfo->primaryKeyToReferrerTable]);
        $select->where([
            $fieldInfo->primaryKeyJunctionToCurrent . ' = ?' => $primaryKeyValue
        ]);
        $select->from($this->getTableNameWithSchema($fieldInfo->junctionTable));

        $results = $this->getResultsFromSelect($select, $sql);

        $relationIds = [];
        foreach ($results as $row) {
            $relationIds[] = $row->{$fieldInfo->primaryKeyToReferrerTable};
        }

        return $relationIds;
    }

    protected function _getOnlyPrimaryKeyValues($results) {
        $primaryKeyField = $this->getPrimaryKeyField();

        $primaryKeyValues = [];
        foreach ($results as $result) {
            $primaryKeyValues[] = $result[$primaryKeyField];
        }

        return $primaryKeyValues;
    }

    public function concatRelationalData($results, $primaryKeyValues)
    {
        if (empty($primaryKeyValues)) {
            // Nothing to concat! The results is empty
            return [];
        }

        $primaryKey = $this->getPrimaryKeyField();

        foreach ($this->_relation_n_n as $relation) {

            if (in_array($relation->fieldName, $this->_relation_n_n_columns)) {
                $sql = new Sql($this->adapter);
                $select = $sql->select();
                $select->columns([$relation->primaryKeyJunctionToCurrent, $relation->primaryKeyToReferrerTable]);
                $select->from($this->getTableNameWithSchema($relation->junctionTable));

                $where = new Where();
                $where->in($relation->primaryKeyJunctionToCurrent, $primaryKeyValues);
                $select->where($where);

                $relationResults = $this->getResultsFromSelect($select, $sql);

                $groupByCurrentId = [];
                foreach ($relationResults as $row) {
                    if (!isset($groupByCurrentId[$row[$relation->primaryKeyJunctionToCurrent]])) {
                        $groupByCurrentId[$row[$relation->primaryKeyJunctionToCurrent]] = [
                            $row[$relation->primaryKeyToReferrerTable]
                        ];
                    } else {
                        $groupByCurrentId[$row[$relation->primaryKeyJunctionToCurrent]][]
                            = $row[$relation->primaryKeyToReferrerTable];
                    }
                }

                foreach ($results as &$result) {
                    $result[$relation->fieldName] = isset($groupByCurrentId[$result[$primaryKey]])
                        ? $groupByCurrentId[$result[$primaryKey]]
                        : '';
                }
            }
        }

        return $results;
    }

    public function getColumns() {
        $columns = $this->_columns;

        return $columns;
    }

    public function getTableNameWithSchema($tableName) {
        if ($this->_dbSchema === null) {
            return $tableName;
        }

        return [$tableName => new TableIdentifier($tableName, $this->_dbSchema)];
    }

    public function getTableNameWithSchemaForOperations($tableName) {
        if ($this->_dbSchema === null) {
            return $tableName;
        }

        return new TableIdentifier($tableName, $this->_dbSchema);
    }

    public function getList()
    {
        $sql = new Sql($this->adapter);
        $select = $sql->select();
        $select->columns($this->getColumns());
        $select->limit($this->limit);
        $select->offset(($this->limit * ($this->page - 1)));

        $select->from($this->getTableNameWithSchema($this->tableName));

        $order_by = $this->orderBy;
        $sorting = $this->sorting;

        if ($order_by !== null) {
            $sortingString = ($sorting === null) ? '' : ' ' . $sorting;

            if ($this->isFieldWithRelation($order_by)) {
                $relationField = $this->_relation_1_n[$order_by];
                $shortNameForRelationTable = $this->getShortName($relationField->tableName, $relationField->fieldName);

                if (is_array($relationField->titleField)) {
                    $orderingFields = [];
                    foreach ($relationField->titleField as $titleField) {
                        $orderingFields[] = $shortNameForRelationTable . '.' . $titleField . $sortingString;
                    }
                    $select->order($orderingFields);
                } else {
                    $order_by = $shortNameForRelationTable . '.' . $relationField->titleField;
                    $select->order($order_by . $sortingString);
                }
            } else {
                if (is_array($order_by)) {
                    $select->order($order_by);
                } else {
                    $select->order($order_by . $sortingString);
                }
            }

        } else {
            $select = $this->defaultOrdering($select);
        }

        if (!empty($this->_filters)) {
            $select = $this->filtering($select, PredicateSet::OP_AND);
        }

        if (!empty($this->_filters_or)) {
            $select = $this->filtering($select, PredicateSet::OP_OR);
        }

        $select = $this->joinStatements($select);
        $select = $this->extraJoinStatements($select);

        $select = $this->whereStatements($select);
        $select = $this->extraWhereStatements($select);

        $results = $this->getResultsFromSelect($select, $sql);

        $resultsIds = $this->_getOnlyPrimaryKeyValues($results);

        $results = $this->concatRelationalData($results, $resultsIds);

        return $results;
    }
}
