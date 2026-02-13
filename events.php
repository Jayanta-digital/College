<?php
require_once 'config/database.php';
require_once 'includes/functions.php';

$events = getLatestEvents(50); // Get last 50 events
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events - Excellence Institute</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 0;
            text-align: center;
        }
        
        .page-header h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }
        
        .breadcrumb {
            display: flex;
            justify-content: center;
            gap: 10px;
            font-size: 14px;
            opacity: 0.9;
            margin-top: 10px;
        }
        
        .breadcrumb a {
            color: white;
            text-decoration: none;
        }
        
        .events-container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 0 20px;
        }
        
        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }
        
        .event-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .event-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-xl);
        }
        
        .event-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            position: relative;
        }
        
        .event-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .event-date-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--accent-color);
            color: white;
            padding: 10px 15px;
            border-radius: 10px;
            font-weight: 700;
            text-align: center;
            min-width: 70px;
        }
        
        .event-date-day {
            font-size: 24px;
            line-height: 1;
        }
        
        .event-date-month {
            font-size: 12px;
            text-transform: uppercase;
        }
        
        .event-content {
            padding: 25px;
        }
        
        .event-category {
            display: inline-block;
            background: var(--bg-light);
            color: var(--primary-color);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .event-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 12px;
            line-height: 1.4;
        }
        
        .event-description {
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .event-meta {
            display: flex;
            gap: 20px;
            font-size: 13px;
            color: var(--text-light);
            padding-top: 15px;
            border-top: 1px solid var(--border-color);
        }
        
        .event-meta i {
            color: var(--accent-color);
            margin-right: 5px;
        }
        
        .event-link {
            display: inline-block;
            margin-top: 15px;
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        
        .event-link:hover {
            color: var(--accent-color);
        }
        
        .filter-section {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: var(--shadow-md);
            margin-bottom: 30px;
        }
        
        .filter-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }
        
        .filter-btn {
            padding: 10px 20px;
            border: 2px solid var(--border-color);
            background: white;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            color: var(--text-dark);
        }
        
        .filter-btn:hover,
        .filter-btn.active {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }
        
        .no-events {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-light);
        }
        
        .no-events i {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.3;
        }
        
        @media (max-width: 768px) {
            .events-grid {
                grid-template-columns: 1fr;
            }
            
            .page-header h1 {
                font-size: 28px;
            }
        }
        
        /* Modal for event details */
        .event-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .event-modal.active {
            display: flex;
        }
        
        .modal-content {
            background: white;
            max-width: 800px;
            width: 100%;
            border-radius: 20px;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
        }
        
        .modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.9);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: none;
            font-size: 20px;
            cursor: pointer;
            z-index: 10;
            color: var(--text-dark);
            transition: all 0.3s ease;
        }
        
        .modal-close:hover {
            background: var(--danger-color);
            color: white;
        }
        
        .modal-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 20px 20px 0 0;
        }
        
        .modal-body {
            padding: 40px;
        }
    </style>
</head>
<body>
    <div class="page-header">
        <h1><i class="fas fa-calendar-alt"></i> Events & Activities</h1>
        <p>Stay updated with our latest events and programs</p>
        <div class="breadcrumb">
            <a href="index.php">Home</a> <span>/</span> <span>Events</span>
        </div>
    </div>
    
    <div class="container">
        <div class="events-container">
            <!-- Filter Section -->
            <div class="filter-section">
                <div class="filter-buttons">
                    <button class="filter-btn active" data-filter="all">
                        <i class="fas fa-th"></i> All Events
                    </button>
                    <button class="filter-btn" data-filter="cultural">
                        <i class="fas fa-music"></i> Cultural
                    </button>
                    <button class="filter-btn" data-filter="academic">
                        <i class="fas fa-graduation-cap"></i> Academic
                    </button>
                    <button class="filter-btn" data-filter="sports">
                        <i class="fas fa-trophy"></i> Sports
                    </button>
                    <button class="filter-btn" data-filter="seminar">
                        <i class="fas fa-chalkboard-teacher"></i> Seminars
                    </button>
                    <button class="filter-btn" data-filter="workshop">
                        <i class="fas fa-tools"></i> Workshops
                    </button>
                    <button class="filter-btn" data-filter="social">
                        <i class="fas fa-hands-helping"></i> Social
                    </button>
                </div>
            </div>

            <!-- Events Grid -->
            <?php if (empty($events)): ?>
            <div class="no-events">
                <i class="fas fa-calendar-times"></i>
                <h3>No Events Found</h3>
                <p>Please check back later for upcoming events</p>
            </div>
            <?php else: ?>
            <div class="events-grid">
                <?php foreach ($events as $event): 
                    $event_date = new DateTime($event['date']);
                    $event_day = $event_date->format('d');
                    $event_month = $event_date->format('M');
                    $event_year = $event_date->format('Y');
                ?>
                <div class="event-card" data-category="cultural">
                    <div class="event-image">
                        <img src="<?php echo $event['image_url']; ?>" alt="<?php echo htmlspecialchars($event['title']); ?>">
                        <div class="event-date-badge">
                            <div class="event-date-day"><?php echo $event_day; ?></div>
                            <div class="event-date-month"><?php echo $event_month; ?></div>
                        </div>
                    </div>
                    
                    <div class="event-content">
                        <span class="event-category">
                            <i class="fas fa-tag"></i> Cultural Event
                        </span>
                        
                        <h3 class="event-title">
                            <?php echo htmlspecialchars($event['title']); ?>
                        </h3>
                        
                        <p class="event-description">
                            <?php echo htmlspecialchars($event['description']); ?>
                        </p>
                        
                        <div class="event-meta">
                            <span>
                                <i class="fas fa-calendar"></i>
                                <?php echo $event_date->format('d M Y'); ?>
                            </span>
                            <span>
                                <i class="fas fa-map-marker-alt"></i>
                                College Campus
                            </span>
                        </div>
                        
                        <a href="#" class="event-link" onclick="openEventModal(<?php echo $event['id']; ?>); return false;">
                            Read More <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            
            <div style="text-align: center; margin-top: 50px;">
                <a href="index.php" class="btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Home
                </a>
            </div>
        </div>
    </div>
    
    <!-- Event Modal -->
    <div class="event-modal" id="eventModal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeEventModal()">
                <i class="fas fa-times"></i>
            </button>
            <img src="assets/images/events/event1.jpg" alt="Event" class="modal-image" id="modalImage">
            <div class="modal-body">
                <span class="event-category" id="modalCategory">
                    <i class="fas fa-tag"></i> Cultural Event
                </span>
                <h2 id="modalTitle">Event Title</h2>
                <div class="event-meta" style="margin: 20px 0;">
                    <span id="modalDate">
                        <i class="fas fa-calendar"></i> Date
                    </span>
                    <span>
                        <i class="fas fa-map-marker-alt"></i> College Campus
                    </span>
                </div>
                <p id="modalDescription">Event description goes here...</p>
            </div>
        </div>
    </div>
    
    <br><br>
    
    <?php include 'includes/footer.php'; ?>
    
    <script>
        // Filter functionality
        const filterBtns = document.querySelectorAll('.filter-btn');
        const eventCards = document.querySelectorAll('.event-card');
        
        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Remove active class from all buttons
                filterBtns.forEach(b => b.classList.remove('active'));
                // Add active class to clicked button
                this.classList.add('active');
                
                const filter = this.getAttribute('data-filter');
                
                eventCards.forEach(card => {
                    if (filter === 'all' || card.getAttribute('data-category') === filter) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
        
        // Modal functions
        function openEventModal(eventId) {
            const modal = document.getElementById('eventModal');
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
            
            // Here you would typically fetch event details via AJAX
            // For demo, we'll just show the modal
        }
        
        function closeEventModal() {
            const modal = document.getElementById('eventModal');
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }
        
        // Close modal on outside click
        document.getElementById('eventModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEventModal();
            }
        });
        
        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeEventModal();
            }
        });
    </script>
</body>
</html>
