<footer class="site-footer">
    <div class="container footer-grid">
        <div>
            <h3><?php echo e($siteName ?? 'School Website'); ?></h3>
            <p><?php echo e($settings['school_tagline'] ?? 'Learning with Purpose and Heart'); ?></p>
        </div>
        <div>
            <h4>Contact</h4>
            <ul>
                <li><?php echo e($settings['school_address'] ?? 'Address not set yet'); ?></li>
                <li><?php echo e($settings['school_phone'] ?? 'Phone not set yet'); ?></li>
                <li><?php echo e($settings['school_email'] ?? 'Email not set yet'); ?></li>
            </ul>
        </div>
        <div>
            <h4>Quick Links</h4>
            <ul>
                <li><a href="<?php echo e(siteUrl()); ?>">Home</a></li>
                <li><a href="<?php echo BASE_URL; ?>/news.php">News</a></li>
                <li><a href="<?php echo BASE_URL; ?>/contact.php">Contact</a></li>
            </ul>
        </div>
    </div>
    <div class="container footer-bottom">
        <p>© <?php echo e(currentYear()); ?> <?php echo e($siteName ?? 'School Website'); ?>. All rights reserved.</p>
    </div>
</footer>
<script src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
</body>
</html>
