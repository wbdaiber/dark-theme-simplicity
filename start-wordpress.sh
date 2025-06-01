#!/bin/bash

# Start WordPress using Docker
echo "Starting WordPress with Docker..."
echo "This will mount the theme directory into WordPress and make it available at http://localhost:8000"

# Check if Docker is installed
if ! command -v docker &> /dev/null; then
    echo "Error: Docker is not installed. Please install Docker first."
    echo "Visit https://docs.docker.com/get-docker/ for installation instructions."
    exit 1
fi

# Check if docker-compose is installed
if ! command -v docker-compose &> /dev/null; then
    echo "Error: docker-compose is not installed. Please install docker-compose first."
    echo "Visit https://docs.docker.com/compose/install/ for installation instructions."
    exit 1
fi

# Start the containers
docker-compose up -d

if [ $? -eq 0 ]; then
    echo "✅ WordPress started successfully!"
    echo "📂 Theme mounted at: /var/www/html/wp-content/themes/dark-theme-simplicity"
    echo "🌐 WordPress: http://localhost:8000"
    echo "🔧 phpMyAdmin: http://localhost:8080"
    echo ""
    echo "To complete setup:"
    echo "1. Visit http://localhost:8000 and complete the WordPress installation"
    echo "2. Go to Appearance > Themes and activate 'Dark Theme Simplicity'"
    echo ""
    echo "To stop WordPress: docker-compose down"
else
    echo "❌ Failed to start WordPress. Please check the error message above."
fi 