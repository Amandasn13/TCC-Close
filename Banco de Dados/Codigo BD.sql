/* NewLogicoClose: */
DROP DATABASE IF EXISTS Tiffanny;
CREATE DATABASE Tiffanny DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE Tiffanny;
CREATE TABLE Usuario (
    IdUsuario INT AUTO_INCREMENT PRIMARY KEY,
    Nome CHAR NOT NULL,
    E_mail CHAR UNIQUE NOT NULL,
    Sobrenome CHAR NOT NULL,
    Nome_de_Usuario CHAR NOT NULL,
    Senha CHAR NOT NULL,
    Data_de_Nascimento DATE NOT NULL,
    Foto_de_Perfil BLOB
);

CREATE TABLE Look (
    IdLook INT AUTO_INCREMENT PRIMARY KEY,
    fk_Fotos_Look_Fotos_Look_PK INT,
    fk_Datas_de_Utilizacao_Look_Datas_de_Utilizacao_Look_PK INT,
    fk_Tags_Look_Tags_Look_PK INT,
    Nome CHAR NOT NULL,
    Vezes_Utilizada DATE NOT NULL,
    Utima_Utilizacao DATE
);

CREATE TABLE Roupa (
    IdRoupa INT AUTO_INCREMENT PRIMARY KEY,
    fk_Tags_Roupa_Tags_Roupa_PK INT,
    fk_Datas_de_Utilizacao_Roupa_Datas_de_Utilizacao_Roupa_PK INT,
    Titulo CHAR,
    Categoria ENUM("Acessório","Calçado","Roupa") NOT NULL,
    Tipo CHAR NOT NULL,
    Foto CHAR NOT NULL,
    Cor CHAR,
    Descricao TEXT,
    Tamanho CHAR,
    Marca CHAR,
    Material CHAR,
    Vezes_Utilizada INT NOT NULL,
    Ultima_Utilizacao DATE
);

CREATE TABLE Fotos_Look (
    Fotos_Look_PK INT AUTO_INCREMENT PRIMARY KEY,
    Fotos_Look BLOB
);

CREATE TABLE Datas_de_Utilizacao_Look (
    Datas_de_Utilizacao_Look_PK INT AUTO_INCREMENT PRIMARY KEY,
    Datas_de_Utilizacao_Look DATE
);

CREATE TABLE Tags_Look (
    Tags_Look_PK INT AUTO_INCREMENT PRIMARY KEY,
    Tags_Look CHAR
);

CREATE TABLE Tags_Roupa (
    Tags_Roupa_PK INT AUTO_INCREMENT PRIMARY KEY,
    Tags_Roupa CHAR
);

CREATE TABLE Datas_de_Utilizacao_Roupa (
    Datas_de_Utilizacao_Roupa_PK INT AUTO_INCREMENT PRIMARY KEY,
    Datas_de_Utilizacao_Roupa DATE
);

CREATE TABLE _Usuario_Look_Roupa (
    fk_Usuario_IdUsuario INT,
    fk_Look_IdLook INT,
    fk_Roupa_IdRoupa INT
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
 
ALTER TABLE Roupa ADD CONSTRAINT FK_Roupa_2
    FOREIGN KEY (fk_Tags_Roupa_Tags_Roupa_PK)
    REFERENCES Tags_Roupa (Tags_Roupa_PK)
    ON DELETE NO ACTION;
 
ALTER TABLE Roupa ADD CONSTRAINT FK_Roupa_3
    FOREIGN KEY (fk_Datas_de_Utilizacao_Roupa_Datas_de_Utilizacao_Roupa_PK)
    REFERENCES Datas_de_Utilizacao_Roupa (Datas_de_Utilizacao_Roupa_PK)
    ON DELETE NO ACTION;
 
ALTER TABLE _Usuario_Look_Roupa ADD CONSTRAINT FK__Usuario_Look_Roupa_1
    FOREIGN KEY (fk_Usuario_IdUsuario)
    REFERENCES Usuario (IdUsuario)
    ON DELETE RESTRICT;
 
ALTER TABLE _Usuario_Look_Roupa ADD CONSTRAINT FK__Usuario_Look_Roupa_2
    FOREIGN KEY (fk_Look_IdLook)
    REFERENCES Look (IdLook)
    ON DELETE NO ACTION;
 
ALTER TABLE _Usuario_Look_Roupa ADD CONSTRAINT FK__Usuario_Look_Roupa_3
    FOREIGN KEY (fk_Roupa_IdRoupa)
    REFERENCES Roupa (IdRoupa)
    ON DELETE NO ACTION;