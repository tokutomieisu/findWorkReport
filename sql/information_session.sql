CREATE TABLE information_session (
    info_id int(10) auto_increment,
    classification char(2),
    place varchar(20),
    i_num varchar(4),
    remarks varchar(400),
    j_id int(10),
    PRIMARY KEY(info_id),
    FOREIGN KEY (j_id) REFERENCES findworkreport(j_id)
);

INSERT INTO
    information_session (
        classification,
        place,
        i_num,
        remarks,
        j_id
    )
VALUES
    (
        '学内',
        '2F大会議室',
        NULL,
        '説明会終了後にアンケートの記入があります。',
        1
    );

INSERT INTO
    information_session (
        classification,
        place,
        i_num,
        remarks,
        j_id
    )
VALUES
    (
        '合同',
        '東京ドーム',
        NULL,
        '説明会に来ていた他校の学生と付き合うことになりました。',
        2
    );

INSERT INTO
    information_session (
        classification,
        place,
        i_num,
        remarks,
        j_id
    )
VALUES
    (
        '学外',
        NULL,
        '50',
        '司会の人がイケメンでした。',
        3
    );

INSERT INTO
    information_session (
        classification,
        place,
        i_num,
        remarks,
        j_id
    )
VALUES
    (
        '学内',
        '2F大会議室',
        NULL,
        '司会の人がイケメンでした。',
        13
    );

INSERT INTO
    information_session (
        classification,
        place,
        i_num,
        remarks,
        j_id
    )
VALUES
    (
        '合同',
        '東京ドーム',
        NULL,
        '説明会終了後にアンケートの記入があります。',
        14
    );

INSERT INTO
    information_session (
        classification,
        place,
        i_num,
        remarks,
        j_id
    )
VALUES
    (
        '学外',
        NULL,
        '50',
        '説明会に来ていた他校の学生と付き合うことになりました。',
        15
    );

INSERT INTO
    information_session (
        classification,
        place,
        i_num,
        remarks,
        j_id
    )
VALUES
    (
        '合同',
        '東京ドーム',
        NULL,
        '説明会終了後にアンケートの記入があります。',
        14
    );

INSERT INTO
    information_session (
        classification,
        place,
        i_num,
        remarks,
        j_id
    )
VALUES
    (
        '学外',
        NULL,
        '50',
        '説明会に来ていた他校の学生と付き合うことになりました。',
        15
    );

INSERT INTO
    information_session (
        classification,
        place,
        i_num,
        remarks,
        j_id
    )
VALUES
    (
        '合同',
        '東京ドーム',
        NULL,
        '説明会終了後にアンケートの記入があります。',
        25
    );

INSERT INTO
    information_session (
        classification,
        place,
        i_num,
        remarks,
        j_id
    )
VALUES
    (
        '学外',
        NULL,
        '50',
        '説明会に来ていた他校の学生と付き合うことになりました。',
        26
    );

INSERT INTO
    information_session (
        classification,
        place,
        i_num,
        remarks,
        j_id
    )
VALUES
    (
        '合同',
        '東京ドーム',
        NULL,
        '説明会終了後にアンケートの記入があります。',
        27
    );

INSERT INTO
    information_session (
        classification,
        place,
        i_num,
        remarks,
        j_id
    )
VALUES
    (
        '学外',
        NULL,
        '50',
        '説明会に来ていた他校の学生と付き合うことになりました。',
        28
    );

INSERT INTO
    information_session (
        classification,
        place,
        i_num,
        remarks,
        j_id
    )
VALUES
    (
        '合同',
        '東京ドーム',
        NULL,
        '説明会終了後にアンケートの記入があります。',
        29
    );

INSERT INTO
    information_session (
        classification,
        place,
        i_num,
        remarks,
        j_id
    )
VALUES
    (
        '学外',
        NULL,
        '50',
        '説明会に来ていた他校の学生と付き合うことになりました。',
        30
    );

INSERT INTO
    information_session (
        classification,
        place,
        i_num,
        remarks,
        j_id
    )
VALUES
    (
        '合同',
        '東京ドーム',
        NULL,
        '説明会終了後にアンケートの記入があります。',
        31
    );

INSERT INTO
    information_session (
        classification,
        place,
        i_num,
        remarks,
        j_id
    )
VALUES
    (
        '学外',
        NULL,
        '50',
        '説明会に来ていた他校の学生と付き合うことになりました。',
        32
    );

INSERT INTO
    information_session (
        classification,
        place,
        i_num,
        remarks,
        j_id
    )
VALUES
    (
        '合同',
        '東京ドーム',
        NULL,
        '説明会終了後にアンケートの記入があります。',
        33
    );

INSERT INTO
    information_session (
        classification,
        place,
        i_num,
        remarks,
        j_id
    )
VALUES
    (
        '学外',
        NULL,
        '50',
        '説明会に来ていた他校の学生と付き合うことになりました。',
        34
    );

INSERT INTO
    information_session (
        classification,
        place,
        i_num,
        remarks,
        j_id
    )
VALUES
    (
        '合同',
        '東京ドーム',
        NULL,
        '説明会終了後にアンケートの記入があります。',
        35
    );

INSERT INTO
    information_session (
        classification,
        place,
        i_num,
        remarks,
        j_id
    )
VALUES
    (
        '学外',
        NULL,
        '50',
        '説明会に来ていた他校の学生と付き合うことになりました。',
        36
    );

SELECT
    *
FROM
    information_session;