/*

    To ensure secure database access, we need to create a user.
    it's ok to use usual root user but in this case i prefer creating a one as for learning something
    
    CREATE USER 'username'@'host' IDENTIFIED BY 'password';

*/
CREATE USER 'mockuser'@'localhost' IDENTIFIED BY 'mockWeb2024';

/*

    after creating a user we need to graint access to that user to our database
    also make sure that u already initialized database

    GRANT ALL PRIVILEGES ON database_name.* TO 'username'@'host';

*/
GRANT ALL PRIVILEGES ON mockwebdb.* TO 'mockuser'@'localhost';


-- After granting privileges, it's important to refresh the privileges to ensure they take effect
FLUSH PRIVILEGES;
