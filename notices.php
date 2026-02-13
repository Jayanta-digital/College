<?php
require_once 'config/database.php';
require_once 'includes/functions.php';

$notices = getLatestNotices(50); // Get last 50 notices
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notices - Excellence Institute</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .page-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #1e40af 100%);
            color: white;
            padding: 60px 0;
            text-align: center;
        }
        
        .page-header h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }
        
        .notices-list {
            max-width: 1000px;
            margin: 50px auto;
        }
        
        .notice-item {
            background: white;
            padding: 25px;
            margin-bottom: 20px;
            border-radius: 12px;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
            border-left: 4px solid var(--primary-color);
        }
        
        .notice-item:hover {
            transform: translateX(5px);
            box-shadow: var(--shadow-lg);
        }
        
        .notice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .notice-date {
            background: var(--primary-color);
            color: white;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }
        
        .notice-title {
            font-size: 18px;
            color: var(--text-dark);
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .notice-actions {
            display: flex;
            gap: 10px;
        }
        
        .btn-download {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 20px;
            background: var(--accent-color);
            color: white;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-download:hover {
            background: #ea580c;
            transform: translateY(-2px);
        }
        
        .new-badge {
            background: var(--danger-color);
            color: white;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 700;
            animation: pulse 2s infinite;
        }
    </style>
</head>
<body>
    <div class="page-header">
        <h1><i class="fas fa-clipboard"></i> News & Notices</h1>
        <p>Stay updated with latest announcements</p>
    </div>
    
    <div class="container">
        <div class="notices-list">
            <?php foreach ($notices as $notice): ?>
            <div class="notice-item">
                <div class="notice-header">
                    <span class="notice-date">
                        <i class="fas fa-calendar-alt"></i>
                        <?php echo date('d M Y', strtotime($notice['date'])); ?>
                    </span>
                    <?php if ($notice['is_new']): ?>
                    <span class="new-badge">NEW</span>
                    <?php endif; ?>
                </div>
                
                <h3 class="notice-title"><?php echo htmlspecialchars($notice['title']); ?></h3>
                
                <?php if ($notice['file_url']): ?>
                <div class="notice-actions">
                    <a href="<?php echo $notice['file_url']; ?>" target="_blank" class="btn-download">
                        <i class="fas fa-file-pdf"></i> View Notice
                    </a>
                    <a href="<?php echo $notice['file_url']; ?>" download class="btn-download">
                        <i class="fas fa-download"></i> Download
                    </a>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div style="text-align: center; margin-top: 40px;">
            <a href="index.php" class="btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Home
            </a>
        </div>
    </div>
    
    <br><br>
</body>
</html>
