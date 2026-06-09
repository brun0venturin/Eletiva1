CREATE DATABASE IF NOT EXISTS Condominio_BD;
USE Condominio_BD;

CREATE TABLE funcionarios (
    id_funcionario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(11) UNIQUE NOT NULL, 
    email VARCHAR(100) UNIQUE,
    senha VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    cargo ENUM('porteiro', 'síndico', 'conselheiro') NOT NULL,
    data_admissao DATE NOT NULL,
	status ENUM('ativo','inativo') NOT NULL DEFAULT 'ativo'
    );
    INSERT INTO funcionarios (
    nome,
    cpf,
    email,
    senha,
    telefone,
    cargo,
    data_admissao,
    status
) VALUES (
    'Administrador',
    '12345678901',
    'admin@condominio.com',
    '$2y$10$v9NTryRhfM663A/JoFOH2OxYMjX7woIw787iDGMSZpwCCWGxCGq16',
    '18991234567',
    'síndico',
    CURDATE(),
    'ativo'
    );
    
    CREATE TABLE moradores (
    id_morador INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    telefone VARCHAR(20),
    cpf VARCHAR(11) UNIQUE NOT NULL,
    data_nasc DATE NOT NULL,
    apartamento VARCHAR(10) NOT NULL,
    bloco VARCHAR(10) NOT NULL,
    status ENUM('ativo','inativo') NOT NULL DEFAULT 'ativo'
);

CREATE TABLE veiculos (
    id_veiculo INT AUTO_INCREMENT PRIMARY KEY,
    id_morador INT NOT NULL,
    placa VARCHAR(10) NOT NULL UNIQUE,
    modelo VARCHAR(50) NOT NULL,
    marca VARCHAR(50) NOT NULL,
    cor VARCHAR(30) NOT NULL,
    CONSTRAINT fk_morador FOREIGN KEY (id_morador) REFERENCES moradores(id_morador)
);

CREATE TABLE ocorrencias (
    id_ocorrencia INT AUTO_INCREMENT PRIMARY KEY,
    id_morador INT NOT NULL,
    id_funcionario INT NOT NULL,
    titulo VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    data_ocorrencia DATE NOT NULL,
    status VARCHAR(20) NOT NULL,
    CONSTRAINT fk_ocorrencia_morador FOREIGN KEY (id_morador) REFERENCES moradores(id_morador),
    CONSTRAINT fk_ocorrencia_funcionario FOREIGN KEY (id_funcionario) REFERENCES funcionarios(id_funcionario)
);

CREATE TABLE movimentacoes (
    id_movimentacao INT AUTO_INCREMENT PRIMARY KEY,
    id_morador INT NOT NULL,
    id_veiculo INT NOT NULL,
    tipo VARCHAR(20) NOT NULL,
    data_movimentacao DATETIME NOT NULL,
    observacao VARCHAR(255),

    CONSTRAINT fk_movimentacao_morador 
        FOREIGN KEY (id_morador) REFERENCES moradores(id_morador),

    CONSTRAINT fk_movimentacao_veiculo 
        FOREIGN KEY (id_veiculo) REFERENCES veiculos(id_veiculo)
);