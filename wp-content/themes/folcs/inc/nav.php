<?php
    if( get_post_type() === 'upcoming' ):
        $hasnav = true;
        $navtype = 'Upcoming Events';
        $navurl = "/#upcoming-events";
    elseif ( get_post_type() === 'past' ):
        $hasnav = true;
        $navtype = 'Past Events';
        $navurl = "/past-events";
    elseif ( get_post_type() === 'blog' ):
        $hasnav = true;
        $navtype = 'Blog';
        $navurl = "/blog";
    elseif ( get_queried_object()->post_name === 'event-series' ):
        $eventseries = true;
    endif;

    $events = wp_count_posts( 'upcoming' )->publish;
?>
<nav<?php if($hasnav){ echo ' class="has-type"'; } ?>>
    <div class="nav">
    <div class="nav-reverse">
	<div class="nav-logo">
       <a href="/"><img src="<?php echo get_template_directory_uri(); ?>/images/logo-folcs-wht.png" alt="FOLCS" class="nav-logo-wht"><img src="<?php echo get_template_directory_uri(); ?>/images/logo-folcs-blk.png" alt="FOLCS" class="nav-logo-blk"></a>
	</div>
    <?php if($hasnav): ?>
    <div class="nav-type-section type-section">
        <a href="<?php echo $navurl; ?>" class="nav-return"><span><?php echo $navtype; ?></span></a>
    </div>
    <?php endif; ?>
    <?php if($eventseries): ?>
        <div class="nav-event-series">
            <div class="event-series-filter type-link color-dark js-event-series">
                Go To Event Series

                <div class="filter-menu-icon">
                    <svg viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet" focusable="false" class="style-scope more-icon" style="pointer-events: none; display: block; width: 100%; height: 100%;">
                        <g class="style-scope more-icon">
                            <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z" class="style-scope more-icon"></path>
                          </g>
                      </svg>
                </div>
            </div>
            <div class="event-series-filters js-series-filters">
                <ul>
                    <li data-filter="conversations"><a href="/event-series/conversations/">Conversations</a></li>
                    <li data-filter="film-series"><a href="/event-series/film-series/">Film Series</a></li>
                    <li data-filter="trials-and-error"><a href="/event-series/trials-and-error/">Trials &amp; Error</a></li>
                    <li data-filter="virtual-film-club"><a href="/event-series/virtual-film-club/">Virtual Film Club</a></li>
                    <li data-filter="law-of-the-land"><a href="/event-series/law-of-the-land/">Law of the Land</a></li>
                    <li data-filter="theater-of-law"><a href="/event-series/theater-of-law/">Theater of Law</a></li>
                    <li data-filter="ISFC"><a href="/event-series/ISFC/">International Short<br>Film Competition</a></li>
                </ul>
            </div>
        </div>
    <?php endif; ?>
	<div class="nav-menu-icon js-nav-menu">
	    <span class="lines"></span>
	</div>
    <div class="main-menu js-main-menu">
        <div class="vertical-container">
            <div class="vertical-content">
                <div class="container">
                    <ul>
                        <li><a href="/#upcoming-events" class="nav-item-upcoming-events js-nav-upcoming-events">Upcoming Events<?php echo ($events > 0) ? '<sup>&nbsp;'.$events.'</sup>' : '' ?></a></li>
                        <li><a href="/event-series" class="nav-item-event-series">Event Series</a></li>
                        <li><a href="/past-events" class="nav-item-past-events">Past Events</a></li>
                        <li><a href="/blog" class="nav-item-blog">Blog</a></li>
                        <li><a href="/become-a-member" class="nav-item-become-a-member">Become a Member</a></li>
                        <li><a href="/donate" class="nav-item-donate">Donate</a></li>
                        <li>
                            <div class="type-link">
                                <a href="/leadership" class="nav-item-leadership">Leadership</a> <a href="/in-the-press" class="nav-item-in-the-press">In the Press</a> <a href="/about" class="nav-item-about">About</a> <a href="/contact" class="nav-item-contact">Contact</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
</nav>