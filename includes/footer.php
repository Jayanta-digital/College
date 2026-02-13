    <!-- Main Footer -->
    <footer class="main-footer">
        <div class="container">
            <div class="footer-grid">
                <!-- About Section -->
                <div class="footer-column">
                    <h3>About Excellence Institute</h3>
                    <p>Excellence Institute, established in 1972, is a premier educational institution committed to providing quality higher education. Accredited by NAAC with A++ Grade, we strive for academic excellence and holistic development of our students.</p>
                    <div class="social-links">
                        <a href="https://www.facebook.com" target="_blank" title="Facebook">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="https://www.twitter.com" target="_blank" title="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.instagram.com" target="_blank" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://www.youtube.com" target="_blank" title="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="https://www.linkedin.com" target="_blank" title="LinkedIn">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="index.php"><i class="fas fa-angle-right"></i> Home</a></li>
                        <li><a href="about.php"><i class="fas fa-angle-right"></i> About Us</a></li>
                        <li><a href="portal/admission.php"><i class="fas fa-angle-right"></i> Admission</a></li>
                        <li><a href="results.php"><i class="fas fa-angle-right"></i> Results</a></li>
                        <li><a href="events.php"><i class="fas fa-angle-right"></i> Events</a></li>
                        <li><a href="gallery.php"><i class="fas fa-angle-right"></i> Gallery</a></li>
                        <li><a href="contact.php"><i class="fas fa-angle-right"></i> Contact Us</a></li>
                    </ul>
                </div>

                <!-- Important Links -->
                <div class="footer-column">
                    <h3>Important Links</h3>
                    <ul class="footer-links">
                        <li><a href="https://www.ugc.ac.in/" target="_blank"><i class="fas fa-external-link-alt"></i> UGC</a></li>
                        <li><a href="http://www.naac.gov.in/" target="_blank"><i class="fas fa-external-link-alt"></i> NAAC</a></li>
                        <li><a href="https://www.gauhati.ac.in/" target="_blank"><i class="fas fa-external-link-alt"></i> Gauhati University</a></li>
                        <li><a href="https://antiragging.in/" target="_blank"><i class="fas fa-external-link-alt"></i> Anti-Ragging</a></li>
                        <li><a href="https://saksham.ugc.ac.in/" target="_blank"><i class="fas fa-external-link-alt"></i> Women Safety</a></li>
                        <li><a href="iqac.php"><i class="fas fa-angle-right"></i> IQAC</a></li>
                        <li><a href="nirf.php"><i class="fas fa-angle-right"></i> NIRF</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="footer-column">
                    <h3>Contact Us</h3>
                    <div class="contact-info">
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <strong>Address</strong>
                                <p>City Center, State<br>PIN: 123456, India</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <div>
                                <strong>Phone</strong>
                                <p>+91-9876543210<br>+91-9876543211</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <strong>Email</strong>
                                <p>info@excellenceinstitute.edu<br>admission@excellenceinstitute.edu</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <strong>Office Hours</strong>
                                <p>Mon - Fri: 9:00 AM - 5:00 PM<br>Sat: 9:00 AM - 2:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="footer-bottom-content">
                    <p>&copy; <?php echo date('Y'); ?> Excellence Institute. All Rights Reserved.</p>
                    <div class="footer-bottom-links">
                        <a href="privacy-policy.php">Privacy Policy</a>
                        <span>|</span>
                        <a href="terms-conditions.php">Terms & Conditions</a>
                        <span>|</span>
                        <a href="sitemap.php">Sitemap</a>
                    </div>
                    <p class="developer-credit">
                        Designed & Developed by <a href="http://sstechindia.com/" target="_blank">S.S. Technologies</a>
                    </p>
                </div>
            </div>

            <!-- Visitor Counter -->
            <div class="visitor-counter">
                <i class="fas fa-users"></i> Visitors: 
                <span class="counter-number">125,847</span>
            </div>
        </div>
    </footer>

    <!-- JavaScript Files -->
    <script src="assets/js/main.js"></script>
    
    <!-- Optional: Add any page-specific scripts here -->
    <?php if (isset($additional_js)): ?>
        <?php foreach ($additional_js as $js): ?>
            <script src="<?php echo $js; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
