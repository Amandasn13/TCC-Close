/* LogicoClose: */
DROP DATABASE IF EXISTS Tiffanny;
CREATE DATABASE Tiffanny DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE Tiffanny;

CREATE TABLE Usuario (
    IdUsuario INT AUTO_INCREMENT PRIMARY KEY,
    Nome CHAR(100) NOT NULL,
    Email CHAR(100) UNIQUE NOT NULL,
    Sobrenome CHAR(100) NOT NULL,
    Nome_de_Usuario CHAR(100) NOT NULL,
    Senha CHAR(100) NOT NULL,
    Nascimento DATE NOT NULL,
    Foto BLOB,
    Biografia TEXT
);

CREATE TABLE Look (
    IdLook INT AUTO_INCREMENT PRIMARY KEY,
    fk_Fotos_Look INT,
    Nome CHAR(100) NOT NULL,
    Descricao TEXT,
    Vezes_Utilizada DATE NOT NULL,
    Ultima_Utilizacao DATE
);

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
    Material CHAR(100),
    Vezes_Utilizada INT NOT NULL,
    Ultima_Utilizacao DATE
);

CREATE TABLE Fotos_Look (
    IdFotosLook INT AUTO_INCREMENT PRIMARY KEY,
    CodFotosLook INT,
    Fotos_Look BLOB
);

CREATE TABLE Usuario_Look_Roupa (
    fk_Usuario INT,
    fk_Look INT,
    fk_Roupa INT
);
/*Tabela para recuperação de senha*/
CREATE TABLE Recuperacao_de_Senha (
  Id int(20) NOT NULL,
  Email varchar(200) NOT NULL,
  Rash varchar(200) NOT NULL,
  Estado int(20) NOT NULL DEFAULT '0'
);

ALTER TABLE Recuperacao_de_Senha
  ADD PRIMARY KEY (Id);
  ALTER TABLE Recuperacao_de_Senha
  MODIFY Id int(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE Look ADD CONSTRAINT FK_Look_2
    FOREIGN KEY (fk_Fotos_Look)
    REFERENCES Fotos_Look (IdFotosLook)
    ON DELETE NO ACTION;
 
ALTER TABLE Usuario_Look_Roupa ADD CONSTRAINT FK_Usuario_Look_Roupa_1
    FOREIGN KEY (fk_Usuario)
    REFERENCES Usuario (IdUsuario)
    ON DELETE RESTRICT;
 
ALTER TABLE Usuario_Look_Roupa ADD CONSTRAINT FK__Usuario_Look_Roupa_2
    FOREIGN KEY (fk_Look)
    REFERENCES Look (IdLook)
    ON DELETE NO ACTION;
 
ALTER TABLE Usuario_Look_Roupa ADD CONSTRAINT FK_Usuario_Look_Roupa_3
    FOREIGN KEY (fk_Roupa)
    REFERENCES Roupa (IdRoupa)
    ON DELETE NO ACTION;
/*Funções*/
CREATE FUNCTION get_idu() RETURNS INTEGER RETURN @iduser;
CREATE FUNCTION get_idr() RETURNS INTEGER RETURN @idroup;
DELIMITER //
/*Operações com Recuperar Senha*/
CREATE PROCEDURE Nova_Recuperacao(e VARCHAR(200), r VARCHAR(200))
	BEGIN
		INSERT INTO Recuperacao_de_Senha(email,rash) VALUES(e,r);
    END //
    
CREATE PROCEDURE BuscarE_RecuperacaoR(r VARCHAR(200))
	BEGIN
    SELECT email FROM Recuperacao_de_Senha WHERE rash = r;
    END //

CREATE PROCEDURE Buscar_RecuperacaoE(e VARCHAR(200))
	BEGIN
		SELECT * FROM Recuperacao_de_Senha WHERE email = e;
    END //
    
CREATE PROCEDURE Apagar_Recuperacao(r VARCHAR(200))
	BEGIN
		DELETE FROM Recuperacao_de_Senha WHERE Rash = r;
		DELETE FROM Usuario WHERE IdUsuario=id;
	END //
    
/*Operações com o Usuario*/
CREATE PROCEDURE Cadastrar_Usuario(n CHAR(200), s CHAR(200), nu CHAR(200), dn DATE, e CHAR(200), k CHAR(200))
	BEGIN
		INSERT INTO Usuario (Nome, Sobrenome, Nome_de_Usuario, Nascimento, Email, Senha) VALUES (n,s,nu,dn,e,k);
	END//

CREATE PROCEDURE Logar_Usuario(nu CHAR(100), e CHAR(100), k CHAR(100))
	BEGIN
		SELECT IdUsuario FROM Usuario WHERE Nome_de_Usuario = nu OR Email = e  AND Senha = k;
	END//

CREATE PROCEDURE Alterar_Usuario(id INT,n CHAR(200), s CHAR(200), dn DATE)
	BEGIN
		UPDATE Usuario SET Nome=n, Sobrenome=s, Nascimento=dn WHERE IdUsuario=id;
	END//

CREATE PROCEDURE Alterar_Senha(id INT, s CHAR(100))
    BEGIN
        UPDATE Usuario SET Senha=s WHERE IdUsuario=id;
    END //

CREATE PROCEDURE Alterar_Email(id INT, e CHAR(100))
    BEGIN
        UPDATE Usuario SET Email = e WHERE IdUsuario=id;
    END //
CREATE PROCEDURE BuscarId_UsuarioNu(nu CHAR(100))
    BEGIN
           SELECT IdUsuario FROM Usuario WHERE Nome_de_Usuario = nu;
    END //
CREATE PROCEDURE AlterarFt_Usuario(id INT, ft BLOB)
	BEGIN
		UPDATE Usuario SET Foto=ft WHERE IdUsuario = id;
    END//
CREATE PROCEDURE BuscarId_UsuarioE(e CHAR(100))
    BEGIN
          SELECT IdUsuario FROM Usuario WHERE Email = e;
    END //
    
CREATE PROCEDURE Buscar_UsuarioE(e CHAR(100))
	BEGIN
		SELECT * FROM Usuario WHERE Email = e;
    END //
    
CREATE PROCEDURE Buscar_Usuario(id INT)
    BEGIN
          SELECT * FROM Usuario WHERE IdUsuario = id;
    END //
    
CREATE PROCEDURE Apagar_Usuario(id INT)
	BEGIN
		DELETE FROM Usuario WHERE IdUsuario=id;
	END//

/*Operações com a Roupa*/
CREATE PROCEDURE Nova_Roupa(dono INT,tit CHAR(100),cat ENUM("Acessório","Calçado","Roupa"),tip CHAR(100),ft BLOB,cor CHAR(100),d TEXT,tam CHAR(100),marca CHAR(100),mat CHAR(100))
    BEGIN
        INSERT INTO Roupa(Titulo,Categoria,Tipo,Foto,Cor,Descricao,Tamanho,Marca,Material) VALUES (tit,cat,tip,ft,cor,d,tam,marca,mat);
        SELECT MAX(IdRoupa) into @idroupa FROM Roupa;
        INSERT INTO Usuario_Look_Roupa(fk_Usuario,fk_Roupa) VALUES (dono,@idroupa);
    END //
    
CREATE PROCEDURE AlterarFt_Roupa(id INT,foto BLOB)
	BEGIN
		UPDATE Roupa SET Foto = foto WHERE IdRoupa = id;
    END //
    
CREATE PROCEDURE Alterar_Roupa(id INT ,tit CHAR(100), cat ENUM("Acessório","Calçado","Roupa"), tip CHAR(100), c CHAR(100), descr TEXT, tam CHAR(100), mar CHAR(100), mat CHAR(100))
	BEGIN
		UPDATE Roupa SET Titulo=tit, Categoria=cat, Tipo=tip, Cor=c, Descricao=descr, Tamanho=tam, Marca=mar, Material=mat WHERE IdRoupa = id;
	END //
    
CREATE PROCEDURE Buscar_Roupas(idU INT)
    BEGIN
		SET @iduser=idU;
		DROP VIEW IF EXISTS Guarda_Roupa;
		CREATE VIEW Guarda_Roupa AS SELECT fk_Roupa FROM Usuario_Look_Roupa AS idroupa WHERE get_idu()=fk_Usuario;
        SELECT * FROM Roupa WHERE IdRoupa IN (SELECT * FROM Guarda_Roupa);
    END //

CREATE PROCEDURE Incrementar_Roupa(id INT, dt DATE)
	BEGIN
		 UPDATE Roupa SET Vezes_Utilizada=s WHERE IdRoupa=id;
    END //

CREATE PROCEDURE Apagar_Roupa(id INT)
	BEGIN
		DELETE FROM Usuario_Look_Roupa WHERE fk_Roupa=id;
		DELETE FROM Roupa WHERE IdRoupa = id;
	END //
/*Operações com looks*/
CREATE PROCEDURE Novo_Look(DONO CHAR(100),n CHAR(100), d CHAR(100),ft BLOB)
	BEGIN
		INSERT INTO Look(Nome,Descricao) VALUES (n,d);
		SELECT MAX(IdLook) into @idlook FROM Look;
		INSERT INTO Usuario_Look_Roupa(fk_Usuario) VALUES (dono,@idlook);
    END //
CREATE PROCEDURE Nova_Foto(id INT, ft BLOB)
	BEGIN
		INSERT INTO fotos_look(Fotos_Look) VALUES (ft);
    END //
CREATE PROCEDURE Buscar_Looks(idU INT)
    BEGIN
		SET @iduser=idU;
		DROP VIEW IF EXISTS Guarda_Looks;
		CREATE VIEW Guarda_Looks AS SELECT fk_Roupa FROM Usuario_Look_Roupa AS idlook WHERE get_idu()=fk_Usuario;
        SELECT * FROM Look WHERE IdLook IN (SELECT * FROM Guarda_Looks);
    END //
CREATE PROCEDURE Apagar_Look(id INT)
	BEGIN
		DELETE FROM Usuario_Look_Roupa WHERE fk_Roupa_IdLook=id;
		DELETE FROM Look WHERE IdLook=id;
	END //
DELIMITER ;