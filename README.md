# CakePHP Assessment

### Instructions
1. Create a new repository in your GitHub account using the provided application zip.
2. Establish an initial commit with the provided code.
3. Complete the functional requirements below & commit these changes to your repository. Open a PR with your changes so that they can be reviewed.
4. Share your repository with us.

---

### Setup

#### System Requirements

- Docker Desktop
- WSL2 (Windows only)

Start by forking the repository to your own GitHub account. Then clone the forked repository to your local machine.

```bash
git clone https://github.com/Arcadis-Intelligence/hotspot-cakephp-assessment
cd hotspot-cakephp-assessment
```

Copy the local environment config

```bash
cp config/app_local.example.php config/app_local.php
```

### Running the application

Start the application using Docker Compose.

```bash
docker compose up -d
```

Install dependencies inside the container.

```bash
docker compose exec app composer install
```

You should now be able to access the application at `http://localhost`.

You can stop the application with `Ctrl+C` and then run `docker compose down` to remove the containers.

---

### CakePHP CLI

You can run CakePHP CLI commands like this:

```bash
docker compose exec app bin/cake <command>
```

Example:

```bash
docker compose exec app bin/cake bake model Actors
```

See [CakePHP docs](https://book.cakephp.org/5/en/) for more help with controllers, models, views, and database setup.

---

### Requirements

This assessment is to see how you write clean, readable code and how you structure your application. Front-end styling is not required, but you can add it if you'd like. We won't take it into account when reviewing the assessment.

The application should:

- Seed a database with at least 5 actors and at least 3 movies per actor
- Use CakePHP ORM to define the relationship between actors and movies
- Have a view that displays the list of actors and their associated movies
- Also include one input that allows the list of actors to be filtered. This can either be done with just PHP or with JavaScript, whichever you prefer. We're just looking for the end result.
- Have a view with one input that allows the user to search people via the The Movie Database (TMDb) API (https://developer.themoviedb.org/reference/search-person) and display the data
  - The API call should be handled on the back end

_We're really just looking for clean code and general best practices here. Nothing fancy is required._
