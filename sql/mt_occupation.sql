CREATE TABLE mt_occupation(
    o_cd char(5)
    ,o_name varchar(30)
    ,in_cd char(5)
    ,PRIMARY KEY(o_cd)
    ,FOREIGN KEY mt_occupation(in_cd) REFERENCES mt_industry(in_cd)
);

INSERT INTO mt_occupation (
    o_cd
    ,o_name
    ,in_cd
    ) VALUES(
    'oc001'
    ,'プログラマー'
    ,'in001'
);

INSERT INTO mt_occupation (
    o_cd
    ,o_name
    ,in_cd
    ) VALUES(
    'oc002'
    ,'システムエンジニア'
    ,'in001'
);

INSERT INTO mt_occupation (
    o_cd
    ,o_name
    ,in_cd
    ) VALUES(
    'oc003'
    ,'プロジェクトマネージャ'
    ,'in001'
);

INSERT INTO mt_occupation (
    o_cd
    ,o_name
    ,in_cd
    ) VALUES(
    'oc004'
    ,'ゲームプランナー'
    ,'in002'
);

INSERT INTO mt_occupation (
    o_cd
    ,o_name
    ,in_cd
    ) VALUES(
    'oc005'
    ,'ゲームプログラマー'
    ,'in002'
);

INSERT INTO mt_occupation (
    o_cd
    ,o_name
    ,in_cd
    ) VALUES(
    'oc006'
    ,'ゲームクリエイター'
    ,'in002'
);

INSERT INTO mt_occupation (
    o_cd
    ,o_name
    ,in_cd
    ) VALUES(
    'oc007'
    ,'音響'
    ,'in003'
);

INSERT INTO mt_occupation (
    o_cd
    ,o_name
    ,in_cd
    ) VALUES(
    'oc008'
    ,'音楽プロデューサー'
    ,'in003'
);

INSERT INTO mt_occupation (
    o_cd
    ,o_name
    ,in_cd
    ) VALUES(
    'oc009'
    ,'DJ'
    ,'in003'
);



SELECT * FROM mt_occupation;
