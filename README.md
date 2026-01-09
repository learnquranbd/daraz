# Daraz Best Deals Finder

A PHP-based web scraper that searches [Daraz.com.bd](https://www.daraz.com.bd) for products and displays them sorted by the highest discount percentage, helping you find the best deals.

## Features

- **Product Search**: Search for any product on Daraz.com.bd
- **Multi-page Scraping**: Fetch up to 20 pages (~800 products) in parallel
- **Discount Sorting**: Products sorted by highest discount percentage first
- **Price Range Filter**:
  - Draggable dual-thumb range slider
  - Manual min/max input fields
  - Real-time filtering without page reload
- **Product Details Display**:
  - Product image
  - Current price and original price
  - Discount percentage badge
  - Savings amount
  - Rating and reviews
  - Units sold
- **Best Deal Highlighting**: Top 3 deals get special gradient badges
- **Rank Badges**: Top 10 products show rank numbers
- **Responsive Design**: Works on desktop and mobile devices

## Screenshots

### Search Interface
The main search page with product name input and page selector.

### Results with Price Filter
Products displayed with draggable price range slider for filtering.

## Requirements

- **PHP 7.4+** (tested with PHP 8.4)
- **PHP cURL extension** enabled
- **Web server** (Apache/Nginx)

## Installation

### 1. Clone the Repository

```bash
# Clone from GitHub
git clone https://github.com/omasters/daraz.git

# Or
git clone https://github.com/learnquranbd/daraz.git
```

### 2. Move to Web Server Directory

```bash
# For Apache (common locations)
sudo cp -r daraz /var/www/html/

# Or create symlink
sudo ln -s /path/to/daraz /var/www/html/daraz
```

### 3. Verify PHP Requirements

```bash
# Check PHP version
php -v

# Check if cURL is enabled
php -m | grep curl
```

### 4. Set Permissions (if needed)

```bash
sudo chown -R www-data:www-data /var/www/html/daraz
```

## Configuration

No configuration file is needed. The application works out of the box.

### Optional: Apache Virtual Host

```apache
<VirtualHost *:80>
    ServerName daraz.local
    DocumentRoot /var/www/html/daraz

    <Directory /var/www/html/daraz>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

### Optional: Nginx Configuration

```nginx
server {
    listen 80;
    server_name daraz.local;
    root /var/www/html/daraz;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

## Usage

### 1. Access the Application

Open your browser and navigate to:
```
http://localhost/daraz/
```

### 2. Search for Products

1. Enter a product name in the search box (e.g., "laptop", "phone", "headphones")
2. Select the number of pages to fetch:
   - 3 Pages (~120 products)
   - 5 Pages (~200 products) - default
   - 10 Pages (~400 products)
   - 15 Pages (~600 products)
   - 20 Pages (~800 products)
3. Click "Search Best Deals"

### 3. Filter by Price Range

After results load, use the price filter:

**Using the Slider:**
- Drag the left thumb to set minimum price
- Drag the right thumb to set maximum price
- Filter applies automatically when you release

**Using Input Fields:**
- Type exact values in Min/Max fields
- Press Enter or click "Apply Filter"

**Reset:**
- Click "Reset Filter" to show all products

### 4. View Product Details

Each product card shows:
- **Rank Badge** (green circle): Position in discount ranking (#1-#10)
- **Discount Badge** (red/orange): Percentage off (top 3 get gradient badge)
- **Product Image**: Click to view on Daraz
- **Product Name**: Click to open product page on Daraz
- **Price**: Current price in orange, original price crossed out
- **Savings**: Amount you save in green
- **Rating**: Star rating with review count
- **Sold**: Number of units sold

## API Details

The scraper uses Daraz's internal AJAX endpoint:

```
GET https://www.daraz.com.bd/catalog/?ajax=true&q={search_term}&page={page_number}
```

### Response Structure

```json
{
  "mods": {
    "listItems": [
      {
        "name": "Product Name",
        "price": "1999",
        "originalPrice": "2999",
        "image": "https://...",
        "itemUrl": "//www.daraz.com.bd/products/...",
        "ratingScore": "4.5",
        "review": "123",
        "itemSoldCntShow": "500 sold"
      }
    ]
  }
}
```

## Project Structure

```
daraz/
├── index.php      # Main application file (frontend + backend)
├── README.md      # This documentation file
└── .gitignore     # Git ignore file
```

## How It Works

1. **Search Request**: User submits a search query
2. **Parallel Fetching**: PHP uses `curl_multi` to fetch multiple pages simultaneously
3. **Data Extraction**: JSON response is parsed to extract product data
4. **Deduplication**: Duplicate products are removed using item IDs
5. **Discount Calculation**: Discount percentage calculated from original and current prices
6. **Sorting**: Products sorted by discount percentage (highest first)
7. **Display**: Results rendered with price statistics and filter controls
8. **Client-side Filtering**: JavaScript filters products by price range without reload

## Troubleshooting

### No Results Showing

1. **Check PHP cURL**: Ensure cURL extension is enabled
   ```bash
   php -m | grep curl
   ```

2. **Check network**: Verify server can reach Daraz.com.bd
   ```bash
   curl -I https://www.daraz.com.bd
   ```

3. **Check PHP errors**: Enable error reporting
   ```php
   error_reporting(E_ALL);
   ini_set('display_errors', 1);
   ```

### Slow Loading

- Reduce the number of pages to fetch
- Check your internet connection speed
- The parallel fetching should complete in 2-5 seconds for 5 pages

### SSL Certificate Issues

If you see SSL errors, the code already has `CURLOPT_SSL_VERIFYPEER => false`. If issues persist, update your CA certificates:

```bash
sudo apt update && sudo apt install ca-certificates
```

## Limitations

- **Rate Limiting**: Daraz may rate-limit requests if too many are made
- **Data Freshness**: Prices and availability may change; data is fetched in real-time
- **Structure Changes**: If Daraz changes their API/page structure, scraper may need updates
- **Region**: Currently configured for Bangladesh (daraz.com.bd)

## Disclaimer

This tool is for educational and personal use only. It scrapes publicly available data from Daraz.com.bd. Please respect Daraz's terms of service and avoid excessive requests.

## License

MIT License - Feel free to use, modify, and distribute.

## Author

Created with the help of Claude AI (Anthropic)

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

---

**Happy Deal Hunting!**
