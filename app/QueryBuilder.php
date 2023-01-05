<?php



class QueryBuilder{
    public $pdo;
    function __construct($host, $dbname, $username, $password)
    {
        $this->pdo = new PDO("mysql:host={$host}; dbname={$dbname}", "{$username}", "{$password}");
    }

    public function getAll($table): array
    {

        $statement = $this->pdo->prepare("SELECT * FROM `$table`");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }
    public function getAllById($table, $id): array
    {

        $statement = $this->pdo->prepare("SELECT * FROM `$table` WHERE `product_id`=:id");
        $statement->bindParam(":id", $id);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }
    public function getAllLimit($table,$id, $limit): array
    {

        $statement = $this->pdo->prepare("SELECT * FROM `$table`  WHERE `id`!=:id LIMIT $limit");
        $statement->bindParam(":id", $id);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }
    public function create($table, $data){

        $keys = array_keys($data);
        $stringOfKeys = implode(",", $keys);
        $stringOfValues = ":" . implode(", :", $keys);
        $sql = "INSERT INTO `$table` ($stringOfKeys) VALUES ($stringOfValues)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);


    }
    public function update($table, $data, $id){
        $keys = array_keys($data);
        $values = '';
        foreach ($keys as $key){
            $values .= $key . '=:'. $key . ', ';
        }
        $values = rtrim($values, ', ');
        $sql = "UPDATE `$table` SET $values WHERE id=:id";

        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(":id", $id);


        $statement->execute($data);


    }
    public function getOneById($table, $id){
        $statement = $this->pdo->prepare("SELECT * FROM `$table` WHERE id=:id");
        $statement->bindParam(":id", $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    public function deleteById($table,$id){
        $sql = "DELETE FROM `$table` WHERE id=:id ";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(":id", $id);
        $statement->execute();


    }


}