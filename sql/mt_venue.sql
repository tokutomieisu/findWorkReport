CREATE TABLE mt_venue(
    v_cd char(1)
    ,v_name varchar(30)
    ,PRIMARY KEY(v_cd)
);

INSERT INTO mt_venue (
    v_cd
    ,v_name
    ) VALUES(
    '1'
    ,'対面'
);

INSERT INTO mt_venue (
    v_cd
    ,v_name
    ) VALUES(
    '2'
    ,'オンライン'
);




SELECT * FROM mt_venue;
