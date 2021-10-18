# learnsql

This requires a MySQL databases to interface with that has a user account with limited SELECT only permissions. There is currently no counter measures in place to prevent SQL Injection so make sure to avoid connecting to an important database.

You will also need to add the following constants in your php.ini file:

[learnsql]
learnsql.cfg.DB_HOST = mysql:host=127.0.0.1;dbname=your_db;charset=utf8mb4;port=3306;'
learnsql.cfg.DB_USER = 'basic_reader'
learnsql.cfg.DB_PASS = 'strongpassword'

You may need to play around with your host address, charset depending on the database, as well as if you have deviated from the default port.
