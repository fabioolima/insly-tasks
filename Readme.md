# Insly tasks

#### TASK 1 - Name

[task-1](https://github.com/fabioolima/insly-tasks/tree/master/task-1)

01001010 01110101 01110011 01110100 00100000 01110111 01110010 01101111 01110100 01100101 00100000 01101101 01101111 01110010 01100101 00100000 01110100 01101000 01100001 01101110 00100000 01101111 01101110 01100101 00100000 01110111 01100001 01111001 00100001


#### TASK 2 - Calculator

[task-2](https://github.com/fabioolima/insly-tasks/tree/master/task-2)

Using Material Desing for Frontend and jQuery.
Backend uses composer for autoloading.

To install with composer: ```composer install```

Run the built in HTTP server: ```php -S 0.0.0.0:9001 public/index.php```

Open http://localhost:9001

#### TASK 3 - Store employee data

[task-3](https://github.com/fabioolima/insly-tasks/tree/master/task-3)

```sql
SELECT tb1.st_name as 'Name', tb3.st_title as 'Language', tb2.tx_text
FROM tb_employees tb1
INNER JOIN tb_employee_info tb2 ON (tb2.id_employee = tb1.id_employee)
INNER JOIN tb_languages tb3 ON (tb3.id_language = tb2.id_language)
INNER JOIN tb_info_type tb4 ON (tb4.id_info_type = tb2.id_info_type)
WHERE tb1.id_employee = 1 AND tb4.id_info_type = 1;
```
