# ORM_Doctrine_Practice
Products listing practice exercise of ORM doctrine 


# Symfony Project

This is a Symfony project for managing products.

## Getting Started

To get started with this project, follow these steps:

1. Clone the repository to your local machine:
git clone <repository_url>

2. Install dependencies using Composer:
composer install

3. Set up your environment variables by copying the `.env` file:
cp .env.dist .env

4. Configure your database connection in the `.env` file.
php bin/console doctrine:database:create

5. Create the database and run migrations:
php bin/console doctrine:migrations:migrate


6. Run the Symfony development server:
symfony server:start

7. Access the application in your web browser at `http://localhost:8000`.

## Usage

- The project allows you to view, create, edit, and delete products.
- Navigate to the homepage to view a list of products.
- Use the provided links to edit or delete existing products.
- To create a new product, click on the "Add New Product" button.

## Contributing

Contributions are welcome! If you'd like to contribute to this project, please follow these steps:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature/your-feature-name`).
3. Make your changes and commit them (`git commit -am 'Add new feature'`).
4. Push to the branch (`git push origin feature/your-feature-name`).
5. Create a new Pull Request.





