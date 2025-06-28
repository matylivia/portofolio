<?php
// Sertakan file koneksi database
require 'db.php';

// Ambil data untuk setiap seksi dari database
$about = $pdo->query("SELECT * FROM about LIMIT 1")->fetch();
$skills = $pdo->query("SELECT * FROM skills ORDER BY id")->fetchAll();
$experiences = $pdo->query("SELECT * FROM experience ORDER BY id DESC")->fetchAll();
$articles = $pdo->query("SELECT * FROM articles ORDER BY id")->fetchAll();
$projects = $pdo->query("SELECT * FROM projects ORDER BY id")->fetchAll();
$activities = $pdo->query("SELECT * FROM activity ORDER BY id DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio - Rahmat Ramadhan</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header class="header">
        <a href="#home" class="logo">Rahmat <span>Ramadhan</span></a>
        <i class='bx bx-menu' id="menu-icon"></i>
        <nav class="navbar">
            <a href="#home" class="active">Home</a>
            <a href="#about">About</a>
            <a href="article.php">Article</a>
            <a href="#projects">Projects</a>
            <a href="#contact">Contact</a>
        </nav>
        <a href="#contact" class="gradient-btn">Contact Me</a>
    </header>

    <section class="hero" id="home">
        <div class="hero-image">
            <img src="./img/p.png" alt="Rahmat Ramadhan" class="hero-logo">
        </div>
    </section>
    
    <?php if ($about): ?>
    <section class="about" id="about">
        <div class="about-header">
            <h2 class="about-title">About</h2>
        </div>
        <div class="about-container">
            <div class="about-content">
                <div class="about-text">
                    <h2 class="section-heading">I'am <span>Rahmat Ramadhan</span></h2>
                    <p class="about-intro"><?php echo nl2br(htmlspecialchars($about['intro'])); ?></p>
                    <p class="about-details"><?php echo nl2br(htmlspecialchars($about['details'])); ?></p>
                    
                    <div class="skills-progress">
                        <h3 class="skills-title">My Skills</h3>
                        <?php foreach ($skills as $skill): ?>
                        <div class="progress-bar">
                            <div class="progress-label"><?php echo htmlspecialchars($skill['name']); ?></div>
                            <div class="progress-track">
                                <div class="progress-fill" style="width: <?php echo htmlspecialchars($skill['percentage']); ?>%"></div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <div class="about-image">
                    <div class="image-wrapper">
                        <img src="./img/<?php echo htmlspecialchars($about['image']); ?>" alt="Rahmat Ramadhan">
                        <div class="image-decoration"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <section class="experience" id="experience">
        <div class="experience-header">
            <h2 class="experience-title">Experience</h2>
        </div>
        <div class="experience-container">
            <?php foreach ($experiences as $exp): ?>
            <div class="experience-item">
                <div class="experience-date"><?php echo htmlspecialchars($exp['date']); ?></div>
                <div class="experience-content">
                    <h3><?php echo htmlspecialchars($exp['title']); ?></h3>
                    <p><?php echo nl2br(htmlspecialchars($exp['description'])); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="article" id="article">
        <div class="projects-header">
            <h2 class="projects-title">Articles</h2>
        </div>
        <div class="portfolio-container article-container">
            <?php foreach ($articles as $index => $article): ?>
            <div class="portfolio-item article-item" data-project="<?php echo $index + 1; ?>">
                <div class="project-image">
                    <i class="bx <?php echo htmlspecialchars($article['icon_class'] ?? 'bxl-figma'); ?> article-icon"></i>
                </div>
                <div class="project-info">
                    <div class="number">0<?php echo $index + 1; ?></div>
                    <div class="project-title"><?php echo htmlspecialchars($article['title']); ?></div>
                    <a href="article.php#<?php echo htmlspecialchars($article['link_id']); ?>" class="project-btn">Read Article</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="projects" id="projects">
        <div class="projects-header">
            <h2 class="projects-title">Projects</h2>
        </div>
        <div class="projects-container">
            <div class="portfolio-container">
                <?php foreach ($projects as $index => $project): ?>
                <div class="portfolio-item project-<?php echo ($index % 4) + 1; ?>" data-project="<?php echo $index + 1; ?>">
                    <div class="project-image">
                        <img src="./img/<?php echo htmlspecialchars($project['image']); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>">
                    </div>
                    <div class="project-info">
                        <div class="number">0<?php echo $index + 1; ?></div>
                        <div class="project-title"><?php echo htmlspecialchars($project['title']); ?></div>
                        <div class="project-desc"><?php echo htmlspecialchars($project['description']); ?></div>
                        <a href="project.php?id=<?php echo $project['id']; ?>" class="project-btn">View Project</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="experience" id="experience">
        <div class="experience-header">
            <h2 class="experience-title">Experience</h2>
        </div>
        <div class="experience-container">
            <?php
            $experiences_stmt = $pdo->query("SELECT * FROM experience ORDER BY id DESC");
            $experiences = $experiences_stmt->fetchAll();
            foreach ($experiences as $exp):
            ?>
            <div class="experience-item">
                <div class="experience-date"><?php echo htmlspecialchars($exp['date']); ?></div>
                <div class="experience-content">
                    <h3><?php echo htmlspecialchars($exp['title']); ?></h3>
                    <p><?php echo nl2br(htmlspecialchars($exp['description'])); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="activity" id="activity">
        <div class="activity-header">
            <h2 class="activity-title">Activity</h2>
        </div>
        <div class="activity-container">
             <?php
            $activities_stmt = $pdo->query("SELECT * FROM activity ORDER BY id DESC");
            $activities = $activities_stmt->fetchAll();
            foreach ($activities as $act):
            ?>
            <div class="activity-item">
                <div class="activity-date"><?php echo htmlspecialchars($act['date']); ?></div>
                <div class="activity-content">
                    <h3><?php echo htmlspecialchars($act['title']); ?></h3>
                    <h4><?php echo htmlspecialchars($act['place']); ?></h4>
                    <p><?php echo nl2br(htmlspecialchars($act['description'])); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="contact" id="contact">
        <div class="contact-header">
            <h2 class="contact-title">Contact</h2>
        </div>
        <div class="contact-container">
            <form id="contactForm" class="contact-form" action="send_message.php" method="POST">
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" required>
                    <div class="error-message" id="nameError"></div>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                    <div class="error-message" id="emailError"></div>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" required>
                    <div class="error-message" id="phoneError"></div>
                </div>
                <div class="form-group">
                    <label for="message">Your Message</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                    <div class="error-message" id="messageError"></div>
                </div>
                <button type="submit" class="submit-btn">Send Message</button>
            </form>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-info">
            <div class="info-item">
                <i class='bx bx-envelope'></i>
                <span>rahmat10535@gmail.com</span>
            </div>
            <div class="info-item">
                <i class='bx bx-phone'></i>
                <span>+62 852 6400 3242</span>
            </div>
            <div class="info-item">
                <i class='bx bx-map'></i>
                <span>Batam, Indonesia</span>
            </div>
        </div>
        <div class="footer-copyright">
            &copy; 2024 Rahmat Ramadhan. All Rights Reserved.
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>