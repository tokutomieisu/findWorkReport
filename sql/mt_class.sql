CREATE TABLE mt_class(
    class_id char(8)
    ,course varchar(30)
    ,season char(1)
    ,curriculum char(3)
    ,t_id char(6)
    ,year char(4)
    ,PRIMARY KEY(class_id)
    ,FOREIGN KEY mt_class(t_id) REFERENCES mt_teacher(t_id)
);

INSERT INTO mt_class (
    class_id
    ,course
    ,season
    ,curriculum
    ,t_id
    ,year
    ) VALUES(
    'PI12A229'
    ,'情報処理学科'
    ,'春'
    ,'2年制'
    ,'198701'
    ,'2022'
);

INSERT INTO mt_class (
    class_id
    ,course
    ,season
    ,curriculum
    ,t_id
    ,year
    ) VALUES(
    'AT14B401'
    ,'ゲーム制作学科'
    ,'春'
    ,'4年制'
    ,'201501'
    ,'2022'
);

INSERT INTO mt_class (
    class_id
    ,course
    ,season
    ,curriculum
    ,t_id
    ,year
    ) VALUES(
    'MC51A102'
    ,'ミュージック学科'
    ,'秋'
    ,'2年制'
    ,'202002'
    ,'2022'
);