<?php
require_once 'config/db.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Drive Rent</title>
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
                    <li><a href="index.php#contact">Contact</a></li>
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
            <h1>About Drive Rent</h1>
            <p>Your Trusted Partner in Premium Car Rentals</p>
        </div>
    </section>

    <!-- About Content -->
    <section class="about-section">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2>Who We Are</h2>
                    <p>Drive Rent is a leading car rental company dedicated to providing premium vehicles and exceptional customer service. With over a decade of experience in the industry, we have built a reputation for reliability, quality, and customer satisfaction.</p>
                    <p>Our mission is to make car rental accessible, affordable, and hassle-free for everyone. Whether you need a vehicle for business, leisure, or special occasions, we have the perfect ride for you.</p>
                    <p>We pride ourselves on our diverse fleet of well-maintained vehicles, competitive pricing, and round-the-clock customer support to ensure your rental experience is nothing short of exceptional.</p>
                </div>
                <img src="https://via.placeholder.com/400x300?text=About+Drive+Rent" alt="About Drive Rent" class="about-image">
            </div>
        </div>
    </section>

    <!-- Our Mission & Vision -->
    <section class="about-section" style="background-color: #f8f9fa;">
        <div class="container">
            <h2 class="section-title">Our Mission & Vision</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-bullseye"></i></div>
                    <h3>Our Mission</h3>
                    <p>To provide high-quality, affordable car rental services that exceed customer expectations while maintaining the highest standards of safety and reliability.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-telescope"></i></div>
                    <h3>Our Vision</h3>
                    <p>To be the most trusted and preferred car rental company, known for exceptional service, innovative solutions, and commitment to customer satisfaction.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-heart"></i></div>
                    <h3>Our Values</h3>
                    <p>Integrity, customer-focused service, reliability, innovation, and environmental responsibility guide all our business decisions and operations.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="about-section">
        <div class="container">
            <h2 class="section-title">Why Choose Drive Rent?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-check-circle"></i></div>
                    <h3>Wide Vehicle Selection</h3>
                    <p>From economy cars to luxury vehicles, we have options for every budget and occasion.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-dollar-sign"></i></div>
                    <h3>Competitive Pricing</h3>
                    <p>Best rates in the market with transparent pricing and no hidden charges.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                    <h3>Comprehensive Insurance</h3>
                    <p>All vehicles come with comprehensive insurance coverage for your peace of mind.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-headset"></i></div>
                    <h3>24/7 Support</h3>
                    <p>Our dedicated support team is available around the clock to assist you.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-tachometer-alt"></i></div>
                    <h3>Well-Maintained Fleet</h3>
                    <p>All vehicles undergo regular maintenance and inspection to ensure safety and reliability.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-mobile-alt"></i></div>
                    <h3>Easy Online Booking</h3>
                    <p>Simple, secure, and fast booking process with instant confirmation.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Team -->
    <section class="about-section" style="background-color: #f8f9fa;">
        <div class="container">
            <h2 class="section-title">Meet Our Team</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-user-tie"></i></div>
                    <h3>John Doe</h3>
                    <p><strong>CEO & Founder</strong></p>
                    <p>With 15 years of industry experience, John leads Drive Rent with vision and dedication.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-user-tie"></i></div>
                    <h3>Sarah Smith</h3>
                    <p><strong>Operations Manager</strong></p>
                    <p>Sarah ensures our fleet runs smoothly and customers receive exceptional service.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-user-tie"></i></div>
                    <h3>Mike Johnson</h3>
                    <p><strong>Customer Service Director</strong></p>
                    <p>Mike and his team are committed to making every customer interaction positive.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics -->
    <section class="about-section">
        <div class="container">
            <h2 class="section-title">By The Numbers</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon" style="color: #dc3545; font-size: 2.5rem;">50+</div>
                    <h3>Vehicles</h3>
                    <p>Modern, well-maintained vehicles in our fleet</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon" style="color: #dc3545; font-size: 2.5rem;">10K+</div>
                    <h3>Happy Customers</h3>
                    <p>Satisfied customers who trust us with their transportation</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon" style="color: #dc3545; font-size: 2.5rem;">5</div>
                    <h3>Locations</h3>
                    <p>Convenient pickup and drop-off locations throughout the region</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon" style="color: #dc3545; font-size: 2.5rem;">10+</div>
                    <h3>Years</h3>
                    <p>Of experience serving customers with excellence</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="about-section" style="background-color: #f8f9fa;">
        <div class="container">
            <h2 class="section-title">Customer Testimonials</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <p style="margin-bottom: 1rem;"><i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i></p>
                    <p>"Drive Rent provided excellent service! The car was clean, well-maintained, and the booking process was seamless."</p>
                    <p><strong>- Emma Wilson</strong></p>
                </div>
                <div class="feature-card">
                    <p style="margin-bottom: 1rem;"><i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i></p>
                    <p>"Best car rental experience ever! Competitive prices, friendly staff, and professional service throughout my stay."</p>
                    <p><strong>- James Brown</strong></p>
                </div>
                <div class="feature-card">
                    <p style="margin-bottom: 1rem;"><i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i></p>
                    <p>"Highly recommend Drive Rent! Great vehicle selection, affordable rates, and excellent customer support."</p>
                    <p><strong>- Lisa Martinez</strong></p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="about-section" style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); color: white;">
        <div class="container" style="text-align: center;">
            <h2 style="color: white; margin-bottom: 1.5rem;">Ready to Rent Your Perfect Car?</h2>
            <p style="margin-bottom: 2rem; font-size: 1.1rem;">Browse our fleet and book your vehicle today!</p>
            <a href="pages/vehicles.php" class="btn btn-outline">Browse Vehicles</a>
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
                        <li><a href="index.php#contact">Contact</a></li>
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