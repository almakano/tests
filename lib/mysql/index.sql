# найти последние 100 событий последних 100 аккаунтов за последний месяц
select 
	t1.*,
	t2.*,
	(
		select value from users_property_values upv 
		where upv.`user_id` = t1.`id` and upv.`property_id` = 1
	) col1
from
	(select * from `users` order by id desc limit 100) t1,
	`users_events` t2
	left join `users_events` t3 on t3.`user_id` = t2.`user_id` and t2.`id` < t3.`id`
where
	t1.`id` = t2.`user_id`
	and t3.`id` is null
	and t2.`inserted_date` > date_sub(now(), interval 1 month)
order by t1.`id` desc
limit 0, 100;

# заблокировать таблицу на чтение, обновить поле и разблокировать
lock tables `users` read;
update `users` set
	`status` = 'updating'
where `status` = 'new'
order by `id` desc
limit 10;

select `id` from `users` where `status` = 'updating';
unlock tables;

# удалить записи таблицы
delete from `users` where is_deleted = 1;

# очистить таблицы и обнулить auto_increment
truncate `users_log`;

# удалить таблицы
drop table users_report_201801;