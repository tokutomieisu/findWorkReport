CREATE TABLE mt_activities(
    a_cd char(1)
    ,a_name varchar(30)
    ,PRIMARY KEY(a_cd)
);

INSERT INTO mt_activities (
    a_cd
    ,a_name
    ) VALUES(
    '1'
    ,'説明会'
);

INSERT INTO mt_activities (
    a_cd
    ,a_name
    ) VALUES(
    '2'
    ,'試験'
    );

INSERT INTO mt_activities (
    a_cd
    ,a_name
    ) VALUES(
    '3'
    ,'面接'
);
INSERT INTO mt_activities (
    a_cd
    ,a_name
    ) VALUES(
    '4'
    ,'その他'
);



SELECT * FROM mt_activities;
