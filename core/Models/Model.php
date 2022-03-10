<?php
namespace Models;

abstract class Model extends \mysqli
{
    protected $table = null;
    protected $primaryKey = 'id';
    private $inquiry = '';
    private $where_query = '';

    public function __construct()
    {
        # Открываем соединение с базой данных
        parent::__construct(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
        $this->set_charset('UTF-8');
    }


    # Вывод данных из таблица БД
    public function get()
    {
        $this->where_query = !$this->where_query ? '' : 'WHERE ' . $this->where_query;
        $this->inquiry = $this->inquiry ?: "SELECT * FROM `{$this->table}` {$this->where_query}";

        # Удаление после выполнения!!!!
        return $this->query($this->inquiry)->fetch_all(MYSQLI_ASSOC);
    }

    # Получение одной записи по первичному ключу
    public function find($id)
    {
        $this->inquiry = "SELECT * FROM `{$this->table}` WHERE `{$this->primaryKey}` = '{$id}' LIMIT 1";
        return $this->query($this->inquiry)->fetch_assoc();
    }

    # Запись данных в таблицу БД
    public function create($array)
    {
        $columns = [];
        $values = [];
        foreach($array as $column => $value) {
            $column = $this->real_escape_string(trim($column));
            $value = $this->real_escape_string(trim($value));
            $columns[] = "`{$column}`";
            $values[] = "'{$value}'";
        }

        $query = 'INSERT INTO `' . $this->table . '` (' . implode(',', $columns) . ') VALUES(' . implode(',', $values) . ')';
        $this->query($query);
        $insert_id = $this->insert_id;
        return $this->find($insert_id);
    }

    # Удаление данных в таблице БД
    public function destroy($id)
    {
        $id = $this->real_escape_string(trim($id));
        $old = $this->find($id);
        if(!$old) return $old;

        $query = "DELETE FROM `{$this->table}` WHERE `{$this->primaryKey}` = '{$id}'";
        $this->query($query);
        return $old;
    }

    # Обновления данных в таблице БД
    public function update($id, $array)
    {
        $id = $this->real_escape_string(trim($id));
        $update = [];
        foreach($array as $column => $value) {
            $column = $this->real_escape_string(trim($column));
            $value = $this->real_escape_string(trim($value));
            $update[] = "`{$column}` = '{$value}'";
        }

        $query = "UPDATE `{$this->table}` SET " . implode(',', $update) . " WHERE `{$this->primaryKey}` = '{$id}'";
        $this->query($query);
        return $this->find($id);
    }

    # Where
    # [
    #    ['name', '=', 'value'],
    #    ['name', '=', 'value']
    # ]
    public function where($arg)
    {
        foreach($arg as $where_query) {
            $where_query[0] = '`' . $this->real_escape_string(trim($where_query[0])) . '` ';
            $where_query[2] = " '" . $this->real_escape_string(trim($where_query[2])) . "'";
            $this->where_query .= ($this->where_query ? ' AND ' : '') . $where_query[0] . $where_query[1] . $where_query[2];
        }

        return $this;
    }

    public function __destruct()
    {
        # закрываем
        $this->close();
    }
}