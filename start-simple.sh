#!/bin/bash

# Start a simple PHP server to display the explanation page
echo "Starting PHP server on http://localhost:8000"
echo "NOTE: This will only serve the explanation page."
echo "      To run the actual theme, you need WordPress."
echo ""
echo "Press Ctrl+C to stop the server."
echo ""

# Check if PHP is installed
if ! command -v php &> /dev/null; then
    echo "Error: PHP is not installed. Please install PHP first."
    exit 1
fi

# Start PHP's built-in server
php -S localhost:8000 