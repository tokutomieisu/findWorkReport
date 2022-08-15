CREATE TABLE mt_flow(
    id INT AUTO_INCREMENT
    ,name varchar(30)
    ,PRIMARY KEY(id)
);

INSERT INTO mt_flow (
    name
    ) VALUES(
    '説明会'
);

INSERT INTO mt_flow (
    name
    ) VALUES(
    '適性検査'
);

INSERT INTO mt_flow (
    name
    ) VALUES(
    '1次面接'
);

INSERT INTO mt_flow (
    name
    ) VALUES(
    '2次面接'
);

INSERT INTO mt_flow (
    name
    ) VALUES(
    '3次面接'
);

INSERT INTO mt_flow (
    name
    ) VALUES(
    '4次面接'
);

INSERT INTO mt_flow (
    name
    ) VALUES(
    '最終面接'
);

SELECT * FROM mt_flow;
