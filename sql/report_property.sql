CREATE TABLE report_property(
    j_id INT,
    p_id INT,
    PRIMARY KEY(j_id, p_id),
    FOREIGN KEY (j_id) REFERENCES findworkreport(j_id),
    FOREIGN KEY (p_id) REFERENCES mt_property(id)
);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (1, 1);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (1, 2);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (2, 1);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (3, 1);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (3, 3);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (3, 4);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (4, 1);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (5, 3);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (6, 1);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (7, 1);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (8, 3);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (9, 4);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (10, 1);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (11, 1);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (12, 1);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (13, 1);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (14, 1);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (15, 3);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (16, 1);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (17, 1);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (18, 3);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (19, 4);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (20, 1);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (21, 1);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (22, 1);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (23, 1);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (24, 1);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (25, 3);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (26, 1);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (27, 1);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (28, 3);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (29, 4);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (30, 1);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (31, 1);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (32, 1);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (33, 1);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (34, 1);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (35, 3);

INSERT INTO
    report_property (j_id, p_id)
VALUES
    (36, 1);

SELECT
    *
FROM
    report_property;