#!/bin/bash

# Dark Theme Simplicity - Test Script
# This script helps verify that theme files load correctly and checks for common issues

# Text formatting
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
BOLD='\033[1m'
NC='\033[0m' # No Color

# Check if running in the correct directory
if [ ! -f "style.css" ] || [ ! -f "functions.php" ]; then
    echo -e "${RED}Error:${NC} This script must be run from the theme root directory."
    echo "Current directory: $(pwd)"
    echo "Please navigate to the theme directory and try again."
    exit 1
fi

echo -e "${BLUE}${BOLD}Dark Theme Simplicity - Theme Test Script${NC}"
echo "====================================="
echo ""

# Function to check if a file exists
check_file() {
    if [ -f "$1" ]; then
        echo -e "${GREEN}✓${NC} $1 exists"
        return 0
    else
        echo -e "${RED}✗${NC} $1 is missing"
        return 1
    fi
}

# Function to check if a directory exists
check_dir() {
    if [ -d "$1" ]; then
        echo -e "${GREEN}✓${NC} $1 directory exists"
        return 0
    else
        echo -e "${RED}✗${NC} $1 directory is missing"
        return 1
    fi
}

# Function to check PHP syntax
check_syntax() {
    if command -v php > /dev/null; then
        if php -l "$1" > /dev/null 2>&1; then
            echo -e "${GREEN}✓${NC} $1 syntax is valid"
            return 0
        else
            echo -e "${RED}✗${NC} $1 has syntax errors:"
            php -l "$1" | grep -v "No syntax errors"
            return 1
        fi
    else
        echo -e "${YELLOW}!${NC} PHP command not available, skipping syntax check for $1"
        return 0
    fi
}

# Function to search for specific text in files
grep_check() {
    local pattern="$1"
    local file="$2"
    local message="$3"
    
    if grep -q "$pattern" "$file"; then
        echo -e "${GREEN}✓${NC} $message"
        return 0
    else
        echo -e "${RED}✗${NC} $message"
        return 1
    fi
}

# Check required theme files
echo -e "${BOLD}Checking required theme files:${NC}"
check_file "style.css"
check_file "functions.php"
check_file "index.php"
check_file "page.php"
check_file "single.php"
check_file "header.php"
check_file "footer.php"
check_file "sidebar.php"
echo ""

# Check required directories
echo -e "${BOLD}Checking required directories:${NC}"
check_dir "inc"
check_dir "css"
check_dir "js"
echo ""

# Check included files
echo -e "${BOLD}Checking included files:${NC}"
check_file "inc/admin.php"
check_file "inc/customizer.php"
check_file "inc/customizer-setup.php"
check_file "inc/enqueue.php"
check_file "inc/accessibility.php"
echo ""

# Check PHP syntax
echo -e "${BOLD}Checking PHP syntax:${NC}"
check_syntax "functions.php"
check_syntax "page.php"
check_syntax "sidebar.php"
check_syntax "inc/admin.php"
check_syntax "inc/customizer.php"
check_syntax "inc/customizer-setup.php"
check_syntax "inc/enqueue.php"
check_syntax "inc/accessibility.php"
echo ""

# Check for duplicate function definitions
echo -e "${BOLD}Checking for duplicate function definitions:${NC}"
echo "This may take a moment..."

# Create a temporary file to store function names
tmpfile=$(mktemp)

# Find all function definitions
grep -r "function " --include="*.php" . | grep -v "\(\/\/\|\/\*\|echo\|printf\)" | sed 's/.*function \([a-zA-Z0-9_]*\).*/\1/' | sort > "$tmpfile"

# Find duplicates
duplicates=$(uniq -d "$tmpfile")

if [ -z "$duplicates" ]; then
    echo -e "${GREEN}✓${NC} No duplicate function definitions found"
else
    echo -e "${RED}✗${NC} Duplicate function definitions found:"
    echo "$duplicates"
    
    # Show the files containing each duplicate function
    echo ""
    echo "Files containing duplicate functions:"
    for func in $duplicates; do
        echo "Function: $func"
        grep -l "function $func" --include="*.php" .
        echo ""
    done
fi

# Clean up
rm "$tmpfile"
echo ""

# Check for important theme settings
echo -e "${BOLD}Checking theme settings:${NC}"

# Check for widget visibility settings
grep_check "dark_theme_simplicity_default_show_widgets" "inc/customizer.php" "Widget visibility setting found in customizer.php"
grep_check "_show_sidebar_widgets" "page.php" "Widget visibility meta usage found in page.php"
grep_check "_show_sidebar_widgets" "sidebar.php" "Widget visibility meta usage found in sidebar.php"

# Check for meta box registration
grep_check "dark_theme_simplicity_add_page_meta_boxes" "inc/admin.php" "Page meta box registration found in admin.php"
grep_check "dark_theme_simplicity_page_settings_callback" "inc/admin.php" "Page meta box callback found in admin.php"
grep_check "dark_theme_simplicity_save_page_settings" "inc/admin.php" "Page meta box save function found in admin.php"

# Check for include statements
grep_check "require_once.*inc/enqueue.php" "functions.php" "Enqueue.php is included in functions.php"
grep_check "require_once.*inc/admin.php" "functions.php" "Admin.php is included in functions.php"
grep_check "require_once.*inc/customizer-setup.php" "functions.php" "Customizer-setup.php is included in functions.php"
grep_check "require_once.*inc/accessibility.php" "functions.php" "Accessibility.php is included in functions.php"

echo ""
echo -e "${BLUE}${BOLD}Test completed!${NC}"
echo "====================================="
echo "Please review any issues flagged above and address them."
echo "For more detailed troubleshooting, refer to debugging-guide.md"

exit 0 