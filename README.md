# Portfolio Laravel

A modern, feature-rich portfolio website built with Laravel 11, Tailwind CSS, and Alpine.js. This project provides a complete admin panel for managing portfolio content, blog posts, skills, experiences, and more.

## 🌟 Features

### Frontend
- **Responsive Design** - Mobile-first approach with Tailwind CSS
- **Hero Section** - Eye-catching landing page with profile image and CTA buttons
- **About Section** - Showcase your background and skills
- **Services** - Highlight your professional services
- **Skills** - Display technical skills with progress bars
- **Experience** - Timeline of work experience
- **Education** - Academic background
- **Portfolio** - Showcase your projects with categories and filters
- **Blog** - Publishing platform with categories and tags
- **Testimonials** - Client feedback and ratings
- **FAQ** - Frequently asked questions section
- **Contact Form** - Get in touch section with email notifications
- **Gallery** - Image showcase
- **Social Media Links** - Links to your social profiles
- **Analytics** - Visitor tracking and statistics

### Admin Panel
- **Complete CRUD Operations** - Manage all website content
- **Dashboard** - Overview of website statistics
- **User Management** - Admin role management
- **SEO Optimization** - Meta tags and descriptions
- **Media Management** - Upload and manage images
- **Blog Management** - Create, edit, publish blog posts
- **Settings** - Configure website settings
- **Message Management** - Handle contact form submissions
- **Beautiful UI** - Modern admin interface with Bootstrap 5

## 📋 Tech Stack

- **Backend**: Laravel 11
- **Frontend**: Blade Templates, Tailwind CSS, Alpine.js
- **Database**: MySQL/PostgreSQL
- **Package Manager**: Composer, NPM
- **Build Tool**: Vite
- **UI Framework**: Bootstrap 5, Font Awesome
- **Animation**: AOS (Animate On Scroll)
- **Rich Text Editor**: CKEditor 5
- **Data Tables**: DataTables
- **Notifications**: SweetAlert2

## 🚀 Quick Start

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL/PostgreSQL

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/egaardiansah67-rgb/portfolio-laravel.git
   cd portfolio-laravel
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   ```

4. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database Setup**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Build Assets**
   ```bash
   npm run build
   ```

7. **Start Development Server**
   ```bash
   php artisan serve
   ```

8. **Access the Application**
   - Frontend: `http://localhost:8000`
   - Admin Panel: `http://localhost:8000/admin/dashboard`
   - Default Admin Credentials: `admin@example.com` / `password`

## 📁 Project Structure

```
portfolio-laravel/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Admin controllers
│   │   │   └── Frontend/       # Frontend controllers
│   │   └── Middleware/
│   ├── Models/                 # Eloquent models
│   └── Traits/
├── database/
│   ├── migrations/             # Database migrations
│   ├── seeders/               # Database seeders
│   └── factories/             # Model factories
├── resources/
│   ├── views/
│   │   ├── admin/             # Admin views
│   │   ├── frontend/          # Frontend views
│   │   └── components/        # Reusable components
│   ├── css/
│   │   └── app.css           # Main stylesheet
│   └── js/
│       └── app.js            # Main JavaScript
├── routes/
│   ├── web.php               # Web routes
│   └── api.php               # API routes
├── config/                    # Configuration files
├── storage/                   # File storage
├── public/                    # Public assets
└── tests/                     # Test files
```

## 🎯 Database Schema

### Core Tables
- `heroes` - Hero section content
- `abouts` - About section
- `services` - Services offered
- `skill_categories` - Skill groupings
- `skills` - Individual skills with proficiency
- `experiences` - Work experience
- `educations` - Educational background
- `portfolio_categories` - Project categories
- `portfolios` - Portfolio projects
- `portfolio_images` - Project images
- `galleries` - Gallery images
- `testimonials` - Client testimonials
- `achievements` - Achievements/stats
- `faqs` - FAQ entries
- `blog_categories` - Blog post categories
- `blogs` - Blog posts
- `tags` - Post tags
- `blog_tag` - Many-to-many relationship
- `messages` - Contact form messages
- `website_settings` - Site configuration
- `social_media` - Social media links
- `visitor_analytics` - Analytics data

## 🔐 Authentication

The project uses Laravel's built-in authentication system. Users can:
- Register and login
- Reset passwords
- Manage profile
- Access admin panel (if admin role)

## 📝 Usage

### Adding a Blog Post
1. Navigate to Admin Panel → Blogs
2. Click "Create New Blog"
3. Fill in title, content, category, and tags
4. Upload thumbnail
5. Publish

### Adding a Portfolio Project
1. Navigate to Admin Panel → Portfolios
2. Click "Create New Project"
3. Add project details, images, links
4. Set as featured if needed
5. Publish

### Managing Skills
1. Create skill categories
2. Add skills under categories
3. Set proficiency percentage
4. Customize colors

### Updating Website Settings
1. Go to Admin Panel → Settings
2. Update website information
3. Configure meta tags for SEO
4. Add analytics codes
5. Save

## 🎨 Customization

### Tailwind CSS
Edit `tailwind.config.js` to customize colors, fonts, and spacing:

```javascript
theme: {
    extend: {
        colors: {
            primary: '#6366f1',
            secondary: '#8b5cf6',
        },
    },
},
```

### Custom Blade Components
Create reusable components in `resources/views/components/`

### API Responses
All admin endpoints return JSON responses for AJAX interactions.

## 🧪 Testing

```bash
# Run tests
php artisan test

# Run specific test
php artisan test tests/Feature/BlogTest.php
```

## 📦 Deployment

### Preparation
```bash
# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Build assets
npm run build
```

### Environment Variables
Update `.env` with production settings:
```
APP_ENV=production
APP_DEBUG=false
DB_CONNECTION=mysql
DB_HOST=your_host
DB_DATABASE=your_db
DB_USERNAME=your_user
DB_PASSWORD=your_password
```

### Server Requirements
- PHP 8.2+
- MySQL 5.7+
- Composer
- Node.js (for asset compilation)

## 📚 API Documentation

### Authentication Endpoints
- `POST /register` - User registration
- `POST /login` - User login
- `POST /logout` - User logout
- `POST /forgot-password` - Password reset

### Admin Endpoints
- `GET /admin/dashboard` - Dashboard statistics
- `POST /admin/heroes` - Update hero section
- `GET /admin/blogs` - List all blogs
- `POST /admin/blogs` - Create new blog
- `PUT /admin/blogs/{id}` - Update blog
- `DELETE /admin/blogs/{id}` - Delete blog

### Frontend Endpoints
- `GET /` - Homepage
- `GET /portfolio` - Portfolio page
- `GET /blog` - Blog page
- `POST /contact` - Submit contact form

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License. See the LICENSE file for details.

## 🙋 Support

For support, email support@example.com or open an issue on GitHub.

## 👨‍💻 Author

**Egaardiansah67-RGB**
- GitHub: [@egaardiansah67-rgb](https://github.com/egaardiansah67-rgb)
- Email: egaardiansah67@gmail.com

## 🎓 Credits

- Laravel Framework
- Tailwind CSS
- Bootstrap
- Font Awesome
- CKEditor

## 📈 Roadmap

- [ ] REST API
- [ ] GraphQL Support
- [ ] Multi-language Support
- [ ] Dark Mode
- [ ] Advanced Analytics
- [ ] Email Notifications
- [ ] Comment System
- [ ] Rating System

---

**Made with ❤️ using Laravel**
