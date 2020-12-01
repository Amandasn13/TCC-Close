<?php
class Look
{
    private $pdo;
    public $msgErro = "";

    public function conexao($nome, $host, $usuario, $senha)
    {

        global $pdo;
        global $msgErro;
        try {
            $pdo = new PDO("mysql:dbname=" . $nome . ";host=" . $host, $usuario, $senha);
        } catch (PDOException $erro) {
            $msgErro = $erro->getMessage();
        }
    }
    //função de apagar o look
    public function apagarlook($id)
    {
        global $pdo;
        global $msgErro;
        $sql = $pdo->prepare("CALL Apagar_Look(:id)");
        $sql->bindValue(":id", $id);
        $sql->nextRowset();
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
