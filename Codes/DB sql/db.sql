/*TODA VEZ QUE REIMPORTAR O BANCO, APAGA AS TABELAS ANTIGAS PARA EVITAR CONFLITOS*/
DROP TABLE IF EXISTS Usuario_atual;
DROP TABLE IF EXISTS Usuario;
DROP TABLE IF EXISTS Notificacao_sistema;
DROP TABLE IF EXISTS Tipo_dinheiro;
DROP TABLE IF EXISTS Carteira;
DROP TABLE IF EXISTS Objetivo;
DROP TABLE IF EXISTS Responsavel;
DROP TABLE IF EXISTS Categoria;
DROP TABLE IF EXISTS Sub_categoria;
DROP TABLE IF EXISTS Periodo_pagamento;
DROP TABLE IF EXISTS Agendamento_financeiro;
DROP TABLE IF EXISTS Agendamento_fixo;
DROP TABLE IF EXISTS Agendamento_parcelado;
DROP TABLE IF EXISTS Registro_financeiro;
DROP TABLE IF EXISTS Cart_reg_fin;

/* -------------------------------------------------------------------------- */


/* CRIAÇÃO DE TABELAS */
CREATE TABLE Usuario (
	Id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	Data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	Ativo BOOLEAN DEFAULT TRUE,
	Nome VARCHAR(100) NOT NULL 
);

CREATE TABLE Usuario_atual (
	Id INT PRIMARY KEY NOT NULL,
	Data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	Ativo BOOLEAN DEFAULT TRUE,
	Usuario_id INT NOT NULL,
	CONSTRAINT FK_USUARIO_USUARIO_ATUAL 
        FOREIGN KEY (Usuario_id) REFERENCES Usuario(Id) ON UPDATE CASCADE 
);

CREATE TABLE Notificacao_sistema (
	Id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	Data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	Ativo BOOLEAN DEFAULT TRUE,
	Nome VARCHAR(50) NOT NULL,
	Descricao VARCHAR(200),
	Status TINYINT DEFAULT 0,
	Usuario_id INT NOT NULL,
	CONSTRAINT FK_USUARIO_NOTIFICACAO_SISTEMA 
        FOREIGN KEY (Usuario_id) REFERENCES Usuario(Id) ON UPDATE CASCADE 
);

CREATE TABLE Tipo_dinheiro (
	Id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	Data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	Ativo BOOLEAN DEFAULT TRUE,
	Nome VARCHAR(100) NOT NULL,
	Sigla VARCHAR(10) NOT NULL 
);

CREATE TABLE Carteira (
	Id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	Data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	Ativo BOOLEAN DEFAULT TRUE,
	Nome VARCHAR(100) NOT NULL,
	Descricao VARCHAR(200),
	Usuario_id INT NOT NULL,
	Carteira_mestre_id INT,
	CONSTRAINT FK_USUARIO_CARTEIRA 
        FOREIGN KEY (Usuario_id) REFERENCES Usuario(Id) ON UPDATE CASCADE ,
    CONSTRAINT FK_CARTEIRA_MESTRE_CARTEIRA 
        FOREIGN KEY (Carteira_mestre_id) REFERENCES Carteira(Id) ON UPDATE CASCADE 
);

CREATE TABLE Objetivo (
	Id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	Data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	Ativo BOOLEAN DEFAULT TRUE,
	Tipo TINYINT(1) NOT NULL,
	Valor DOUBLE(12,2) NOT NULL,
	Carteira_id INT NOT NULL,
	Tipo_dinheiro_id INT NOT NULL,
    CONSTRAINT FK_CARTEIRA_OBJETIVO 
        FOREIGN KEY (Carteira_id) REFERENCES Carteira(Id) ON UPDATE CASCADE ,
    CONSTRAINT FK_TIPO_DINHEIRO_OBJETIVO 
        FOREIGN KEY (Tipo_dinheiro_id) REFERENCES Tipo_dinheiro(Id) ON UPDATE CASCADE 
);

CREATE TABLE Responsavel (
	Id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	Data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	Ativo BOOLEAN DEFAULT TRUE,
	Nome VARCHAR(100) NOT NULL,
	Descricao VARCHAR(200)
);

CREATE TABLE Categoria (
	Id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	Data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	Ativo BOOLEAN DEFAULT TRUE,
	Nome VARCHAR(100) NOT NULL
);

CREATE TABLE Sub_categoria (
	Id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	Data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	Ativo BOOLEAN DEFAULT TRUE,
	Nome VARCHAR(100) NOT NULL,
	Categoria_id INT NOT NULL,
	CONSTRAINT FK_CATEGORIA_SUB_CATEGORIA 
        FOREIGN KEY (Categoria_id) REFERENCES Categoria(Id) ON UPDATE CASCADE 
);

CREATE TABLE Periodo_pagamento (
	Id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	Data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	Ativo BOOLEAN DEFAULT TRUE,
	Nome VARCHAR(100) NOT NULL 
);

CREATE TABLE Agendamento_financeiro (
	Id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	Data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	Ativo BOOLEAN DEFAULT TRUE,
	Nome VARCHAR(100) NOT NULL,
	Descricao VARCHAR(200),
	Data_inicio TIMESTAMP NOT NULL,
	Tipo BOOLEAN NOT NULL,
	Valor DOUBLE(12,2) NOT NULL,
	Usuario_id INT NOT NULL,
	Periodo_pagamento_id INT NOT NULL,
	CONSTRAINT FK_USUARIO_AGENDAMENTO_FINANCEIRO 
        FOREIGN KEY (Usuario_id) REFERENCES Usuario(Id) ON UPDATE CASCADE ,
    CONSTRAINT FK_PERIODO_PAGAMENTO_AGENDAMENTO_FINANCEIRO 
        FOREIGN KEY (Periodo_pagamento_id) REFERENCES Periodo_pagamento(Id) ON UPDATE CASCADE 
);

CREATE TABLE Agendamento_fixo (
	Id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	Data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	Ativo BOOLEAN DEFAULT TRUE,
	Agendamento_financeiro_id INT NOT NULL,
	CONSTRAINT FK_AGENDAMENTO_FINANCEIRO_AGENDAMENTO_FIXO 
        FOREIGN KEY (Agendamento_financeiro_id) REFERENCES Agendamento_financeiro(Id) ON UPDATE CASCADE 
);

CREATE TABLE Agendamento_parcelado (
	Id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	Data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	Ativo BOOLEAN DEFAULT TRUE,
	Numero_parcelas INT NOT NULL,
	Agendamento_financeiro_id INT NOT NULL,
	CONSTRAINT FK_AGENDAMENTO_FINANCEIRO_AGENDAMENTO_PARCELADO 
        FOREIGN KEY (Agendamento_financeiro_id) REFERENCES Agendamento_financeiro(Id) ON UPDATE CASCADE 
);

CREATE TABLE Registro_financeiro (
	Id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	Data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	Ativo BOOLEAN DEFAULT TRUE,
	Nome VARCHAR(100) NOT NULL,
	Descricao VARCHAR(200),
	Valor DOUBLE(12,2) NOT NULL,
	Tipo BOOLEAN NOT NULL,
	Data_pagamento TIMESTAMP NOT NULL,
	Doacao BOOLEAN NOT NULL DEFAULT 0,
	Responsavel_id INT NOT NULL DEFAULT 0,
	Sub_categoria_id INT NOT NULL,
	Tipo_dinheiro_id INT NOT NULL,
	Agendamento_financeiro_id INT NOT NULL,
	CONSTRAINT FK_RESPONSAVEL_REGISTRO_FINANCEIRO 
        FOREIGN KEY (Responsavel_id) REFERENCES Responsavel(Id) ON UPDATE CASCADE ,
    CONSTRAINT FK_SUB_CATEGORIA_REGISTRO_FINANCEIRO 
        FOREIGN KEY (Sub_categoria_id) REFERENCES Sub_categoria(Id) ON UPDATE CASCADE ,
    CONSTRAINT FK_TIPO_DINHEIRO_REGISTRO_FINANCEIRO 
        FOREIGN KEY (Tipo_dinheiro_id) REFERENCES Tipo_dinheiro(Id) ON UPDATE CASCADE ,
    CONSTRAINT FK_AGENDAMENTO_FINANCEIRO_REGISTRO_FINANCEIRO 
        FOREIGN KEY (Agendamento_financeiro_id) REFERENCES Agendamento_financeiro(Id) ON UPDATE CASCADE 
);

CREATE TABLE Cart_reg_fin (
	Id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	Data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	Ativo BOOLEAN DEFAULT TRUE,
	Carteira_id INT NOT NULL,
	Divida_id INT NOT NULL,
	Registro_financeiro_id INT NOT NULL,
	CONSTRAINT FK_CARTEIRA_CART_REG_FIN 
        FOREIGN KEY (Carteira_id) REFERENCES Carteira(Id) ON UPDATE CASCADE ,
    CONSTRAINT FK_OBJETIVO_CART_REG_FIN 
        FOREIGN KEY (Divida_id) REFERENCES Objetivo(Id) ON UPDATE CASCADE ,
    CONSTRAINT FK_REGISTRO_FINANCEIRO_CART_REG_FIN 
        FOREIGN KEY (Registro_financeiro_id) REFERENCES Registro_financeiro(Id) ON UPDATE CASCADE 
);


/* -------------------------------------------------------------------------- */


/* Popular o DB */

/*ABAIXO INSERE OS USUÁRIOS DO SISTEMA*/
INSERT INTO usuario (Nome) 
        VALUES('Teste 1');
INSERT INTO usuario (Nome) 
        VALUES('Teste 2');
INSERT INTO usuario (Nome) 
        VALUES('Rodrigo');
INSERT INTO usuario (Nome) 
        VALUES('Teste User Nome Grande Extenso Gigante');
INSERT INTO usuario (Nome) 
        VALUES('Teste 5');
INSERT INTO usuario (Nome) 
        VALUES('Teste 6');
INSERT INTO usuario (Nome) 
        VALUES('Teste 7');

/*ABAIXO INSERE O USUÁRIO ATUAL DO SISTEMA*/
INSERT INTO usuario_atual (Id, Usuario_id) 
        VALUES( 1, 0);

/*ABAIXO INSERE AS CATEGORIAS DO SISTEMA*/
INSERT INTO categoria (Nome) 
        VALUES('Automóvel');
INSERT INTO categoria (Nome) 
        VALUES('Alimentação');
INSERT INTO categoria (Nome) 
        VALUES('Higiene');
INSERT INTO categoria (Nome) 
        VALUES('Lazer');