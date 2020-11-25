<?php
USE PHPMailer\PHPMailer\PHPMailer;
USE PHPMailer\PHPMailer\SMTP;
USE PHPMailer\PHPMailer\Exception;
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
public function editar1($id, $nome, $sobrenome, $nomeusuario, $nascimento)
    {
        
        global $pdo;
        global $msgErro;             
        $sql = $pdo->prepare("CALL Atualizar_Usuario(:id, :n, :s, :nu, :dn)");
        $sql->bindvalue(":id", $id);
        $sql->bindvalue(":n", $nome);              
        $sql->bindValue(":s", $sobrenome); 
        $sql->bindValue(":nu", $nomeusuario); 
        $sql->bindValue(":dn", $nascimento);
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
public function editartitulo($titulo, $id, $categoria, $tipo, $cor, $descricao, $tamanho, $marca, $material)
{
    
    global $pdo;
    global $msgErro;
   
        
        $sql = $pdo->prepare("UPDATE Roupa SET Titulo= :tit, Categoria = :cat, Tipo = :tip, Cor = :co, Descricao = :descr, Tamanho = :tam, Marca = :mar, Material =
        :mat WHERE IdRoupa= :id");
        $sql->bindValue(":tit", $titulo); 
        $sql->bindValue(":id", $id);
        $sql->bindValue(":cat", $categoria); 
        $sql->bindValue(":tip", $tipo); 
        $sql->bindValue(":co", $cor); 
        $sql->bindValue(":descr", $descricao);  
        $sql->bindValue(":tam", $tamanho); 
        $sql->bindValue(":mar", $marca);
        $sql->bindValue(":mat", $material);  
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
public function esquecisenha($email){
    
    global $pdo;
    global $msgErro;

        $sql = $pdo->prepare("SELECT * FROM Usuario WHERE E_mail = :e");
        $sql->bindValue(":e", $email);
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            $resultado = $sql->fetch(PDO::FETCH_ASSOC);
            $chave = md5(md5($resultado['IdUsuario'].$resultado['Senha']));
            $email = $resultado['E_mail'];
            $this->add_dados_recover($email, $chave);
            echo "<script language=javascript type= 'text/javascript'>
            window.alert('Email enviado!')
            </script>";

        }else{
            echo "<script language=javascript type= 'text/javascript'>
            window.alert('E-mail não pertence a nenhum usuário!')
            </script>";
        }
       

}
    public function add_dados_recover($email, $chave){
        
        global $pdo;
        global $msgErro;
        
        $sql = $pdo->prepare("INSERT INTO recover_solicitation (email, rash) VALUES (:e, :r)");
        $sql->bindValue(":e", $email);
        $sql->bindValue(":r", $chave);
        $sql->execute();
        if($sql->rowCount() > 0){
			$this->enviar_email($email, $chave);
		}else{
            return false;
        }
    
    }
    public function enviar_email($email, $chave){
        
        global $pdo;
        global $msgErro;

        require_once('src/PHPMailer.php');
        require_once('src/SMTP.php');
        require_once('src/Exception.php');



$mail = new PHPMailer(true);

try {
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Username = 'close.projct@gmail.com';
	$mail->Password = 'CapTCC07';
	$mail->Port = 587;

	$mail->setFrom('close.projct@gmail.com');
	$mail->addAddress($email);
    $corpo = '<!doctype html><head>
        <html>
        <meta charset="UTF-8">
    </head><body><p>Foi solicitada a alteração da sua senha do Close, clique<a href="http://localhost/TCC%20Def/TCC-Close/CODS/HTML/Alterar_Senha.php?chave='.$chave.'"> aqui</a> para alterá-la. Caso não tenha sido você apenas ignore essa 
    mensagem e mantenha-se alerta!</p></body></html>';
    $mail->isHTML(true);
	$mail->Subject = 'Alterar senha';
	$mail->Body = $corpo;
	$mail->AltBody = $corpo;

	if($mail->send()) {
		echo 'Email enviado com sucesso';
	} else {
		echo 'Email nao enviado';
	}
} catch (Exception $e) {
	echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
}

    }
    public function deletarash($rash){
        global $pdo;
        global $msgErro;

        $sql = $pdo->prepare("DELETE FROM recover_solicitation WHERE rash = :r");
        $sql->bindValue(":r", $rash);
        $sql->execute();
        return true;

    }

}
?>