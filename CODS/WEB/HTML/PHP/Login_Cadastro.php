<?php

Class Usuario
{
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

    public function cadastrar($nome, $sobrenome, $nomeusuario, $nascimento, $email, $senha)
    {
        
        global $pdo;
        global $msgErro;
        //verifica se o usuáio cadastrado já existe!
        $sql = $pdo->prepare("CALL BuscarId_UsuarioNu(:nu)");
        $sql->bindValue(":nu", $nomeusuario); 
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            return false; //isso vai acontecer se o usuário ja exister, ai nao pode cadastrar :(
        }
        else
        {
            //se realmente for um novo usuario, cadastrar!
            $sql = $pdo->prepare("CALL Cadastrar_Usuario(:n, :s, :nu, :d, :e, :k)");
            $sql->bindValue(":n", $nome); 
            $sql->bindValue(":s", $sobrenome); 
            $sql->bindValue(":nu", $nomeusuario); 
            $sql->bindValue(":d", $nascimento);
            $sql->bindValue(":e", $email);
            $sql->bindValue(":k", md5($senha)); 
            $sql->execute();
            return true;
        }

    }

    public function logar($nomeusuario, $senha, $E_mail)
    {
        global $msgErro;
        global $pdo;
        $sql = $pdo->prepare("CALL Logar_Usuario(:nu, :e, :s)");
        $sql->bindValue (":nu", $nomeusuario);
        $sql->bindValue (":s", md5($senha));
        $sql->bindValue (":e", $E_mail);
        $sql->execute();
        //esse if ta fazendo a verificação se tá certo o user e a senha da pessoa.   
        if ($sql->rowCount() > 0) {
 
             $dado = $sql->fetch();
             session_start();
             $_SESSION['IdUsuario'] = $dado ['IdUsuario'];
             return true;
             
 
        }
        else{
             return false;

    }
    }
    public function verifica($email)
    {
        
        global $pdo;
        global $msgErro;
        //verifica se o email q a pessoa usar já nao ta sendo usado por nenhum outro usuario!
        $sql = $pdo->prepare("CALL BuscarId_UsuarioE(:e)");
        $sql->bindValue(":e", $email); 
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            return false; 
        }
        else{
       
       return true;
    }
}
public function editar1($id, $nome, $sobrenome, $nomeusuario, $nascimento, $biografia)
    {
        
        global $pdo;
        global $msgErro;             
        $sql = $pdo->prepare("CALL Atualizar_Usuario(:id, :n, :s, :nu, :dn, :e)");
        $sql->bindvalue(":id", $id);
        $sql->bindvalue(":n", $nome);              
        $sql->bindValue(":s", $sobrenome); 
        $sql->bindValue(":nu", $nomeusuario); 
        $sql->bindValue(":dn", $nascimento);
        $sql->bindValue(":e", $email);   
        $sql->execute();
        return true;
       

    }
    public function editar2($senha, $id)
    {
        
        global $pdo;
        global $msgErro;             
        $sql = $pdo->prepare("CALL Alterar_Senha(:id, :s)");
        $sql->bindvalue(":s", md5($senha));                
        $sql->bindvalue(":id", $id);
        $sql->execute();
        return true;
       

    }
    public function editar3($email, $id)
    {
        
        global $pdo;
        global $msgErro;             
        $sql = $pdo->prepare("CALL Alterar_Email(:id, :e)");
        $sql->bindvalue(":e", $email);                
        $sql->bindvalue(":id", $id); 
        $sql->execute();
        return true;
       

    }


public function cadastrarfotoroupa($title, $tipo, $tamanho, $cor, $marca, $descricao, $foto)
{
    
    global $pdo;
    global $msgErro;
   
        //se realmente for um novo usuario, cadastrar!
        $sql = $pdo->prepare("INSERT INTO Roupa (Title, Tipo, Tamanho, Cor, Marca, Descricao, Foto)
         VALUES (:tit, :descr, :co, :tam, :mar, :tip, :fot)");
        $sql->bindValue(":tit", $title); 
        $sql->bindValue(":descr", $descricao); 
        $sql->bindValue(":co", $cor);
        $sql->bindValue(":tam", $tamanho);
        $sql->bindValue(":mar", $marca);
        $sql->bindValue(":tip", $tipo); 
        $sql->bindValue(":fot", $foto); 
        $sql->execute();
        return true;
    

}
//ediçaõ do titulo/nome da roupa!
public function editartitulo($titulo, $id)
{
    
    global $pdo;
    global $msgErro;
   
        
        $sql = $pdo->prepare("UPDATE Roupa SET Titulo= :tit WHERE IdRoupa= :id");
        $sql->bindValue(":tit", $titulo); 
        $sql->bindValue(":id", $id); 
        $sql->execute();
        return true;
    

}
//edição da descrição da foto
public function editardescricao($descricao, $id)
{
    
    global $pdo;
    global $msgErro;
   
        
        $sql = $pdo->prepare("UPDATE Roupa SET Descricao= :disc WHERE IdRoupa= :id");
        $sql->bindValue(":disc", $descricao); 
        $sql->bindValue(":id", $id); 
        $sql->execute();
        return true;
    

}
public function editarfoto($foto, $id)
{
    
    global $pdo;
    global $msgErro;
   
        $sql = $pdo->prepare("UPDATE Roupa SET Foto= :fot WHERE IdRoupa= :id");
        $sql->bindValue(":fot", $foto); 
        $sql->bindValue(":id", $id); 
        $sql->execute();
        return true;
    

}
public function apagarfoto($id)
{
    
    global $pdo;
    global $msgErro;
   
        $sql = $pdo->prepare("CALL Apagar_Roupa(:id)");
        $sql->bindValue(":id", $id);
        $sql->execute();
        return true;
    

}
}
?>