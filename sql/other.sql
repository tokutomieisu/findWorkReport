CREATE TABLE other (
    other_id int(10) auto_increment,
    classification varchar(15),
    o_num varchar(2),
    contents varchar(400),
    remarks varchar(400),
    j_id int(10),
    PRIMARY KEY(other_id),
    FOREIGN KEY (j_id) REFERENCES findworkreport(j_id)
);

INSERT INTO
    other (
        classification,
        o_num,
        contents,
        remarks,
        j_id
    )
VALUES
(
        'グループワーク',
        '6',
        'みんなで役割を決めて頑張りました。とてもたのしかったです',
        '社風がよかった',
        10
    );

INSERT INTO
    other (
        classification,
        o_num,
        contents,
        remarks,
        j_id
    )
VALUES
(
        'グループディスカッション',
        '5',
        'きのこの山派かたけのこの里派か。私はたけのこ派で参戦し、最終的にきのこ派を武力で制圧しました。',
        'やっぱり対面がいいな',
        11
    );

INSERT INTO
    other (
        classification,
        o_num,
        contents,
        remarks,
        j_id
    )
VALUES
(
        'その他',
        NULL,
        'Google本社で勤務しているHALの先輩に会いに行きました。Google本社の社員全員がロリコンでした。',
        'ロリコン多いのでお勧めです',
        12
    );

SELECT
    *
FROM
    other;