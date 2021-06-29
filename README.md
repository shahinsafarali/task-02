
## Setting up project
0. Run `composer install` and `php artisan key:generate`
2. Set database credentials
3. Set `QUEUE_CONNECTION=database`
4. Call `php artisan migrate:fresh --seed` to populate database
5. Sample employees file is in project dir. Find `employees.xml`
6. Run `php artisan queue:work`

Notes:
Since the task description did not include from where I should 
select work hours of employees with hourly payment type (to calculate monthly payment), 
I created work_hours table to store hours of each employee for days.

Please note that, I used varchar datatype to store payment_type, we could use enum or tinyint here,
but I deliberately chose varchar. Enum has a lot of evil sides, for example, there will be 
problems if you want to another type to enum values - Alter table query is not very cost effective.
And for the sake of O of SOLID - Open-Closed principle I used direct class names here, so, you can 
easily add another payment type in the future. However, this kind of things usually depends on the
requirements of project. Maybe there won't be another type, so we might not need this functionality eventually.

I implemented all parts of task. I spend almost 5 hours for this task. According to task description
I should not be used any framework, tool (except Laravel, MySql, javascript/Vue.js, html, css), 
that is why I had created a basic stylesheet for table, pagination and 404 page.


Please contact me if you have any questions. You can also watch screen recording of task features. 
https://streamable.com/f20igp
https://www.t.me/myawesomeusername
