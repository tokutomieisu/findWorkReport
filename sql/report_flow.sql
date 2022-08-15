CREATE TABLE report_flow(
    i_id INT,
    f_id INT,
    PRIMARY KEY(i_id, f_id),
    FOREIGN KEY (i_id) REFERENCES information_session(info_id),
    FOREIGN KEY (f_id) REFERENCES mt_flow(id)
);

INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (1, 1);

INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (1, 2);

INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (1, 3);

INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (1, 4);

INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (1, 7);

INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (2, 3);

INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (2, 7);


INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (3, 3);

INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (3, 7);


INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (4, 3);

INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (4, 7);


INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (5, 3);

INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (5, 7);


INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (6, 3);

INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (6, 7);


INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (7, 3);

INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (7, 7);


INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (8, 3);

INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (8, 7);


INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (9, 3);

INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (9, 7);


INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (10, 3);

INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (10, 7);


INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (11, 3);

INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (11, 7);


INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (12, 3);

INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (12, 7);


INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (13, 3);

INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (13, 7);


INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (14, 3);

INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (14, 7);


INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (15, 3);

INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (15, 7);


INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (16, 3);

INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (16, 7);


INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (17, 3);

INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (17, 7);


INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (18, 3);

INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (18, 7);


INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (19, 3);

INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (19, 7);


INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (20, 3);

INSERT INTO
    report_flow (i_id, f_id)
VALUES
    (20, 7);




SELECT
    *
FROM
    report_flow;