<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daraz Best Deals Finder</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        header {
            text-align: center;
            padding: 30px 0;
        }

        h1 {
            color: #f57224;
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #666;
            font-size: 1.1rem;
        }

        .search-box {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .search-form {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }

        .search-input {
            flex: 1;
            min-width: 250px;
            padding: 15px 25px;
            font-size: 1.1rem;
            border: 2px solid #ddd;
            border-radius: 50px;
            outline: none;
            transition: border-color 0.3s;
        }

        .search-input:focus {
            border-color: #f57224;
        }

        .pages-select {
            padding: 15px 20px;
            font-size: 1rem;
            border: 2px solid #ddd;
            border-radius: 50px;
            outline: none;
            background: white;
            cursor: pointer;
        }

        .pages-select:focus {
            border-color: #f57224;
        }

        .search-btn {
            padding: 15px 40px;
            font-size: 1.1rem;
            background: #f57224;
            color: white;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
        }

        .search-btn:hover {
            background: #d4611f;
            transform: translateY(-2px);
        }

        .loading {
            text-align: center;
            padding: 50px;
            display: none;
        }

        .loading.show {
            display: block;
        }

        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #f57224;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .filter-box {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .filter-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .filter-title {
            font-weight: 600;
            color: #333;
            font-size: 1.1rem;
        }

        .filter-reset {
            background: none;
            border: none;
            color: #f57224;
            cursor: pointer;
            font-size: 0.9rem;
            text-decoration: underline;
        }

        .filter-reset:hover {
            color: #d4611f;
        }

        /* Range Slider Styles */
        .range-slider-container {
            margin-bottom: 25px;
        }

        .range-slider {
            position: relative;
            height: 40px;
            margin: 0 10px;
        }

        .range-slider input[type="range"] {
            position: absolute;
            width: 100%;
            height: 8px;
            background: none;
            pointer-events: none;
            -webkit-appearance: none;
            appearance: none;
            top: 50%;
            transform: translateY(-50%);
        }

        .range-slider input[type="range"]::-webkit-slider-runnable-track {
            width: 100%;
            height: 8px;
            background: transparent;
            border-radius: 4px;
        }

        .range-slider input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 24px;
            height: 24px;
            background: #f57224;
            border-radius: 50%;
            cursor: pointer;
            pointer-events: all;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
            border: 3px solid white;
            margin-top: -8px;
            transition: transform 0.15s, box-shadow 0.15s;
        }

        .range-slider input[type="range"]::-webkit-slider-thumb:hover {
            transform: scale(1.1);
            box-shadow: 0 3px 10px rgba(0,0,0,0.3);
        }

        .range-slider input[type="range"]::-webkit-slider-thumb:active {
            transform: scale(1.15);
            background: #d4611f;
        }

        .range-slider input[type="range"]::-moz-range-track {
            width: 100%;
            height: 8px;
            background: transparent;
            border-radius: 4px;
        }

        .range-slider input[type="range"]::-moz-range-thumb {
            width: 24px;
            height: 24px;
            background: #f57224;
            border-radius: 50%;
            cursor: pointer;
            pointer-events: all;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
            border: 3px solid white;
            transition: transform 0.15s, box-shadow 0.15s;
        }

        .range-slider input[type="range"]::-moz-range-thumb:hover {
            transform: scale(1.1);
            box-shadow: 0 3px 10px rgba(0,0,0,0.3);
        }

        .slider-track {
            position: absolute;
            width: 100%;
            height: 8px;
            background: #e0e0e0;
            border-radius: 4px;
            top: 50%;
            transform: translateY(-50%);
        }

        .slider-range {
            position: absolute;
            height: 8px;
            background: linear-gradient(90deg, #f57224, #e74c3c);
            border-radius: 4px;
            top: 50%;
            transform: translateY(-50%);
        }

        .price-labels {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            font-size: 0.85rem;
            color: #888;
        }

        .price-range-container {
            display: flex;
            gap: 20px;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .price-input-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .price-input-group label {
            color: #666;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .price-input-wrapper {
            position: relative;
        }

        .price-input-wrapper::before {
            content: '৳';
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
            font-size: 0.9rem;
        }

        .price-input {
            width: 130px;
            padding: 10px 15px 10px 30px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.3s;
        }

        .price-input:focus {
            border-color: #f57224;
        }

        .filter-btn {
            padding: 10px 25px;
            background: #27ae60;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.95rem;
            transition: background 0.3s, transform 0.2s;
        }

        .filter-btn:hover {
            background: #219a52;
            transform: translateY(-1px);
        }

        .price-stats {
            display: flex;
            gap: 25px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 0.9rem;
            color: #666;
            flex-wrap: wrap;
        }

        .price-stat {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #f8f9fa;
            padding: 8px 15px;
            border-radius: 20px;
        }

        .price-stat strong {
            color: #f57224;
        }

        .results-info {
            background: #fff;
            padding: 15px 25px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .results-count {
            color: #333;
            font-weight: 600;
        }

        .filtered-count {
            color: #27ae60;
            font-weight: 500;
        }

        .sort-info {
            color: #f57224;
            font-weight: 500;
        }

        .results-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }

        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .product-card.hidden {
            display: none;
        }

        .discount-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: #e74c3c;
            color: white;
            padding: 8px 12px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 0.9rem;
            z-index: 1;
        }

        .best-deal {
            background: linear-gradient(135deg, #f57224, #e74c3c);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: contain;
            background: #f9f9f9;
            padding: 10px;
        }

        .product-info {
            padding: 20px;
        }

        .product-name {
            font-size: 0.95rem;
            color: #333;
            margin-bottom: 15px;
            line-height: 1.4;
            height: 2.8em;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .product-name a {
            color: inherit;
            text-decoration: none;
        }

        .product-name a:hover {
            color: #f57224;
        }

        .price-section {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .current-price {
            font-size: 1.3rem;
            font-weight: bold;
            color: #f57224;
        }

        .original-price {
            font-size: 0.95rem;
            color: #999;
            text-decoration: line-through;
        }

        .savings {
            color: #27ae60;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .rating {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #666;
            font-size: 0.85rem;
        }

        .stars {
            color: #f1c40f;
        }

        .no-results {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 15px;
        }

        .no-results h3 {
            color: #333;
            margin-bottom: 10px;
        }

        .no-results p {
            color: #666;
        }

        .error-message {
            background: #fee;
            border: 1px solid #fcc;
            color: #c00;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 20px;
        }

        .rank-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: #27ae60;
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.9rem;
            z-index: 1;
        }

        .sold-info {
            color: #888;
            font-size: 0.8rem;
            margin-top: 5px;
        }

        .pages-info {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 10px 15px;
            border-radius: 8px;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .no-filter-results {
            text-align: center;
            padding: 40px 20px;
            background: #fff3e0;
            border-radius: 10px;
            color: #e65100;
            display: none;
        }

        .no-filter-results.show {
            display: block;
        }

        .selected-range {
            text-align: center;
            font-size: 1.1rem;
            color: #333;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .selected-range span {
            color: #f57224;
            font-weight: 700;
        }

        @media (max-width: 600px) {
            h1 {
                font-size: 1.8rem;
            }

            .search-input {
                min-width: 100%;
            }

            .search-btn {
                width: 100%;
            }

            .pages-select {
                width: 100%;
            }

            .price-input {
                width: 110px;
            }

            .price-range-container {
                flex-direction: column;
                align-items: stretch;
            }

            .price-input-group {
                justify-content: space-between;
            }

            .filter-btn {
                width: 100%;
            }

            .price-stats {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Daraz Best Deals Finder</h1>
            <p class="subtitle">Find the highest discounts on Daraz.com.bd</p>
        </header>

        <div class="search-box">
            <form class="search-form" id="searchForm" method="GET">
                <input type="text" name="q" class="search-input" placeholder="Enter product name (e.g., iPhone, Samsung TV, Laptop...)" value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>" required>
                <select name="pages" class="pages-select">
                    <option value="3" <?php echo (isset($_GET['pages']) && $_GET['pages'] == '3') ? 'selected' : ''; ?>>3 Pages (~120 products)</option>
                    <option value="5" <?php echo (!isset($_GET['pages']) || $_GET['pages'] == '5') ? 'selected' : ''; ?>>5 Pages (~200 products)</option>
                    <option value="10" <?php echo (isset($_GET['pages']) && $_GET['pages'] == '10') ? 'selected' : ''; ?>>10 Pages (~400 products)</option>
                    <option value="15" <?php echo (isset($_GET['pages']) && $_GET['pages'] == '15') ? 'selected' : ''; ?>>15 Pages (~600 products)</option>
                    <option value="20" <?php echo (isset($_GET['pages']) && $_GET['pages'] == '20') ? 'selected' : ''; ?>>20 Pages (~800 products)</option>
                </select>
                <button type="submit" class="search-btn">Search Best Deals</button>
            </form>
        </div>

        <div class="loading" id="loading">
            <div class="spinner"></div>
            <p>Searching for the best deals across multiple pages...</p>
        </div>

        <div id="results">
            <?php
            if (isset($_GET['q']) && !empty(trim($_GET['q']))) {
                $searchQuery = trim($_GET['q']);
                $pagesToFetch = isset($_GET['pages']) ? intval($_GET['pages']) : 5;
                $pagesToFetch = max(1, min(20, $pagesToFetch));

                $results = searchDaraz($searchQuery, $pagesToFetch);

                if (isset($results['error'])) {
                    echo '<div class="error-message">' . htmlspecialchars($results['error']) . '</div>';
                } elseif (empty($results['products'])) {
                    echo '<div class="no-results">
                            <h3>No products found</h3>
                            <p>Try searching with different keywords</p>
                          </div>';
                } else {
                    $products = $results['products'];
                    $pagesLoaded = $results['pagesLoaded'];
                    $minPrice = $results['minPrice'];
                    $maxPrice = $results['maxPrice'];
                    $avgPrice = $results['avgPrice'];

                    echo '<div class="pages-info">Loaded ' . $pagesLoaded . ' pages from Daraz</div>';

                    // Price Filter Box with Range Slider
                    echo '<div class="filter-box">
                            <div class="filter-header">
                                <span class="filter-title">Filter by Price Range</span>
                                <button type="button" class="filter-reset" onclick="resetPriceFilter()">Reset Filter</button>
                            </div>

                            <div class="selected-range">
                                Selected: <span id="selectedMin">৳' . number_format(floor($minPrice)) . '</span> - <span id="selectedMax">৳' . number_format(ceil($maxPrice)) . '</span>
                            </div>

                            <div class="range-slider-container">
                                <div class="range-slider">
                                    <div class="slider-track"></div>
                                    <div class="slider-range" id="sliderRange"></div>
                                    <input type="range" id="rangeMin" min="' . floor($minPrice) . '" max="' . ceil($maxPrice) . '" value="' . floor($minPrice) . '" step="1">
                                    <input type="range" id="rangeMax" min="' . floor($minPrice) . '" max="' . ceil($maxPrice) . '" value="' . ceil($maxPrice) . '" step="1">
                                </div>
                                <div class="price-labels">
                                    <span>৳' . number_format(floor($minPrice)) . '</span>
                                    <span>৳' . number_format(ceil($maxPrice)) . '</span>
                                </div>
                            </div>

                            <div class="price-range-container">
                                <div class="price-input-group">
                                    <label>Min:</label>
                                    <div class="price-input-wrapper">
                                        <input type="number" id="priceMin" class="price-input" value="' . floor($minPrice) . '" min="0" placeholder="Min">
                                    </div>
                                </div>
                                <div class="price-input-group">
                                    <label>Max:</label>
                                    <div class="price-input-wrapper">
                                        <input type="number" id="priceMax" class="price-input" value="' . ceil($maxPrice) . '" min="0" placeholder="Max">
                                    </div>
                                </div>
                                <button type="button" class="filter-btn" onclick="applyPriceFilter()">Apply Filter</button>
                            </div>

                            <div class="price-stats">
                                <div class="price-stat">Lowest: <strong>৳' . number_format($minPrice) . '</strong></div>
                                <div class="price-stat">Highest: <strong>৳' . number_format($maxPrice) . '</strong></div>
                                <div class="price-stat">Average: <strong>৳' . number_format($avgPrice) . '</strong></div>
                            </div>
                          </div>';

                    echo '<div class="results-info">
                            <span class="results-count">Found <span id="totalCount">' . count($products) . '</span> products</span>
                            <span class="filtered-count" id="filteredCount" style="display:none;">Showing <span id="visibleCount">0</span> products in price range</span>
                            <span class="sort-info">Sorted by highest discount %</span>
                          </div>';

                    echo '<div class="no-filter-results" id="noFilterResults">
                            <h3>No products in this price range</h3>
                            <p>Try adjusting the min/max values</p>
                          </div>';

                    echo '<div class="results-grid" id="productsGrid">';

                    $rank = 1;
                    foreach ($products as $product) {
                        $discountClass = $rank <= 3 ? 'best-deal' : '';
                        $discount = $product['discount'];
                        $currentPrice = $product['price'];
                        $originalPrice = $product['originalPrice'];
                        $savings = $originalPrice - $currentPrice;

                        echo '<div class="product-card" data-price="' . $currentPrice . '">';
                        if ($rank <= 10) {
                            echo '<div class="rank-badge">#' . $rank . '</div>';
                        }
                        if ($discount > 0) {
                            echo '<div class="discount-badge ' . $discountClass . '">' . $discount . '% OFF</div>';
                        }
                        echo '<img src="' . htmlspecialchars($product['image']) . '" alt="' . htmlspecialchars($product['name']) . '" class="product-image" loading="lazy">';
                        echo '<div class="product-info">';
                        echo '<h3 class="product-name"><a href="' . htmlspecialchars($product['url']) . '" target="_blank">' . htmlspecialchars($product['name']) . '</a></h3>';
                        echo '<div class="price-section">';
                        echo '<span class="current-price">৳' . number_format($currentPrice) . '</span>';
                        if ($originalPrice > $currentPrice) {
                            echo '<span class="original-price">৳' . number_format($originalPrice) . '</span>';
                        }
                        echo '</div>';
                        if ($savings > 0) {
                            echo '<div class="savings">You save ৳' . number_format($savings) . '</div>';
                        }
                        if (!empty($product['rating'])) {
                            echo '<div class="rating">';
                            echo '<span class="stars">★</span>';
                            echo '<span>' . number_format($product['rating'], 1) . '</span>';
                            if (!empty($product['reviews'])) {
                                echo '<span>(' . $product['reviews'] . ' reviews)</span>';
                            }
                            echo '</div>';
                        }
                        if (!empty($product['sold'])) {
                            echo '<div class="sold-info">' . htmlspecialchars($product['sold']) . '</div>';
                        }
                        echo '</div></div>';
                        $rank++;
                    }

                    echo '</div>';

                    // Store original min/max for reset
                    echo '<script>
                        var originalMinPrice = ' . floor($minPrice) . ';
                        var originalMaxPrice = ' . ceil($maxPrice) . ';
                    </script>';
                }
            }

            function searchDaraz($query, $pagesToFetch = 5) {
                $encodedQuery = urlencode($query);
                $allProducts = [];
                $pagesLoaded = 0;
                $seenIds = [];

                $multiHandle = curl_multi_init();
                $curlHandles = [];

                for ($page = 1; $page <= $pagesToFetch; $page++) {
                    $url = "https://www.daraz.com.bd/catalog/?ajax=true&q=" . $encodedQuery . "&page=" . $page;

                    $ch = curl_init();
                    curl_setopt_array($ch, [
                        CURLOPT_URL => $url,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_SSL_VERIFYPEER => false,
                        CURLOPT_HTTPHEADER => [
                            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                            'Accept: application/json, text/plain, */*',
                            'Accept-Language: en-US,en;q=0.5',
                            'X-Requested-With: XMLHttpRequest',
                            'Connection: keep-alive',
                        ]
                    ]);

                    curl_multi_add_handle($multiHandle, $ch);
                    $curlHandles[$page] = $ch;
                }

                $running = null;
                do {
                    curl_multi_exec($multiHandle, $running);
                    curl_multi_select($multiHandle);
                } while ($running > 0);

                foreach ($curlHandles as $page => $ch) {
                    $response = curl_multi_getcontent($ch);
                    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                    if ($httpCode === 200 && $response) {
                        $jsonData = json_decode($response, true);

                        if (isset($jsonData['mods']['listItems']) && is_array($jsonData['mods']['listItems'])) {
                            $pagesLoaded++;

                            foreach ($jsonData['mods']['listItems'] as $item) {
                                $itemId = $item['itemId'] ?? $item['nid'] ?? null;
                                if ($itemId && isset($seenIds[$itemId])) {
                                    continue;
                                }
                                if ($itemId) {
                                    $seenIds[$itemId] = true;
                                }

                                $currentPrice = floatval($item['price'] ?? 0);
                                $originalPrice = floatval($item['originalPrice'] ?? $currentPrice);
                                $discount = 0;

                                if ($originalPrice > 0 && $currentPrice > 0 && $originalPrice > $currentPrice) {
                                    $discount = round((($originalPrice - $currentPrice) / $originalPrice) * 100);
                                }

                                $productUrl = '';
                                if (!empty($item['itemUrl'])) {
                                    $productUrl = $item['itemUrl'];
                                    if (strpos($productUrl, '//') === 0) {
                                        $productUrl = 'https:' . $productUrl;
                                    }
                                }

                                $allProducts[] = [
                                    'name' => $item['name'] ?? 'Unknown Product',
                                    'price' => $currentPrice,
                                    'originalPrice' => $originalPrice,
                                    'discount' => $discount,
                                    'image' => $item['image'] ?? '',
                                    'url' => $productUrl,
                                    'rating' => floatval($item['ratingScore'] ?? 0),
                                    'reviews' => $item['review'] ?? '',
                                    'sold' => $item['itemSoldCntShow'] ?? ''
                                ];
                            }
                        }
                    }

                    curl_multi_remove_handle($multiHandle, $ch);
                    curl_close($ch);
                }

                curl_multi_close($multiHandle);

                if (empty($allProducts)) {
                    return ['error' => 'No products found. Please try a different search term.'];
                }

                // Calculate price statistics
                $prices = array_column($allProducts, 'price');
                $minPrice = min($prices);
                $maxPrice = max($prices);
                $avgPrice = array_sum($prices) / count($prices);

                // Sort by discount percentage (highest first)
                usort($allProducts, function($a, $b) {
                    return $b['discount'] - $a['discount'];
                });

                return [
                    'products' => $allProducts,
                    'pagesLoaded' => $pagesLoaded,
                    'minPrice' => $minPrice,
                    'maxPrice' => $maxPrice,
                    'avgPrice' => $avgPrice
                ];
            }
            ?>
        </div>
    </div>

    <script>
        document.getElementById('searchForm').addEventListener('submit', function() {
            document.getElementById('loading').classList.add('show');
            document.getElementById('results').style.opacity = '0.5';
        });

        // Range Slider functionality
        var rangeMin = document.getElementById('rangeMin');
        var rangeMax = document.getElementById('rangeMax');
        var priceMin = document.getElementById('priceMin');
        var priceMax = document.getElementById('priceMax');
        var sliderRange = document.getElementById('sliderRange');
        var selectedMin = document.getElementById('selectedMin');
        var selectedMax = document.getElementById('selectedMax');

        function formatPrice(price) {
            return '৳' + parseInt(price).toLocaleString('en-IN');
        }

        function updateSliderRange() {
            if (!rangeMin || !rangeMax || !sliderRange) return;

            var min = parseInt(rangeMin.min);
            var max = parseInt(rangeMin.max);
            var minVal = parseInt(rangeMin.value);
            var maxVal = parseInt(rangeMax.value);

            var percentMin = ((minVal - min) / (max - min)) * 100;
            var percentMax = ((maxVal - min) / (max - min)) * 100;

            sliderRange.style.left = percentMin + '%';
            sliderRange.style.width = (percentMax - percentMin) + '%';

            // Update selected range display
            if (selectedMin) selectedMin.textContent = formatPrice(minVal);
            if (selectedMax) selectedMax.textContent = formatPrice(maxVal);
        }

        function syncInputsFromSliders() {
            if (priceMin) priceMin.value = rangeMin.value;
            if (priceMax) priceMax.value = rangeMax.value;
            updateSliderRange();
        }

        function syncSlidersFromInputs() {
            if (rangeMin && priceMin) {
                var minVal = Math.max(parseInt(rangeMin.min), Math.min(parseInt(priceMin.value) || 0, parseInt(rangeMax.value)));
                rangeMin.value = minVal;
                priceMin.value = minVal;
            }
            if (rangeMax && priceMax) {
                var maxVal = Math.min(parseInt(rangeMax.max), Math.max(parseInt(priceMax.value) || 0, parseInt(rangeMin.value)));
                rangeMax.value = maxVal;
                priceMax.value = maxVal;
            }
            updateSliderRange();
        }

        if (rangeMin && rangeMax) {
            rangeMin.addEventListener('input', function() {
                var minVal = parseInt(rangeMin.value);
                var maxVal = parseInt(rangeMax.value);

                if (minVal > maxVal) {
                    rangeMin.value = maxVal;
                }
                syncInputsFromSliders();
            });

            rangeMax.addEventListener('input', function() {
                var minVal = parseInt(rangeMin.value);
                var maxVal = parseInt(rangeMax.value);

                if (maxVal < minVal) {
                    rangeMax.value = minVal;
                }
                syncInputsFromSliders();
            });

            // Apply filter on mouse up (after dragging)
            rangeMin.addEventListener('change', applyPriceFilter);
            rangeMax.addEventListener('change', applyPriceFilter);

            // Initialize slider range
            updateSliderRange();
        }

        if (priceMin) {
            priceMin.addEventListener('input', syncSlidersFromInputs);
            priceMin.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    syncSlidersFromInputs();
                    applyPriceFilter();
                }
            });
        }

        if (priceMax) {
            priceMax.addEventListener('input', syncSlidersFromInputs);
            priceMax.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    syncSlidersFromInputs();
                    applyPriceFilter();
                }
            });
        }

        function applyPriceFilter() {
            var minPrice = parseFloat(document.getElementById('priceMin')?.value) || 0;
            var maxPrice = parseFloat(document.getElementById('priceMax')?.value) || Infinity;

            var products = document.querySelectorAll('.product-card');
            var visibleCount = 0;

            products.forEach(function(card) {
                var price = parseFloat(card.getAttribute('data-price'));
                if (price >= minPrice && price <= maxPrice) {
                    card.classList.remove('hidden');
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
                }
            });

            // Update counts
            var visibleCountEl = document.getElementById('visibleCount');
            var filteredCountEl = document.getElementById('filteredCount');
            if (visibleCountEl) visibleCountEl.textContent = visibleCount;
            if (filteredCountEl) filteredCountEl.style.display = 'inline';

            // Show/hide no results message
            var noResults = document.getElementById('noFilterResults');
            var grid = document.getElementById('productsGrid');
            if (visibleCount === 0) {
                if (noResults) noResults.classList.add('show');
                if (grid) grid.style.display = 'none';
            } else {
                if (noResults) noResults.classList.remove('show');
                if (grid) grid.style.display = 'grid';
            }
        }

        function resetPriceFilter() {
            if (typeof originalMinPrice === 'undefined' || typeof originalMaxPrice === 'undefined') return;

            if (priceMin) priceMin.value = originalMinPrice;
            if (priceMax) priceMax.value = originalMaxPrice;
            if (rangeMin) rangeMin.value = originalMinPrice;
            if (rangeMax) rangeMax.value = originalMaxPrice;

            updateSliderRange();

            var products = document.querySelectorAll('.product-card');
            products.forEach(function(card) {
                card.classList.remove('hidden');
            });

            var filteredCountEl = document.getElementById('filteredCount');
            if (filteredCountEl) filteredCountEl.style.display = 'none';

            var noResults = document.getElementById('noFilterResults');
            if (noResults) noResults.classList.remove('show');

            var grid = document.getElementById('productsGrid');
            if (grid) grid.style.display = 'grid';
        }
    </script>
</body>
</html>
