<?php
session_start();
require_once '../config/database.php';
require_once '../includes/functions.php';

// Check if logged in
if (!isset($_SESSION['student_id'])) {
    header('Location: student.php');
    exit;
}

$student_id = $_SESSION['student_id'];
$student_name = $_SESSION['student_name'];
$roll_number = $_SESSION['roll_number'];

// Fetch student results
$results = getStudentResults($student_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: var(--bg-light);
        }
        
        .dashboard-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #1e40af 100%);
            color: white;
            padding: 30px 0;
            margin-bottom: 30px;
        }
        
        .dashboard-header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .welcome-text h1 {
            font-size: 28px;
            margin-bottom: 5px;
        }
        
        .welcome-text p {
            opacity: 0.9;
        }
        
        .logout-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 10px 25px;
            border-radius: 25px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }
        
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .dashboard-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
        }
        
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }
        
        .card-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 15px;
        }
        
        .card-icon.blue {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .card-icon.green {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }
        
        .card-icon.orange {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }
        
        .card-icon.purple {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            color: white;
        }
        
        .card-title {
            font-size: 14px;
            color: var(--text-light);
            margin-bottom: 5px;
        }
        
        .card-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-dark);
        }
        
        .section-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 20px;
        }
        
        .results-table {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: var(--shadow-md);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        table thead tr {
            background: var(--bg-light);
        }
        
        table th,
        table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }
        
        table th {
            font-weight: 600;
            color: var(--primary-color);
        }
        
        table tbody tr:hover {
            background: var(--bg-light);
        }
        
        .badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }
        
        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }
        
        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
        }
        
        .quick-links {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        
        .quick-link-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
            text-decoration: none;
            color: var(--text-dark);
        }
        
        .quick-link-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
            color: var(--primary-color);
        }
        
        .quick-link-card i {
            font-size: 40px;
            margin-bottom: 10px;
            color: var(--primary-color);
        }
    </style>
</head>
<body>
    <div class="dashboard-header">
        <div class="container">
            <div class="welcome-text">
                <h1>Welcome, <?php echo htmlspecialchars($student_name); ?>!</h1>
                <p>Roll Number: <?php echo htmlspecialchars($roll_number); ?></p>
            </div>
            <a href="logout.php" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>
    
    <div class="container">
        <div class="dashboard-grid">
            <div class="dashboard-card">
                <div class="card-icon blue">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="card-title">Total Courses</div>
                <div class="card-value">8</div>
            </div>
            
            <div class="dashboard-card">
                <div class="card-icon green">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="card-title">Current CGPA</div>
                <div class="card-value">8.5</div>
            </div>
            
            <div class="dashboard-card">
                <div class="card-icon orange">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="card-title">Attendance</div>
                <div class="card-value">85%</div>
            </div>
            
            <div class="dashboard-card">
                <div class="card-icon purple">
                    <i class="fas fa-trophy"></i>
                </div>
                <div class="card-title">Rank</div>
                <div class="card-value">12</div>
            </div>
        </div>
        
        <h2 class="section-title">Examination Results</h2>
        <div class="results-table">
            <?php if (empty($results)): ?>
                <p>No results available yet.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Semester</th>
                            <th>Examination</th>
                            <th>Date</th>
                            <th>Total Marks</th>
                            <th>Obtained Marks</th>
                            <th>Percentage</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $result): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($result['semester']); ?></td>
                            <td><?php echo htmlspecialchars($result['exam_name']); ?></td>
                            <td><?php echo date('d M Y', strtotime($result['exam_date'])); ?></td>
                            <td><?php echo $result['total_marks']; ?></td>
                            <td><?php echo $result['obtained_marks']; ?></td>
                            <td><?php echo number_format($result['percentage'], 2); ?>%</td>
                            <td>
                                <?php
                                $status = $result['status'];
                                $badgeClass = $status === 'Pass' ? 'badge-success' : ($status === 'Fail' ? 'badge-danger' : 'badge-warning');
                                ?>
                                <span class="badge <?php echo $badgeClass; ?>">
                                    <?php echo $status; ?>
                                </span>
                            </td>
                            <td>
                                <a href="download-result.php?id=<?php echo $result['id']; ?>" class="btn-sm">
                                    <i class="fas fa-download"></i> Download
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
        
        <h2 class="section-title" style="margin-top: 40px;">Quick Links</h2>
        <div class="quick-links">
            <a href="profile.php" class="quick-link-card">
                <i class="fas fa-user-circle"></i>
                <h3>My Profile</h3>
            </a>
            <a href="attendance.php" class="quick-link-card">
                <i class="fas fa-calendar-alt"></i>
                <h3>Attendance</h3>
            </a>
            <a href="timetable.php" class="quick-link-card">
                <i class="fas fa-clock"></i>
                <h3>Time Table</h3>
            </a>
            <a href="fees.php" class="quick-link-card">
                <i class="fas fa-money-bill"></i>
                <h3>Fee Payment</h3>
            </a>
            <a href="library.php" class="quick-link-card">
                <i class="fas fa-book"></i>
                <h3>Library</h3>
            </a>
            <a href="complaints.php" class="quick-link-card">
                <i class="fas fa-comment-dots"></i>
                <h3>Complaints</h3>
            </a>
        </div>
    </div>
    
    <br><br>
    
    <footer class="main-footer">
        <div class="container">
            <div class="footer-bottom">
                <p>&copy; 2025 Excellence Institute. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
