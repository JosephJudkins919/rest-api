Rest API Midterm

## Description
This project is a PHP OOP REST API for managing quotations. It allows users to perform CRUD operations on quotes, authors, and categories.

## Endpoints
- `/api/quotes`: Retrieve all quotes or create a new quote
- `/api/quotes/{id}`: Retrieve, update, or delete a quote by ID
- `/api/quotes/author/{author_id}`: Retrieve quotes by author ID
- `/api/quotes/category/{category_id}`: Retrieve quotes by category ID
- `/api/quotes/author/{author_id}/category/{category_id}`: Retrieve quotes by author ID and category ID
- `/api/authors`: Retrieve all authors or create a new author
- `/api/authors/{id}`: Retrieve, update, or delete an author by ID
- `/api/categories`: Retrieve all categories or create a new category
- `/api/categories/{id}`: Retrieve, update, or delete a category by ID

## Setup
1. Create a MySQL database named `quotesdb`
2. Run the SQL schema script provided in `db_schema.sql`
3. Update database credentials in `database.php`
4. Start the PHP server and access the API using the provided endpoints

## Author
[Joseph Judkins](https://rest-api-807m.onrender.com)
