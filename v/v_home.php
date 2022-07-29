<section class="s-bricks">

    <div class="masonry">
        <div class="bricks-wrapper h-group">

            <div class="grid-sizer"></div>

            <?foreach($articles as $article):?>
                <article class="brick entry format-standard animate-this">

                    <div class="entry__thumb">
                        <a href="index.php?c=post&id_article=<?=$article['id_article']?>" class="thumb-link">
                            <img src="assets/images/thumbs/masonry/beetle-600.jpg" 
                                srcset="assets/images/thumbs/masonry/beetle-600.jpg 1x, assets/images/thumbs/masonry/beetle-1200.jpg 2x" alt="">
                        </a>
                    </div> <!-- end entry__thumb -->

                    <div class="entry__text">
                        <div class="entry__header">

                            <div class="entry__meta">
                                <span class="entry__cat-links">
                                    <a href="#"><?=$article['category_name']?></a>
                                </span>
                            </div>

                            <h1 class="entry__title"><a href="/c/c_post.php?id_article=<?=$article['id_article']?>"><?=$article['title']?></a></h1>
                            
                        </div>
                        <div class="entry__excerpt">
                            <p>
                            <?=$article['excerpt']?>
                            </p>
                        </div>
                    </div> <!-- end entry__text -->

                </article> <!-- end article -->
            <?endforeach?>


        </div> <!-- end brick-wrapper --> 
    </div> <!-- end masonry -->


</section> <!-- end s-bricks -->
    
