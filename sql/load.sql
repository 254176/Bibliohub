-- Insert data into the Books table
LOAD DATA LOCAL
     INFILE 'books.csv'
     INTO TABLE Books
     FIELDS TERMINATED BY ','
     LINES TERMINATED BY '\n';

-- Insert data into the Inventory table
INSERT INTO Inventory
       (InventoryID, ISBN, TransactionID)
       VALUES
       (1, 9781234567890, 1001),
       (2, 9781234567891, 1002),
       (3, 9781234567892, 1003),
       (4, 9781234567893, 1004);

-- Insert data into the Users table
INSERT INTO Users
       (UserID, Role, Name, Email, Address, Password)
       VALUES
       (1, 'standard', 'Alice Smith', 'alice@example.com', '123 Main St, Anytown, USA', 'password1'),
       (2, 'standard', 'Bob Johnson', 'bob@example.com', '456 Elm St, Othertown, USA', 'password2'),
       (3, 'admin', 'Charlie Brown', 'charlie@example.com', '789 Oak St, Somewhereville, USA', 'password3');

-- Insert data into the Transactions table
INSERT INTO Transactions
       (TransactionID, UserID, InventoryID, TransactionType, TransactionDate, DueDate, Status)
       VALUES
       -- The librarian (Charlie) registers four books…
       (1001, 3, 1, 2, '2024-04-01 09:00:00', NULL, true),
       (1002, 3, 2, 2, '2024-04-01 10:00:00', NULL, true),
       (1003, 3, 3, 2, '2024-04-01 11:00:00', NULL, true),
       (1004, 3, 4, 2, '2024-04-01 12:00:00', NULL, true),

       -- … which are checked out three days later.
       (1005, 1, 1, 0, '2024-04-04 09:00:00', '2024-04-11 09:00:00', false),
       (1006, 2, 2, 0, '2024-04-05 10:00:00', '2024-04-12 10:00:00', false),
       (1007, 3, 3, 0, '2024-04-06 11:00:00', '2024-04-13 11:00:00', false),
       (1008, 1, 4, 0, '2024-04-07 12:00:00', '2024-04-14 12:00:00', false),

       -- Two are returned on time, one is returned late, one is never returned.
       (1009, 1, 1, 1, '2024-04-07 11:00:00', NULL, true),
       (1010, 1, 4, 1, '2024-04-07 11:03:00', NULL, true),
       (1011, 2, 2, 1, '2024-04-13 11:03:00', NULL, true);

-- Insert data into the Events table
LOAD DATA LOCAL
     INFILE 'events.csv'
     INTO TABLE Events
     FIELDS TERMINATED BY ','
     LINES TERMINATED BY '\n';
