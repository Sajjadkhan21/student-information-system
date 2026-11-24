# Student Information System (SIS)

A simple student records app (add, edit, delete, search) built with **PHP** and **MySQL**.

## Features

- List and search students by name or roll number
- Add, edit, and delete student records
- Database settings read from environment variables, so the same code runs locally, in Docker and in Kubernetes

## Project structure

```
sis-app/
├── config.php           # database connection (reads DB_* env variables)
├── index.php            # list and search students
├── add.php              # add a student
├── edit.php             # edit a student
├── delete.php           # delete a student
├── schema.sql           # creates the students table
├── Dockerfile           # builds the PHP/Apache app image
└── docker-compose.yml   # runs the app and MySQL together
```

## Configuration

| Variable  | Default        | Purpose        |
|-----------|----------------|----------------|
| `DB_HOST` | `127.0.0.1`    | Database host  |
| `DB_NAME` | `sis`          | Database name  |
| `DB_USER` | `sis_user`     | Database user  |
| `DB_PASS` | `ChangeMe123!` | Database password |

The defaults are for local learning only. Never commit real passwords; in Kubernetes, use a Secret.

## Run locally (Ubuntu)

1. Install the requirements:

   ```bash
   sudo apt update
   sudo apt install -y php-cli php-mysql mysql-server git
   sudo systemctl enable --now mysql
   ```

2. Create the database and user:

   ```bash
   sudo mysql
   ```

   ```sql
   CREATE DATABASE IF NOT EXISTS sis;
   CREATE USER IF NOT EXISTS 'sis_user'@'localhost' IDENTIFIED BY 'ChangeMe123!';
   GRANT ALL PRIVILEGES ON sis.* TO 'sis_user'@'localhost';
   FLUSH PRIVILEGES;
   EXIT;
   ```

3. Create the table:

   ```bash
   mysql -u sis_user -p sis < schema.sql
   ```

4. Start the app:

   ```bash
   php -S 0.0.0.0:8000
   ```

5. Open http://localhost:8000

## Run with Docker Compose

Requires Docker with the Compose v2 plugin.

```bash
docker compose up --build
```

Open http://localhost:8080. On the first start, MySQL takes 20 to 30 seconds to initialise, so refresh if you see a connection error.

Useful commands:

```bash
docker compose ps            # list containers
docker compose logs db       # database logs
docker compose logs web      # app logs
docker compose down          # stop (data kept)
docker compose down -v       # stop and delete the database volume
```

## Build a versioned image

```bash
docker build -t sis-app:1.0.0 .

*Author: Sajjad Ullah*
