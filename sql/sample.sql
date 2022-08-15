-- ゆうなちゃん
SELECT
    c.c_name,
    f.day,
    cl.curriculum,
    cl.course,
    a.student_id
FROM
    mt_company c
    INNER JOIN findworkreport f ON c.c_id = f.c_id
    INNER JOIN affiliation a ON f.af_id = a.id
    INNER JOIN mt_class cl ON a.class_id = cl.class_id
WHERE
    c.c_id = 'co00001';

/**
 学生IDから所属ID取得
 */
SELECT
    a.id
FROM
    affiliation a
WHERE
    a.student_id = '202112345';

/**
 会社名から会社ＩＤを検索(c_id)
 */
--説明会
SELECT c.c_name, f.day, v.v_name, a.a_name, i.classification, i.place, i.i_num, f.property, i.remarks FROM information_session AS i INNER JOIN findworkreport AS f ON f.j_id = i.j_id INNER JOIN mt_company AS c ON c.c_id = f.c_id INNER JOIN mt_venue AS v ON v.v_cd = f.v_cd INNER JOIN mt_activities AS a ON a.a_cd = f.a_cd WHERE i.j_id = 2;
--試験
SELECT c.c_name, f.day, v.v_name, a.a_name, t.classification, t.question, t.theme, t.timerequired, t.wordcount, t.contents, f.property, t.remarks FROM tests AS t INNER JOIN findworkreport AS f ON f.j_id = t.j_id INNER JOIN mt_company AS c ON c.c_id = f.c_id INNER JOIN mt_venue AS v ON v.v_cd = f.v_cd INNER JOIN mt_activities AS a ON a.a_cd = f.a_cd WHERE t.j_id = 4;
--面接
SELECT c.c_name, f.day, v.v_name, a.a_name, i.interviewer, i.i_name, i.i_num, i.question, f.property, i.remarks FROM interview AS i INNER JOIN findworkreport AS f ON f.j_id = i.j_id INNER JOIN mt_company AS c ON c.c_id = f.c_id INNER JOIN mt_venue AS v ON v.v_cd = f.v_cd INNER JOIN mt_activities AS a ON a.a_cd = f.a_cd WHERE i.j_id = 7;
--その他
SELECT c.c_name, f.day, v.v_name, a.a_name, o.o_num, o.contents, f.property, o.remarks FROM other AS o INNER JOIN findworkreport AS f ON f.j_id = o.j_id INNER JOIN mt_company AS c ON c.c_id = f.c_id INNER JOIN mt_venue AS v ON v.v_cd = f.v_cd INNER JOIN mt_activities AS a ON a.a_cd = f.a_cd WHERE o.j_id = 10;



SELECT


    *
FROM
    information_session
WHERE
    place IS NOT NULL;
    AND i_num IS NOT NULL;

INSERT INTO report_property (j_id,p_id)VALUES(?,?);

SELECT  p.name FROM findworkreport AS f INNER JOIN report_property AS fp ON f.j_id = fp.j_id INNER JOIN mt_property AS p ON p.id = fp.p_id WHERE f.j_id = 1;

SELECT  fl.name FROM information_session AS f INNER JOIN information_session i ON f.j_id = i.j_id INNER JOIN report_flow AS rf ON i.info_id = rf.i_id INNER JOIN mt_flow AS fl ON rf.f_id = fl.id WHERE f.j_id = 1;

localhost/findWorkReport/login.php



