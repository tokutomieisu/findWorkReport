CREATE TABLE findworkreport(
    j_id INT AUTO_INCREMENT,
    af_id INT,
    c_id char(7),
    a_cd char(2),
    in_cd char(5),
    o_cd char(5),
    v_cd char(1),
    day date,
    PRIMARY KEY (j_id),
    FOREIGN KEY (af_id) REFERENCES affiliation(id),
    FOREIGN KEY (c_id) REFERENCES mt_company(c_id),
    FOREIGN KEY (a_cd) REFERENCES mt_activities(a_cd),
    FOREIGN KEY (in_cd) REFERENCES mt_industry(in_cd),
    FOREIGN KEY (o_cd) REFERENCES mt_occupation(o_cd),
    FOREIGN KEY (v_cd) REFERENCES mt_venue(v_cd)
);

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        1,
        'co00001',
        '1',
        'in001',
        'oc001',
        '1',
        '2022-06-21'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        2,
        'co00002',
        '1',
        'in001',
        'oc001',
        '1',
        '2022-06-20'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        3,
        'co00003',
        '1',
        'in001',
        'oc001',
        '1',
        '2022-06-19'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        1,
        'co00001',
        '2',
        'in001',
        'oc001',
        '2',
        '2022-06-21'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        2,
        'co00002',
        '2',
        'in001',
        'oc001',
        '2',
        '2022-06-21'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        3,
        'co00003',
        '2',
        'in001',
        'oc001',
        '2',
        '2022-06-21'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        1,
        'co00001',
        '3',
        'in001',
        'oc001',
        '1',
        '2022-06-20'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        2,
        'co00002',
        '3',
        'in001',
        'oc001',
        '1',
        '2022-06-19'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        3,
        'co00003',
        '1',
        'in001',
        'oc001',
        '1',
        '2022-06-21'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        1,
        'co00001',
        '4',
        'in001',
        'oc001',
        '1',
        '2022-06-21'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        2,
        'co00002',
        '4',
        'in001',
        'oc001',
        '1',
        '2022-06-21'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        3,
        'co00003',
        '4',
        'in001',
        'oc001',
        '1',
        '2022-06-20'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        1,
        'co00004',
        '1',
        'in001',
        'oc001',
        '1',
        '2022-06-21'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        2,
        'co00005',
        '1',
        'in002',
        'oc002',
        '1',
        '2022-06-20'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        3,
        'co00006',
        '1',
        'in003',
        'oc003',
        '1',
        '2022-06-19'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        1,
        'co00004',
        '2',
        'in001',
        'oc001',
        '2',
        '2022-06-21'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        2,
        'co00005',
        '2',
        'in002',
        'oc002',
        '2',
        '2022-06-21'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        3,
        'co00006',
        '2',
        'in003',
        'oc003',
        '2',
        '2022-06-21'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        1,
        'co00004',
        '3',
        'in001',
        'oc001',
        '1',
        '2022-06-20'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        2,
        'co00005',
        '3',
        'in002',
        'oc002',
        '1',
        '2022-06-19'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        3,
        'co00006',
        '1',
        'in003',
        'oc003',
        '1',
        '2022-06-21'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        1,
        'co00004',
        '4',
        'in001',
        'oc001',
        '1',
        '2022-06-21'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        2,
        'co00005',
        '4',
        'in002',
        'oc002',
        '1',
        '2022-06-21'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        3,
        'co00006',
        '4',
        'in003',
        'oc003',
        '1',
        '2022-06-20'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        2,
        'co00001',
        '1',
        'in001',
        'oc001',
        '2',
        '2022-06-21'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        3,
        'co00001',
        '1',
        'in001',
        'oc001',
        '2',
        '2022-06-21'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        2,
        'co00002',
        '1',
        'in001',
        'oc001',
        '2',
        '2022-06-21'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        3,
        'co00002',
        '1',
        'in001',
        'oc001',
        '2',
        '2022-06-21'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        2,
        'co00003',
        '1',
        'in001',
        'oc001',
        '2',
        '2022-06-21'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        3,
        'co00003',
        '1',
        'in001',
        'oc001',
        '2',
        '2022-06-21'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        2,
        'co00004',
        '1',
        'in001',
        'oc001',
        '2',
        '2022-06-21'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        3,
        'co00004',
        '1',
        'in001',
        'oc001',
        '2',
        '2022-06-21'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        2,
        'co00005',
        '1',
        'in002',
        'oc002',
        '2',
        '2022-06-21'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        3,
        'co00005',
        '1',
        'in002',
        'oc002',
        '2',
        '2022-06-21'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        2,
        'co00006',
        '1',
        'in003',
        'oc003',
        '2',
        '2022-06-21'
    );

INSERT INTO
    findworkreport (
        af_id,
        c_id,
        a_cd,
        in_cd,
        o_cd,
        v_cd,
        day
    )
VALUES
    (
        3,
        'co00006',
        '1',
        'in003',
        'oc003',
        '2',
        '2022-06-21'
    );

SELECT
    *
FROM
    findworkreport;