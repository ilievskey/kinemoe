
# Kinemoe

![App Screenshot](readme/mobileProject.png)

This project is a platform for uploading and watching content with social aspects in the form of discussions.

With separate features for the admin and users the features are listed below.
# Features for users

### User Registration and Authentication
- **Sign Up**: Create a new account using your email.
- **Login**: Access your account with your credentials.

### User Profile
- **View Profile**: See your profile details, including your username, email, and any engagement you've made.
- **Profile Standing**: Receive badges for good behavior and plentiful engagement or face your fate by receiving warnings and bans.
- **Edit Profile**: Update your profile information and remove content if you change your mind.

### Content Browsing
- **Explore Content**: Browse a vast collection of movies, series, and podcasts.
- **View Content Details**: Click on any content to see detailed information, including synopsis, cast, and reviews.

### Social
- **Discussions**: Post your opinion about anything including your favorite movies.
- **Comment**: Leave comments on discussions to share your thoughts and interact with other users.
- **Like**: Like your favorite discussions to show appreciation.

# Features for admin

### Admin Dashboard
- **Home**: See engagement metrics, newest users and latest reports, all at glance.
- **Users**: Search for users and edit their name and email, add roles to users, moderate their discussions or comments, add a badge for good users and punish bad behavior with warnings and bans.
- **Reports**: Manage and moderate reports or dismiss accordingly.
- **Content**: Upload new, schedule for later or edit existing content such as movies, series, podcasts for the whole world to see.
- **System**: Change the site’s appearance by changing the name, logo, contact info and it’s terms of service.

### Discussions
- **Discussions Highlighting**: When in discussions page you have the ability to pin certain discussions to the top of the page so that users can be reminded by certain events or trends.

# Screenshots

![App Screenshot](readme/multipleMobile.png)

# How to install

## Prerequisites
- Make sure you have node.js installed
- Make sure you have npm installed
- Make sure you have composer installed
- If you are using XAMPP make sure to move the project in the htdocs folder

## Installation
- Navigate to the root folder of the project in your console or terminal
- Run `composer install` to install composer dependencies
- Run `npm install` to install npm dependencies
- Create you own or simply copy the example `.env` file
- Make sure to create a database with the same name as set in `DB_DATABASE` in the `.env` file
- Once you have `.env` ready run `php artisan key:generate`
- Run `php artisan migrate` to set up the db
- Run `php artisan db:seed` to seed the db
- Run `php artisan storage:link` to create a symbolic link
- Run `npm run dev` (preferably in a new console or terminal)
- Run `php artisan serve` and go to `localhost:8000` (or the port you were assigned with)

## Default credentials
- `admin@admin.com`:`adminadmin` - admin
- `rainbow@six.com`:`rainbow6` - user
- `tom@clancy.com`:`tomclancy` - another user

You can now log in as the admin and access the dashboard, as well as entering as a regular user.
As a regular user you may explore the page and view content, make posts and reports.
As an admin you may explore the dashboard and its features like moderation and content uploads.