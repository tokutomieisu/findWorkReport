CREATE TABLE mt_student(
    student_id char(9),
    no char(8),
    pass char(9),
    date_of_birth char(8),
    name varchar(30),
    admission char(4),
    graduation char(4),
    PRIMARY KEY(student_id)
);

INSERT INTO
    mt_student (
        student_id,
        no,
        pass,
        date_of_birth,
        name,
        admission,
        graduation
    )
VALUES
    (
        '202112345',
        'ohs12345',
        'B20010506',
        '20010506',
        '大阪　春子',
        '2021',
        '2022'
    );

INSERT INTO
    mt_student (
        student_id,
        no,
        pass,
        date_of_birth,
        name,
        admission,
        graduation
    )
VALUES
    (
        '202023456',
        'ohs23456',
        'B20000101',
        '20000101',
        '島崎　美奈子',
        '2020',
        '2022'
    );

INSERT INTO
    mt_student (
        student_id,
        no,
        pass,
        date_of_birth,
        name,
        admission,
        graduation
    )
VALUES
    (
        '201934567',
        'ohs34567',
        'B19990516',
        '19990516',
        '竹中　義彦',
        '2019',
        NULL
    );