Product Inventory CRUD Application
Introduction:
This is a Product Inventory CRUD application developed with PHP, MySQL, HTML, CSS, and JavaScript. The application allows users to manage product data, including adding, editing, and deleting products. The admin dashboard provides key statistics like the total number of products, total stock value, and the number of out-of-stock products.

Features:
├──Add, edit, and delete products
├──Manage product images
├──Filter products by category
├──Search products 
├──Dashboard with key statistics
├──Stock management and alerts for low stock
├──How to run the project locally:

Prerequisites:
Before you begin, ensure you have met the following requirements;

├──PHP: Version 8.0 or higher
├──MySQL: Database server
├──Apache: Web server (XAMPP, WAMP, or MAMP)

Setup the Database:
Create a MySQL database;
1. CREATE DATABASE pdctinventorydb;
2. Import the SQL file into the database (pdctinventorydb.sql)
3. Update the config.php file with your database credentials
4. Run the Project Locally (http://localhost/ProductInventoryCRUD/)

How to use:
First go to the home and log into the account.  After logging into the account, the dashboard will come.  Then you can access the Products management page through the "Manage Products" link on the sidebar.  A new product can be added by "Add New Product" on the right side.  "Back to Dashboard" can be redirected back to Dashboard.  Products can be edited by clicking the "pencil" icon at the bottom of an existing product and deleted by clicking the "Trash Bin" icon.
Click the "Log Out" link on the sidebar to log out of the account.

File Structure:
ProductInventoryCRUD/
│
├── Dashboard/ 
     ├── dashboard-style.css                      # Dashboard styles
     ├── dashboard.php                            # Dashboard page
├── Images/                                       # Folder where product images are saved
├── Login/
     ├── login.php                                # Login function
     ├── loginform.php                            # Login page
     ├── logout.php                               # Logout function
     ├── passwordreset.php                        # Password reset function
├── Products/
     ├── addproduct.php                           # New product adding page
     ├── change-image.php                         # Product image change page
     ├── edit.php                                 # Existing product edit page
     ├── products.php                             # Existing products showing page
├── config.php                                    # Database Configuration 
├── index.php                                     # Homepage or landing page
├── pdctinventorydb.sql                           # SQL queries
├── search.php                                    # Search function 
├── style.css                                     # Home page styles

