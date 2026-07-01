# API Documentation

## Base URL

```
https://yourdomain.com/api
```

## Authentication

The API uses Laravel Sanctum for token-based authentication.

### Obtain Token

**Endpoint**: `POST /auth/login`

**Request**:
```json
{
    "email": "user@example.com",
    "password": "password"
}
```

**Response**:
```json
{
    "success": true,
    "token": "1|abcdef...",
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "user@example.com",
        "role": "admin"
    }
}
```

### Using Token

Include the token in request headers:
```
Authorization: Bearer 1|abcdef...
```

## Endpoints

### Hero Section

#### Get Hero
**GET** `/heroes`

**Response**:
```json
{
    "id": 1,
    "name": "John Doe",
    "profession": "Full Stack Developer",
    "description": "Passionate developer...",
    "profile_image": "/storage/heroes/image.jpg",
    "button_hire_text": "Hire Me"
}
```

#### Update Hero
**PUT** `/heroes/{id}`

**Parameters**:
- `name` (string, required)
- `profession` (string, required)
- `description` (string, optional)
- `profile_image` (file, optional)

### About Section

#### Get About
**GET** `/about`

**Response**:
```json
{
    "id": 1,
    "title": "About Me",
    "description": "Lorem ipsum...",
    "image": "/storage/about/image.jpg"
}
```

#### Update About
**PUT** `/about/{id}`

### Services

#### List Services
**GET** `/services`

**Query Parameters**:
- `page` (integer, default: 1)
- `per_page` (integer, default: 15)
- `sort` (string: 'name', 'created_at')

**Response**:
```json
{
    "data": [
        {
            "id": 1,
            "name": "Web Development",
            "description": "...",
            "icon": "fas fa-globe",
            "order": 1
        }
    ],
    "meta": {
        "total": 10,
        "per_page": 15,
        "current_page": 1
    }
}
```

#### Create Service
**POST** `/services`

**Parameters**:
- `name` (string, required)
- `description` (string, required)
- `icon` (string, optional)
- `order` (integer, optional)

#### Update Service
**PUT** `/services/{id}`

#### Delete Service
**DELETE** `/services/{id}`

### Skills

#### List Skills
**GET** `/skills`

**Query Parameters**:
- `category_id` (integer, optional)
- `page` (integer, default: 1)

**Response**:
```json
{
    "data": [
        {
            "id": 1,
            "name": "PHP",
            "percentage": 90,
            "color": "#6366f1",
            "category_id": 1,
            "category": {
                "id": 1,
                "name": "Backend"
            }
        }
    ]
}
```

#### Create Skill
**POST** `/skills`

**Parameters**:
- `skill_category_id` (integer, required)
- `name` (string, required)
- `percentage` (integer, 0-100, required)
- `color` (string hex, required)
- `icon` (string, optional)

#### Update Skill
**PUT** `/skills/{id}`

#### Delete Skill
**DELETE** `/skills/{id}`

### Experiences

#### List Experiences
**GET** `/experiences`

**Response**:
```json
{
    "data": [
        {
            "id": 1,
            "job_title": "Senior Developer",
            "company_name": "Tech Corp",
            "start_date": "2021-01-15",
            "end_date": null,
            "is_current": true
        }
    ]
}
```

#### Create Experience
**POST** `/experiences`

**Parameters**:
- `job_title` (string, required)
- `company_name` (string, required)
- `description` (string, optional)
- `start_date` (date, required)
- `end_date` (date, optional)
- `is_current` (boolean, optional)

### Portfolio

#### List Portfolios
**GET** `/portfolios`

**Query Parameters**:
- `category` (string slug, optional)
- `featured` (boolean, optional)
- `page` (integer, default: 1)

**Response**:
```json
{
    "data": [
        {
            "id": 1,
            "title": "Project Title",
            "slug": "project-title",
            "description": "...",
            "thumbnail": "/storage/portfolios/image.jpg",
            "client_name": "Client Name",
            "technologies": "Laravel, Vue.js",
            "github_url": "https://github.com/...",
            "live_url": "https://project.com",
            "is_featured": true,
            "category": {
                "id": 1,
                "name": "Web"
            },
            "images": [
                {
                    "id": 1,
                    "image_path": "/storage/portfolio-images/img1.jpg"
                }
            ]
        }
    ]
}
```

#### Get Single Portfolio
**GET** `/portfolios/{slug}`

#### Create Portfolio
**POST** `/portfolios`

**Parameters**:
- `portfolio_category_id` (integer, required)
- `title` (string, required)
- `description` (string, required)
- `full_description` (string, optional)
- `thumbnail` (file, optional)
- `client_name` (string, optional)
- `technologies` (string, optional)
- `github_url` (URL, optional)
- `live_url` (URL, optional)
- `project_date` (date, optional)
- `is_featured` (boolean, optional)
- `images[]` (file array, optional)

### Blog

#### List Blogs
**GET** `/blogs`

**Query Parameters**:
- `category` (string slug, optional)
- `tag` (string slug, optional)
- `search` (string, optional)
- `page` (integer, default: 1)

**Response**:
```json
{
    "data": [
        {
            "id": 1,
            "title": "Blog Title",
            "slug": "blog-title",
            "description": "...",
            "content": "...",
            "thumbnail": "/storage/blogs/image.jpg",
            "views": 150,
            "is_published": true,
            "published_at": "2024-01-15T10:30:00Z",
            "author": {
                "id": 1,
                "name": "John Doe"
            },
            "category": {
                "id": 1,
                "name": "Technology"
            },
            "tags": [
                {
                    "id": 1,
                    "name": "Laravel"
                }
            ]
        }
    ]
}
```

#### Get Single Blog
**GET** `/blogs/{slug}`

#### Create Blog
**POST** `/blogs`

**Parameters**:
- `blog_category_id` (integer, required)
- `title` (string, required)
- `description` (string, required)
- `content` (string, required)
- `thumbnail` (file, optional)
- `meta_title` (string, optional)
- `meta_description` (string, optional)
- `is_published` (boolean, optional)
- `tags[]` (integer array, optional)

#### Update Blog
**PUT** `/blogs/{id}`

#### Delete Blog
**DELETE** `/blogs/{id}`

### Contact

#### Submit Contact Form
**POST** `/contact`

**Parameters**:
- `name` (string, required)
- `email` (email, required)
- `subject` (string, required)
- `message` (string, required, min: 10 characters)

**Response**:
```json
{
    "success": true,
    "message": "Message sent successfully"
}
```

## Error Responses

### Validation Error
```json
{
    "success": false,
    "message": "Validation failed",
    "errors": {
        "name": ["The name field is required"],
        "email": ["The email must be a valid email address"]
    }
}
```

### Unauthorized
```json
{
    "message": "Unauthenticated."
}
```

### Not Found
```json
{
    "success": false,
    "message": "Resource not found"
}
```

### Server Error
```json
{
    "message": "Server Error",
    "errors": "..."
}
```

## Rate Limiting

API requests are rate limited to:
- **60 requests per minute** for authenticated users
- **20 requests per minute** for unauthenticated users

## Pagination

All list endpoints support pagination:

```
GET /api/portfolios?page=1&per_page=15
```

**Response includes meta data**:
```json
{
    "data": [...],
    "meta": {
        "total": 100,
        "per_page": 15,
        "current_page": 1,
        "last_page": 7,
        "from": 1,
        "to": 15
    }
}
```

## Sorting

Use `sort` parameter:
```
GET /api/portfolios?sort=-created_at
```

Supported sorts:
- `name` / `-name`
- `created_at` / `-created_at`
- `updated_at` / `-updated_at`
- `views` / `-views`

## Filtering

Many endpoints support filtering:

```
GET /api/portfolios?featured=true&category=web
```

## Examples

### JavaScript/Fetch

```javascript
// Get all portfolios
fetch('https://yourdomain.com/api/portfolios')
    .then(response => response.json())
    .then(data => console.log(data));

// Create a new portfolio
fetch('https://yourdomain.com/api/portfolios', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer YOUR_TOKEN'
    },
    body: JSON.stringify({
        portfolio_category_id: 1,
        title: 'My Project',
        description: 'Project description',
        technologies: 'Laravel, Vue.js'
    })
})
.then(response => response.json())
.then(data => console.log(data));
```

### cURL

```bash
# Get portfolios
curl -X GET "https://yourdomain.com/api/portfolios" \
  -H "Accept: application/json"

# Create portfolio
curl -X POST "https://yourdomain.com/api/portfolios" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"portfolio_category_id": 1, "title": "My Project"}'
```

---

**Last Updated**: 2024
**API Version**: 1.0
