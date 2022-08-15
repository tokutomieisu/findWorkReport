CREATE TABLE mt_industry(
    in_cd char(5)
    ,in_name varchar(30)
    ,PRIMARY KEY(in_cd)
);

INSERT INTO mt_industry (
    in_cd
    ,in_name
    ) VALUES(
    'in001'
    ,'IT'
);

INSERT INTO mt_industry (
    in_cd
    ,in_name
    ) VALUES(
    'in002'
    ,'ゲーム'
);

INSERT INTO mt_industry (
    in_cd
    ,in_name
    ) VALUES(
    'in003'
    ,'ミュージック'
);


SELECT * FROM mt_industry;
