# Education-Monitor-Students-Tracking-System
This project focuses on developing a web-based Student Progress Tracking System that helps teachers and academic staff monitor and manage students’ performance more efficiently. . Instead of relying on traditional methods such as paper records or spreadsheets, the system provides a centralized digital platform where attendance, gradess, and overall progress can be recorded and accessed easier. This makes the process faster, more accurate, and easier to manage.

# Problem Statement
Many educational institutions still depend on manual or semi-digital methods to track student performance. These methods often cause several issues:
Teachers spend a lot of time recording attendance and calculating grades manually.


- Student data can be lost or not updated properly across different files.
- There is no single system that stores all student information in one place.
- It becomes difficult to quickly identify students who need academic support.
- Preparing student reports manually takes time and may include errors.
- Because of these problems, the overall efficiency of tracking student progress is reduced. Therefore, there is a need for a digital system that can solve these challenges in an easy way.


# Project Aim
The main aim of this project is to design and develop a web-based system that allows teachers and administrators to record, monitor, and analyze student performance. The system will include features such as tracking grades, attendance, and overall progress in a centralized and user-friendly platform.


# Project Objectives
The project will achieve the following objectives:
Develop a secure login system for Admin, Teacher, and Student users within the first two weeks.


- Create a student management module to add, update, and view student information.
- Build an attendance system to record daily attendance for each subject.
- Develop a grade management system for assignments, midterm, and final exams.
- Generate automatic reports that show student performance clearly by Week 13.
- Help identify students who are at academic risk.
- Design a simple and easy-to-use interface that reduces manual effort.


# Project Scope and Limitations
The system WILL include:
-Secure login with role-based access
-Student profile management
-Attendance tracking
-Grade management
-Progress reports and data visualization
-MySQL database
-Web interface using PHP, HTML, and CSS

The system will NOT include:
-Financial or fee management
-Communication between parents and teachers
-Mobile application
-Course registration system
-Integration with external LMS

# Significance of the Project
This system provides several benefits:
For teachers: reduces workload and saves time


-For students: allows easy access to their academic progress
-For administrators: helps in better decision-making
-For institutions: improves accuracy and organization of data

In addition, this project supports Oman Vision 2040 by encouraging digital transformation in education and improving the use of technology in academic environments.


# Project Methodology
This project uses the Waterfall Model, which is a step-by-step approach where each phase is completed before moving to the next one.
This model was chosen because:
-The requirements are clear from the beginning
-The project scope isa sample.
-The timeline is fixed (14 weeks)


# Hardware and Software Requirements
Hardware Requirements:
- Intel Core i5 or equivalent (minimum)
- RAM 8 GB minimum
- Storage 256 GB free disk space
- Network Internet connection for browser access
- Input Devices is Keyboard and mouse


# Software Requirements:
- XAMPP: Local server environment (Apache + MySQL + PHP)
- PHP: Backend programming language
- MySQL: Database management system
- HTML / CSS  :Frontend web interface development
- VS Code: Code editor for development
- phpMyAdmin: Visual database management tool
- Google Chrome : Web browser for running and testing the system








# Fixed PHP/MySQL Student System: 

1) Put this folder in htdocs as: grad_project_fixed
2) Open phpMyAdmin and import setup_database.sql
3) Edit config.php only if your MySQL username/password is different.
4) Open: http://localhost/grad_project_fixed/

Default logins:
admin / 123
teacher / 123
student / 123

Main fixes:
- Removed wrong folders named dashboard.php, students.php, teachers.php, attendance.php.
- Added real navigation links for each role.
- Rebuilt CSS layout so sidebar, cards, forms, and tables are organized.
- Login now checks the users table and redirects by role.
- Admin can add/delete students and teachers with user accounts.
- Teacher can enter grades, attendance, and see failing students under 50.
- Student sees only their own grades, attendance, average, and status.
<img width="2559" height="1168" alt="Screenshot 2026-06-19 202938" src="https://github.com/user-attachments/assets/6f6c6ff8-34f0-40e9-8d12-3b4c8dae1606" />




