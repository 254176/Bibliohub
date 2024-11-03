# Bibliohub
The BiblioHub Database Management System aims to streamline library operation by providing a centralized platform for managing book inventory, user data, transactions, and community events. 
This report begins by outlining the architecture of the database system that lays the foundation for BiblioHub. Then we examine the conceptual design of the database where we can see the relationships between data in the system. From there, the report describes the logic of these relationships and how they should be constructed and constrained in the database. Next up, we look at the existing functional dependencies. Finally, the report will describe how the database is to be implemented, installed, and executed.  

When walking through the report, it will be evident that BiblioHub will enhance productivity, expediency, and organization for libraries. More stimulating tasks can be carried out when BiblioHub is doing most of the heavy lifting when it comes to the vital operations of running a library. Of course, this works in the favor of librarians, library card holders and organizations that frequent libraries


Interface Requirements
BiblioHub will have separate interfaces for librarians and users. Librarians will be able to manage inventory, user data, transactions, and events. Users will be able to search for books, view events, and manage their own accounts. 
Functional Requirements 
-	User authentication and authorization. 
-	Create, retrieve, edit, and delete operations for books, users, transactions, and events.
-	Transaction management for books including check-outs, returns and renewals. 
-	Event management including creation, editing, and cancellation. 
Non-Functional Requirements
-	Performance: Response time should be within acceptable limits, even under peak loads. 
-	Security: User data, transaction and event details must be encrypted and protected from unauthorized access. 
-	Scalability: The system should handle a growing number of users, books, and events without compromising performance. 
Data Dictionary and Business Rules: 
Books: ISBN (Primary Key), Title, Author, Genre. 
Users: UserID (Primary Key), Role, Name, Email, Address, Password. 
Transactions: TransactionID (Primary Key), UserID (Foreign Key), InventoryID (Foreign Key),    TransactionType, TransactionDate, DueDate, Status. 
Events: EventID (Primary Key), UserID (Foreign Key), EventDate, EventTitle, EventDescription. 
Logical Database Schema
The logical schema is restructured and translated from the ER diagram, ensuring referential integrity through appropriate foreign key constraints. 
Books: 
ISBN (Primary Key) 
Title 
Author 
Genre 

Inventory: 
InventoryID (Primary Key) 
ISBN (Foreign Key referencing Books.ISBN) 
TransactionID (Foreign Key referencing Transactions.TransactionID) 

Users: 
UserID (Primary Key) 
Role 
Name 
Email 
Address 
Password 

Transactions: 
TransactionID (Primary Key) 
UserID (Foreign Key referencing Users.UserID) 
InventoryID (Foreign Key referencing Inventory.InventoryID) 
TransactionType 
TransactionDate 
DueDate 
Status 

Events: 
EventID (Primary Key) 
UserID (Foreign Key referencing Users.UserID) 
EventDate 
EventTitle 
EventDescription 
SQL statements used to construct the database schema are as follows:
CREATE TABLE Books ( 
	ISBN DECIMAL(13, 0) NOT NULL, 
	Title VARCHAR(255), 
	Author VARCHAR(255), 
	Genre VARCHAR(50), 
	-- Our primary key. 
	PRIMARY KEY (ISBN) 
); 
  
CREATE TABLE Inventory ( 
	InventoryID INT NOT NULL, 
	ISBN DECIMAL(13, 0) NOT NULL, 
	TransactionID INT NOT NULL, 
	-- Our primary key. 
	PRIMARY KEY(InventoryID), 
	-- If a book’s removed from inventory, we have no use for its metadata. 
	FOREIGN KEY(ISBN) 
	        REFERENCES Books(ISBN) 
	        ON DELETE CASCADE 
); 
  
CREATE TABLE Users ( 
	UserID INT NOT NULL, 
	Role SET('standard', 'admin') NOT NULL, 
	Name VARCHAR(255) NOT NULL, 
	Email VARCHAR(255) NOT NULL, 
	Address VARCHAR(255), 
    Password CHAR(64), 
	-- Our primary key. 
	PRIMARY KEY(UserID) 
); 
CREATE TABLE Events ( 
	EventID INT NOT NULL, 
	UserID INT NOT NULL, 
	EventDate TIMESTAMP NOT NULL, 
	EventTitle VARCHAR(100) NOT NULL, 
	EventDescription VARCHAR(2000) NOT NULL, 
	-- Our primary key. 
	PRIMARY KEY(EventID), 
	FOREIGN KEY(UserID) 
	        REFERENCES Users(UserID) 
); 
  
CREATE TABLE Transactions ( 
	TransactionID INT NOT NULL, 
	UserID INT NOT NULL, 
	InventoryID INT NOT NULL, 
	TransactionType INT NOT NULL, 
	TransactionDate TIMESTAMP NOT NULL, 
	DueDate TIMESTAMP NOT NULL, 
	State BOOLEAN NOT NULL, 
	-- Our primary key. 
	PRIMARY KEY(TransactionID), 
	-- If a user revokes their library card/requests account deletion, do 
	-- not destroy the Transaction history. 
	FOREIGN KEY(UserID) 
	        REFERENCES Users(UserID), 
	-- If a book is completely removed from inventory, keep history of its 
	-- addition/removal. 
	FOREIGN KEY(InventoryID) 
	        REFERENCES Inventory(InventoryID) 
); 


Expected Database Operations 
Querying Books:
Description: Users will search for books based on various criteria such as title, author, genre, or ISBN.
Operations:
-	Retrieving book details based on title, author, genre, or ISBN.
-	Displaying available copies of a book in the inventory.
2.	Providing additional information about a book, such as its availability status.
Estimated Data Volume: Depends on the size of the library's collection and the frequency of book queries by users.
 
Updating Inventory:
Description: Librarians will add new books to the inventory, update existing book records, and remove books from the inventory.
Operations:
-	Adding new entries to the inventory table with details such as ISBN, InventoryID, and TransactionID.
-	Updating existing inventory records to reflect changes in book status or availability.
-	Removing obsolete or damaged books from the inventory.
Estimated Data Volume: Depends on the frequency of inventory updates and the rate of book acquisitions or removals.
Managing User Accounts:
Description: Librarians will manage user accounts, including registration, updating user details, and handling account deletions.
Operations:
-	Adding new user accounts with details such as UserID, Role, Name, Email, Address, and Password.
-	Updating user information such as email address, contact details, or password changes.
3.	Deactivating or deleting user accounts upon request or due to policy violations.
Estimated Data Volume: Depends on the number of registered users and the frequency of account updates or deletions.
Processing Transactions:
Description: Transactions include book checkouts, returns, renewals, and inventory updates.
Operations:
-	Recording new transactions with details such as TransactionID, UserID, InventoryID, TransactionType, TransactionDate, DueDate, and Status.
-	Updating transaction records to reflect changes in book status or due dates.
-	Handling transaction-related actions such as renewals or late returns.
Estimated Data Volume: Depends on the frequency of book transactions and the size of the library's user base.
Organizing Events:
Description: Librarians will organize community events such as book clubs, author signings, and reading marathons.
Operations:
-	Adding new event entries with details such as EventID, UserID, EventDate, EventTitle, and EventDescription.
-	Updating event details such as date, time, or description changes.
-	Cancelling events and updating event status accordingly.
Estimated Data Volume: Depends on the frequency of events organized by the library and the number of attendees per event.


 
Functional Dependencies and Database Normalization
Functional dependencies for each relation are identified and analyzed to ensure data integrity and eliminate redundancy. 
The relations in this database are in Boyce-Codd Normal Form (BCNF), which ensures that in each relation there are no non-trivial functional dependencies other than those involving the primary keys. 

Books 		ISBN → Title, Author, Genre 
The ISBN uniquely determines the Title, Author, and Genre of a book. This is because each book has a unique ISBN, and a specific ISBN corresponds to a specific Title, Author, and Genre. 

Inventory	InventoryID → ISBN, TransactionID 
The InventoryID uniquely determines the ISBN and TransactionID associated with a book in the inventory. Each inventory item has a unique InventoryID, and it is associated with a specific ISBN and TransactionID. 

Users 		UserID → Role, Name, Email, Address, Password 
The UserID uniquely determines the Role, Name, Email, Address, and Password of a user. Each user has a unique UserID, and their role and personal information are associated with this UserID. 

Transactions	TransactionID → UserID, InventoryID, TransactionType, TransactionDate, DueDate, Status 
The TransactionID uniquely determines the UserID, InventoryID, TransactionType, TransactionDate, DueDate, and Status of a transaction. Each transaction has a unique TransactionID, and its details such as user involved, item transacted, transaction type, dates, and status are determined by this ID. 

Events	 	EventID → UserID, EventDate, EventTitle, EventDescription 
The EventID uniquely determines the UserID, EventDate, EventTitle, and EventDescription of an event. Each event has a unique EventID, and its details such as organizer, date, title, and description are determined by this ID. 
The Database System

Installation and Invocation
BiblioHub is written in PHP and uses MySQL as its database system. It should be able to run on any system with a PHP, a CGI-compatible HTTP server, and a MySQL implementation. We recommend nginx alongside MariaDB. You should have access to MySQL’s prompt with permission to create a database/user, and PHP should be configured with support for the mysqli module.  Refer to official documentation for details on installing and configuring these components. 
4.	Create the SQL database BiblioHub alongside a dedicated SQL user with permissions on the database. The MySQL prompt should appear as follows: 
5.	> CREATE USER 'bh'@'localhost' IDENTIFIED BY 'your_password'; 
> CREATE DATABASE BiblioHub; 
> GRANT ALL PRIVILEGES ON BiblioHub.* TO 'bh'@'localhost';
6.	Initialize the database structure and optionally “seed” with test data. Files create.sql and load.sql are provided, respectively, to aid in this process. With the database named “BiblioHub” and user “bh”, the files can be used from a UNIX command-line as follows:
$ mariadb --user=bh --password --database=BiblioHub < create.sql 
$ mariadb --user=bh --password --database=BiblioHub < load.sql 
7.	Place the PHP files in a path that is accessible to your webserver. This can be done by copying the contents of the provided source-code archive (see Appendix) into your web-server’s root directory. Now add your databases credentials to config.php. If the file has not already been created, copy it from config.php.example. With the database named “BiblioHub” and user “bh”, this is what config.php may look like: 
<?php 
define('SITETITLE', 'BiblioHub Library'); 
define('DBHOST', 'localhost'); 
define('DBNAME', 'BiblioHub'); 
define('DBUSER', 'bh'); 
define('DBPASS', 'your_password'); 
define('DBCONNSTRING', 'mysql:dbname=' . DBNAME . ';charset=utf8mb4;'); 
?> 
 
System Usage

In BiblioHub, there are three pages that are most important: dashboard.php, book_management.php, and dashboard.php. From these pages, books can be checked out/returned, current inventory can be viewed, books can be added/modified/removed, and the user can log in.
At the dashboard, the user can mark a book in the inventory as “borrowed” or “returned”, using its inventory ID or other data to identify the book. One enters the data into the forms (for example, ISBN into the ISBN text-box), selects the transaction type (Borrowed/Returned) from the drop-down menu Transaction”, and clicks “Submit”.

The book management page is used for adding, modifying, and removing books’ metadata from the database. To add a book to the database, the user must simply enter the book’s title, author, genre, ISBN, and, optionally, the ID of the creation-transaction, into the “Add Book” form. To modify a book is similar: In the “Update Book” form, the user enters the book’s ISBN, and then specifies the to-be-modified fields before clicking “Update Book”.

The book log page provides a view of all book metadata stored in the database: ISBN, title, author, and genre. Here we can see the result of the database actions depicted in the above screenshots from the book management page. The book “Free Software, Free Society” was added to the database, and then subsequently retitled “Free as in Freedom (2.0)”. In can be seen here as the first row.


The transactions-page provides a low-level log of all transactions made in BiblioHub: The addition/removal/modification of books’ metadata, as well as checking out and returning inventory items.

The user login page allows the user to login to the system, using a user name and password. For this demonstration version of BiblioHub, the contents of the user table are displayed, so one can easily authenticate as an account from the testing dataset.

User Application Interface
The user interface is designed to be intuitive and user-friendly, with separate interfaces for librarians and users. Librarians have access to administrative features such as inventory management, while users can view available books and manage their accounts. BiblioHub is a web-service, whose interface is written in HTML and CSS. Screenshots of the interface and usage instructions can be found in the Database System section. 
Conclusions and Future Work
The BiblioHub Database Management System has been successfully implemented to address the challenges faced by libraries in managing their vast collections and numerous community events. The system provides a robust platform for efficient library operations and enhanced user experience. With BiblioHub time and tedious effort needed to run a library are reduced to less than a fraction of the time. This efficiency increases productivity and allows for more interpersonal interactions that are not purely transactional. BiblioHub will be advantageous to librarians, library card holders and organizations. 
Although BiblioHub operates proficiently, it will most certainly benefit from improvements.  New developments may include:
-	recommendation algorithms in the catalog so users can see similar books
-	addition of more entities to include other media formats including audiobooks, films, albums, video games, etc.
-	 integration with other external databases/libraries to help users find their item of interest
-	further optimization for scalability and performance as the data sets for the DBMS grow






