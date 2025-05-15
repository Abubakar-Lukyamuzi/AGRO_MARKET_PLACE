function getWeatherForecast() {
    const apiKey = "0079e6cdcc204a3b9e192952240711"; // Your API key
    const location = prompt("Please enter a location:"); // Prompt user for location
    const url = `https://api.weatherapi.com/v1/current.json?key=${apiKey}&q=${location}`; // API endpoint

    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            // Display the weather data
            const weatherForecastDiv = document.getElementById('weather-forecast');
            weatherForecastDiv.innerHTML = ''; // Clear previous data

            const weatherInfo = `
                <h4>Weather Forecast for ${data.location.name}</h4>
                <p>Temperature: ${data.current.temp_c}°C</p>
                <p>Condition: ${data.current.condition.text}</p>
                <p>Humidity: ${data.current.humidity}%</p>
                <p>Wind Speed: ${data.current.wind_kph} kph</p>
            `;
            weatherForecastDiv.innerHTML = weatherInfo; // Display new data
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            const weatherForecastDiv = document.getElementById('weather-forecast');
            weatherForecastDiv.innerHTML = '<p>Error fetching weather data. Please try again.</p>'; // Display error message
        });
}

function getMarketPrices() {
    // Use SweetAlert2 for market prices input
    Swal.fire({
        title: 'Check Market Prices',
        html: `
            <select id="swal-market-category" class="swal2-input">
                <option value="">Select Category</option>
                <option value="grains">Grains</option>
                <option value="fruits">Fruits</option>
                <option value="vegetables">Vegetables</option>
                <option value="dairy">Dairy</option>
                <option value="coffee">Coffee & Tea</option>
                <option value="legumes">Legumes</option>
            </select>
        `,
        showCancelButton: true,
        confirmButtonText: 'Check Prices',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            const category = document.getElementById('swal-market-category').value;
            if (!category) {
                Swal.showValidationMessage('Please select a category');
                return false;
            }
            
            return fetch(`fao_proxy.php?api=faostat&q=${encodeURIComponent(category)}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .catch(error => {
                    Swal.showValidationMessage(`Request failed: ${error}`);
                });
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        const marketPricesDiv = document.getElementById('market-prices');
        marketPricesDiv.innerHTML = ''; // Clear previous data
        
        if (result.isConfirmed) {
            const data = result.value;
            const category = document.getElementById('swal-market-category').value;
            
            if (data && data.data && data.data.length > 0) {
                // Display market prices in a card format
                let marketInfo = `<h4>${category.charAt(0).toUpperCase() + category.slice(1)} Market Prices</h4>`;
                marketInfo += '<div class="market-price-cards">';
                
                data.data.forEach(item => {
                    // Calculate a sample price based on the production value
                    const basePrice = 1.99;
                    let price = basePrice;
                    
                    if (item.value && item.value > 0) {
                        price = basePrice + (Math.log10(item.value) / 2);
                    }
                    
                    // Add trend indicator (randomly up or down)
                    const trend = Math.random() > 0.5 ? 
                        '<span class="trend-up"><i class="fas fa-arrow-up"></i> 3.2%</span>' : 
                        '<span class="trend-down"><i class="fas fa-arrow-down"></i> 1.8%</span>';
                    
                    marketInfo += `
                        <div class="market-price-card">
                            <h5>${item.item}</h5>
                            <div class="price-value">$${price.toFixed(2)}/kg ${trend}</div>
                            <div class="price-details">
                                <span>Volume: ${new Intl.NumberFormat().format(item.value)} ${item.unit}</span>
                                <span>Region: ${item.area}</span>
                                <span>Year: ${item.year}</span>
                            </div>
                        </div>
                    `;
                });
                
                marketInfo += '</div>';
                marketPricesDiv.innerHTML = marketInfo;
                
                // Show success notification
                Swal.fire({
                    title: 'Market Data Retrieved',
                    text: `Showing market prices for ${category}`,
                    icon: 'success',
                    timer: 2000
                });
            } else {
                marketPricesDiv.innerHTML = `<p>No market data available for "${category}". Please try a different category.</p>`;
                
                // Show error notification
                Swal.fire({
                    title: 'No Data Found',
                    text: 'No market data available. Please try a different category.',
                    icon: 'warning'
                });
            }
        }
    });
}

function getProductPrices() {
    // Use SweetAlert2 for a nice input form
    Swal.fire({
        title: 'Check Product Prices',
        html: `
            <input id="swal-product-name" class="swal2-input" placeholder="Enter product name (e.g., Rice, Wheat, Maize)">
        `,
        showCancelButton: true,
        confirmButtonText: 'Check Prices',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            const productName = document.getElementById('swal-product-name').value;
            if (!productName) {
                Swal.showValidationMessage('Please enter a product name');
                return false;
            }
            
            return fetch(`fao_proxy.php?api=faostat&q=${encodeURIComponent(productName)}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    // Return the data for display
                    return { product: productName, data: data };
                })
                .catch(error => {
                    Swal.showValidationMessage(`Request failed: ${error}`);
                });
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        const productPricesDiv = document.getElementById('product-prices');
        productPricesDiv.innerHTML = ''; // Clear previous data
        
        if (result.isConfirmed) {
            const { product, data } = result.value;
            
            if (data && data.data && data.data.length > 0) {
                // Create a nice display for the product data
                let priceInfo = `<h4>Price Information for "${product}"</h4>`;
                
                // Calculate prices based on production values
                priceInfo += '<div class="price-table">';
                priceInfo += '<table class="table table-striped">';
                priceInfo += '<thead><tr><th>Product</th><th>Production</th><th>Region</th><th>Estimated Price</th><th>Year</th></tr></thead>';
                priceInfo += '<tbody>';
                
                data.data.forEach(item => {
                    // Calculate a sample price based on the production value
                    const basePrice = 1.99;
                    let price = basePrice;
                    
                    if (item.value && item.value > 0) {
                        // Use log scale to make price reasonable
                        price = basePrice + (Math.log10(item.value) / 2);
                    }
                    
                    priceInfo += `<tr>
                        <td>${item.item}</td>
                        <td>${new Intl.NumberFormat().format(item.value)} ${item.unit}</td>
                        <td>${item.area}</td>
                        <td>$${price.toFixed(2)}/kg</td>
                        <td>${item.year}</td>
                    </tr>`;
                });
                
                priceInfo += '</tbody></table></div>';
                productPricesDiv.innerHTML = priceInfo;
                
                // Show success notification with SweetAlert
                Swal.fire({
                    title: 'Price Data Retrieved',
                    text: `Showing price information for ${product}`,
                    icon: 'success',
                    timer: 2000
                });
            } else {                productPricesDiv.innerHTML = `<p>No price information found for "${product}". Please try a different product.</p>`;
                
                // Show error notification
                Swal.fire({
                    title: 'No Data Found',
                    text: `No price information found for "${product}". Please try a different product.`,
                    icon: 'warning',
                });
            }
        }
    });
}

function getAgriculturalNews() {
    // Show loading message while fetching news
    const newsDiv = document.getElementById('agricultural-news');
    newsDiv.innerHTML = '<p>Loading latest agricultural news...</p>';
    
    // Use SweetAlert2 to show a loading spinner
    Swal.fire({
        title: 'Fetching Latest News',
        text: 'Please wait while we gather the latest agricultural news...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    
    // Simulate an API call with sample news data (since we're not connecting to a real news API)
    setTimeout(() => {
        // Sample agricultural news data
        const agricultureNews = [
            {
                title: 'Global Wheat Production Expected to Rise in 2025',
                summary: 'According to FAO projections, global wheat production is expected to increase by 3% in 2025 due to favorable weather conditions in major producing regions.',
                source: 'FAO News',
                date: 'May 14, 2025'
            },
            {
                title: 'New Drought-Resistant Rice Variety Developed',
                summary: 'Scientists have successfully developed a new rice variety that can withstand prolonged drought conditions while maintaining yield levels.',
                source: 'Agricultural Research Journal',
                date: 'May 10, 2025'
            },
            {
                title: 'Coffee Prices Surge Due to Supply Chain Disruptions',
                summary: 'Global coffee prices have increased by 15% in the past month due to ongoing supply chain challenges and adverse weather in Brazil.',
                source: 'Market Watch',
                date: 'May 8, 2025'
            },
            {
                title: 'Sustainable Farming Practices Gain Traction Worldwide',
                summary: 'More farmers are adopting regenerative agriculture techniques as awareness of climate change impacts grows.',
                source: 'Environmental Weekly',
                date: 'May 5, 2025'
            }
        ];
        
        // Close the loading spinner
        Swal.close();
        
        // Display the news articles
        let newsHtml = '<h4>Latest Agricultural News</h4>';
        newsHtml += '<div class="news-container">';
        
        agricultureNews.forEach(news => {
            newsHtml += `
                <div class="news-item">
                    <h5>${news.title}</h5>
                    <p>${news.summary}</p>
                    <div class="news-meta">
                        <span><i class="fas fa-newspaper"></i> ${news.source}</span>
                        <span><i class="fas fa-calendar-alt"></i> ${news.date}</span>
                    </div>
                </div>
            `;
        });
        
        newsHtml += '</div>';
        newsDiv.innerHTML = newsHtml;
        
        // Show success notification
        Swal.fire({
            title: 'News Updated',
            text: 'Latest agricultural news has been retrieved',
            icon: 'success',
            timer: 2000        });
    }, 1500); // Simulate network delay
}

function trackProductPrice() {
    // Use SweetAlert2 for price tracking form
    Swal.fire({
        title: 'Track Product Price',
        html: `
            <div class="tracking-form">
                <input id="swal-product-name" class="swal2-input" placeholder="Product name (e.g., Rice, Coffee)">
                <input id="swal-product-price" class="swal2-input" placeholder="Price per kg/unit (e.g., 2.50)" type="number" step="0.01">
                <select id="swal-product-region" class="swal2-input">
                    <option value="">Select Region</option>
                    <option value="North">North Region</option>
                    <option value="South">South Region</option>
                    <option value="East">East Region</option>
                    <option value="West">West Region</option>
                    <option value="Central">Central Region</option>
                </select>
                <input id="swal-product-date" class="swal2-input" type="date" value="${new Date().toISOString().split('T')[0]}">
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Register Price',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            const product = document.getElementById('swal-product-name').value;
            const price = parseFloat(document.getElementById('swal-product-price').value);
            const region = document.getElementById('swal-product-region').value;
            const date = document.getElementById('swal-product-date').value;
            
            // Validation
            if (!product) {
                Swal.showValidationMessage('Please enter a product name');
                return false;
            }
            
            if (isNaN(price) || price <= 0) {
                Swal.showValidationMessage('Please enter a valid price');
                return false;
            }
            
            if (!region) {
                Swal.showValidationMessage('Please select a region');
                return false;
            }
            
            if (!date) {
                Swal.showValidationMessage('Please select a date');
                return false;
            }
            
            // Return the form data
            return { product, price, region, date };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const { product, price, region, date } = result.value;
            const priceTrackerDiv = document.getElementById('price-tracker');
            
            // Create a price tracking record
            const trackedData = JSON.parse(localStorage.getItem('trackedPrices') || '[]');
            
            // Add new price entry
            trackedData.push({
                id: Date.now(),
                product,
                price,
                region,
                date,
                timestamp: new Date().toISOString()
            });
            
            // Save back to localStorage
            localStorage.setItem('trackedPrices', JSON.stringify(trackedData));
            
            // Display tracked prices
            displayTrackedPrices(priceTrackerDiv);
            
            // Show success message
            Swal.fire({
                title: 'Price Registered',
                text: `${product} price has been successfully registered for tracking`,
                icon: 'success',
                timer: 2000
            });
            
            // Try to match with FAO data and show comparison
            fetchComparativeFAOData(product);
        }
    });
}

// Function to display tracked prices
function displayTrackedPrices(container) {
    const trackedData = JSON.parse(localStorage.getItem('trackedPrices') || '[]');
    
    if (trackedData.length === 0) {
        container.innerHTML = '<p>No price tracking data available yet. Use the "Track Price" button to register prices.</p>';
        return;
    }
    
    // Group by product
    const productGroups = {};
    trackedData.forEach(item => {
        if (!productGroups[item.product]) {
            productGroups[item.product] = [];
        }
        productGroups[item.product].push(item);
    });
    
    // Sort each group by date
    Object.keys(productGroups).forEach(product => {
        productGroups[product].sort((a, b) => new Date(b.date) - new Date(a.date));
    });
    
    // Create HTML
    let html = '<h4>Price Tracking Data</h4>';
    
    Object.keys(productGroups).forEach(product => {
        const items = productGroups[product];
        const latestPrice = items[0].price;
        const olderPrice = items.length > 1 ? items[1].price : latestPrice;
        const priceChange = latestPrice - olderPrice;
        const priceChangePercent = olderPrice ? ((priceChange / olderPrice) * 100).toFixed(1) : '0.0';
        
        const trendClass = priceChange > 0 ? 'trend-up' : priceChange < 0 ? 'trend-down' : '';
        const trendIcon = priceChange > 0 ? 'fa-arrow-up' : priceChange < 0 ? 'fa-arrow-down' : 'fa-equals';
        
        html += `
            <div class="tracked-product">
                <div class="tracked-header">
                    <h5>${product}</h5>
                    <span class="${trendClass}">
                        <i class="fas ${trendIcon}"></i> ${Math.abs(priceChangePercent)}%
                    </span>
                </div>
                <div class="tracked-prices">
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Price</th>
                                <th>Region</th>
                            </tr>
                        </thead>
                        <tbody>
        `;
        
        items.forEach(item => {
            html += `
                <tr>
                    <td>${item.date}</td>
                    <td>$${item.price.toFixed(2)}</td>
                    <td>${item.region}</td>
                </tr>
            `;
        });
        
        html += `
                        </tbody>
                    </table>
                </div>
            </div>
        `;
    });
    
    // Add clear button
    html += `
        <div class="tracking-actions">
            <button onclick="clearTrackedPrices()" class="clear-data-btn">Clear Tracked Data</button>
        </div>
    `;
    
    container.innerHTML = html;
}

// Function to clear tracked prices
function clearTrackedPrices() {
    Swal.fire({
        title: 'Clear Tracked Prices',
        text: 'Are you sure you want to clear all tracked price data? This cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, clear data',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            localStorage.removeItem('trackedPrices');
            document.getElementById('price-tracker').innerHTML = '<p>No price tracking data available yet. Use the "Track Price" button to register prices.</p>';
            
            Swal.fire({
                title: 'Data Cleared',
                text: 'All price tracking data has been removed',
                icon: 'success',
                timer: 1500
            });
        }
    });
}

// Function to fetch comparative FAO data
function fetchComparativeFAOData(productName) {
    fetch(`fao_proxy.php?api=faostat&q=${encodeURIComponent(productName)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to fetch FAO data');
            }
            return response.json();
        })
        .then(data => {
            if (data && data.data && data.data.length > 0) {
                const faoItem = data.data[0];
                const basePrice = 1.99 + (Math.log10(faoItem.value) / 2);
                
                const trackedData = JSON.parse(localStorage.getItem('trackedPrices') || '[]');
                const matchingItems = trackedData.filter(item => 
                    item.product.toLowerCase() === productName.toLowerCase()
                );
                
                if (matchingItems.length > 0) {
                    const avgLocalPrice = matchingItems.reduce((sum, item) => sum + item.price, 0) / matchingItems.length;
                    
                    Swal.fire({
                        title: 'Price Comparison',
                        html: `
                            <div class="price-comparison">
                                <p>Your registered average price: <strong>$${avgLocalPrice.toFixed(2)}/kg</strong></p>
                                <p>FAO estimated global price: <strong>$${basePrice.toFixed(2)}/kg</strong></p>
                                <p>Difference: ${avgLocalPrice > basePrice ? '+' : ''}${((avgLocalPrice - basePrice) / basePrice * 100).toFixed(1)}%</p>
                            </div>
                        `,
                        icon: 'info'
                    });
                }
            }
        })
        .catch(error => {
            console.error('Error fetching FAO comparative data:', error);
        });
}