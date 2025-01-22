# MOVIEASY - Laravel Movie/Series/Episode Management App

This is a movie management application built with Laravel. Users can manage their movie, series and episode collection, including adding them to a list, favorites, and watchlists. The application uses a simple, dynamic interface powered by plain CSS and JavaScript.

## Technologies Used

- **PHP 8.2+**
- **Laravel Framework** (version 11.9)
- **MySQL** (for database storage)
- **Vite** (for asset management)
- **Raw SQL** (used for database queries instead of Eloquent ORM for practice)
- **Plain CSS** (no CSS frameworks like Tailwind, for practice and simplicity)
- **JavaScript** (for dynamic interactions without full page reloads)

## Features

- **User authentication:** Users can register and log in to their accounts.
- **Search, filter, sort options:** : Users can search movies by title, id, year and type, then filter the results by title asc, title desc, year asc and year desc, filter them by poster.
- **Dynamic Movie List**: Users can add movies/series/episodes to their personal list, favorites, and watchlist, see the details of the item.
- **MySQL Database**: Using raw SQL queries to handle all database interactions (no Eloquent ORM).
- **Session Management**: Sessions are used to manage user data across requests.
- **No Framework CSS**: The UI is styled with plain CSS (for practice and simplicity).
- **Vite for Asset Management**: JavaScript and CSS files are compiled using Vite.

##  External API Usage
- The application uses the OMDb API to fetch movie data, such as title, year, genre, poster, and other relevant details. This API enables filtering, searching, and displaying detailed information about movies.

- **OMDb API link:** https://www.omdbapi.com

- **API Usage:**
    - Search Functionality: Movie/series/episodes can be searched using the OMDb API by title, id, year and type criteria.
    - Data Integration: The API responses are filtered and displayed by the application, with user actions managed through session handling.
- **Configuring OMDb API:**
    - Register for an API key on the OMDb API website.
    - Set up the OMDb_API_KEY variable in the .env file:
  ```plaintext
    OMDB_API_KEY=your_api_key_here
  ```
    - Set up the OMDb_API_URL variable in the .env file:
  ```plaintext
    OMDB_API_URL=http://www.omdbapi.com/
  ```
    - The key is used in API calls to authenticate requests.

## Installation

1. Clone this repository to your local machine:
   ```bash
   git clone https://github.com/priusz/movieasy.git
2. Navigate to the project directory:
   ```bash
   cd .\laravel-app\  
3. Install the necessary PHP dependencies:
   ```bash
   composer install
4. Install the necessary frontend dependencies:
   ```bash
   npm install
5. Create a .env file from the .env.example file:
   ```bash
   cp .env.example .env  
7. Generate the application key:
   ```bash
   php artisan key:generate
9. Set up the database in your .env file and run migrations:
    ```bash
    php artisan migrate
11. Run seeders:
    ```bash
    php artisan db:seed
13. Run the development server:
    ```bash
    php artisan serve
15. For frontend assets:
    ```bash
    npm run dev

## Usage
- **Search items from the database:** Users can search/filter/sort movies/series/episodes.
- **Add to My List:** Users can add movies/series/episodes to their personal collection.
- **Add to Watchlist/Favorites:** Movies/series/episodes can also be added to a watchlist or favorites list.
- **Manage the personal collection:** IN PROCESS
- **Dynamic Updates:** The page is dynamically updated using JavaScript, so the page does not need to reload when interacting with items.

## Development Notes
- **Raw SQL:** This project uses raw SQL queries for all database interactions rather than Laravel's Eloquent ORM. This is primarily done for practice and learning purposes.
- **Plain CSS:** The project uses plain CSS for styling, avoiding CSS frameworks like Tailwind for simplicity and control over the design.
- **Session Management:** Session data is managed using Laravel's session handling, which stores the state of user actions such as which movies have been added to the list.

## Contributing
- Feel free to fork the repository and create pull requests for improvements or bug fixes. If you have suggestions for new features or want to report bugs, open an issue in the GitHub repository.
- Fork the repository.
- Create a new branch (git checkout -b feature-name).
- Commit your changes (git commit -am 'Add new feature').
- Push to the branch (git push origin feature-name).
- Create a new Pull Request.
