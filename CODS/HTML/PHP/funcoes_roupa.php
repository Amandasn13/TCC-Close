<?php

Class Roupa{
        
    private $pdo;
    public $msgErro = "";
    public function conexao($nome, $host, $usuario, $senha)
    {
        global $pdo; 
        global $msgErro;
        try
        {
        $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
        }
        catch(PDOException $erro)
        {
            $msgErro = $erro->getMessage();            
        }
    }
    //edição das informações com textos da roupa
    public function editartitulo($id, $titulo, $categoria, $tipo, $cor, $descricao, $tamanho, $marca, $material)
    {
        
        global $pdo;
        global $msgErro;
       
            
            $sql = $pdo->prepare("CALL Alterar_Roupa(:id, :tit, :cat, :tip, :c, :descr, :tam, :mar, :mat)");
            $sql->bindValue(":id", $id);
            $sql->bindValue(":tit", $titulo); 
            $sql->bindValue(":cat", $categoria); 
            $sql->bindValue(":tip", $tipo); 
            $sql->bindValue(":c", $cor); 
            $sql->bindValue(":descr", $descricao);  
            $sql->bindValue(":tam", $tamanho); 
            $sql->bindValue(":mar", $marca);
            $sql->bindValue(":mat", $material);
            $sql->nextRowset(); 
            $sql->execute();
            if($sql->rowCount() > 0)
            {
                return true;
            }else{
                return false;
            }      
    }
    //função de apagar a roupa
    public function apagarfoto($id){
    
    global $pdo;
    global $msgErro;
   
        $sql = $pdo->prepare("CALL Apagar_Roupa(:id)");
        $sql->bindValue(":id", $id);
        $sql->nextRowset();
        $sql->execute();
        return true;    
    }
    
}