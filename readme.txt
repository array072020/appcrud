# Version 2.0 Written by TaskS
# PDO CRUDS with Data Tables(Bootstrap) 

## Setup the Script
1. Download the Script appcrud.7z
2. Extract it into web directory
3. Create a Database with the name of **cruds** 
 & import the SQL file into the database appcrud/dbsql/cruds.sql
4. Configure the Database Credentials in appcrud/app/config/db.php
        <?php   // Change $username, $password
		$username = 'root';
		$password = 'password';
		$db = new PDO('mysql:host=localhost;dbname=cruds;charset=utf8', $username, $password);
		$db->exec("SET CHARACTER SET utf8"); 
	?>
5. Browser call -> http://127.0.0.1/appcrud