/*CRIAÇÃO DO BANCO DE DADOS*/
DROP DATABASE IF EXISTS Tiffanny;
CREATE DATABASE Tiffanny DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE Tiffanny;
/*CRIAÇÃO DAS TABELAS*/
/*Criação da Tabela Usuário*/
CREATE TABLE Usuario (
    IdUsuario INT AUTO_INCREMENT PRIMARY KEY,
    Nome CHAR(100) NOT NULL,
    Email CHAR(100) UNIQUE NOT NULL,
    Sobrenome CHAR(100) NOT NULL,
    Nome_de_Usuario CHAR(100) NOT NULL,
    Senha CHAR(100) NOT NULL,
    Nascimento DATE NOT NULL,
    Foto BLOB
);
/*Criação da Tabela Roupa*/
CREATE TABLE Roupa (
    IdRoupa INT AUTO_INCREMENT PRIMARY KEY,
    Titulo CHAR(100),
    Categoria ENUM("Acessório","Calçado","Roupa") NOT NULL,
    Tipo CHAR(100) NOT NULL,
    Foto BLOB,
    Cor CHAR(100),
    Descricao TEXT,
    Tamanho CHAR(100),
    Marca CHAR(100),
    Material CHAR(100)
);
/*Criação da Tabela Look*/
CREATE TABLE Look (
    IdLook INT AUTO_INCREMENT PRIMARY KEY,
    Nome CHAR(100) NOT NULL,
    Descricao TEXT
);
/*Criação da tabela para fotos dos Looks*/
CREATE TABLE Fotos_Look (
    IdFotosLook INT AUTO_INCREMENT PRIMARY KEY,
    fk_Look INT,
    Fotos_Look BLOB,
	CONSTRAINT FOREIGN KEY (fk_Look) REFERENCES Look (IdLook)
);
/*Criação da tabela que relaciona Usuarios Looks e Roupas*/
CREATE TABLE Usuario_Look_Roupa (
	fk_Usuario INT,
    fk_Look INT,
    fk_Roupa INT,
    CONSTRAINT FOREIGN KEY (fk_Usuario) REFERENCES Usuario (IdUsuario),
    CONSTRAINT FOREIGN KEY (fk_Look) REFERENCES Look (IdLook),
    CONSTRAINT FOREIGN KEY (fk_Roupa) REFERENCES Roupa (IdRoupa)
);
/*Criação da tabela para recuperação de senha*/
CREATE TABLE Recuperacao_de_Senha (
  Id INT(20) AUTO_INCREMENT PRIMARY KEY,
  Email VARCHAR(200) NOT NULL,
  Rash VARCHAR(200) NOT NULL,
  Estado VARCHAR(20) NOT NULL DEFAULT '0'
);
/*FUNÇÕES*/
CREATE FUNCTION get_idu() RETURNS INTEGER RETURN @iduser; /*retorna o valor da variavel @iduser*/
CREATE FUNCTION get_idr() RETURNS INTEGER RETURN @idroup; /*retorna o valor da variavel @idroup*/
DELIMITER //
/*PROCEDIMENTOS ARMAZENADOS*/
/*--Procedures de recuperação de senha--*/
/*Cria uma nova requisição para a recuperação*/
CREATE PROCEDURE Nova_Recuperacao(e VARCHAR(200), r VARCHAR(200))
	BEGIN
		INSERT INTO Recuperacao_de_Senha(email,rash) VALUES(e,r);
    END//
/*Retorna os dados da requisição de acordo com o email do usuário*/
CREATE PROCEDURE Buscar_RecuperacaoE(e VARCHAR(200))
	BEGIN
		SELECT * FROM Recuperacao_de_Senha WHERE email = e LIMIT 1;
    END//
/*Retorna o email do usuário de acordo com o hash da requisição*/
CREATE PROCEDURE BuscarE_RecuperacaoR(r VARCHAR(200))
	BEGIN
    SELECT email FROM Recuperacao_de_Senha WHERE rash = r LIMIT 1;
    END//
/*Apaga/Finaliza a requisição*/
CREATE PROCEDURE Apagar_Recuperacao(r VARCHAR(200))
	BEGIN
		DELETE FROM Recuperacao_de_Senha WHERE Rash = r;
		DELETE FROM Usuario WHERE IdUsuario=id;
	END//
/*--Procedures com a tabela usuário--*/
/*Cadastra o Usuário*/
CREATE PROCEDURE Cadastrar_Usuario(n CHAR(200), s CHAR(200), nu CHAR(200), dn DATE, e CHAR(200), k CHAR(200))
	BEGIN
		INSERT INTO Usuario (Nome, Sobrenome, Nome_de_Usuario, Nascimento, Email, Senha) VALUES (n,s,nu,dn,e,k);
	END//
/*Retorna o id de um usuário de acordo com seu dados de login*/
CREATE PROCEDURE Logar_Usuario(nu CHAR(100), e CHAR(100), k CHAR(100))
	BEGIN
		SELECT IdUsuario FROM Usuario WHERE Nome_de_Usuario = nu OR Email = e  AND Senha = k LIMIT 1;
	END//
/*Retorna todos os dados de um usuário de acordo com seu id*/
CREATE PROCEDURE Buscar_Usuario(id INT)
    BEGIN
          SELECT * FROM Usuario WHERE IdUsuario = id LIMIT 1;
    END//
/*Retorna todos os dados de um usuário de acordo com seu email*/
CREATE PROCEDURE Buscar_UsuarioE(e CHAR(100))
	BEGIN
		SELECT * FROM Usuario WHERE Email = e LIMIT 1;
    END//
/*Retorna o id de um usuário de acordo com o seu nome de usuário*/
CREATE PROCEDURE BuscarId_UsuarioNu(nu CHAR(100))
    BEGIN
           SELECT IdUsuario FROM Usuario WHERE Nome_de_Usuario = nu LIMIT 1;
    END//
/*Retorna o id de um usuário de acordo com o seu email*/
CREATE PROCEDURE BuscarId_UsuarioE(e CHAR(100))
    BEGIN
          SELECT IdUsuario FROM Usuario WHERE Email = e LIMIT 1;
    END//
/*Altera alguns dados do usuário*/
CREATE PROCEDURE Alterar_Usuario(id INT,n CHAR(200), s CHAR(200), dn DATE)
	BEGIN
		UPDATE Usuario SET Nome=n, Sobrenome=s, Nascimento=dn WHERE IdUsuario=id;
	END//
/*Altera o nome do usuário*/
CREATE PROCEDURE Alterar_Nome(id INT, n CHAR(100))
	BEGIN
		UPDATE Usuario SET Nome_de_Usuario = n WHERE IdUsuario=id;
	END//
/*Altera o email de usuário*/
CREATE PROCEDURE Alterar_Email(id INT, e CHAR(100))
    BEGIN
        UPDATE Usuario SET Email = e WHERE IdUsuario=id;
    END//
/*Altera a senha do usuário*/
CREATE PROCEDURE Alterar_Senha(id INT, s CHAR(100))
    BEGIN
        UPDATE Usuario SET Senha=s WHERE IdUsuario=id;
    END //
/*Altera a foto de perfil do usuário*/
CREATE PROCEDURE AlterarFt_Usuario(id INT, ft BLOB)
	BEGIN
		UPDATE Usuario SET Foto=ft WHERE IdUsuario = id;
    END//
/*Remove a conta de um usuário e todos os seus dados*/
CREATE PROCEDURE Apagar_Usuario(id INT)
	BEGIN
    DELETE FROM Usuario_Look_Roupa WHERE fk_Usuario=id;
		DELETE FROM Usuario WHERE IdUsuario=id;
	END//
/*--Procedures com a tabela Roupa--*/
/*Cadastra uma nova roupa*/
CREATE PROCEDURE Nova_Roupa(dono INT,tit CHAR(100),cat ENUM("Acessório","Calçado","Roupa"),tip CHAR(100),ft BLOB,cor CHAR(100),d TEXT,tam CHAR(100),marca CHAR(100),mat CHAR(100))
    BEGIN
        INSERT INTO Roupa(Titulo,Categoria,Tipo,Foto,Cor,Descricao,Tamanho,Marca,Material) VALUES (tit,cat,tip,ft,cor,d,tam,marca,mat);
        SELECT MAX(IdRoupa) into @idroupa FROM Roupa;
        INSERT INTO Usuario_Look_Roupa(fk_Usuario,fk_Roupa) VALUES (dono,@idroupa);
    END//
/*Retorna as Roupas para a página de Guarda-Roupa*/
CREATE PROCEDURE Buscar_Roupas(idU INT, e INT)
    BEGIN
		SET @iduser=idU;
		DROP VIEW IF EXISTS Guarda_Roupa;
		CREATE VIEW Guarda_Roupa AS SELECT fk_Roupa FROM Usuario_Look_Roupa AS idroupa WHERE get_idu()=fk_Usuario;
        CASE e /*Modos de Ordenação no Guarda-Roupa*/
			WHEN 1 THEN /*A a Z*/
				SELECT * FROM Roupa WHERE IdRoupa IN (SELECT * FROM Guarda_Roupa) ORDER BY Titulo ASC;
			WHEN 2 THEN /*Z a A*/
				SELECT * FROM Roupa WHERE IdRoupa IN (SELECT * FROM Guarda_Roupa) ORDER BY Titulo DESC;
            WHEN 3 THEN /*Mais novos*/
				SELECT * FROM Roupa WHERE IdRoupa IN (SELECT * FROM Guarda_Roupa) ORDER BY IdRoupa DESC;
            WHEN 4 THEN /*Mais Antigos*/
				SELECT * FROM Roupa WHERE IdRoupa IN (SELECT * FROM Guarda_Roupa) ORDER BY IdRoupa ASC;
        END CASE;
    END//
/*Altera alguns dados do usuário*/
CREATE PROCEDURE Alterar_Roupa(id INT ,tit CHAR(100), cat ENUM("Acessório","Calçado","Roupa"), tip CHAR(100), c CHAR(100), descr TEXT, tam CHAR(100), mar CHAR(100), mat CHAR(100))
	BEGIN
		UPDATE Roupa SET Titulo=tit, Categoria=cat, Tipo=tip, Cor=c, Descricao=descr, Tamanho=tam, Marca=mar, Material=mat WHERE IdRoupa = id;
	END//
/*Alterar a foto da roupa*/
CREATE PROCEDURE AlterarFt_Roupa(id INT,foto BLOB)
	BEGIN
		UPDATE Roupa SET Foto = foto WHERE IdRoupa = id;
    END//
/*Remove uma roupa*/
CREATE PROCEDURE Apagar_Roupa(id INT)
	BEGIN
		DELETE FROM Usuario_Look_Roupa WHERE fk_Roupa=id;
		DELETE FROM Roupa WHERE IdRoupa = id;
	END//
/*--Procedures de Looks e suas Fotos--*/
/*Cria um novo look*/
CREATE PROCEDURE Novo_Look(DONO CHAR(100),n CHAR(100), d CHAR(100),ft BLOB)
	BEGIN
		INSERT INTO Look(Nome,Descricao) VALUES (n,d);
		SELECT MAX(IdLook) into @idlook FROM Look;
		INSERT INTO Usuario_Look_Roupa(fk_Usuario) VALUES (dono,@idlook);
    END//
/*Adiciona uma foto a um look*/
CREATE PROCEDURE Nova_Foto(id INT, ft BLOB)
	BEGIN
		INSERT INTO fotos_look(fk_Look,Fotos_Look) VALUES (ft,id);
    END//
/*Retorna os Looks para a página de Guarda-Roupa*/
CREATE PROCEDURE Buscar_Looks(idU INT,e INT)
    BEGIN
		SET @iduser=idU;
		DROP VIEW IF EXISTS Guarda_Looks;
		CREATE VIEW Guarda_Looks AS SELECT fk_Roupa FROM Usuario_Look_Roupa AS idlook WHERE get_idu()=fk_Usuario;
        SELECT * FROM Look WHERE IdLook IN (SELECT * FROM Guarda_Looks);
		CASE e /*Modos de Ordenação no Guarda-Roupa*/
			WHEN 1 THEN /*A a Z*/
				SELECT * FROM Look WHERE IdLook IN (SELECT * FROM Guarda_Look) ORDER BY Titulo ASC;
			WHEN 2 THEN /*Z a A*/
				SELECT * FROM Look WHERE IdLook IN (SELECT * FROM Guarda_Look) ORDER BY Titulo DESC;
            WHEN 3 THEN /*Mais novos*/
				SELECT * FROM Look WHERE IdLook IN (SELECT * FROM Guarda_Look) ORDER BY IdLook ASC;
            WHEN 4 THEN /*Mais Antigos*/
				SELECT * FROM Look WHERE IdLook IN (SELECT * FROM Guarda_Look) ORDER BY IdLook DESC;
        END CASE;
    END//
/*Remove um Look*/
CREATE PROCEDURE Apagar_Look(id INT)
	BEGIN
		DELETE FROM Usuario_Look_Roupa WHERE fk_Roupa_IdLook=id;
		DELETE FROM Look WHERE IdLook=id;
	END//
DELIMITER ;