<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
	</head>
	</body>
        <?php
            require_once 'funcoes_usuario.php';
            session_start();
            if(!isset($_SESSION['IdUsuario']))
            {
                header("location: ../Close_Log02.php");
                exit;
            }else{
			require_once("Conexao.php");
            
                $id = $_POST['id_user'];
                $titulo = $_POST['titulo'];
                $descricao = $_POST['descricao'];
                $arquivo = $_FILES['arquivo'];
                $sql = "CALL Novo_Look('$id','$titulo','$descricao')";
                $resultado = mysqli_query($connect, $sql);
                $total = mysqli_affected_rows($connect);
                if($total > 0){
                $dados1 = mysqli_fetch_array($resultado);
                $id = $dados1['MAX(IdLook)'];
                mysqli_next_result($connect);
                for ($cont = 0; $cont < count($arquivo['name']); $cont++) {
            
                    $destino = "../Fotos_Looks/" . $arquivo['name'][$cont];
                
                    if (move_uploaded_file($arquivo['tmp_name'][$cont], $destino)) {
                        
                            $nome_final = $arquivo['name'][$cont];
                        $query = mysqli_query($connect, "CALL Nova_Foto('$id', '$nome_final')");
                        $total = mysqli_affected_rows($connect);
                        if($total > 0){
                            $_SESSION['msg'] = "<div class='alert alert-success' id='msg-alert1' style='position: fixed; margin-top: 5px; bottom: 80%;
                            right: 20px; border-left: 7px solid #58D68D;'>
                                <span class='fa fa-check-circle'></span>
                                <span class='msg'> Look cadastrado com sucesso! </span>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='padding-left: 9px; padding-bottom:9px;'>
                                    <span aria-hidden='true' onclick='this.parentElement.style.display='none';'>&times;</span>
                                </button>
                            </div>";
                                echo "<script language=java script type= 'text/javascript'>
                                window.location.href = '../Close_GuardRp02.php'
                                </script>";
                        }
                    
                        
                    } else {
                        $_SESSION['msg'] = "<div class='alert alert-danger' id='msg-alert1' style='position: fixed; margin-top: 5px; bottom: 85%;
                        right: 20px; border-left: 7px solid #C0392B ;'>
                            <span class='fa fa-meh-o'></span>
                            <span class='msg'> Não foi possível cadastrar o look! </span>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='padding-left: 9px; padding-bottom:9px;'>
                                <span aria-hidden='true' onclick='this.parentElement.style.display='none';'>&times;</span>
                            </button>
                        </div>";
                        echo "<script language=java script type= 'text/javascript'>
                        window.location.href = '../Close_GuardRp02.php'
                        </script>";                    
                    }
                }
            }else{
                $_SESSION['msg'] = "<div class='alert alert-danger' id='msg-alert1' style='position: fixed; margin-top: 5px; bottom: 85%;
                        right: 20px; border-left: 7px solid #C0392B ;'>
                            <span class='fa fa-meh-o'></span>
                            <span class='msg'> Não foi possível cadastrar o look! </span>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='padding-left: 9px; padding-bottom:9px;'>
                                <span aria-hidden='true' onclick='this.parentElement.style.display='none';'>&times;</span>
                            </button>
                        </div>";
                echo "<script language=java script type= 'text/javascript'>
                window.location.href = '../Close_GuardRp02.php'
                </script>";   
            }
        }
		?>
		
	</body>
</html>
