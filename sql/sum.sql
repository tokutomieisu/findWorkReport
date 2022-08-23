DROP DATABASE db26;

CREATE DATABASE db26 DEFAULT CHARACTER SET utf8;

use db26;

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

CREATE TABLE mt_teacher(
    t_id char(6),
    t_cd char(2),
    t_name varchar(30),
    PRIMARY KEY(t_id)
);

INSERT INTO
    mt_teacher (t_id, t_cd, t_name)
VALUES
    ('198701', '29', '永峰　弘万');

INSERT INTO
    mt_teacher (t_id, t_cd, t_name)
VALUES
    ('201501', '01', '田中　信也');

INSERT INTO
    mt_teacher (t_id, t_cd, t_name)
VALUES
    ('202002', '02', '木下　和也');

CREATE TABLE mt_property(
    id INT AUTO_INCREMENT,
    name varchar(30),
    PRIMARY KEY(id)
);

INSERT INTO
    mt_property (name)
VALUES
    ('筆記用具');

INSERT INTO
    mt_property (name)
VALUES
    ('履歴書');

INSERT INTO
    mt_property (name)
VALUES
    ('健康診断書');

INSERT INTO
    mt_property (name)
VALUES
    ('成績卒見');

INSERT INTO
    mt_property (name)
VALUES
    ('エントリーシート');

INSERT INTO
    mt_property (name)
VALUES
    ('印鑑');

INSERT INTO
    mt_property (name)
VALUES
    ('作品');

INSERT INTO
    mt_property (name)
VALUES
    ('その他');

SELECT
    *
FROM
    mt_property;

CREATE TABLE mt_class(
    class_id char(8),
    course varchar(30),
    season char(1),
    curriculum char(3),
    t_id char(6),
    year char(4),
    PRIMARY KEY(class_id),
    FOREIGN KEY mt_class(t_id) REFERENCES mt_teacher(t_id)
);

INSERT INTO
    mt_class (
        class_id,
        course,
        season,
        curriculum,
        t_id,
        year
    )
VALUES
    (
        'PI12A229',
        '情報処理学科',
        '春',
        '2年制',
        '198701',
        '2022'
    );

INSERT INTO
    mt_class (
        class_id,
        course,
        season,
        curriculum,
        t_id,
        year
    )
VALUES
    (
        'AT14B401',
        'ゲーム制作学科',
        '春',
        '4年制',
        '201501',
        '2022'
    );

INSERT INTO
    mt_class (
        class_id,
        course,
        season,
        curriculum,
        t_id,
        year
    )
VALUES
    (
        'MC51A102',
        'ミュージック学科',
        '秋',
        '2年制',
        '202002',
        '2022'
    );

CREATE TABLE mt_activities(
    a_cd char(1),
    a_name varchar(30),
    PRIMARY KEY(a_cd)
);

INSERT INTO
    mt_activities (a_cd, a_name)
VALUES
    ('1', '説明会');

INSERT INTO
    mt_activities (a_cd, a_name)
VALUES
    ('2', '試験');

INSERT INTO
    mt_activities (a_cd, a_name)
VALUES
    ('3', '面接');

INSERT INTO
    mt_activities (a_cd, a_name)
VALUES
    ('4', 'その他');

SELECT
    *
FROM
    mt_activities;

CREATE TABLE mt_company(
    c_id char(7),
    c_name varchar(30),
    c_names varchar(30),
    c_post char(7),
    c_address varchar(30),
    c_tel varchar(30),
    c_mail varchar(30),
    c_section varchar(30),
    PRIMARY KEY(c_id)
);

INSERT INTO
    mt_company (
        c_id,
        c_name,
        c_names,
        c_post,
        c_address,
        c_tel,
        c_mail,
        c_section
    )
VALUES
    (
        'co00001',
        '株式会社HALシステムズ',
        '(株)HALシステムズ',
        '6011111',
        '大阪府大阪市北区梅田１－１－１',
        '0612345678',
        'abc@hal.ac.jp',
        '人事部採用課'
    );

INSERT INTO
    mt_company (
        c_id,
        c_name,
        c_names,
        c_post,
        c_address,
        c_tel,
        c_mail,
        c_section
    )
VALUES
    (
        'co00002',
        '株式会社LINU',
        '(株)LINU',
        '5022222',
        '大阪府大阪市北区梅田２－２－２',
        '0512345678',
        'abc@linu.ac.jp',
        '人事部採用課'
    );

INSERT INTO
    mt_company (
        c_id,
        c_name,
        c_names,
        c_post,
        c_address,
        c_tel,
        c_mail,
        c_section
    )
VALUES
    (
        'co00003',
        '株式会社Panasonick',
        '(株)Panasonick',
        '4033333',
        '大阪府大阪市北区梅田３－３－３',
        '0412345678',
        'abc@panasonick.ac.jp',
        '人事部採用課'
    );

INSERT INTO
    mt_company (
        c_id,
        c_name,
        c_names,
        c_post,
        c_address,
        c_tel,
        c_mail,
        c_section
    )
VALUES
    (
        'co00004',
        '株式会社MTTデータ関西',
        '(株)MTTデータ関西',
        '5022222',
        '大阪府大阪市北区梅田２－２－２',
        '0512345678',
        'abc@linu.ac.jp',
        '人事部採用課'
    );

INSERT INTO
    mt_company (
        c_id,
        c_name,
        c_names,
        c_post,
        c_address,
        c_tel,
        c_mail,
        c_section
    )
VALUES
    (
        'co00005',
        '株式会社トゥーシバ',
        '(株)トゥーシバ',
        '4033333',
        '大阪府大阪市北区梅田３－３－３',
        '0412345678',
        'abc@panasonick.ac.jp',
        '人事部採用課'
    );

INSERT INTO
    mt_company (
        c_id,
        c_name,
        c_names,
        c_post,
        c_address,
        c_tel,
        c_mail,
        c_section
    )
VALUES
    (
        'co00006',
        '株式会社SKYE',
        '(株)SKYE',
        '5022222',
        '大阪府大阪市北区梅田２－２－２',
        '0512345678',
        'abc@linu.ac.jp',
        '人事部採用課'
    );

SELECT
    *
FROM
    mt_company;

CREATE TABLE mt_flow(
    id INT AUTO_INCREMENT,
    name varchar(30),
    PRIMARY KEY(id)
);

INSERT INTO
    mt_flow (name)
VALUES
    ('説明会');

INSERT INTO
    mt_flow (name)
VALUES
    ('適性検査');

INSERT INTO
    mt_flow (name)
VALUES
    ('1次面接');

INSERT INTO
    mt_flow (name)
VALUES
    ('2次面接');

INSERT INTO
    mt_flow (name)
VALUES
    ('3次面接');

INSERT INTO
    mt_flow (name)
VALUES
    ('4次面接');

INSERT INTO
    mt_flow (name)
VALUES
    ('最終面接');

SELECT
    *
FROM
    mt_flow;

CREATE TABLE mt_industry(
    in_cd char(5),
    in_name varchar(30),
    PRIMARY KEY(in_cd)
);

INSERT INTO
    mt_industry (in_cd, in_name)
VALUES
    ('in001', 'IT');

INSERT INTO
    mt_industry (in_cd, in_name)
VALUES
    ('in002', 'ゲーム');

INSERT INTO
    mt_industry (in_cd, in_name)
VALUES
    ('in003', 'ミュージック');

SELECT
    *
FROM
    mt_industry;

CREATE TABLE mt_occupation(
    o_cd char(5),
    o_name varchar(30),
    in_cd char(5),
    PRIMARY KEY(o_cd),
    FOREIGN KEY mt_occupation(in_cd) REFERENCES mt_industry(in_cd)
);

INSERT INTO
    mt_occupation (o_cd, o_name, in_cd)
VALUES
    ('oc001', 'プログラマー', 'in001');

INSERT INTO
    mt_occupation (o_cd, o_name, in_cd)
VALUES
    ('oc002', 'システムエンジニア', 'in001');

INSERT INTO
    mt_occupation (o_cd, o_name, in_cd)
VALUES
    ('oc003', 'プロジェクトマネージャ', 'in001');

INSERT INTO
    mt_occupation (o_cd, o_name, in_cd)
VALUES
    ('oc004', 'ゲームプランナー', 'in002');

INSERT INTO
    mt_occupation (o_cd, o_name, in_cd)
VALUES
    ('oc005', 'ゲームプログラマー', 'in002');

INSERT INTO
    mt_occupation (o_cd, o_name, in_cd)
VALUES
    ('oc006', 'ゲームクリエイター', 'in002');

INSERT INTO
    mt_occupation (o_cd, o_name, in_cd)
VALUES
    ('oc007', '音響', 'in003');

INSERT INTO
    mt_occupation (o_cd, o_name, in_cd)
VALUES
    ('oc008', '音楽プロデューサー', 'in003');

INSERT INTO
    mt_occupation (o_cd, o_name, in_cd)
VALUES
    ('oc009', 'DJ', 'in003');

SELECT
    *
FROM
    mt_occupation;

CREATE TABLE mt_venue(
    v_cd char(1),
    v_name varchar(30),
    PRIMARY KEY(v_cd)
);

INSERT INTO
    mt_venue (v_cd, v_name)
VALUES
    ('1', '対面');

INSERT INTO
    mt_venue (v_cd, v_name)
VALUES
    ('2', 'オンライン');

SELECT
    *
FROM
    mt_venue;

CREATE TABLE affiliation(
    id INT AUTO_INCREMENT,
    student_id char(9),
    class_id char(8),
    PRIMARY KEY(id),
    FOREIGN KEY (student_id) REFERENCES mt_student(student_id),
    FOREIGN KEY (class_id) REFERENCES mt_class(class_id)
);

INSERT INTO
    affiliation (student_id, class_id)
VALUES
    ('202112345', 'PI12A229');

INSERT INTO
    affiliation (student_id, class_id)
VALUES
    ('202023456', 'AT14B401');

INSERT INTO
    affiliation (student_id, class_id)
VALUES
    ('201934567', 'MC51A102');

SELECT
    *
FROM
    affiliation;

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
    FOREIGN KEY (c_id) REFERENCES mt_company(c_id) on update cascade,
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
        16
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
        17
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
        18
    );

SELECT
    *
FROM
    tests;

CREATE TABLE interview (
    i_id int(10) auto_increment,
    classification char(2),
    interviewer varchar(2),
    i_name varchar(15),
    i_num varchar(2),
    question varchar(400),
    remarks varchar(400),
    j_id int(10),
    PRIMARY KEY(i_id),
    FOREIGN KEY (j_id) REFERENCES findworkreport(j_id)
);

INSERT INTO
    interview (
        classification,
        interviewer,
        i_name,
        i_num,
        question,
        remarks,
        j_id
    )
VALUES
    (
        '個人',
        '5',
        '1',
        NULL,
        '志望動機、ガクチカ、部活の遍歴、趣味',
        '自分への質問だけでなく、ほかの受験者の回答もしっかりと聞きましょう。',
        7
    );

INSERT INTO
    interview (
        classification,
        interviewer,
        i_name,
        i_num,
        question,
        remarks,
        j_id
    )
VALUES
    (
        '集団',
        '2',
        NULL,
        '3',
        'どういう会社にしていきたいか、10年後にどんなエンジニアになっていたいか',
        '最終面接だけでなく社会人になっても将来のビジョンは大切です。しっかりと考えていきましょう。',
        8
    );

INSERT INTO
    interview (
        classification,
        interviewer,
        i_name,
        i_num,
        question,
        remarks,
        j_id
    )
VALUES
    (
        '役員',
        '2',
        '最終',
        NULL,
        'どうやってgoogleを支えていきたいか、10年後にどんなエンジニアになっていたいか',
        '海賊王に俺はなる！',
        9
    );

INSERT INTO
    interview (
        classification,
        interviewer,
        i_name,
        i_num,
        question,
        remarks,
        j_id
    )
VALUES
    (
        '個人',
        '5',
        '1',
        NULL,
        '志望動機、ガクチカ、部活の遍歴、趣味',
        '自分への質問だけでなく、ほかの受験者の回答もしっかりと聞きましょう。',
        19
    );

INSERT INTO
    interview (
        classification,
        interviewer,
        i_name,
        i_num,
        question,
        remarks,
        j_id
    )
VALUES
    (
        '集団',
        '2',
        NULL,
        '3',
        'どういう会社にしていきたいか、10年後にどんなエンジニアになっていたいか',
        '最終面接だけでなく社会人になっても将来のビジョンは大切です。しっかりと考えていきましょう。',
        20
    );

INSERT INTO
    interview (
        classification,
        interviewer,
        i_name,
        i_num,
        question,
        remarks,
        j_id
    )
VALUES
    (
        '役員',
        '2',
        '最終',
        NULL,
        'どうやってgoogleを支えていきたいか、10年後にどんなエンジニアになっていたいか',
        '海賊王に俺はなる！',
        21
    );

SELECT
    *
FROM
    interview;

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
        22
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
        23
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
        24
    );

SELECT
    *
FROM
    other;

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

CREATE TABLE new_company(
    d_id char(7),
    c_name varchar(30),
    c_names varchar(30),
    c_post char(7),
    c_address varchar(30),
    c_tel varchar(30),
    c_mail varchar(30),
    c_section varchar(30),
    c_id char(7),
    PRIMARY KEY(d_id)
);

SELECT
    *
FROM
    new_company;

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