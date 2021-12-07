CREATE SCHEMA FOLHA;

CREATE TABLE FOLHA.TBCIDADE (
    CIDCODIGO SERIAL NOT NULL,
    CIDNOME VARCHAR(50) NOT NULL,
    CIDESTADO VARCHAR(50) NOT NULL,
    PRIMARY KEY (CIDCODIGO)
);

CREATE TABLE FOLHA.TBCARGO (
    CARCODIGO SERIAL NOT NULL,
    CARDESCRICAO VARCHAR(50) NOT NULL,
    PRIMARY KEY (CARCODIGO)
);

CREATE TABLE FOLHA.TBFUNCIONARIO (
    FUNMATRICULA INTEGER NOT NULL,
    FUNNOME VARCHAR(50) NOT NULL,
    FUNSENHA VARCHAR(32) NOT NULL,
    FUNNASCIMENTO DATE NOT NULL,
    FUNSEXO SMALLINT NOT NULL CHECK(FUNSEXO IN (1, 2)),
    FUNSALARIO DECIMAL(7,2) NOT NULL,
    CIDCODIGO INTEGER NOT NULL,
    CARCODIGO INTEGER NOT NULL,
    PRIMARY KEY (FUNMATRICULA),
    FOREIGN KEY(CIDCODIGO)
    REFERENCES FOLHA.TBCIDADE(CIDCODIGO),
    FOREIGN KEY(CARCODIGO)
    REFERENCES FOLHA.TBCARGO(CARCODIGO)
);


CREATE TABLE FOLHA.TBPAGAMENTO (
    PAGMES SMALLINT NOT NULL CHECK(PAGMES BETWEEN 1 AND 12),
    PAGANO SMALLINT NOT NULL CHECK(PAGANO BETWEEN 1900 AND 2400),
    FUNMATRICULA INTEGER NOT NULL,
    PROVENTOS DECIMAL(7,2) NOT NULL,
    DESCONTOS DECIMAL(7,2) NOT NULL,
    PRIMARY KEY (PAGMES, PAGANO, FUNMATRICULA),
    FOREIGN KEY (FUNMATRICULA)
    REFERENCES FOLHA.TBFUNCIONARIO(FUNMATRICULA)
);

INSERT INTO folha.tbcargo(cardescricao)
     VALUES ('Calceteiro'),
            ('Zelador'),
            ('Telefonista'),
            ('Gerente de Recursos Humanos'),
            ('Professor'),
            ('Recepcionista');

INSERT INTO folha.tbcidade(cidnome, cidestado)
     VALUES ('Rio do Sul', 'Santa Catarina'),
            ('Laurentino', 'Santa Catarina'),
            ('Ituporanga', 'Santa Catarina'),
            ('Lontras', 'Santa Catarina'),
            ('Blumenau', 'Santa Catarina'),
            ('São Paulo', 'São Paulo');

INSERT INTO folha.tbfuncionario(funmatricula, funnome, funsenha, funnascimento,
                                funsexo, funsalario, cidcodigo, carcodigo)
     VALUES (123474, 'João'  , '202cb962ac59075b964b07152d234b70', '1990-03-11', 1, 1234.58, 3, 5),
            (51314 , 'Maria' , '202cb962ac59075b964b07152d234b70', '1987-05-02', 2, 2615.40, 2, 3),
            (402406, 'José'  , '202cb962ac59075b964b07152d234b70', '1994-01-23', 1, 1542.15, 1, 1),
            (48123 , 'Ana'   , '202cb962ac59075b964b07152d234b70', '1993-03-26', 2, 1513.19, 4, 2),
            (56434 , 'Carlos', '202cb962ac59075b964b07152d234b70', '1979-10-30', 1, 3443.91, 5, 4),
            (754684, 'Felipe', '202cb962ac59075b964b07152d234b70', '1981-12-14', 1, 5435.76, 1, 5);						  

INSERT INTO folha.tbpagamento(pagmes, pagano, proventos, descontos, funmatricula)
     VALUES (01, 2021, 450, 300, 123474),
            (02, 2021, 450, 200, 123474),
            (03, 2021, 450, 150, 123474),
            (04, 2021, 350, 300, 123474),
            (05, 2021, 500, 150, 123474),
            (06, 2021, 400, 100, 123474),
            (04, 2021, 350, 300, 754684),
            (05, 2021, 500, 150, 754684),
            (06, 2021, 400, 100, 754684),
            (04, 2021, 350, 300, 402406),
            (05, 2021, 500, 150, 402406),
            (06, 2021, 400, 100, 402406);
