-- 検索結果詳細閲覧画面の各ページSQL

-- readStudentInfo.php
-- 企業IDから就活レポート及び記録生徒を求める
SELECT j_id , c_id , day FROM findworkreport WHERE c_id = 'co00001';

SELECT a.student_id , f.day , c. curriculum , c.course 
FROM findworkreport f 
INNER JOIN affiliation a ON f.af_id = a.id
JOIN mt_class c ON a.class_id = c.class_id  
WHERE c_id = 'co00001' 
GROUP BY a.student_id 
ORDER BY f.day DESC;

-- ↓正しい方
SELECT f.af_id , f.day , c. curriculum , c.course 
FROM findworkreport f 
INNER JOIN affiliation a ON f.af_id = a.id
JOIN mt_class c ON a.class_id = c.class_id  
WHERE c_id = 'co00001' 
GROUP BY f.af_id 
ORDER BY f.day DESC;

SELECT f.af_id , f.day , c. curriculum , c.course FROM findworkreport f INNER JOIN affiliation a ON f.af_id = a.id JOIN mt_class c ON a.class_id = c.class_id  WHERE c_id = 'co00001' GROUP BY f.af_id ORDER BY f.day DESC;

-- findWorkReport.php
SELECT j_id FROM findworkreport WHERE  

SELECT a.student_id , f.day , f.j_id 
FROM findworkreport f 
INNER JOIN affiliation a ON f.af_id = a.id
WHERE f.c_id = 'co00001' AND a.student_id = '202112345';

SELECT j_id  , day , a_cd ,af_id
FROM findworkreport 
WHERE c_id = 'co00001' AND af_id = '1' AND a_cd = '1'
ORDER BY day DESC;

-- 説明会テーブルからレポート内容を取得する
SELECT f.j_id  , f.day , i.classification FROM findworkreport f INNER JOIN information_session i  ON f.j_id = i.j_id WHERE c_id = 'co00001' AND af_id = '1' AND a_cd = '1' ORDER BY day DESC;

-- 試験テーブルからレポート内容を取得する
SELECT f.j_id  , f.day , t.classification FROM findworkreport f INNER JOIN tests t  ON f.j_id = t.j_id WHERE c_id = 'co00001' AND af_id = '1' AND a_cd = '2' ORDER BY day DESC;

-- 面接テーブルからレポート内容を取得する
SELECT f.j_id  , f.day , i.classification FROM findworkreport f INNER JOIN interview i  ON f.j_id = i.j_id WHERE c_id = 'co00001' AND af_id = '1' AND a_cd = '3' ORDER BY day DESC;

-- その他テーブルからレポート内容を取得する
SELECT f.j_id  , f.day , o.classification FROM findworkreport f INNER JOIN other o  ON f.j_id = o.j_id WHERE c_id = 'co00001' AND af_id = '1' AND a_cd = '4' ORDER BY day DESC;


-- readStudentInfo
--説明会
SELECT c.c_name, f.day, v.v_name, a.a_name, i.classification, i.place, i.i_num, f.property, i.remarks FROM information_session AS i INNER JOIN findworkreport AS f ON f.j_id = i.j_id INNER JOIN mt_company AS c ON c.c_id = f.c_id INNER JOIN mt_venue AS v ON v.v_cd = f.v_cd INNER JOIN mt_activities AS a ON a.a_cd = f.a_cd WHERE i.j_id = 2;
--試験
SELECT c.c_name, f.day, v.v_name, a.a_name, t.classification, t.question, t.theme, t.timerequired, t.wordcount, t.contents, f.property, t.remarks FROM tests AS t INNER JOIN findworkreport AS f ON f.j_id = t.j_id INNER JOIN mt_company AS c ON c.c_id = f.c_id INNER JOIN mt_venue AS v ON v.v_cd = f.v_cd INNER JOIN mt_activities AS a ON a.a_cd = f.a_cd WHERE t.j_id = 4;
--面接
SELECT c.c_name, f.day, v.v_name, a.a_name, i.interviewer, i.i_name, i.i_num, i.question, f.property, i.remarks FROM interview AS i INNER JOIN findworkreport AS f ON f.j_id = i.j_id INNER JOIN mt_company AS c ON c.c_id = f.c_id INNER JOIN mt_venue AS v ON v.v_cd = f.v_cd INNER JOIN mt_activities AS a ON a.a_cd = f.a_cd WHERE i.j_id = 7;
--その他
SELECT c.c_name, f.day, v.v_name, a.a_name, o.o_num, o.contents, f.property, o.remarks FROM other AS o INNER JOIN findworkreport AS f ON f.j_id = o.j_id INNER JOIN mt_company AS c ON c.c_id = f.c_id INNER JOIN mt_venue AS v ON v.v_cd = f.v_cd INNER JOIN mt_activities AS a ON a.a_cd = f.a_cd WHERE o.j_id = 10;





