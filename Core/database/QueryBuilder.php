<?php

class QueryBuilder {

    protected $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function selectAll($table, $class) {
        try {
            $query = $this->pdo->prepare("select * from {$table}");
            // II) luego se ejecutara el query con la siguente funcion:
            $query->execute();
            // III)
            } catch(Exception) {
                echo "Error al obtener las tareas";
            }
            /** NOTAS
             * PDO::FETCH_CLASS es una constante que le indicara a PDO
             * que recupere la informacion como un array asociativo.
             */
            return $query->fetchAll(PDO::FETCH_CLASS, $class);
    }

    public function find($table, $id) {
        try {
            $query = $this->pdo->prepare("select * from {$table} where id={$id} limit 0,1");
            // II) luego se ejecutara el query con la siguente funcion:
            $query->execute();
            // III)
            } catch(Exception) {
                echo "Error al obtener las tareas";
            }
            /** NOTAS
             * PDO::FETCH_CLASS es una constante que le indicara a PDO
             * que recupere la informacion como un array asociativo.
             */
            dd($query->fetchAll(PDO::FETCH_ASSOC)[0]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($table, $params) {

        // Para obtener un array con las keys del arreglo de params.
        $cols = array_keys($params);

        // Para separar y pegar con comas dichos titulos de columnas.
        $cols_glued = implode(', ', $cols);

        /**
         * Para la preparacion del query se debe hacer con los placeholders
         * de la forma x:, y:, z:, ya que cuando se ejecute la consulta PDO va
         * a remplazar con los valores apropiados.
         */
        $placeholders = ":" . implode(', :', $cols);
        $sql = "insert into {$table} ({$cols_glued}) values ({$placeholders})";

        try {

        // Luego que ya se tiene la setencia sql configurada con los
        // parametros necesarios, la preparamos en un query:
        $query = $this->pdo->prepare($sql);

        // y por ultimo le pasamos el arreglo con los datos 
        // necesarios para sustituir en los lugares requeridos:

        $query->execute($params);
        } catch (Exception $error) {
            die($error);
        }
        
    }

    public function update($table, $id, $params)
    {
        // Para obtener un array con las keys del arreglo de params.
        $cols = array_keys($params);
        // Para separar y pegar con comas dichos titulos de columnas.
        $cols = array_map(function ($col) {
            return "{$col}=:{$col}";
        }, $cols);
        $cols_glued = implode(", ", $cols);
        $cols_glued;
        /**
         * Para la preparacion del query se debe hacer con los placeholders
         * de la forma x:, y:, z:, ya que cuando se ejecute la consulta PDO va
         * a remplazar con los valores apropiados.
         */
        $sql = "update {$table} set {$cols_glued} where id=:id";

        try {

        // Luego que ya se tiene la setencia sql configurada con los
        // parametros necesarios, la preparamos en un query:
        $query = $this->pdo->prepare($sql);
        // y por ultimo le pasamos el arreglo con los datos
        // necesarios para sustituir en los lugares requeridos:
        $query->execute([...$params, 'id' => $id]);  //$params['id'] = 123; //tenemos que asignar el id al momento de hacer un execute de update. Esta es una forma.
        } catch (Exception $error) {
            die($error->getMessage());
        }
        
    }

    public function delete($table, $id)
    {
        $sql = "delete from {$table} where id=:id;";

        try {

        // Luego que ya se tiene la setencia sql configurada con los
        // parametros necesarios, la preparamos en un query:
        $query = $this->pdo->prepare($sql);
        // y por ultimo le pasamos el arreglo con los datos
        // necesarios para sustituir en los lugares requeridos:
        $query->execute(['id' => $id]);  //$params['id'] = 123; //tenemos que asignar el id al momento de hacer un execute de update. Esta es una forma.
        } catch (Exception $error) {
            die($error->getMessage());
        }
        
    }
}