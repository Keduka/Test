/**
 * モバイルプログラミング2
 * RDB実習
 */

/*-----------------------------*/
/* 専用のDB作成                 */
/*-----------------------------*/
CREATE DATABASE NovelRDB;
USE NovelRDB;

/*-----------------------------*/
/* シナリオマスター                */
/*-----------------------------*/
/*-- テーブル定義 --*/
CREATE TABLE Scenario(
    `id`     int,
    `cmd`    varchar(5),
    `value`  varchar(255),

    primary key (`id`)
)
ENGINE=InnoDB   /* MySQLのエンジンを指定 */
CHARSET=utf8;   /* 文字コード */

/*--  テストデータ挿入 --*/
INSERT INTO Scenario(`id`, `cmd`, `value`)
VALUES
    (1, 'TXT', '吾輩わがはいは猫である。名前はまだ無い。')
  , (2, 'TXT', 'どこで生れたかとんと見当けんとうがつかぬ。')
  , (3, 'TXT', '何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。')
  , (4, 'CHAR', 'image/char2.png')
  , (5, 'TXT', '吾輩はここで始めて人間というものを見た。')
;

/*-----------------------------*/
/* ユーザー管理                  */
/*-----------------------------*/
/*-- テーブル定義 --*/
CREATE TABLE User(
    `id`             int          AUTO_INCREMENT,
    `name`           varchar(64),
    `register_date`  datetime,

    primary key (`id`)
)
ENGINE=InnoDB   /* MySQLのエンジンを指定 */
CHARSET=utf8;   /* 文字コード */

/*--  テストデータ挿入 --*/
INSERT INTO User(name, register_date)
VALUES
   ('パンダ', now())
  ,('バナナ', now())
;


/*-----------------------------*/
/* セーブデータ管理               */
/*-----------------------------*/
/*-- テーブル定義 --*/
CREATE TABLE Save(
  `user_id`       int,
  `save_id`       int,
  `scenario_id`   int,
  `register_date` datetime,

  primary key (`user_id`, `save_id`)
)
ENGINE=InnoDB   /* MySQLのエンジンを指定 */
CHARSET=utf8;   /* 文字コード */

/*--  テストデータ挿入 --*/
INSERT INTO Save(user_id, save_id, scenario_id, register_date)
VALUES
    (1, 1, 1, now())
  , (1, 2, 5, now())
  , (2, 1, 3, now())
;
