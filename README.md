
# Laravel Attendance Management System with QR Code

## Description

This is a Laravel-based web application designed to manage student attendance using QR codes. The system allows three types of users (students, admins, and lecturers) to access and manage attendance data.

### Features
- **Student Access**: Students can scan QR codes to mark their attendance.
- **Admin Access**: Admins can manage users, attendance records, and generate reports.
- **Lecturer Access**: Lecturers can create and manage classes, as well as view attendance reports for their courses.
- **QR Code Generation and Scanning**: The application generates unique QR codes for each class, which can be scanned by students to mark attendance.

## Technologies Used
- Laravel 10.x
- PHP 8.x
- MySQL
- Bootstrap 5 (Frontend)
- QR Code generation and scanning libraries

## Installation

### Prerequisites
Before running this project, make sure you have the following installed on your machine:
- PHP >= 8.0
- Composer
- MySQL
- Laravel 10.x (can be installed via Composer)

### Steps to Set Up the Project

1. **Clone the repository:**
   ```bash
   git clone https://github.com/basedcodesBen/presensi-mahasiswa.git
   ```

2. **Navigate to the project folder:**
   ```bash
   cd presensi-mahasiswa
   ```

3. **Install the dependencies:**
   ```bash
   composer install
   ```

4. **Create the `.env` file:**
   ```bash
   cp .env.example .env
   ```

5. **Configure the environment variables:**
   Open the `.env` file and update the following values:
   - `DB_DATABASE=your_database_name`
   - `DB_USERNAME=your_database_user`
   - `DB_PASSWORD=your_database_password`

6. **Generate the application key:**
   ```bash
   php artisan key:generate
   ```

7. **Migrate the database:**
   ```bash
   php artisan migrate
   ```

8. **Run the development server:**
   ```bash
   php artisan serve
   ```

Your application should now be running at `http://localhost:8000`.

## Usage

### Accessing the Application

1. **Students**: Can log in, scan the QR codes for classes, and view their attendance history.
2. **Admins**: Have full control over managing users, classes, and attendance data. They can also generate attendance reports.
3. **Lecturers**: Can create classes, manage attendance for their courses, and view student attendance records.

## Additional Commands

- **Run Tests:**
  ```bash
  php artisan test
  ```

- **Clear Cache (if needed):**
  ```bash
  php artisan cache:clear
  ```

## Contributing

Feel free to fork this project, make changes, and submit pull requests!

## License

This project is open-source and available under the [MIT License](LICENSE).
