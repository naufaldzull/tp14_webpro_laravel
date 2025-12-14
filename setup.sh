#!/bin/bash

# Setup script untuk fix Laravel loading lambat

echo "🔧 Setting up Laravel project..."

# 1. Create empty database.sqlite file
echo "📁 Creating database.sqlite file..."
touch database/database.sqlite
echo "✅ database.sqlite created"

# 2. Clear Laravel caches
echo "🧹 Clearing Laravel caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
echo "✅ Caches cleared"

echo ""
echo "✅ Setup complete!"
echo ""
echo "📝 Next steps:"
echo "1. Make sure Express.js is running on port 3000"
echo "2. Check .env file has: EXPRESS_API_URL=http://127.0.0.1:3000"
echo "3. Run: php artisan serve"
echo ""
