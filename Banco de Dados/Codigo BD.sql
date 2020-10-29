/* NewLogicoClose: */
DROP DATABASE IF EXISTS Tiffanny;
CREATE DATABASE Tiffanny DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE Tiffanny;
CREATE TABLE Usuario (
    Senha CHAR(100),
    E_mail CHAR(100),
    Data_de_Nascimento DATE,
    IdUsuario INT PRIMARY KEY,
    Sobrenome CHAR(100),
    Foto_de_Perfil BLOB,
    Biografia TEXT,
    Nome CHAR(100),
    Nome_de_Usuario CHAR(100)
);

CREATE TABLE Look (
    Utima_Utilizacao DATE,
    Vezes_Utilizada DATE,
    fk_Fotos_Look_Fotos_Look_PK INT,
    fk_Datas_de_Utilizacao_Look_Datas_de_Utilizacao_Look_PK INT,
    Nome CHAR(100),
    fk_Tags_Look_Tags_Look_PK INT,
    IdLook INT PRIMARY KEY,
    fk_Usuario_IdUsuario INT
);

CREATE TABLE Roupa (
    Marca CHAR(100),
    Vezes_Utilizada INT,
    fk_Tags_Roupa_Tags_Roupa_PK INT,
    IdRoupa INT PRIMARY KEY,
    Tamanho CHAR(100),
    Material CHAR(100),
    Ultima_Utilizacao DATE,
    Tipo CHAR(100),
    Foto CHAR(100),
    Categoria ENUM("Acessório","Calçado","Roupa"),
    fk_Datas_de_Utilizacao_Roupa_Datas_de_Utilizacao_Roupa_PK INT,
    Descricao TEXT,
    Titulo CHAR(100),
    Cor CHAR(100),
    fk_Usuario_IdUsuario INT
);

CREATE TABLE Fotos_Look (
    Fotos_Look_PK INT NOT NULL PRIMARY KEY,
    Fotos_Look BLOB
);

CREATE TABLE Datas_de_Utilizacao_Look (
    Datas_de_Utilizacao_Look_PK INT NOT NULL PRIMARY KEY,
    Datas_de_Utilizacao_Look DATE
);

CREATE TABLE Tags_Look (
    Tags_Look_PK INT NOT NULL PRIMARY KEY,
    Tags_Look CHAR(100)
);

CREATE TABLE Tags_Roupa (
    Tags_Roupa_PK INT NOT NULL PRIMARY KEY,
    Tags_Roupa CHAR(100)
);

CREATE TABLE Datas_de_Utilizacao_Roupa (
    Datas_de_Utilizacao_Roupa_PK INT NOT NULL PRIMARY KEY,
    Datas_de_Utilizacao_Roupa DATE
);
 
ALTER TABLE Look ADD CONSTRAINT FK_Look_2
    FOREIGN KEY (fk_Fotos_Look_Fotos_Look_PK)
    REFERENCES Fotos_Look (Fotos_Look_PK)
    ON DELETE NO ACTION;
 
ALTER TABLE Look ADD CONSTRAINT FK_Look_3
    FOREIGN KEY (fk_Datas_de_Utilizacao_Look_Datas_de_Utilizacao_Look_PK)
    REFERENCES Datas_de_Utilizacao_Look (Datas_de_Utilizacao_Look_PK)
    ON DELETE NO ACTION;
 
ALTER TABLE Look ADD CONSTRAINT FK_Look_4
    FOREIGN KEY (fk_Tags_Look_Tags_Look_PK)
    REFERENCES Tags_Look (Tags_Look_PK)
    ON DELETE NO ACTION;
 
ALTER TABLE Look ADD CONSTRAINT FK_Look_5
    FOREIGN KEY (fk_Usuario_IdUsuario)
    REFERENCES Usuario (IdUsuario)
    ON DELETE CASCADE;
 
ALTER TABLE Roupa ADD CONSTRAINT FK_Roupa_2
    FOREIGN KEY (fk_Tags_Roupa_Tags_Roupa_PK)
    REFERENCES Tags_Roupa (Tags_Roupa_PK)
    ON DELETE NO ACTION;
 
ALTER TABLE Roupa ADD CONSTRAINT FK_Roupa_3
    FOREIGN KEY (fk_Datas_de_Utilizacao_Roupa_Datas_de_Utilizacao_Roupa_PK)
    REFERENCES Datas_de_Utilizacao_Roupa (Datas_de_Utilizacao_Roupa_PK)
    ON DELETE NO ACTION;
 
ALTER TABLE Roupa ADD CONSTRAINT FK_Roupa_4
    FOREIGN KEY (fk_Usuario_IdUsuario)
    REFERENCES Usuario (IdUsuario)
    ON DELETE CASCADE;
    
/*PROCEDIMENTOS*/    
DELIMITER //
/*Operações com o Usuario*/

CREATE PROCEDURE Cadastrar_Usuario(n CHAR(100), s CHAR(100), nu CHAR(100), dn DATE, e CHAR(100), k CHAR(100))
	BEGIN
		INSERT INTO Usuario (Nome, Sobrenome, Nome_de_Usuario, Data_de_Nascimento, E_mail, Senha) VALUES (n,s,nu,dn,e,k);
	END//

CREATE PROCEDURE Logar_Usuario(nu CHAR(100), e CHAR(100), k CHAR(100))
	BEGIN
		SELECT IdUsuario FROM Usuario WHERE Nome_de_Usuario = nu OR E_mail = e  AND Senha = k;
	END//

CREATE PROCEDURE Atualizar_Usuario(id INT,n CHAR(100), s CHAR(100), nu CHAR(100), dn DATE, e CHAR(100))
	BEGIN
		UPDATE Usuario SET Nome=n, Sobrenome=s,Nome_de_Usuario=nu, Data_de_Nascimento=dn, E_mail=e WHERE IdUsuario=id;
	END//

CREATE PROCEDURE Alterar_Senha(id INT, s CHAR(100))
    BEGIN
        UPDATE Usuario SET Senha=s WHERE IdUsuario=id;
    END //

CREATE PROCEDURE Alterar_Email(id INT, e CHAR(100))
    BEGIN
        UPDATE Usuario SET E_mail = e;
    END //
CREATE PROCEDURE BuscarId_UsuarioNu(nu CHAR(100))
    BEGIN
        SELECT IdUsuario FROM Usuario WHERE Nome_de_Usuario = nu;
    END //

CREATE PROCEDURE BuscarId_UsuarioE(e CHAR(100))
    BEGIN
        SELECT IdUsuario FROM Usuario WHERE E_mail = e;
    END //

CREATE PROCEDURE Apagar_Usuario(id INT)
	BEGIN
		DELETE FROM Usuario WHERE IdUsuario=id;
	END//

/*Operações com a Roupa*/

CREATE PROCEDURE Nova_Roupa(dono INT,tit CHAR(100),cat ENUM("Acessório","Calçado","Roupa"),tip CHAR(100),ft BLOB,cor CHAR(100),d TEXT,tam CHAR(100),marca CHAR(100),mat CHAR(100))
    BEGIN
		INSERT INTO Roupa(Titulo,Categoria,Tipo,Foto,Cor,Descricao,Tamanho,Marca,Material,fk_Usuario_IdUsuario) VALUES (tit,cat,tip,ft,cor,d,tam,marca,mat,dono);
    END //

CREATE PROCEDURE Buscar_Roupas(idU INT)
    BEGIN
    SELECT * FROM Roupa;
    SELECT * FROM Roupa WHERE fk_Usuario_IdUsuario = 1;
    END //
    DELIMITER ;