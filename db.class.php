<?php

require_once "post.class.php";

class DB
{

    public static PDO $pdo;
    private static $tableColumns = "";
    private static $tableValueParams = "";
    private static $tableSetParams = "";
    private static $tableName = "";

    public function __construct()
    {
        $this::connect();
    }

    public static function connect()
    {
        try {
            self::$pdo = new PDO('mysql:host=mariadb;dbname=blog', 'root', 'root');
        } catch (\PDOException $ex) {
            exit("Veritabanına bağlanırken bir hata ile karşılaşıldı. {$ex->getMessage()}");
        }


        if (static::$tableName) {
            self::$tableName  = static::$tableName;
        } else {
            self::$tableName  = strtolower(static::class) . 's';
        }
    }


    public static function All()
    {
        self::connect();
        $query = self::$pdo->query("Select * from " . self::$tableName . "");

        return $query->fetchAll(PDO::FETCH_CLASS, static::class);
    }


    public static function find(int $id): static | null
    {
        self::connect();

        $query = "SELECT * FROM " . self::$tableName . " WHERE id=:id";
        $namedQuery = self::$pdo->prepare($query);

        $namedQuery->bindValue(':id', $id);

        $namedQuery->execute();

        $result = $namedQuery->fetchObject(static::class);

        $result = $result ?: null;

        return $result;
    }


    public function serialize(): array
    {
        $properties = get_object_vars($this);
        $totalProperties = count($properties);
        $propertiesCounter = 0;

        foreach ($properties as $columnName => $value) {

            self::$tableValueParams .= ":" . $columnName;
            self::$tableColumns .= $columnName;

            self::$tableSetParams .= "$columnName=:$columnName";
            $propertiesCounter++;

            if ($propertiesCounter < $totalProperties) {

                self::$tableSetParams .= ',';
                self::$tableValueParams .= ',';
                self::$tableColumns .= ',';
            }
        }
        return $properties;
    }

    public function create()
    {
        self::connect();

        $properties = $this->serialize();

        $namedQuery = self::$pdo->prepare("INSERT INTO " . self::$tableName . "(" . self::$tableColumns . ") VALUES(" . self::$tableValueParams . ")");

        foreach ($properties as $param => $value) {
            $namedQuery->bindValue(":$param", $value);
        }

        $namedQuery->execute();
    }

    public function update()
    {
        self::connect();
        $properties = $this->serialize();

        $query = "UPDATE " . self::$tableName . " SET " . self::$tableSetParams . " WHERE id=:id";
        $namedQuery = self::$pdo->prepare($query);

        foreach ($properties as $param => $value) {
            $namedQuery->bindValue(":$param", $value);
        }

        $namedQuery->execute();
    }

    public function delete()
    {
        self::connect();

        $query = "DELETE FROM " . self::$tableName . " WHERE id=:id";
        $namedQuery = self::$pdo->prepare($query);

        $namedQuery->bindValue(":id", $this->id);

        $namedQuery->execute();
    }
}
