/* Modelo_Físico: */
DROP DATABASE IF EXISTS Tiffanny;
CREATE DATABASE Tiffanny DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE Tiffanny;

CREATE TABLE Usuario (
    IdUsuario INT AUTO_INCREMENT PRIMARY KEY,
    Nome CHAR,
    E_mail CHAR UNIQUE NOT NULL,
    Sobrenome CHAR NOT NULL,
    Senha CHAR NOT NULL,
    Data_de_Nascimento DATE NOT NULL,
    Genero CHAR,
    Biografia CHAR,
    Foto_de_Perfil BLOB
)CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE Roupa (
    IdRoupa INT AUTO_INCREMENT PRIMARY KEY,
    Categoria ENUM("Acessório","Calçado","Roupa") NOT NULL,
    Tipo CHAR NOT NULL,
    Foto BLOB NOT NULL,
    Descricao CHAR,
    Cor CHAR,
    fk_Usuario_IdUsuario INT,
    Tamanho CHAR,
    Marca CHAR,
    Material CHAR,
    Titulo CHAR
)CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE Look (
    IdLook INT AUTO_INCREMENT PRIMARY KEY,
    fk_Foto_Foto_PK INT
) CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE Tag (
    Palavra_Chave CHAR NOT NULL,
    IdTag INT AUTO_INCREMENT PRIMARY KEY
)CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE Foto (
    Foto_PK INT NOT NULL PRIMARY KEY,
    Foto BLOB NOT NULL
)CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE Roupa_Look (
    fk_Roupa_IdRoupa INT,
    fk_Look_IdLook INT
)CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE Roupa_Tag (
    fk_Roupa_IdRoupa INT,
    fk_Tag_IdTag INT
)CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE Tag_Look (
    fk_Tag_IdTag INT,
    fk_Look_IdLook INT
)CHARACTER SET utf8 COLLATE utf8_general_ci;
 
ALTER TABLE Roupa ADD CONSTRAINT FK_Roupa_2
    FOREIGN KEY (fk_Usuario_IdUsuario)
    REFERENCES Usuario (IdUsuario)
    ON DELETE CASCADE;
 
ALTER TABLE Look ADD CONSTRAINT FK_Look_2
    FOREIGN KEY (fk_Foto_Foto_PK)
    REFERENCES Foto (Foto_PK)
    ON DELETE NO ACTION;
 
ALTER TABLE Roupa_Look ADD CONSTRAINT FK_Roupa_Look_1
    FOREIGN KEY (fk_Roupa_IdRoupa)
    REFERENCES Roupa (IdRoupa)
    ON DELETE RESTRICT;
 
ALTER TABLE Roupa_Look ADD CONSTRAINT FK_Roupa_Look_2
    FOREIGN KEY (fk_Look_IdLook)
    REFERENCES Look (IdLook)
    ON DELETE SET NULL;
 
ALTER TABLE Roupa_Tag ADD CONSTRAINT FK_Roupa_Tag_1
    FOREIGN KEY (fk_Roupa_IdRoupa)
    REFERENCES Roupa (IdRoupa)
    ON DELETE SET NULL;
 
ALTER TABLE Roupa_Tag ADD CONSTRAINT FK_Roupa_Tag_2
    FOREIGN KEY (fk_Tag_IdTag)
    REFERENCES Tag (IdTag)
    ON DELETE SET NULL;
 
ALTER TABLE Tag_Look ADD CONSTRAINT FK_Tag_Look_1
    FOREIGN KEY (fk_Tag_IdTag)
    REFERENCES Tag (IdTag)
    ON DELETE SET NULL;
 
ALTER TABLE Tag_Look ADD CONSTRAINT FK_Tag_Look_2
    FOREIGN KEY (fk_Look_IdLook)
    REFERENCES Look (IdLook)
    ON DELETE SET NULL;