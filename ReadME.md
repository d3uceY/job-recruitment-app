# Job Application Management System

## Overview
This is an admin dashboard system for managing job openings and applications. The system provides a user-friendly interface for HR administrators to track open positions, monitor applicant statistics, and manage the recruitment process.

## Features
- Protected access with authentication
- Responsive dashboard layout with sidebar navigation
- Real-time statistics including:
  - Number of open positions
  - Count of new applicants 
  - Total applications received
- User-friendly interface with Bootstrap styling

## Technical Details
- Built with PHP and MySQL
- Frontend using Bootstrap framework
- Key components:
    - Authentication system (`protect.inc.php`)
    - Database connectivity (`db_con.php`) 
    - Responsive layout with header, sidebar, navbar and footer
    - Real-time data querying and display

## Project Structure

### Authentication System

#### User Authentication Flow
1. **Sign Up Process**
   - New users register via `signup.php`
   - Form validation checks for:
     - Empty fields
     - Valid email format
     - Password matching
     - Unique username/email
   - Passwords are hashed before storage
   - Successful registration redirects to signin page

2. **Sign In Process**
   - Users login through `signin.php`
   - Validates credentials against database
   - Creates session with user ID and username
   - Redirects to dashboard on success

3. **Session Protection**
   - `protect.inc.php` guards admin routes
   - Checks for valid session
   - Redirects unauthorized users to login

4. **Logout Handling**
   - `logout.inc.php` destroys session
   - Redirects to signin page

### Job Management System

#### Job Postings
1. **Adding Jobs** (`add-jobs.php`)
   - Form with fields for:
     - Job title
     - Location
     - Duration
     - Summary
     - Responsibilities
     - Requirements
   - Rich text editing via Quill.js
   - Server-side validation

2. **Editing Jobs** (`edit-job.php`)
   - Pre-populated form with existing job data
   - Same fields as add form
   - Updates database on submission

3. **Viewing Jobs** (`view_jobs.php`)
   - DataTables integration for sorting/filtering
   - Actions for edit/delete
   - Responsive table layout

#### Application Management

1. **Application Form** (`application_form.php`)
   - Collects applicant information:
     - Personal details
     - Educational background
     - Work experience
     - Resume upload
   - Client and server-side validation
   - File upload handling

2. **Application Processing** (`manage_job_applications.php`)
   - View application details
   - Update application status
   - Delete applications
   - File download capability

### Master Data Management

#### Location Management
- CRUD operations for locations
- State and country tracking
- Used in job postings and applications

#### Industry Categories
- Management of industry types
- Modal-based editing
- Validation for duplicates

#### Educational Levels
- Standardized education levels
- Used in application forms
- CRUD functionality

### Frontend Components

1. **Layout System**
   - Consistent header/footer
   - Responsive sidebar navigation
   - User profile dropdown
   - Success/error alerts

2. **UI Libraries**
   - Bootstrap 5
   - Font Awesome icons
   - DataTables
   - Quill.js editor

3. **Career Portal**
   - Public job listings
   - Filterable by location
   - Application submission interface
   - Mobile-responsive design

### Database Structure

The application uses MySQL with the following key tables:
- `users` - Authentication data
- `job_openings` - Job posting details
- `job_applications` - Application submissions
- `locations` - Location master data
- `industry_category` - Industry types
- `educational_level` - Education standards



### Author & Credits

This project was developed by [d3uceY](https://github.com/d3uceY). If you use or modify this project, please provide appropriate credit and attribution to the original author.

this is my first project in php and mysql. i am still learning and i will update this project as i learn more.


