AUTHOR:
    Luke Fordham

INITIALISE ENVIRONMENT:
    - create folder to contain root folders/files.
    - run composer in root directory of created folder and run 'composer install' in terminal to install required packages.

APPLICATION INFO:
    - This application connects to a local MySQL database that I ran with XAMPP (the database should be named 'mydb' and contain an 'entries' table).
    - The 'entries' table must include a 'user' column and a 'time' column, both set to type: text.
    - The connection parameters do not include a password and the default user string 'root' is used.
    - The application allows the user to log their name & the current time and date to the 'entries' table of the database, by running 'php application.php app:log-access' in the terminal.
    - The application allows the user to print all the user and time entries in the 'entries' table of the database, by running 'php application.php app:read-data' in the terminal.
