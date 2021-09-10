<?php

require_once "post.class.php";

class DB
{

    public static PDO $pdo;
    private static $tableColumns = "";
    private static $tableValueParams = "";
    private static $tableSetParams = "";

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
    }


    public static function All()
    {
        self::connect();
        $query = self::$pdo->query('Select * from posts');

        return $query->fetchAll(PDO::FETCH_CLASS, static::class);
    }


    public static function find(int $id) : static | null
    {
        self::connect();

        $query = "SELECT * FROM posts WHERE id=:id";
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

        $namedQuery = self::$pdo->prepare("INSERT INTO posts(" . self::$tableColumns . ") VALUES(" . self::$tableValueParams . ")");

        foreach ($properties as $param => $value) {
            $namedQuery->bindValue(":$param", $value);
        }

        $namedQuery->execute();
    }

    public function update()
    {
        self::connect();
        $properties = $this->serialize();

        $query = "UPDATE posts SET " . self::$tableSetParams . " WHERE id=:id";
        $namedQuery = self::$pdo->prepare($query);

        foreach ($properties as $param => $value) {
            $namedQuery->bindValue(":$param", $value);
        }

        $namedQuery->execute();
    }

    public function delete()
    {
        self::connect();

        $query = "DELETE FROM posts WHERE id=:id";
        $namedQuery = self::$pdo->prepare($query);

        $namedQuery->bindValue(":id", $this->id);

        $namedQuery->execute();
    }
}
