<?php
require_once 'db_connect.php';

// Fetch all courses for the home page
$course_stmt = $pdo->query("SELECT * FROM courses");
$courses = $course_stmt->fetchAll();

// Check if a course is selected
$selected_course_id = isset($_GET['course_id']) ? (int)$_GET['course_id'] : null;
$videos = [];
$current_course_name = "";

if ($selected_course_id) {
    // Fetch videos for the selected course
    $video_stmt = $pdo->prepare("SELECT * FROM videos WHERE course_id = ?");
    $video_stmt->execute([$selected_course_id]);
    $videos = $video_stmt->fetchAll();

    // Fetch current course name
    foreach ($courses as $course) {
        if ($course['id'] == $selected_course_id) {
            $current_course_name = $course['course_name'];
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeLearn | Red Edition</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <nav>
            <a href="index.php" class="logo">CodeLearn</a>
        </nav>
    </header>

    <main class="container">
        <?php if (!$selected_course_id): ?>
            <!-- HOME PAGE: Course Selection -->
            <section class="hero">
                <h1>Unlock Your Coding Potential</h1>
                <p>Curated 1M+ views programming excellence. Choose your discipline and start your journey today.</p>
            </section>

            <div class="card-grid">
                <?php foreach ($courses as $course): ?>
                    <div class="card">
                        <div class="image-container">
                            <img src="<?php echo htmlspecialchars($course['image_url']); ?>" alt="<?php echo htmlspecialchars($course['course_name']); ?>">
                        </div>
                        <div class="info">
                            <h2 class="title"><?php echo htmlspecialchars($course['course_name']); ?> Specialization</h2>
                            <a href="index.php?course_id=<?php echo $course['id']; ?>" class="btn-watch">Start Learning</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php else: ?>
            <!-- COURSE PAGE: Video Selection -->
            <div style="margin-top: 3rem;">
                <a href="index.php" class="back-link">← All Courses</a>
                
                <h2 style="font-size: 2.5rem; font-weight: 900; color: var(--text-primary); margin-bottom: 3rem; text-transform: uppercase; border-left: 8px solid var(--primary-red); padding-left: 1.5rem;">
                    <?php echo htmlspecialchars($current_course_name); ?>
                </h2>
                
                <div class="card-grid">
                    <?php if (empty($videos)): ?>
                        <p style="color: var(--text-secondary);">No premium tutorials found for this course yet.</p>
                    <?php else: ?>
                        <?php foreach ($videos as $video): ?>
                            <a href="<?php echo htmlspecialchars($video['video_url']); ?>" target="_blank" class="card">
                                <div class="image-container">
                                    <img src="<?php echo htmlspecialchars($video['thumbnail_url']); ?>" alt="<?php echo htmlspecialchars($video['title']); ?>">
                                </div>
                                <div class="info">
                                    <h3 class="title"><?php echo htmlspecialchars($video['title']); ?></h3>
                                    <div class="stats">
                                        <span>👁️ <?php echo number_format($video['view_count']); ?></span>
                                        <span>👍 <?php echo number_format($video['likes']); ?></span>
                                    </div>
                                    <span class="btn-watch" style="margin-top: 1.5rem;">Watch on YouTube</span>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> CodeLearn. Premium Education for the Driven.</p>
    </footer>

</body>
</html>
