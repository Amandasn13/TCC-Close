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
    Data_de_Nascimento DATE NOT NULL,
    Foto_de_Perfil BLOB,
    Biografia TEXT
);

CREATE TABLE Look (
    IdLook INT AUTO_INCREMENT PRIMARY KEY,
    fk_Fotos_Look INT,
    fk_Datas_de_Utilizacao_Look INT,
    fk_Tags_Look INT,
    Nome CHAR(100) NOT NULL,
    Descricao TEXT,
    Vezes_Utilizada DATE NOT NULL,
    Ultima_Utilizacao DATE
);

CREATE TABLE Roupa (
    IdRoupa INT AUTO_INCREMENT PRIMARY KEY,
    fk_Tags_Roupa INT,
    fk_Datas_de_Utilizacao_Roupa INT,
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

CREATE TABLE Datas_de_Utilizacao_Look (
    IdDatasLook INT AUTO_INCREMENT PRIMARY KEY,
    CodDatasLook INT,
    Datas_de_Utilizacao_Look DATE
);

CREATE TABLE Tags_Look (
    IdTagsLook INT AUTO_INCREMENT PRIMARY KEY,
    CodTagsLook INT,
    Tags_Look CHAR(100)
);

CREATE TABLE Tags_Roupa (
    IdTagsRoupa INT AUTO_INCREMENT PRIMARY KEY,
    CodTagsRoupa INT,
    Tags_Roupa CHAR(100)
);

CREATE TABLE Datas_de_Utilizacao_Roupa (
    IdDatasRoupa INT AUTO_INCREMENT PRIMARY KEY,
    CodDatasRoupa INT,
    Datas_de_Utilizacao_Roupa DATE
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
 
ALTER TABLE Look ADD CONSTRAINT FK_Look_3
    FOREIGN KEY (fk_Datas_de_Utilizacao_Look)
    REFERENCES Datas_de_Utilizacao_Look (IdDatasLook)
    ON DELETE NO ACTION;
 
ALTER TABLE Look ADD CONSTRAINT FK_Look_4
    FOREIGN KEY (fk_Tags_Look)
    REFERENCES Tags_Look (IdTagsLook)
    ON DELETE NO ACTION;
 
ALTER TABLE Roupa ADD CONSTRAINT FK_Roupa_2
    FOREIGN KEY (fk_Tags_Roupa)
    REFERENCES Tags_Roupa (IdTagsRoupa)
    ON DELETE NO ACTION;
 
ALTER TABLE Roupa ADD CONSTRAINT FK_Roupa_3
    FOREIGN KEY (fk_Datas_de_Utilizacao_Roupa)
    REFERENCES Datas_de_Utilizacao_Roupa (IdDatasRoupa)
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
/*Operações com o Usuario*/
DELIMITER //
CREATE PROCEDURE Cadastrar_Usuario(n CHAR(200), s CHAR(200), nu CHAR(200), dn DATE, e CHAR(200), k CHAR(200))
	BEGIN
		INSERT INTO Usuario (Nome, Sobrenome, Nome_de_Usuario, Data_de_Nascimento, Email, Senha) VALUES (n,s,nu,dn,e,k);
	END//

CREATE PROCEDURE Logar_Usuario(nu CHAR(100), e CHAR(100), k CHAR(100))
	BEGIN
		SELECT IdUsuario FROM Usuario WHERE Nome_de_Usuario = nu OR Email = e  AND Senha = k;
	END//

CREATE PROCEDURE Atualizar_Usuario(id INT,n CHAR(200), s CHAR(200), dn DATE)
	BEGIN
		UPDATE Usuario SET Nome=n, Sobrenome=s, Data_de_Nascimento=dn WHERE IdUsuario=id;
	END//
DELIMITER //
CREATE PROCEDURE Alterar_Senha(id INT, s CHAR(100))
    BEGIN
        UPDATE Usuario SET Senha=s WHERE IdUsuario=id;
    END //

CREATE PROCEDURE Alterar_Email(id INT, e CHAR(100))
    BEGIN
        UPDATE Usuario SET Email = e WHERE IdUsuario=id;
    END //
 CREATE PROCEDURE Alterar_Nome(id INT, n CHAR(100))
	BEGIN
		UPDATE Usuario SET Nome_de_Usuario = n WHERE IdUsuario = id;
	END //
CREATE PROCEDURE BuscarId_UsuarioNu(nu CHAR(100))
    BEGIN
           SELECT IdUsuario FROM Usuario WHERE Nome_de_Usuario = nu;
    END //
    
CREATE PROCEDURE BuscarId_UsuarioE(e CHAR(100))
    BEGIN
          SELECT IdUsuario FROM Usuario WHERE Email = e;
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
    
CREATE PROCEDURE Buscar_Roupas(idU INT)
    BEGIN
		SET @iduser=idU;
		DROP VIEW IF EXISTS Guarda_Roupa;
		CREATE VIEW Guarda_Roupa AS SELECT fk_Roupa FROM Usuario_Look_Roupa AS idroupa WHERE get_idu()=fk_Usuario;
        SELECT * FROM Roupa WHERE IdRoupa IN (SELECT * FROM Guarda_Roupa);
    END //

CREATE PROCEDURE Apagar_Roupa(id INT)
	BEGIN
		DELETE FROM Usuario_Look_Roupa WHERE fk_Roupa=id;
		DELETE FROM Roupa WHERE IdRoupa = id;
	END //
CREATE PROCEDURE Incrementar_Roupa(id INT, dt DATE)
	BEGIN
		 UPDATE Roupa SET Vezes_Utilizada=s WHERE IdRoupa=id;
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