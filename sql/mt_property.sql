CREATE TABLE mt_property(
    id INT AUTO_INCREMENT
    ,name varchar(30)
    ,PRIMARY KEY(id)
);

INSERT INTO mt_property (
    name
    ) VALUES(
    '筆記用具'
);

INSERT INTO mt_property (
    name
    ) VALUES(
    '履歴書'
);

INSERT INTO mt_property (
    name
    ) VALUES(
    '健康診断書'
);

INSERT INTO mt_property (
    name
    ) VALUES(
    '成績卒見'
);

INSERT INTO mt_property (
    name
    ) VALUES(
    'エントリーシート'
);

INSERT INTO mt_property (
    name
    ) VALUES(
    '印鑑'
);

INSERT INTO mt_property (
    name
    ) VALUES(
    '作品'
);

INSERT INTO mt_property (
    name
    ) VALUES(
    'その他'
);


SELECT name FROM mt_property;