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

SELECT
    *
FROM
    interview;