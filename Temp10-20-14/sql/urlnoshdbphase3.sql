DROP DATABASE if EXISTS urlnoshdbphase3;
CREATE DATABASE urlnoshdbphase3;
USE urlnoshdbphase3;

DROP TABLE if EXISTS memberClasses;
CREATE TABLE memberClasses (
        memberClassId             int PRIMARY KEY,
        memberClassName           varchar (255) UNIQUE
);

DROP TABLE if EXISTS commentTags;
CREATE TABLE commentTags (
        commentTagId             int PRIMARY KEY AUTO_INCREMENT,
        commentTagName           varchar (255) UNIQUE
);

DROP TABLE IF EXISTS comments;
CREATE TABLE comments (
        commentId       	 int PRIMARY KEY AUTO_INCREMENT,
        evaluationUrl        varchar(1024) NOT NULL,
        comment	             varchar(2048) NOT NULL,
        memberClassId        int NOT NULL,
        commentDateCreated   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (memberClassId) REFERENCES memberClasses(memberClassId)
);

DROP TABLE IF EXISTS commentTagMap;
CREATE TABLE commentTagMap (
        commentTagId             int,
        commentId                int,
        FOREIGN KEY (commentTagId) REFERENCES commentTags(commentTagId),
        FOREIGN KEY (commentTagId) REFERENCES comments(commentId)
);

INSERT INTO commentTags VALUES
      (1, 'layout'), (2, 'colors'), (3, 'semantics'), (4, 'content');

INSERT INTO memberClasses VALUES
        (1, 'reader'), (2, 'nosher'), (3, 'moderator');

INSERT INTO comments (evaluationUrl, comment, memberClassId)
        VALUES ('http://www.npr.org/blogs/thetwo-way/2014/09/27/351986593/hiker-catches-volcanos-eruption-on-video-and-is-overtaken-by-ash', 'Shows the incredible power of nature', 1);
INSERT INTO comments (evaluationUrl, comment, memberClassId)
        VALUES ('http://validator.w3.org/', 'Why doesn\t the W3C semantic validator allow file upload?', 1);

INSERT INTO comments (evaluationUrl, comment, memberClassId)
        VALUES ('https://www.flickr.com/explore/', 'Flickr explore page always has some pheonomenal pictures', 3);
		
INSERT INTO comments (evaluationUrl, comment, memberClassId)
        VALUES ('http://www.cbc.ca/news/technology/bash-bug-aka-shellshock-has-no-easy-fix-1.2779383', 'The Bash shellshock has no easy fix', 2);


INSERT INTO commentTagMap (commentTagId, commentId) VALUES
       (1, 1), (1, 4), (1, 3), (2, 1), (2, 4), (4, 3);