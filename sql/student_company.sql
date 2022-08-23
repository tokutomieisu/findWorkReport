/*お気に入り企業*/
CREATE TABLE student_company(
    s_id char(9),
    c_id char(7),
    PRIMARY KEY(s_id, c_id),
    FOREIGN KEY (s_id) REFERENCES mt_student(student_id),
    FOREIGN KEY (c_id) REFERENCES mt_company(c_id)
);

INSERT INTO
    student_company (s_id, c_id)
VALUES
    ("202112345", "co00004");

INSERT INTO
    student_company (s_id, c_id)
VALUES
    ("202112345", "co00001");

INSERT INTO
    student_company (s_id, c_id)
VALUES
    ("202112345", "co00002");

SELECT
    *
FROM
    student_company;

SELECT c.c_name
FROM mt_student s
INNER JOIN student_company sc ON s.student_id = sc.s_id
INNER JOIN mt_company c ON c.c_id = sc.c_id
WHERE s.student_id = "202112345";