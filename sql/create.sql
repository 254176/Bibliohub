CREATE TABLE Books (
	ISBN DECIMAL(13, 0) NOT NULL,
	Title VARCHAR(255),
	Author VARCHAR(255),
	Genre VARCHAR(50),
	-- Our primary key.
	PRIMARY KEY (ISBN),
	FULLTEXT KEY (Title, Author)
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

CREATE TABLE Transactions (
	TransactionID INT NOT NULL,
	UserID INT NOT NULL,
	InventoryID INT NOT NULL,
	TransactionType INT NOT NULL,
	TransactionDate TIMESTAMP NOT NULL,
	DueDate TIMESTAMP NOT NULL,
	Status BOOLEAN NOT NULL,
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
