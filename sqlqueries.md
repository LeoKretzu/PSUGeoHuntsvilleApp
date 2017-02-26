SQL Queries:
create database huntsville;

create table huntsville
(
	ynresponse char(1),
	latitude varchar(255),
	longitude varchar(255),
    flooding char(1),
    highwinds char(1),
    earthquake char(1),
    tsunami char(1),
    tornado char(1),
    hale char(1),
    snowstorm char(1),
    medical char(1),
    mgmtcomment varchar(255),
    ageandnumppl varchar(255) not null,
    needmedattn varchar(255)
);

select * from huntsville;

insert into huntsville values
('y', '13.168', '11.345', 'n', 'n', 'n', 'n', 'n', 'n', 'n', 'n', 'n', '2', 'n'),
('n', '34.56', '32.5', 'y', 'n', 'y', 'n', 'y', 'n', 'y', 'n', 'y', '12', 'hi'),
('y', '22.75', '18.5', 'n', 'y', 'n', 'y', 'n', 'y', 'n', 'y', 'n', '62', 'n');

sudo tail -n 1 /var/log/httpd/access_log | awk '{ print $1 }' # gets new IP
sudo sed -i -e 's/50.247.42.34/96.94.171.13/g' /etc/httpd/conf.d/phpMyAdmin.conf # changes IP 