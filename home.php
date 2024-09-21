<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    <link rel="stylesheet" href="wao.css">
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<header>
    <nav>
        <div class="logo">
            <h1>IMS</h1>
        </div>
        <div class="dropdown">
            <button onclick="toggleDropdown()" class="dropbtn">Menu</button>
            <div id="dropdown-content" class="dropdown-content">
                <a href="index.php">Stocks</a>
                <a href="supplier.php">Branch Transfer</a>
                <a href="supplierorders.php">Supplier Orders</a>
                <a href="returnedgoods.php">Returned Orders</a>
                <a href="#" onclick="confirmLogout()">Logout</a>
            </div>
        </div>
    </nav>
</header>


    <main>
        <section class="hero">
            <div class="hero-content">
                <h2>Welcome to the Inventory Stock Management System</h2>
                <p>Streamline your inventory operations with our powerful software.</p>
            </div>
        </section>

        <section class="features">
            <div class="container">
                <h3>Key Features</h3>
                <div class="features-grid">
                    <div class="feature">
                        <span class="icon">&#128640;</span>
                        <h4>Real-Time Inventory Tracking</h4>
                        <p>Stay updated with your stock levels at all times.</p>
                    </div>
                    <div class="feature">
                        <span class="icon">&#128202;</span>
                        <h4>Report Generation</h4>
                        <p>Generate detailed reports of stock inventory value.</p>
                    </div>
                    <div class="feature">
                        <span class="icon">&#128188;</span>
                        <h4>Stock Management</h4>
                        <p>Efficiently manages orders from suppliers, branch transfer, and Returned Orders  from one place.</p>
                    </div>
                    <div class="feature">
                        <span class="icon">&#128187;</span>
                        <h4>User-Friendly Interface</h4>
                        <p>Intuitive interface for easy navigation and usage.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="inventory-overview">
            <div class="container">
                <h3>Inventory Overview</h3>
                <!-- Canvas for displaying the bar chart -->
                <canvas id="inventoryChart" width="400" height="200"></canvas>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 Inventory Management System</p>
        </div>
    </footer>

    <script>
        // Function to confirm logout
        function confirmLogout() {
            var logout = confirm("Are you sure you want to logout?");
            if (logout) {
                window.location.href = "logout.php"; // Redirect to logout page if user confirms
            }
        }

        // Function to fetch inventory data from the server
        function fetchInventoryData() {
            // Replace this with your actual AJAX call to fetch inventory data
            // For demonstration purposes, using dummy data here
            return {
                productNames: ['Boards', 'Multi colored chalks', 'White Board', 'Notebooks', 'Ballpens'],
                inventoryCounts: [50, 80, 30, 70, 90] // Dummy inventory counts
            };
        }

        // Function to create a bar chart
        function createBarChart() {
            var ctx = document.getElementById('inventoryChart').getContext('2d');
            var inventoryData = fetchInventoryData(); // Fetch inventory data
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: inventoryData.productNames,
                    datasets: [{
                        label: 'Inventory',
                        data: inventoryData.inventoryCounts,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Call the function to create the bar chart
        createBarChart();

        // Periodically update the chart with new inventory data (for demonstration purposes)
        setInterval(function() {
            var ctx = document.getElementById('inventoryChart').getContext('2d');
            var inventoryData = fetchInventoryData(); // Fetch updated inventory data
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: inventoryData.productNames,
                    datasets: [{
                        label: 'Inventory',
                        data: inventoryData.inventoryCounts,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }, 5000); // Update every 5 seconds (adjust as needed)
    </script>
</body>
</html>
