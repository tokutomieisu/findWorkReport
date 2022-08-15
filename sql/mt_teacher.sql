CREATE TABLE mt_teacher(
    t_id char(6)
    ,t_cd char(2)
    ,t_name varchar(30)
    ,PRIMARY KEY(t_id)
);

INSERT INTO mt_teacher (
    t_id
    ,t_cd
    ,t_name
    ) VALUES(
    '198701'
    ,'29'
    ,'永峰　弘万'
);

INSERT INTO mt_teacher (
    t_id
    ,t_cd
    ,t_name
    ) VALUES(
    '201501'
    ,'01'
    ,'田中　信也'
);

INSERT INTO mt_teacher (
    t_id
    ,t_cd
    ,t_name
    ) VALUES(
    '202002'
    ,'02'
    ,'木下　和也'
);