# Tasker

## Introduction

Tasker is a web-based task management application designed to efficiently organize and manage tasks for its users. With an intuitive user interface and robust functionalities, Tasker simplifies the tracking, updating, and completion of tasks.

## Features

- **User Authentication**: Secure login and session management.
- **Task Management**: Create, update, and track tasks with features for managing tasks on specific dates.
- **User Profiles**: View and edit user information, and customize profiles.
- **Team Collaboration**: Manage and view team information for collaborative tasks.
- **Calendar View**: An interactive calendar for planning and managing tasks.
- **Dynamic Routing**: Redirects users based on their session status to appropriate views.

## Getting Started

To run Tasker, a web server with PHP support is required. Clone the repository and deploy the files to your server.

### Prerequisites

- PHP 7.4 or higher
- A web server (e.g., Apache, NGINX)

### Installation

1. Clone the repository to your server.
2. Configure your web server to serve `main.php` as the entry point.
3. Access the application through your web browser.

## File Structure

- **PHP Files**: Main application files including main.php, mainview.php, register.php, user.php, login.php.
- **JavaScript Files**: mainview.js for calendar functionality and task management, user.js for user session management and information retrieval.
- **Controller Files**: AppController.php, DefaultController.php, SecurityController.php, TaskController.php, TeamController.php for handling various aspects of the application.
- **Model Files**: Tasks.php, TasksTeam.php, TasksUser.php, Team.php, User.php, UserInfo.php representing data structures.
- **Repository Files**: Repository.php, TeamRepository.php, UserInfoRepository.php, UserRepository.php, UserTaskRepository.php for data operations.
- **Infrastructure Files**:
DATABASE.php for database configuration,
index.php as the application entry point,
Routing.php for handling routes.

## Contributors
Michal Szymacha