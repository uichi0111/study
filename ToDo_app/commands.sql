create database todo_app;
grant all on todo_app.* to dbuser@localhost identified by '3EwruTre';

use todo_app

create table tasks (
    id int not null auto_increment primary key,
    seq int not null,
    type enum('notyet', 'done', 'deleted') default 'notyet',
    title text,
    created datetime,
    modified datetime,
    KEY type(type),
    KEY seq(seq)
    );

insert into tasks (seq, type, title, created, modified) values
(1, 'notyet', '牛乳を買う', now(), now()),
(2, 'notyet', '企画書を作る', now(), now()),
(3, 'done', 'ゴミを捨てる', now(), now());





mysql> SHOW VARIABLES LIKE '%char%';
+--------------------------+----------------------------+
| Variable_name            | Value                      |
+--------------------------+----------------------------+
| character_set_client     | utf8                       |
| character_set_connection | utf8                       |
| character_set_database   | latin1                     |
| character_set_filesystem | binary                     |
| character_set_results    | utf8                       |
| character_set_server     | latin1                     |
| character_set_system     | utf8                       |
| character_sets_dir       | /usr/share/mysql/charsets/ |
+--------------------------+----------------------------+

latin1のせいで文字化けが発生したので
/etc/mysql/my.cnf を開いて、[mysqld]のところに

character_set_server=utf8

と書いて、mysqlを再起動する。service mysql restart

mysql> SHOW VARIABLES LIKE '%char%';
+--------------------------+----------------------------+
| Variable_name            | Value                      |
+--------------------------+----------------------------+
| character_set_client     | utf8                       |
| character_set_connection | utf8                       |
| character_set_database   | utf8                       |
| character_set_filesystem | binary                     |
| character_set_results    | utf8                       |
| character_set_server     | utf8                       |
| character_set_system     | utf8                       |
| character_sets_dir       | /usr/share/mysql/charsets/ |
+--------------------------+----------------------------+
これで解決






