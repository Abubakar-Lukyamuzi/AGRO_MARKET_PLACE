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