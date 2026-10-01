# SCHOOL WEBSITE PROJECT CONTEXT

## 1. PROJECT OVERVIEW

### Project Name

[School Name] Website

### Project Type

Professional school website with an administrative dashboard.

### Project Goal

Build a modern, responsive and easy-to-manage school website using PHP, MySQL, HTML, CSS and JavaScript.

The website will have two main parts:

1. Public-facing school website
2. Secure administrator dashboard

The public website allows students, parents, teachers and visitors to learn about the school.

The administrator dashboard allows authorized school administrators to manage website content without manually editing PHP files.

---

# 2. TECHNOLOGY STACK

## Backend

* PHP
* MySQL

## Frontend

* HTML5
* CSS3
* JavaScript

## Database

* MySQL

## Development Environment

* Visual Studio Code
* XAMPP or another local PHP/MySQL development environment

## Deployment

The finished website should be deployable to a standard PHP/MySQL hosting provider.

---

# 3. PROJECT PRINCIPLES

The website must be:

* Professional
* Modern
* Clean
* Responsive
* Easy to navigate
* Easy to maintain
* Fast-loading
* Secure
* Accessible on mobile, tablet and desktop
* Suitable for a real school
* Easy for non-technical administrators to manage

Do not introduce unnecessary technologies or frameworks unless there is a clear reason to do so.

The core application should remain understandable to someone with intermediate PHP knowledge.

---

# 4. PUBLIC WEBSITE

The public website should contain the following main sections.

## 4.1 Home

The homepage should include:

* School logo
* School name
* Navigation menu
* Hero/banner section
* Welcome message
* Short introduction to the school
* Principal/headteacher message
* Key school statistics
* Academic highlights
* Why choose our school
* Latest news
* Announcements
* Upcoming events
* Gallery preview
* Admissions call-to-action
* Contact information
* Footer

The homepage should provide clear navigation to the other sections of the website.

---

# 5. ABOUT PAGE

The About page should provide information about the school.

Possible sections:

* School history
* Mission
* Vision
* Core values
* School leadership
* Principal/headteacher message
* School facilities
* Achievements

Content should eventually be manageable from the administrator dashboard where practical.

---

# 6. ACADEMICS PAGE

The Academics section should provide information about educational programs offered by the school.

Possible information:

* Nursery/primary/secondary sections where applicable
* Classes
* Subjects
* Curriculum
* Academic departments
* Teaching approach
* Examination information
* Academic achievements

The exact academic structure will be determined after the school information is provided.

---

# 7. ADMISSIONS PAGE

The Admissions page should provide prospective parents/students with information about joining the school.

Possible sections:

* Admission information
* Requirements
* Application procedure
* Required documents
* Fees information
* Important dates
* Frequently asked questions
* Application/contact button

If required later, an online application system can be added.

For the initial version, the admissions section does not need to process payments.

---

# 8. SCHOOL LIFE PAGE

The School Life section can contain:

* Clubs
* Sports
* Music
* Cultural activities
* Student activities
* Trips
* Events
* Student leadership
* School community activities

---

# 9. NEWS AND ANNOUNCEMENTS

The website should have a dynamic News/Announcements section.

Administrators should be able to:

* Create news
* Edit news
* Delete news
* Publish/unpublish news
* Add images
* Set publication dates
* Add titles
* Add descriptions/content

Visitors should be able to view published news.

Each news item should preferably have its own detail page.

Example:

`news.php`

and:

`news-details.php?id=15`

---

# 10. EVENTS

The website should support school events.

Administrators should be able to:

* Add events
* Edit events
* Delete events
* Set event dates
* Set event times
* Add locations
* Add descriptions
* Publish/unpublish events

The public website should display upcoming events.

---

# 11. GALLERY

The website should contain a photo gallery.

Administrators should be able to:

* Upload images
* Add image titles/captions
* Organize images into categories/albums
* Delete images
* Edit captions

The public gallery should display images in a responsive layout.

Uploaded files must be validated for:

* File type
* File size
* File extension
* Safe filename handling

Only appropriate image formats should be allowed.

---

# 12. CONTACT PAGE

The Contact page should contain:

* School address
* Telephone number
* Email address
* Location
* Office hours
* Google Maps location where appropriate
* Contact form
* Social media links where applicable

The contact form should allow visitors to send messages to the school.

Messages should be stored in the database and accessible through the administrator dashboard.

---

# 13. ADMINISTRATOR DASHBOARD

The dashboard is an essential part of this project.

The dashboard should be located under:

`/admin/`

The dashboard must be protected by authentication.

Unauthenticated visitors must not be able to access administrative pages.

---

# 14. ADMIN LOGIN

The administrator login should include:

* Username/email
* Password
* Login button
* Logout functionality
* Session-based authentication

Passwords must NEVER be stored as plain text.

Use:

`password_hash()`

for storing passwords and:

`password_verify()`

for checking passwords.

---

# 15. ADMIN DASHBOARD HOME

After login, the administrator should see an overview dashboard.

Possible dashboard statistics:

* Total news posts
* Total announcements
* Total events
* Total gallery images
* Total contact messages
* Number of administrators

The dashboard may also show:

* Recent news
* Recent messages
* Upcoming events
* Quick action buttons

Example quick actions:

* Add News
* Add Event
* Upload Image
* View Messages

---

# 16. ADMIN CONTENT MANAGEMENT

The administrator should be able to manage website content through CRUD operations.

CRUD means:

* Create
* Read
* Update
* Delete

Content areas should include:

### News

* Add
* View
* Edit
* Delete
* Publish/unpublish

### Announcements

* Add
* View
* Edit
* Delete
* Publish/unpublish

### Events

* Add
* View
* Edit
* Delete

### Gallery

* Upload
* View
* Edit
* Delete

### Messages

* View
* Mark as read/unread
* Delete

---

# 17. ADMIN USERS

The system should support administrator accounts.

Initial version:

* Admin login
* Admin logout
* Change password
* Add administrator
* Delete administrator

If multiple user roles are introduced later, possible roles include:

* Super Admin
* Administrator
* Editor

Permissions should be enforced on the server side.

---

# 18. SCHOOL SETTINGS

The dashboard should eventually allow administrators to manage basic school information.

Possible settings:

* School name
* Logo
* School slogan
* Address
* Phone number
* Email
* Social media links
* About text
* Mission
* Vision
* Contact information

The public website should retrieve this information from the database where appropriate.

---

# 19. DATABASE

The application should use MySQL.

Initial database tables may include:

* `admins`
* `school_settings`
* `news`
* `announcements`
* `events`
* `gallery`
* `gallery_categories`
* `messages`

Additional tables can be introduced when a genuine requirement exists.

Avoid creating unnecessary database tables.

---

# 20. DATABASE SECURITY

Database queries should use prepared statements.

Do not build SQL queries by directly concatenating untrusted user input.

The application should use:

* Prepared statements
* Input validation
* Output escaping
* Secure password hashing
* Session authentication

Sensitive database credentials must not be committed to a public Git repository.

---

# 21. PHP PROJECT STRUCTURE

A suggested structure is:

```text
school-website/
│
├── index.php
├── about.php
├── academics.php
├── admissions.php
├── school-life.php
├── news.php
├── news-details.php
├── events.php
├── gallery.php
├── contact.php
│
├── admin/
│   ├── index.php
│   ├── login.php
│   ├── logout.php
│   ├── dashboard.php
│   │
│   ├── news/
│   ├── announcements/
│   ├── events/
│   ├── gallery/
│   ├── messages/
│   ├── users/
│   └── settings/
│
├── includes/
│   ├── config.php
│   ├── database.php
│   ├── auth.php
│   ├── header.php
│   ├── navbar.php
│   └── footer.php
│
├── assets/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── script.js
│   └── images/
│
├── uploads/
│   ├── gallery/
│   └── news/
│
├── database/
│   └── school.sql
│
└── context/
    └── project-context.md
```

This structure can be modified as development progresses.

---

# 22. REUSABLE PHP COMPONENTS

Avoid duplicating common HTML across every page.

Use reusable PHP includes for:

* Header
* Navigation
* Footer
* Database connection
* Authentication
* Common functions

For example:

```php
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<!-- Page content -->

<?php include 'includes/footer.php'; ?>
```

Admin pages should have their own reusable dashboard components.

---

# 23. DESIGN DIRECTION

The design should be:

* Modern
* Professional
* Trustworthy
* Clean
* School-appropriate
* Visually appealing without being excessive

The design should prioritize readability and usability.

The website must be fully responsive.

Do not use excessive animations.

Animations should be subtle and should not interfere with usability.

---

# 24. RESPONSIVE DESIGN

The website must work properly on:

* Desktop computers
* Laptops
* Tablets
* Android phones
* iPhones

Navigation should adapt to smaller screens.

Cards, images, tables and forms must not overflow the screen on mobile devices.

The administrator dashboard must also be responsive.

---

# 25. ACCESSIBILITY

The website should follow basic accessibility principles.

Use:

* Semantic HTML
* Proper headings
* Labels for form fields
* Alt text for images
* Good color contrast
* Keyboard-friendly navigation
* Clear buttons and links

---

# 26. SECURITY REQUIREMENTS

Security is important because the project contains an administrator dashboard.

The system should protect against common vulnerabilities including:

* SQL injection
* Cross-site scripting (XSS)
* Unauthorized dashboard access
* Unsafe file uploads
* Session abuse
* Weak password storage

Use:

* Prepared statements
* Output escaping
* Password hashing
* Session checks
* Server-side validation
* Secure upload handling

Security should not depend only on JavaScript validation.

---

# 27. ADMIN URL STRUCTURE

Possible structure:

```text
/admin/login.php
/admin/dashboard.php
/admin/news/
admin/announcements/
admin/events/
admin/gallery/
admin/messages/
admin/users/
admin/settings/
```

All protected admin pages must verify authentication.

---

# 28. PUBLIC URL STRUCTURE

Possible structure:

```text
/
/about.php
/academics.php
/admissions.php
/school-life.php
/news.php
/news-details.php?id=1
/events.php
/gallery.php
/contact.php
```

The exact routing can be improved later if clean URLs are required.

---

# 29. CONTENT MANAGEMENT PRINCIPLE

Whenever practical, information that changes frequently should be managed through the dashboard rather than hard-coded into PHP.

Examples:

Dynamic:

* News
* Announcements
* Events
* Gallery
* Contact messages
* School contact details

Potentially static:

* Basic page structure
* Navigation structure
* Design components

---

# 30. DEVELOPMENT RULES

When modifying the project:

1. Do not unnecessarily rewrite working code.
2. Do not remove existing functionality without a reason.
3. Check how existing files are structured before making changes.
4. Maintain consistent naming conventions.
5. Keep database queries secure.
6. Keep public and admin functionality separated.
7. Test changes before moving to the next feature.
8. Do not invent school information.
9. Use placeholders until actual school information is provided.
10. Keep the project beginner/intermediate-friendly.
11. Explain major changes when implementing them.
12. Avoid unnecessary dependencies.

---

# 31. CURRENT PROJECT STATUS

Status:

Planning stage.

No production code has been created yet.

The next development step is to establish the local PHP development environment and create the initial project structure.

---

# 32. INFORMATION STILL REQUIRED

The following information will be provided later:

### School

* School name
* School logo
* School slogan
* School type
* School location
* School address
* Phone numbers
* Email address
* Social media accounts

### Academic

* Classes offered
* Subjects
* Curriculum
* Academic programs

### Leadership

* Headteacher/principal name
* Leadership team
* Principal message

### Admissions

* Admission requirements
* Application process
* Fees information
* Important dates

### Branding

* Primary color
* Secondary color
* Preferred fonts
* Design references

Do not invent these details.

---

# 33. FUTURE FEATURES

The following features may be considered after the initial website is complete:

* Online student applications
* Online admission forms
* Student portal
* Parent portal
* Teacher portal
* Student management
* Fee/payment management
* School timetable
* Results management
* Attendance management
* SMS notifications
* Email notifications
* Online payments
* Downloadable documents
* Search functionality

These features are NOT part of the initial scope unless specifically requested.

---

# 34. INITIAL DEVELOPMENT ORDER

Development should follow this order:

### Step 1

Set up PHP development environment.

### Step 2

Create project folder structure.

### Step 3

Create MySQL database.

### Step 4

Create database connection.

### Step 5

Create reusable website layout.

### Step 6

Build homepage.

### Step 7

Build remaining public pages.

### Step 8

Create administrator authentication.

### Step 9

Build administrator dashboard.

### Step 10

Build News management.

### Step 11

Build Announcements management.

### Step 12

Build Events management.

### Step 13

Build Gallery management.

### Step 14

Build Messages management.

### Step 15

Build School Settings.

### Step 16

Improve security and validation.

### Step 17

Make the entire system responsive.

### Step 18

Test the complete website.

### Step 19

Prepare the application for deployment.

---

# 35. IMPORTANT AI DEVELOPMENT INSTRUCTION

This document is the master context for the school website project.

When an AI assistant is asked to modify this project, it should use this document as the primary project reference.

Before making significant changes:

1. Understand the existing project structure.
2. Check existing functionality.
3. Preserve working functionality.
4. Follow the architecture defined here.
5. Do not invent missing school information.
6. Ask for clarification when an important requirement is genuinely unknown.
7. Prefer simple, maintainable PHP solutions.
8. Do not introduce unnecessary frameworks or dependencies.
9. Follow the security requirements.
10. Update this context file when important architectural decisions or project requirements change.

The project should be developed incrementally rather than generating the entire application at once.

---

# END OF PROJECT CONTEXT

## INITIAL SCAFFOLD STATUS

The initial PHP project structure has been created for the school website, including:

- Public-facing pages for home, about, academics, admissions, school life, news, events, gallery, and contact
- Shared includes for configuration, database access, authentication, header, navigation, and footer
- Responsive styling and lightweight JavaScript for mobile navigation
- A protected admin area with login and dashboard placeholders
- A starter MySQL schema for the main project tables

This scaffold is intended to be developed incrementally from the planning brief and should be expanded with real school content and full CRUD operations as the project progresses.
