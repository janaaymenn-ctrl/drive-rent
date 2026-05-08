<?php
require_once 'config/db.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drive Rent - Your Premium Car Rental Service</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Navigation -->
    <header>
        <div class="header-container">
            <a href="index.php" class="logo">
                <i class="fas fa-car"></i>
                Drive Rent
            </a>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="pages/vehicles.php">Our Vehicles</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a href="pages/dashboard.php">Dashboard</a></li>
                        <?php if ($_SESSION['user_type'] === 'admin'): ?>
                            <li><a href="admin/index.php">Admin Panel</a></li>
                        <?php endif; ?>
                        <li><a href="pages/logout.php" class="btn btn-danger">Logout</a></li>
                    <?php else: ?>
                        <li><a href="pages/login.php" class="btn btn-outline">Login</a></li>
                        <li><a href="pages/register.php" class="btn btn-primary">Sign Up</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Welcome to Drive Rent</h1>
            <p>Your Premier Car Rental Experience</p>
            <p>Browse our fleet of premium vehicles and book your ride today</p>
            <a href="pages/vehicles.php" class="btn btn-outline">Browse Vehicles</a>
        </div>
    </section>

    <!-- Featured Vehicles -->
    <section class="vehicles-section">
        <div class="container">
            <h2 class="section-title">Featured Vehicles</h2>
            <div class="vehicles-grid">
                <?php
                // Fetch featured vehicles
                $query = "SELECT * FROM vehicles WHERE status = 'available' LIMIT 6";
                $result = $conn->query($query);

                if ($result && $result->num_rows > 0) {
                    while ($vehicle = $result->fetch_assoc()) {
                        echo '<div class="vehicle-card" data-type="' . htmlspecialchars($vehicle['vehicle_type']) . '" data-price="' . $vehicle['price_per_day'] . '">';
                        echo '<img src="' . htmlspecialchars($vehicle['image_url'] ?: 'https://via.placeholder.com/300x200?text=Vehicle') . '" alt="' . htmlspecialchars($vehicle['vehicle_name']) . '" class="vehicle-image">';
                        echo '<div class="vehicle-info">';
                        echo '<h3 class="vehicle-name">' . htmlspecialchars($vehicle['vehicle_name']) . '</h3>';
                        echo '<p class="vehicle-type">' . htmlspecialchars($vehicle['vehicle_type']) . '</p>';
                        echo '<div class="vehicle-specs">';
                        echo '<div class="spec"><i class="fas fa-users"></i> ' . $vehicle['capacity'] . ' Seats</div>';
                        echo '<div class="spec"><i class="fas fa-gas-pump"></i> ' . htmlspecialchars($vehicle['fuel_type']) . '</div>';
                        echo '<div class="spec"><i class="fas fa-cogs"></i> ' . htmlspecialchars($vehicle['transmission']) . '</div>';
                        echo '<div class="spec"><i class="fas fa-palette"></i> ' . htmlspecialchars($vehicle['color']) . '</div>';
                        echo '</div>';
                        echo '<p class="vehicle-price'>\$' . number_format($vehicle['price_per_day'], 2) . '<span> / day</span></p>';
                        echo '<div class="vehicle-actions">';
                        echo '<a href="pages/vehicle-detail.php?id=' . $vehicle['id'] . '" class="btn btn-secondary">View Details</a>';
                        echo isset($_SESSION['user_id']) ? '<a href="pages/booking.php?vehicle_id=' . $vehicle['id'] . '" class="btn btn-primary">Book Now</a>' : '<a href="pages/login.php" class="btn btn-primary">Book Now</a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No vehicles available at the moment.</p>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="about-section">
        <div class="container">
            <h2 class="section-title">Why Choose Drive Rent?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-star"></i></div>
                    <h3>Premium Fleet</h3>
                    <p>Choose from our wide selection of well-maintained luxury and economy vehicles</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-clock"></i></div>
                    <h3>24/7 Support</h3>
                    <p>Our dedicated customer service team is always ready to help you</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-lock"></i></div>
                    <h3>Safe & Secure</h3>
                    <p>Your safety and security are our top priorities with insured vehicles</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-tag"></i></div>
                    <h3>Best Prices</h3>
                    <p>Competitive rates and flexible payment options for all budgets</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-map"></i></div>
                    <h3>Multiple Locations</h3>
                    <p>Pick up and drop off at multiple convenient locations</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-check"></i></div>
                    <h3>Easy Booking</h3>
                    <p>Simple and quick online booking process with instant confirmation</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="about-section">
        <div class="container">
            <h2 class="section-title">Get In Touch</h2>
            <div class="about-content">
                <div class="about-text">
                    <h3>Contact Information</h3>
                    <p><i class="fas fa-map-marker-alt"></i> <strong>Address:</strong> 123 Main Street, City, State 12345</p>
                    <p><i class="fas fa-phone"></i> <strong>Phone:</strong> +1 (555) 123-4567</p>
                    <p><i class="fas fa-envelope"></i> <strong>Email:</strong> info@driverent.com</p>
                    <p><i class="fas fa-clock"></i> <strong>Hours:</strong> 24/7</p>
                </div>
                <form method="POST" class="booking-form">
                    <h3>Send Us a Message</h3>
                    <div class="form-group">
                        <input type="text" placeholder="Your Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" placeholder="Your Email" required>
                    </div>
                    <div class="form-group">
                        <textarea placeholder="Your Message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div>
                    <h4>About Drive Rent</h4>
                    <p>We provide premium car rental services with a commitment to customer satisfaction and safety.</p>
                </div>
                <div>
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="pages/vehicles.php">Vehicles</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4>Support</h4>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Insurance Info</a></li>
                    </ul>
                </div>
                <div>
                    <h4>Follow Us</h4>
                    <div style="display: flex; gap: 1rem; font-size: 1.5rem;">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 Drive Rent. All rights reserved. | Designed with <i class="fas fa-heart"></i> by Our Team</p>
            </div>
        </div>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>