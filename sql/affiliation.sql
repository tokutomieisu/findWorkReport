CREATE TABLE affiliation(
    id INT AUTO_INCREMENT
    ,student_id char(9)
    ,class_id char(8)
    ,PRIMARY KEY(id)
    ,FOREIGN KEY (student_id) REFERENCES mt_student(student_id)
    ,FOREIGN KEY (class_id) REFERENCES mt_class(class_id)
);

INSERT INTO affiliation (
    student_id
    ,class_id
    ) VALUES(
    '202112345'
    ,'PI12A229'
);

INSERT INTO affiliation (
    student_id
    ,class_id
    ) VALUES(
    '202023456'
    ,'AT14B401'
);

INSERT INTO affiliation (
    student_id
    ,class_id
    ) VALUES(
    '201934567'
    ,'PI12A229'
);


SELECT * FROM affiliation;