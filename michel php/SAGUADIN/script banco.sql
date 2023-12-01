CREATE DATABASE saguadim;
USE saguadim;

-- CRIACAO DA TABELA DE USUARIOS
CREATE TABLE usuarios(
    usu_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    usu_login VARCHAR(20) NOT NULL,
    usu_senha VARCHAR(50) NOT NULL,
    usu_status CHAR(1) NOT NULL,
    usu_key VARCHAR(10) NOT NULL
);

--CRIACAO DA TABELA DE CLIENTE
CREATE TABLE clientes(
    cli_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    cli_nome VARCHAR(50) NOT NULL,
    cli_email VARCHAR(100) NOT NULL,
    cli_telefone BIGINT NOT NULL,
    cli_cpf VARCHAR(20) NOT NULL,
    cli_curso VARCHAR(50) NOT NULL,
    cli_sala INT NOT NULL,
    cli_status CHAR(1) NOT NULL,
    cli_saldo FLOAT(10,2) NOT NULL
);

-- CRIACAO DA TABELA DE PRODUTOS --
CREATE TABLE produtos(
    pro_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    pro_nome VARCHAR(100) NOT NULL,
    pro_desc VARCHAR(150) NOT NULL,
    pro_preco DECIMAL(10,2) NOT NULL,
    pro_custo  DECIMAL(10,2) NOT NULL,
    pro_quant INT NOT NULL,
    pro_val DATE NOT NULL,
    pro_for VARCHAR(100) NOT NULL,
    fk_for_id INT NOT NULL,
    pro_status CHAR(1)
);

-- CRIACAO DA TABELA DE ENCOMENDAS -- 
CREATE TABLE encomendas(
enc_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
enc_emissao DATETIME NOT NULL,
enc_entrega DATETIME NOT NULL,
fk_pro_id INT NOT NULL,
fk_cli_id INT NOT NULL,
fk_ven_id INT NOT NULL,
enc_status CHAR(1)
);

-- CRIACAO DA TABELA DE VENDAS -- 
CREATE TABLE vendas(
    ven_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ven_data DATETIME NOT NULL,
    fk_cli_id INT NOT NULL,
    ven_total DECIMAl(10,2) NOT NULL,
    fk_id_codigo VARCHAR(50) NOT NULL
);

-- CRIACAO DA TABELA DE ITEM VENDA OLHAR COM CALME E PRECISAO ANALITICA--
CREATE TABLE item_venda(
    iv_id INT NOT NULL AUTO_INCREMENT,
    iv_quant INT NOT NULL,
    iv_total DECIMAL(10,2) NOT NULL,
    iv_codigo VARCHAR(50) NOT NULL PRIMARY KEY,
    fk_pro_id INT NOT NULL
); 

-- CRIACAO DA TABELA DE TELA_LOG -- 
CREATE TABLE tabel_log(
    tab_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    tab_query TEXT NOT NULL,
    tab_data DATETIME NOT NULL
);

-- CRIACAO DA TABELA DE FORNECEDOR --
CREATE TABLE fornecedor(
    for_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    for_nome VARCHAR(50)
); 

-- CHAVES ESTRANGEIRAS --
-- CHAVE PRODUTOS --
ALTER TABLE produtos ADD CONSTRAINT fk_for_id_pro FOREIGN KEY (fk_for_id) REFERENCES fornecedor(for_id);
 
-- CHAVE ENCOMENDAS --
ALTER TABLE encomendas ADD CONSTRAINT fk_pro_id_enc FOREIGN KEY (fk_pro_id) REFERENCES produtos(pro_id);
ALTER TABLE encomendas ADD CONSTRAINT fk_cli_id_enc FOREIGN KEY (fk_cli_id) REFERENCES clientes(cli_id);
ALTER TABLE encomendas ADD CONSTRAINT fk_ven_id_ven FOREIGN KEY (fk_ven_id) REFERENCES vendas(ven_id);
 
-- CHAVE VENDAS --
ALTER TABLE vendas ADD CONSTRAINT fk_cli_id_ven FOREIGN KEY (fk_cli_id) REFERENCES clientes(cli_id);


-- CHAVES ITEM VENDA -- 
ALTER TABLE item_venda ADD CONSTRAINT fk_pro_id_iv FOREIGN KEY (fk_pro_id) REFERENCES produtos(pro_id);

