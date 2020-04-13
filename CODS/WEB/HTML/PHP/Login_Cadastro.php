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
        $sql = $pdo->prepare("SELECT IdUsuario FROM Usuario WHERE Nome_Usuário = :NU");
        $sql->bindValue(":NU", $nomeusuario); 
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            return false; //isso vai acontecer se o usuário ja exister, ai nao pode cadastrar :(
        }
        else
        {
            //se realmente for um novo usuario, cadastrar!
            $sql = $pdo->prepare("INSERT INTO Usuario (Nome, Sobrenome, Nome_Usuário, Data_De_Nascimento, E_mail, Senha)
             VALUES (:nom, :sbnome, :NU, :dat, :ema, :s)");
            $sql->bindValue(":nom", $nome); 
            $sql->bindValue(":sbnome", $sobrenome); 
            $sql->bindValue(":NU", $nomeusuario); 
            $sql->bindValue(":dat", $nascimento);
            $sql->bindValue(":ema", $email);
            $sql->bindValue(":s", md5($senha)); 
            $sql->execute();
            return true;
        }

    }

    public function logar($nomeusuario, $senha, $E_mail)
    {
        global $msgErro;
        global $pdo;
        
             $sql = $pdo->prepare("SELECT IdUsuario FROM Usuario WHERE Nome_Usuário = :NU OR E_mail = :ema  AND Senha = :s");
        $sql->bindValue (":NU", $nomeusuario);
        $sql->bindValue (":s", md5($senha));
        $sql->bindValue (":ema", $E_mail);
        $sql->Execute();
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
        //verifica se o email q a pessoa usar já nao ta sendo usado po nenhum outro usuario!
        $sql = $pdo->prepare("SELECT IdUsuario FROM Usuario WHERE E_mail = :ema");
        $sql->bindValue(":ema", $email); 
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            return false; 
        }
        else{
       
       return true;
    }
}
}
?>