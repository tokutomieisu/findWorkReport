CREATE TABLE tests (
    test_id int(10) auto_increment,
    classification char(2),
    question varchar(400),
    theme varchar(50),
    timerequired varchar(6),
    wordcount varchar(5),
    contents varchar(400),
    remarks varchar(400),
    j_id int(10),
    PRIMARY KEY(test_id),
    FOREIGN KEY (j_id) REFERENCES findworkreport(j_id)
);

INSERT INTO
    tests (
        classification,
        question,
        theme,
        timerequired,
        wordcount,
        contents,
        remarks,
        j_id
    )
VALUES
    (
        'ES',
        '入社してやりたいこと',
        NULL,
        NULL,
        NULL,
        NULL,
        'やりたいことが無かった',
        4
    );

INSERT INTO
    tests (
        classification,
        question,
        theme,
        timerequired,
        wordcount,
        contents,
        remarks,
        j_id
    )
VALUES
    (
        '作文',
        NULL,
        '学生時代力を入れたこと',
        '40分',
        '600字',
        NULL,
        'タイトルが難しかった',
        5
    );

INSERT INTO
    tests (
        classification,
        question,
        theme,
        timerequired,
        wordcount,
        contents,
        remarks,
        j_id
    )
VALUES
    (
        '筆記',
        NULL,
        NULL,
        NULL,
        NULL,
        '計算・文章読解・YG性格検査',
        '100点を狙えそう',
        6
    );

SELECT
    *
FROM
    tests;