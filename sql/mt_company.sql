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